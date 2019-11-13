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
		header("Location: ../login.php");
		die();
	} else if ($mostraFunc["CD_Nivel"] == 2) {
		
	}
	
	function verifica_CPF($valor) //987767546543
	{

		$n[1] = substr($valor,0,1);
		$n[2] = substr($valor,1,1);
		$n[3] = substr($valor,2,1);
		$n[4] = substr($valor,4,1);
		$n[5] = substr($valor,5,1);
		$n[6] = substr($valor,6,1);
		$n[7] = substr($valor,8,1);
		$n[8] = substr($valor,9,1);
		$n[9] = substr($valor,10,1);
		$n[10] = substr($valor,12,1);
		$n[11] = substr($valor,13,1);
		
		$soma1 = ($n[1] * 10 +
				  $n[2] *  9 +
				  $n[3] *  8 +
				  $n[4] *  7 +
				  $n[5] *  6 +
				  $n[6] *  5 +
				  $n[7] *  4 +
				  $n[8] *  3 +
				  $n[9] *  2 );
				  
		$d1 = 11 - ($soma1 % 11);
		
		if( $d1 == 10 or $d1 == 11)
		{
			$d1 = 0;
		}
		
		$soma2 = ($n[1] * 11 +
				  $n[2] * 10 +
				  $n[3] *  9 +
				  $n[4] *  8 +
				  $n[5] *  7 +
				  $n[6] *  6 +
				  $n[7] *  5 +
				  $n[8] *  4 +
				  $n[9] *  3 +
				  $d1   *  2 );
				  
		$d2 = 11 - ($soma2 % 11);
		
		if( $d2 == 10 or $d2 == 11)
		{
			$d2 = 0;
		}
		
		if(($d1 <> $n[10]) or ($d2 <> $n[11]) or $valor == "000.000.000-00" or $valor == "111.111.111-11" or $valor == "222.222.222-22" or $valor == "333.333.333-33" or $valor == "444.444.444-44" or $valor == "555.555.555-55" or $valor == "666.666.666-66" or $valor == "777.777.777-77" or $valor == "888.888.888-88" or $valor == "999.999.999-99")
		{
			$erro = true;
		}
		else
		{
			$erro = false;
		}
		return $erro;
	}

	//TIPO
	if( !isset($_POST["tipo"]) ){
		header("Location: alterarFunc.php");
		die();
	} else {
		$tipo = $_POST["tipo"];
		$_SESSION["tipo"] = $tipo;
	}

	//CPF
	if( !isset($_POST["cpf"]) ){
		$_SESSION["cadastroFuncErro"] = "Digite o CPF.";
		header("Location: alterarFunc.php");
		die();
	} else {
		$cpfF = $_POST["cpf"];
		$_SESSION["cpfF"] = $cpfF;
	}

	//NOME
	if( !isset($_POST["nome"]) ){
		$_SESSION["cadastroFuncErro"] = "Digite o Nome.";
		header("Location: alterarFunc.php");
		die();
	} else {
		$nome = $_POST["nome"];
		$_SESSION["nome"] = $nome;
	}

	//SEXO
	if( !isset($_POST["sexo"]) ){
		$_SESSION["cadastroFuncErro"] = "Selecione o sexo.";
		header("Location: alterarFunc.php");
		die();
	} else {
		$sexo = $_POST["sexo"];
	}

	//UBS
	if( $_POST["ubs"] == "" ){
		$_SESSION["cadastroFuncErro"] = "Selecione a Unidade Básica de Saúde. " . $_POST["ubs"];
		header("Location: alterarFunc.php");
		die();
	} else {
		$ubs = $_POST["ubs"];
	}

	if($tipo == 1 || $tipo == 2) {
		//SENHA
		if( !isset($_POST["senha"]) ){
			$_SESSION["cadastroFuncErro"] = "Digite a Senha.";
			header("Location: alterarFunc.php");
			die();
		} else {
			$senha = $_POST["senha"];
		}

		//CONFIRMA SENHA
		if( !isset($_POST["senhaCon"]) ){
			$_SESSION["cadastroFuncErro"] = "Confirme a Senha.";
			header("Location: alterarFunc.php");
			die();
		} else {
			$senhaCon = $_POST["senhaCon"];
		}

		//VALIDA SENHA
		if( $senha == $senhaCon ){

		} else {
			$_SESSION["cadastroFuncErro"] = "As senhas não correspondem.";
			header("Location: alterarFunc.php");
			die();
		}
	}

	if ($tipo == 3) {
		//CRM
		if( !isset($_POST["crm"]) ){
			$_SESSION["cadastroFuncErro"] = "Digite o CRM.";
			header("Location: alterarFunc.php");
			die();
		} else {
			$crm = $_POST["crm"];
			$_SESSION["crm"] = $crm;
		}

		//ESPECIALIDADE
		if( !isset($_POST["especialidade"]) ){
			$_SESSION["cadastroFuncErro"] = "Digite a especialidade.";
			header("Location: alterarFunc.php");
			die();
		} else {
			$especialidade = $_POST["especialidade"];
			$_SESSION["especialidade"] = $especialidade;
		}
	}

	if ($tipo == 4) {
		//COREN
		if( !isset($_POST["coren"]) ){
			$_SESSION["cadastroFuncErro"] = "Digite o COREN.";
			header("Location: alterarFunc.php");
			die();
		} else {
			$coren = $_POST["coren"];
			$_SESSION["coren"] = $coren;
		}
	}

	//VERIFICA CPF
	if(verifica_CPF($cpfF))
	{
		$_SESSION["cadastroFuncErro"] = "CPF inválido.";
		header("Location: alterarFunc.php");
		die();
	}


	if ($tipo == 1){
		$tpF = "Recepcionista";
		$upPac = mysqli_query($conn, "UPDATE Funcionario SET NM_Funcionario = '$nome', NM_Senha = '$senha', NM_Sexo = '$sexo', ID_Ubs = '$ubs' WHERE NR_Cpf = '$cpfF'") or die(mysqli_error($conn));
	}

	if ($tipo == 2){
		$upPac = mysqli_query($conn, "UPDATE Funcionario SET NM_Funcionario = '$nome', NM_Senha = '$senha', NM_Sexo = '$sexo', ID_Ubs = '$ubs' WHERE NR_Cpf = '$cpfF'") or die(mysqli_error($conn));
		$tpF = "Chefe de UBS";
	}

	if ($tipo == 3){
		$upPac = mysqli_query($conn, "UPDATE Medico SET NM_Medico = '$nome', NM_Sexo = '$sexo', ID_Ubs = '$ubs', DS_Especialidade = '$especialidade', NR_Crm = '$crm' WHERE NR_Cpf = '$cpfF'") or die(mysqli_error($conn));
		$tpF = "Médico";
	}

	if ($tipo == 4){
		$upPac = mysqli_query($conn, "UPDATE Enfermeiro SET NM_Enfermeiro = '$nome', NM_Sexo = '$sexo', ID_Ubs = '$ubs', NR_Coren = '$coren' WHERE NR_Cpf = '$cpfF'") or die(mysqli_error($conn));
		$tpF = "Enfermeiro";
	}
	
	//$resultPront = mysqli_num_rows($queryPront);
	//$mostraPacPront = mysqli_fetch_array($queryPront);
	//if ($resultPront > 0){
	//	$_SESSION["cadastroProntErro"] = $mostraPacPront["NM_Paciente"] . " portador do CPF " . $mostraPacPront["NR_Cpf"] . " já está cadastrado no Prontuário " . $mostraPacPront["ID_Prontuario"] . ".";
	//	header("Location: cadastroProntuario.php");
	//	die();
	//}
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
	<script type="text/javascript">
	function habilita() {
		var habilita = document.getElementById('email');
		if (habilita.value != ""){
			document.getElementById('senha').disabled = true;
		} else {
			document.getElementById('senha').disabled = false;
		}
	};
	</script>
</head>
<body onload="habilita();">
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
					<h1 class="text-center">Funcionario alterado com sucesso.</h1>	
					<center>
						<div class="row">
							<?php 
								UNSET($_SESSION["cpfF"]);
								UNSET($_SESSION["nome"]);
								UNSET($_SESSION["tipo"]);
								echo "<br><br><br><h4 style='font-weight: 300;''>" . $nome . " portador do CPF " . $cpfF . " foi alterado com sucesso como " . $tpF . ".</h4><br>";
							?>
						</div>
						<div class="row">
							<div class="col-xs-12 btnSucesso">
							<a class="btn btn-default" href="gerenciarFunc.php" role="button">Gerenciar Funcionários</a>
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