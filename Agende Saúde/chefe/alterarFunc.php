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
		
	} else if ($mostraFunc["CD_Nivel"] == 2) {
		header("Location: ../login.php");
		die();
	}
	$cpfFunc = $_POST["alte"];
	$tipoFunc = $_POST["tipofunc"];
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
											Consulta
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
						echo $mostraFunc["NM_Funcionario"] . ".";
						?>
					</span>
					<a href="../sair.php">Sair</a>
				</div>
				<div class="col-xs-9 col-xs-offset-3 text-justify fMain">
					<div class="col-xs-12 branco sombra cadastroPront">
						<h1 class="text-center">Alterar Funcionário</h1>	
						<center>
							<h1>
								<small>
									<?php
										if($tipoFunc == "func"){
											$selectFuncio = mysqli_query($conn, "SELECT * FROM Funcionario WHERE NR_Cpf = '$cpfFunc'") or die(mysqli_error($conn));
											$mostraFuncio = mysqli_fetch_array($selectFuncio);
											$nomeF = $mostraFuncio["NM_Funcionario"]; 
											$tipoFunc = $mostraFuncio["NM_TipoFuncionario"];
											echo $nomeF;
											echo "<br>" . $tipoFunc; 
										} else if ($tipoFunc == "medico") {
											$selectFuncio = mysqli_query($conn, "SELECT * FROM Medico WHERE NR_Cpf = '$cpfFunc'") or die(mysqli_error($conn));
											$mostraFuncio = mysqli_fetch_array($selectFuncio);
											$nomeF = $mostraFuncio["NM_Medico"]; 
											$tipoFunc = "Medico";
											echo $nomeF;
											echo "<br>" . $tipoFunc; 
										} else if ($tipoFunc == "enfe") {
											$selectFuncio = mysqli_query($conn, "SELECT * FROM Enfermeiro WHERE NR_Cpf = '$cpfFunc'") or die(mysqli_error($conn));
											$mostraFuncio = mysqli_fetch_array($selectFuncio);
											$nomeF = $mostraFuncio["NM_Enfermeiro"]; 
											$tipoFunc = "Enfermeiro";
											echo $nomeF;
											echo "<br>" . $tipoFunc; 
										}
									?>
								</small>
							</h1>
							<?php
							if(isset($_SESSION["cadastroAlProntErro"])){
								echo "<p class='text-center text-danger' style='font-size:1.4em; margin:12px 0 0 0;'>" . $_SESSION["cadastroAlProntErro"] . "</p>";
								unset($_SESSION["cadastroAlProntErro"]);
							}
							?>
						</center>

						<?php 
						if ($tipoFunc == ""){

						} else if ($tipoFunc == "Recepcionista") {
							?>	
							<form action="valida-alterarFunc.php" method="POST">
								<input type="hidden" name="tipo" value="1">
								<h2>Dados Pessoais <small>(Recepcionista)</small></h2>
								<div class="row">
									<div class="col-xs-6">
										<div class="form-group">
											<label for="nome">Nome</label>
											<input type="text" class="form-control" id="nome" placeholder="Nome" autocomplete="off" name="nome" value="<?php echo $nomeF; ?>" required>
										</div>
									</div>
									<div class="col-xs-6">
										<div class="form-group" id="sexo1">
											<label for="sexo1">Sexo</label>
											<select class="form-control" name="sexo" required>
												<option value="" disabled>Escolha uma opção</option>
												<option value="Masculino" <?php if( $mostraFuncio["NM_Sexo"] == "Masculino"){ echo "selected"; } ?>>Masculino</option>
												<option value="Feminino" <?php if( $mostraFuncio["NM_Sexo"] == "Feminino"){ echo "selected"; } ?>>Feminino</option>
											</select>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-xs-6">
										<div class="form-group">
											<label for="cpf1">CPF</label>
											<input type="text" class="form-control simple-field-data-mask" maxlength="14" data-mask="000.000.000-00" id="cpf" placeholder="CPF" autocomplete="off" name="cpf" value="<?php echo $cpfFunc; ?>" required>
										</div>
									</div>
									<div class="col-xs-6">
										<div class="form-group">
											<label for="membroGrupo">Selecione a UBS do Funcionário:</label>
											<select id="membroGrupo" class="form-control" name="ubs" required>
												<option disabled selected>Selecione ...</option>
												<?php  
												$selectUbs 	= mysqli_query($conn, "SELECT CD_Ubs, NM_Ubs FROM Ubs") or die(mysqli_error($conn));
												$result 		= mysqli_num_rows($selectUbs);						
												while($mostraUbs = mysqli_fetch_array($selectUbs)) {
													if($mostraUbs["CD_Ubs"] == $mostraFuncio["ID_Ubs"]){
														echo "<option value='" . $mostraUbs["CD_Ubs"] . "' selected>" . $mostraUbs["NM_Ubs"] . "</option>"; 
													} else {
														echo "<option value='" . $mostraUbs["CD_Ubs"] . "'>" . $mostraUbs["NM_Ubs"] . "</option>"; 
													}													
												}
												?>
											</select>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-xs-6">
										<div class="form-group">
											<label for="sus1">Senha</label>
											<input type="password" class="form-control" id="senha" placeholder="Senha" autocomplete="off" name="senha" required>
										</div>
									</div>
									<div class="col-xs-6">
										<div class="form-group">
											<label for="sus1">Confirmar Senha</label>
											<input type="password" class="form-control" id="senha" placeholder="Senha" autocomplete="off" name="senhaCon" required>
										</div>
									</div>
								</div>
								<div class="row rowBtn">
									<div class="col-xs-12">		
										<div class="form-group">		
											<button type="submit" class="btn btn-primary" id="concluirPront">Concluir</button>
										</div>
									</div>	
								</div>
							</form>									
							<?php 
						} else if ($tipoFunc == "Chefe") {
							?>	
							<form action="valida-alterarFunc.php" method="POST">
								<input type="hidden" name="tipo" value="2">
								<h2>Dados Pessoais <small>(Chefe de UBS)</small></h2>
								<div class="row">
									<div class="col-xs-6">
										<div class="form-group">
											<label for="nome">Nome</label>
											<input type="text" class="form-control" id="nome" placeholder="Nome" autocomplete="off" name="nome" value="<?php echo $nomeF; ?>" required>
										</div>
									</div>
									<div class="col-xs-6">
										<div class="form-group" id="sexo1">
											<label for="sexo1">Sexo</label>
											<select class="form-control" name="sexo" required>
												<option value="" disabled>Escolha uma opção</option>
												<option value="Masculino" <?php if( $mostraFuncio["NM_Sexo"] == "Masculino"){ echo "selected"; } ?>>Masculino</option>
												<option value="Feminino" <?php if( $mostraFuncio["NM_Sexo"] == "Feminino"){ echo "selected"; } ?>>Feminino</option>
											</select>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-xs-6">
										<div class="form-group">
											<label for="cpf1">CPF</label>
											<input type="text" class="form-control simple-field-data-mask" maxlength="14" data-mask="000.000.000-00" id="cpf" placeholder="CPF" autocomplete="off" name="cpf" value="<?php echo $cpfFunc; ?>" required>
										</div>
									</div>
									<div class="col-xs-6">
										<div class="form-group">
											<label for="membroGrupo">Selecione a UBS do Funcionário:</label>
											<select id="membroGrupo" class="form-control" name="ubs" required>
												<option disabled selected>Selecione ...</option>
												<?php  
												$selectUbs 	= mysqli_query($conn, "SELECT CD_Ubs, NM_Ubs FROM Ubs") or die(mysqli_error($conn));
												$result 		= mysqli_num_rows($selectUbs);						
												while($mostraUbs = mysqli_fetch_array($selectUbs)) {
													if($mostraUbs["CD_Ubs"] == $mostraFuncio["ID_Ubs"]){
														echo "<option value='" . $mostraUbs["CD_Ubs"] . "' selected>" . $mostraUbs["NM_Ubs"] . "</option>"; 
													} else {
														echo "<option value='" . $mostraUbs["CD_Ubs"] . "'>" . $mostraUbs["NM_Ubs"] . "</option>"; 
													}													
												}
												?>
											</select>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-xs-6">
										<div class="form-group">
											<label for="sus1">Senha</label>
											<input type="password" class="form-control" id="senha" placeholder="Senha" autocomplete="off" name="senha" required>
										</div>
									</div>
									<div class="col-xs-6">
										<div class="form-group">
											<label for="sus1">Confirmar Senha</label>
											<input type="password" class="form-control" id="senha" placeholder="Senha" autocomplete="off" name="senhaCon" required>
										</div>
									</div>
								</div>
								<div class="row rowBtn">
									<div class="col-xs-12">		
										<div class="form-group">		
											<button type="submit" class="btn btn-primary" id="concluirPront">Concluir</button>
										</div>
									</div>	
								</div>
							</form>											
							<?php 
						} else if ($tipoFunc == "Diretora") {
							echo "<br><br><center><p style='font-size: 1.6em;'>Este tipo de Funcionário só pode ser alterado diretamente no Sistema.</p></center><br><br>";
						} else if ($tipoFunc == "Medico") {
							?>	
							<form action="valida-alterarFunc.php" method="POST">
								<input type="hidden" name="tipo" value="3">
								<h2>Dados Pessoais <small>(Médico)</small></h2>
								<div class="row">
									<div class="col-xs-6">
										<div class="form-group">
											<label for="nome1">Nome</label>
											<input type="text" class="form-control" id="nome" placeholder="Nome" autocomplete="off" name="nome" required value="<?php echo $nomeF; ?>">
										</div>
									</div>
									<div class="col-xs-6">
										<div class="form-group" id="sexo1">
											<label for="sexo1">Sexo</label>
											<select class="form-control" name="sexo" required>
												<option value="" disabled>Escolha uma opção</option>
												<option value="Masculino" <?php if( $mostraFuncio["NM_Sexo"] == "Masculino"){ echo "selected"; } ?>>Masculino</option>
												<option value="Feminino" <?php if( $mostraFuncio["NM_Sexo"] == "Feminino"){ echo "selected"; } ?>>Feminino</option>
											</select>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-xs-6">
										<div class="form-group">
											<label for="cpf1">CPF</label>
											<input type="text" class="form-control simple-field-data-mask" maxlength="14" data-mask="000.000.000-00" id="cpf" placeholder="CPF" autocomplete="off" name="cpf" value="<?php echo $cpfFunc; ?>" required>
										</div>
									</div>
									<div class="col-xs-6">
										<div class="form-group">
											<label for="sus1">CRM</label>
											<input type="text" class="form-control simple-field-data-mask" maxlength="10" data-mask="00000000-0" id="crm" placeholder="CRM" autocomplete="off" name="crm" required value="<?php echo $mostraFuncio["NR_Crm"]; ?>">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-xs-6">
										<div class="form-group">
											<label for="membroGrupo">Selecione a UBS do Médico:</label>
											<select id="membroGrupo" class="form-control" name="ubs" required>
												<option disabled selected>Selecione ...</option>
												<?php  
												$selectUbs 	= mysqli_query($conn, "SELECT CD_Ubs, NM_Ubs FROM Ubs") or die(mysqli_error($conn));
												$result 		= mysqli_num_rows($selectUbs);						
												while($mostraUbs = mysqli_fetch_array($selectUbs)) {
													if($mostraUbs["CD_Ubs"] == $mostraFuncio["ID_Ubs"]){
														echo "<option value='" . $mostraUbs["CD_Ubs"] . "' selected>" . $mostraUbs["NM_Ubs"] . "</option>"; 
													} else {
														echo "<option value='" . $mostraUbs["CD_Ubs"] . "'>" . $mostraUbs["NM_Ubs"] . "</option>"; 
													}	 
												}
												?>
											</select>
										</div>
									</div>
									<div class="col-xs-6">
										<div class="form-group">
											<label for="sus1">Especialidade</label>
											<input type="text" class="form-control simple-field-data-mask" id="esp" placeholder="Especialidade" autocomplete="off" name="especialidade" required value="<?php echo $mostraFuncio["DS_Especialidade"]; ?>">
										</div>
									</div>	
								</div>
								<div class="row rowBtn">
									<div class="col-xs-12">				
										<button type="submit" class="btn btn-primary" id="concluirPront">Concluir</button>
									</div>
								</div>	
							</form>									
							<?php 
						} else if ($tipoFunc == "Enfermeiro") {
							?>	
							<form action="valida-alterarFunc.php" method="POST">
								<input type="hidden" name="tipo" value="4">
								<h2>Dados Pessoais <small>(Enfermeiro)</small></h2>
								<div class="row">
									<div class="col-xs-6">
										<div class="form-group">
											<label for="nome1">Nome</label>
											<input type="text" class="form-control" id="nome" placeholder="Nome" autocomplete="off" name="nome" required value="<?php echo $nomeF; ?>">
										</div>
									</div>
									<div class="col-xs-6">
										<div class="form-group" id="sexo1">
											<label for="sexo1">Sexo</label>
											<select class="form-control" name="sexo" required>
												<option value="" disabled>Escolha uma opção</option>
												<option value="Masculino" <?php if( $mostraFuncio["NM_Sexo"] == "Masculino"){ echo "selected"; } ?>>Masculino</option>
												<option value="Feminino" <?php if( $mostraFuncio["NM_Sexo"] == "Feminino"){ echo "selected"; } ?>>Feminino</option>
											</select>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-xs-6">
										<div class="form-group">
											<label for="cpf1">CPF</label>
											<input type="text" class="form-control simple-field-data-mask" maxlength="14" data-mask="000.000.000-00" id="cpf" placeholder="CPF" autocomplete="off" name="cpf" required value="<?php echo $cpfFunc; ?>">
										</div>
									</div>
									<div class="col-xs-6">
										<div class="form-group">
											<label for="sus1">Coren</label>
											<input type="text" class="form-control simple-field-data-mask" maxlength="7" data-mask="000.000" id="coren" placeholder="Coren" autocomplete="off" name="coren" required value="<?php echo $mostraFuncio["NR_Coren"]; ?>">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-xs-6">
										<div class="form-group">
											<label for="membroGrupo">Selecione a UBS do Médico:</label>
											<select id="membroGrupo" class="form-control" name="ubs" required>
												<option disabled selected>Selecione ...</option>
												<?php  
												$selectUbs 	= mysqli_query($conn, "SELECT * FROM Ubs") or die(mysqli_error($conn));
												$result = mysqli_num_rows($selectUbs);						
												while($mostraUbs = mysqli_fetch_array($selectUbs)) {
													if($mostraUbs["CD_Ubs"] == $mostraFuncio["ID_Ubs"]){
														echo "<option value='" . $mostraUbs["CD_Ubs"] . "' selected>" . $mostraUbs["NM_Ubs"] . "</option>"; 
													} else {
														echo "<option value='" . $mostraUbs["CD_Ubs"] . "'>" . $mostraUbs["NM_Ubs"] . "</option>"; 
													}	 
												}
												?>
											</select>
										</div>
									</div>
									<div class="row rowBtn">
										<div class="col-xs-12">				
											<button type="submit" class="btn btn-primary" id="concluirPront">Concluir</button>
										</div>
									</div>	
								</div>
							</form>									
							<?php 
						}
						?>

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