<?php  
	include_once("../conexao.php");
	session_start();
	if(!isset($_SESSION["cpf"]) || !isset($_SESSION["senha"])) {
		$_SESSION["loginErro"] = "CPF ou Senha inválido.";
		header("Location: ../login.php");
		die();
	} else {
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
	}
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
									<a href="gerenciarAgenda.php"><li class="list-group-item">Alterar</li></a>
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
					echo $mostraFunc["NM_Funcionario"] . ".";
				?>
				</span>
				<a href="../sair.php">Sair</a>
			</div>
			<div class="col-xs-9 col-xs-offset-3 text-justify fMain">
				<div class="col-xs-12 branco sombra cadastroPront">
					<h1 class="text-center">Cadastro de Especialidade Médica</h1>
					<?php
						if(isset($_SESSION["cadastroConsultErro"])){
							echo "<p class='text-center text-danger' style='font-size:1.4em; margin:12px 0 0 0;'>" . $_SESSION["cadastroConsultErro"] . "</p>";
							unset($_SESSION["cadastroConsultErro"]);
						}
					?>
					<form action="valida-consulta.php" method="POST">
						<h2>Dados da Especialidade</h2>
						<div class="row">
							<div class="col-xs-12">
								<div class="form-group">
									<label for="nomeConsult">Nome</label>
									<input type="text" class="form-control" id="nomeConsult" name="nomeConsulta" autocomplete="off" placeholder="Nome" value="<?php echo @$_SESSION["nomeConsulta"]; unset($_SESSION['nomeConsulta']); ?>" required>
								</div>
							</div>							
						</div>		
						<div class="row">
							<div class="col-xs-6">
								<div class="form-group">
									<label for="nomeConsult">Nome do Médico</label>
									<select class="form-control" id="nomeMedico" name="nmMe" placeholder="Nome">
										<option value="NULL" selected>Nenhum ...</option>
										<?php  
											$selectMedico = mysqli_query($conn, "SELECT NR_Cpf, NM_Medico FROM Medico") or die(mysqli_error($conn));
											$resultMed = mysqli_num_rows($selectMedico);						
											while($mostraMedico = mysqli_fetch_array($selectMedico)) {
												echo "<option value='" . $mostraMedico["NR_Cpf"] . "'>" . $mostraMedico["NM_Medico"] . "</option>"; 
											}
										?>
									</select>
								</div>
							</div>	
							<div class="col-xs-6">
								<div class="form-group">
									<label for="nomeConsult">Nome do Enfermeiro</label>
									<select class="form-control" id="nomeEnfermeiro" name="nmEm" placeholder="Nome">
										<option value="NULL" selected>Nenhum ...</option>
										<?php  
											$selectEnfermeiro = mysqli_query($conn, "SELECT NR_Cpf, NM_Enfermeiro FROM Enfermeiro") or die(mysqli_error($conn));
											$resultEnf = mysqli_num_rows($selectEnfermeiro);						
											while($mostraEnf = mysqli_fetch_array($selectEnfermeiro)) {
												echo "<option value='" . $mostraEnf["NR_Cpf"] . "'>" . $mostraEnf["NM_Enfermeiro"] . "</option>"; 
											}
										?>
									</select>
								</div>
							</div>
						</div>
						<br>
						<div class="row">
							<div class="col-xs-6">
									<div class="form-group">
									<label>Horário da Consulta</label>
									<br>Inicio do Atendimento:
									<input type="time" class="form-control" maxlength="5" id="iCon" placeholder="Inicio do Atendimento" autocomplete="off" value="<?php echo @$_SESSION["inicioCon"]; unset($_SESSION['inicioCon']); ?>" name="inicioCon" required>
									<br>Fim do Atendimento:
									<input type="time" class="form-control" maxlength="5" id="fCon" placeholder="Fim do Atendimento" autocomplete="off" value="<?php echo @$_SESSION["fimCon"]; unset($_SESSION['fimCon']); ?>" name="fimCon" required>
								</div>
							</div>
							<div class="col-xs-6">
								<div class="form-group">
									<label>Dias da Semana</label>
									<div class="checkbox">
										<label>
											<input type="checkbox" value="1" name="segunda"> Segunda-Feira
										</label>
									</div>
									<div class="checkbox">
										<label>
											<input type="checkbox" value="1" name="terca"> Terça-Feira
										</label>
									</div>
									<div class="checkbox">
										<label>
											<input type="checkbox" value="1" name="quarta"> Quarta-Feira
										</label>
									</div>
									<div class="checkbox">
										<label>
											<input type="checkbox" value="1" name="quinta"> Quinta-Feira
										</label>
									</div>
									<div class="checkbox">
										<label>
											<input type="checkbox" value="1" name="sexta"> Sexta-Feira
										</label>
									</div>
								</div>
							</div>																		
						</div>		
						<div class="row rowBtn">
							<div class="col-xs-12">				
								<button type="submit" class="btn btn-primary" id="concluirPront">Concluir</button>
							</div>
						</div>			
					</form>
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