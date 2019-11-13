<?php  
	include_once("../conexao.php");
	session_start();
	if(!isset($_SESSION["cpf"]) || !isset($_SESSION["senha"])) {
		$_SESSION["loginErro"] = "CPF ou Senha inválido.";
		header("Location: ../login.php");
		die();
	}
	$cpf = $_SESSION["cpf"];
	$sql = mysqli_query($conn, "SELECT * FROM Funcionario WHERE NR_Cpf = '$cpf'") or die(mysqli_error($conn));
	$mostraFunc = mysqli_fetch_array($sql);
	if ($mostraFunc["CD_Nivel"] == 0) {
		header("Location: ../login.php");
		die();
	} else if ($mostraFunc["CD_Nivel"] == 1) {
		
	} else if ($mostraFunc["CD_Nivel"] == 2) {
		header("Location: ../login.php");
		die();
	}
	$ubs = $mostraFunc['ID_Ubs'];
	$cd = $_POST["cd"];
	

	if( $_POST["nomeConsulta"] == "" ){
		$_SESSION["cadastroConsultErro"] = "Digite o nome da consulta.";
		header("Location: cadastrarConsulta.php");
		die();
	} else {
		$nmConsulta = $_POST["nomeConsulta"];
		$_SESSION["nomeConsulta"] = $nmConsulta;
	}

	if( !isset($_POST["nmMe"]) and !isset($_POST["nmEm"])){
		$_SESSION["cadastroConsultErro"] = "Preencha com pelo menos um médico ou enfermeiro.";
		header("Location: cadastrarConsulta.php");
		die();
	} else {
		$nmMedico = $_POST["nmMe"];
		if($nmMedico != "NULL"){
			$nmMedico = "'" . $nmMedico . "'";
		}
		$nmEnfermeiro = $_POST["nmEm"];
		if($nmEnfermeiro != "NULL"){
			$nmEnfermeiro = "'" . $nmEnfermeiro . "'";
		}
	}

	if( !isset($_POST["inicioCon"])){
		$_SESSION["cadastroConsultErro"] = "Digite o horário inicial do atendimento a está consulta.";
		header("Location: cadastrarConsulta.php");
		die();
	} else {
		$inicioCon = $_POST["inicioCon"];
		$_SESSION["inicioCon"] = $inicioCon;
	}

	if( !isset($_POST["fimCon"])){
		$_SESSION["cadastroConsultErro"] = "Digite o horário final do atendimento a está consulta.";
		header("Location: cadastrarConsulta.php");
		die();
	} else {
		$fimCon = $_POST["fimCon"];
		$_SESSION["fimCon"] = $fimCon;
	}

	if( !isset($_POST["segunda"]) && !isset($_POST["terca"]) && !isset($_POST["quarta"]) && !isset($_POST["quinta"]) && !isset($_POST["sexta"])){
		$_SESSION["cadastroConsultErro"] = "Escolha pelo menos um dia da semana.";
		header("Location: cadastrarConsulta.php");
		die();
	} else {
		$domingo = 0;
		if (!isset($_POST["segunda"])){
			$segunda = 0;
		} else {
			$segunda = 1;
		}
		if (!isset($_POST["terca"])){
			$terca = 0;
		} else {
			$terca = 1;
		}
		if (!isset($_POST["quarta"])){
			$quarta = 0;
		} else {
			$quarta = 1;
		}
		if (!isset($_POST["quinta"])){
			$quinta = 0;
		} else {
			$quinta = 1;
		}
		if (!isset($_POST["sexta"])){
			$sexta = 0;
		} else {
			$sexta = 1;
		}
		$sabado = 0;
		$semana = $domingo . $segunda . $terca . $quarta . $quinta . $sexta . $sabado;
	}

	$alteraCon = mysqli_query($conn, "UPDATE Consulta SET NM_Consulta = '$nmConsulta', HR_ConsultaInicio = '$inicioCon', HR_ConsultaFinal = '$fimCon', NM_DiasSemana = '$semana', ID_Funcionario = '$cpf', ID_Medico = $nmMedico, ID_Enfermeiro = $nmEnfermeiro WHERE CD_Consulta = '$cd'") or die(mysqli_error($conn));
?>
<!doctype html>
<html lang = "pt-br">
<head>
	<!-- META -->
	<meta http-equiv="content-type" content="text/html" charset="UTF-8">
	<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, minimum-scale=1.0, user-scalable=no">
	<title> Agende Saúde </title>
	<meta name="description" content="Site para realização de agendamentos em UBS's de Mongaguá.">
	<meta name="keywords" content="Saúde, UBS, Unidades Básicas de Saúde, Mongaguá, Agendamentos, Consultas">
	<meta name="robots" content="index, follow">
	<meta name="author" content="FINIS">
	<link rel="icon" type="image/png" href="../IMG/favicon.png"/>
	<link rel="shortcut icon" href="../IMG/favicon.ico" >
	<!-- FONT AWESOME -->
	<link rel="stylesheet" href="../css/font-awesome.min.css">
	<!-- FONT LATO -->
	<link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel="stylesheet">
	<!-- BOOTSTRAP CSS -->
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<!-- BOOTSTRAP THEME CSS -->
	<link rel="stylesheet" href="../css/bootstrap-theme.min.css">
	<!-- CSS/JS -->
	<link rel="stylesheet" type="text/css" href="../style.css"/>
	<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
</head>
<body>
	<div class="container-fluid fPrincipal">
		<div class="row fRow">
			<div class="col-xs-3 fMenuCol">
				<div class="col-xs-8 col-xs-offset-2">
					<a href="principalFunc.php"><img src="../IMG/ASLogo.png" alt=""></a>
				</div>
				<div class="col-xs-10 col-xs-offset-1" id="menuPesquisar">
					<div class="input-group">
						<input type="text" class="form-control" placeholder="Procurar ...">
						<span class="input-group-btn">
							<button class="btn btn-primary" type="button"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
						</span>
					</div>
				</div>
				<div class="col-xs-12 menuFunc">
					<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
						<div class="panel panel-primary panel-teste">
							<div class="panel-heading" role="tab" id="headingOne">
								<h4 class="panel-title">
									<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
										Prontuário
									</a>
								</h4>
							</div>
							<div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
								<ul class="list-group">
									<a href="cadastroProntuario.php"><li class="list-group-item">Cadastrar</li></a>
									<a href="gerenciarProntuario.php"><li class="list-group-item">Gerenciar</li></a>
								</ul>
							</div>
						</div>
						<div class="panel panel-primary">
							<div class="panel-heading" role="tab" id="headingTwo">
								<h4 class="panel-title">
									<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
										Especialidade Médica
									</a>
								</h4>
							</div>
							<div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
								<ul class="list-group">
									<a href="cadastrarConsulta.php"><li class="list-group-item">Cadastrar</li></a>
									<a href="gerenciarConsulta.php"><li class="list-group-item">Gerenciar</li></a>
								</ul>
							</div>
						</div>
						<div class="panel panel-primary">
							<div class="panel-heading" role="tab" id="headingThree">
								<h4 class="panel-title">
									<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
										Agendamento
									</a>
								</h4>
							</div>
							<div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
								<ul class="list-group">
									<a href="agendarNovo.php"><li class="list-group-item">Novo</li></a>
									<a href="gerenciarAgenda.php"><li class="list-group-item">Gerenciar</li></a>
								</ul>
							</div>
						</div>
						<div class="panel panel-primary">
							<div class="panel-heading" role="tab" id="headingFive">
								<h4 class="panel-title">
									<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
										Funcionários
									</a>
								</h4>
							</div>
							<div id="collapseFive" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFive">
								<ul class="list-group">
									<a href="cadastroFunc.php"><li class="list-group-item">Novo Funcionário</li></a>
									<a href="gerenciarFunc.php"><li class="list-group-item">Gerenciar Funcionário</li></a>
								</ul>
							</div>
						</div>
						<div class="panel panel-primary">
							<div class="panel-heading" role="tab" id="headingFour">
								<h4 class="panel-title">
									<a class="collapsed" role="button" href="relatorio.php">
										Relatório
									</a>
								</h4>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-9 col-xs-offset-3 fTopCol bg-primary">
				<span>Bem-vindo(a) 
				<?php 
					$cpf = $_SESSION["cpf"];
					$sql = mysqli_query($conn, "SELECT NR_Cpf, NM_Funcionario, CD_Nivel FROM Funcionario WHERE NR_Cpf = '$cpf'") or die(mysqli_error($conn));
					$mostraFunc = mysqli_fetch_array($sql);
					echo $mostraFunc["NM_Funcionario"] . ".";
				?>
				</span>
				<a href="../login.php">Sair</a>
			</div>
			<div class="col-xs-9 col-xs-offset-3 text-justify fMain">
				<div class="col-xs-12 branco sombra cadastroPront">
					<h1 class="text-center">Especialidade médica alterada com sucesso.</h1>	
					<center>
						<div class="row">
							<div class="col-xs-12">
								
							</div>
						</div>
						<div class="row">
							<?php 
								$_SESSION["nomeConsulta"] = "";
								$_SESSION["inicioCon"] = "";
								$_SESSION["fimCon"] = "";
							?>
							<div class="col-xs-12 btnSucesso">
							<a class="btn btn-default" href="gerenciarConsulta.php" role="button">Gerenciar Consulta</a>
								<a class="btn btn-default" href="principalFunc.php" role="button">Voltar para Inicio</a>
							</div>
						</div>
					</center>					
				</div>
			</div>
		</div>
	</div>
	<!-- JQUERY -->
	<script src="../js/jquery-3.1.0.min.js"></script>
	<!-- MASCARA CPF -->
	<script type="text/javascript" src="../js/jquery.mask.js"></script>
	<!-- BOOTSTRAP JS -->
	<script src="../js/bootstrap.min.js"></script>
	<!-- JS -->
	<script type="text/javascript" src="../js/js.js"></script>
</body>
</html>