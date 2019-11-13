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
		$ubs = $mostraFunc["ID_Ubs"];
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
	<script type="text/javascript">
      	function mudaRadio(posicao) {
      		if(posicao == 3){
      			document.getElementById('pesq').type = 'hidden';
      			document.getElementById('pesqcpf').type = 'text';
      			document.getElementById('pesqcpf').value = "";
      		} else {
      			document.getElementById('pesq').type = 'text';
      			document.getElementById('pesqcpf').type = 'hidden';
      			document.getElementById('pesqcpf').value = "";
      		}
    	}
    </script>
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
					echo $mostraFunc["NM_Funcionario"] . ".";
				?>
				</span>
				<a href="../sair.php">Sair</a>
			</div>
			<div class="col-xs-9 col-xs-offset-3 text-justify fMain">	
				<div class="row rowPesquisarPront">
					<div class="col-xs-12">
						<h1 class="text-center">Gerenciar Funcionários</h1>
						<form action="" method="post">
							<div class="input-group pesquisaPront">
								<input type="text" class="form-control" placeholder="Procurar ..." autocomplete="off" id="pesq" name="pesquisa">
								<input type="hidden" class="form-control simple-field-data-mask" maxlength="14" data-mask="000.000.000-00" placeholder="Procurar ..." autocomplete="off" id="pesqcpf" name="pesquisaCpf">
								<span class="input-group-btn">
									<button class="btn btn-primary" type="submit"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
								</span>
							</div>		
							<table class="tbGerenciaPront">
									<tr>
										<td><label><input type="radio" name="optionsRadios" value="2" onClick="mudaRadio(2)"> Pesquisar por nome</label></td>
										<td><label><input type="radio" name="optionsRadios" value="3" onClick="mudaRadio(3)"> Pesquisar por CPF</label></td>
									</tr>
								</table>					
						</form>						
					</div>
				</div>		
				<?php 
						$pesquisaCpf = @$_POST["pesquisaCpf"];
						$op = @$_POST["optionsRadios"];

						if(!isset($_POST["pesquisa"])){
							$pesquisa = $ubs;
						} else {							
							$pesquisa = $_POST["pesquisa"];
						}
						
						if(!isset($_SESSION["pesq"])){
							
						} else {		
							if ($_SESSION["op"] == 3) {
								$pesquisaCpf = $_SESSION["pesq"];
							} else {
								$pesquisa = $_SESSION["pesq"];
							}				
							UNSET($_SESSION["pesq"]);
						}

						if(!isset($_SESSION["op"])){
							
						} else {							
							$op = $_SESSION["op"];
							UNSET($_SESSION["op"]);
						}

						if(!isset($_POST["pesqNmAlt"])){
							
						} else {							
							$pesquisa = $_POST["pesqNmAlt"];
							$op = 2;
						}
						
						if ($op == "") {
							if ($pesquisa == ""){
								$selectUbsF = mysqli_query($conn, "SELECT NM_Ubs, CD_Ubs FROM Ubs WHERE CD_Ubs = '$ubs'") or die(mysqli_error($conn));
								$mostraUbsF = mysqli_fetch_array($selectUbsF);
								$resultUbsF = mysqli_num_rows($selectUbsF);
								if ($resultUbsF == 0){
									echo "<center><h4>Unidade Básica de Saúde não existe.</h2></center>";
								} else {
									$ubsF = $mostraUbsF["CD_Ubs"];
									$selectFunc = mysqli_query($conn, "SELECT NM_Funcionario, NR_Cpf, CD_Nivel, ID_Status FROM Funcionario WHERE ID_Ubs = '$ubsF'") or die(mysqli_error($conn));
									$selectMedic = mysqli_query($conn, "SELECT NM_Medico, NR_Cpf, ID_Status FROM Medico WHERE ID_Ubs = '$ubsF'") or die(mysqli_error($conn));
									$selectEnfe = mysqli_query($conn, "SELECT NM_Enfermeiro, NR_Cpf, ID_Status FROM Enfermeiro WHERE ID_Ubs = '$ubsF'") or die(mysqli_error($conn));
									echo "<div class='col-xs-12 branco sombra alterarPront'>";
									echo "<div class='row ProntTableRow'>";
									echo "<div class='col-xs-12 formProntBtn'>";
									echo "<h1>" . $mostraUbsF["NM_Ubs"] . "</h1>";
									echo "<table class='table table-hover'>";
									echo "<thead>
											<tr>
												<th>Nome</th>
												<th>CPF</th>
												<th>Nível</th>
												<th></th>
											</tr>
										</thead>";
										echo "<tbody>";									
										while($mostraFunc = mysqli_fetch_array($selectFunc)) {
											if($mostraFunc["CD_Nivel"] == 1 OR $mostraFunc["CD_Nivel"] == 2){
													
												} else {

												
											$cpfFunc = $mostraFunc["NR_Cpf"];
											if($mostraFunc["ID_Status"] == 1){
												echo "<tr>";
											} else {
												echo "<tr class='desativado'>";
											}
											echo "<td>" . $mostraFunc["NM_Funcionario"] . "</td>
											<td>" . $cpfFunc . "</td>
											<td>";  
											if($mostraFunc["CD_Nivel"] == 0){
												echo "Recepcionista";
											} 
											if($mostraFunc["CD_Nivel"] == 1){
												echo "Chefe de UBS";
											}
											if($mostraFunc["CD_Nivel"] == 2){
												echo "Diretora";
											}
											echo "</td>";
											if($mostraFunc["ID_Status"] == 1){
												echo "<td>
												<form action='alterarFunc.php' method='POST'>
												<input type='hidden' name='tipofunc' value='func'>
												<button class='btn btn-primary' value='" . $cpfFunc . "' name='alte'>Alterar</button>
												</form>
												<form action='desativaFunc.php' method='POST'>
												<input type='hidden' name='tipofunc' value='func'>
												<input type='hidden' name='func' value='" . $cpfFunc . "'>
												<input type='hidden' name='op' value='1'>
												<input type='hidden' name='pesq' value='" . $pesquisa . "'>
												<button class='btn btn-danger' value='0' name='desativa'>Desativar</button>
												</form>";
											} else {
												echo "<td>
												<form action='alterarFunc.php' method='POST'>
												<input type='hidden' name='tipofunc' value='func'>
												<button disabled class='btn btn-primary' value='" . $cpfFunc . "' name='alte'>Alterar</button>
												</form>
												<form action='desativaFunc.php' method='POST'>
												<input type='hidden' name='tipofunc' value='func'>
												<input type='hidden' name='op' value='1'>
												<input type='hidden' name='pesq' value='" . $pesquisa . "'>
												<input type='hidden' name='func' value='" . $cpfFunc . "'>
												<button class='btn btn-success' value='1' name='ativa'>Ativar</button>
												</form>";
											}
											echo "</td>
										</tr>";

											}
										}
										while($mostraMedic = mysqli_fetch_array($selectMedic)) {
											$cpfMedico = $mostraMedic["NR_Cpf"];
											if($mostraMedic["ID_Status"] == 1){
												echo "<tr>";
											} else {
												echo "<tr class='desativado'>";
											}
											echo "<td>" .$mostraMedic["NM_Medico"] . "</td>
											<td>" . $cpfMedico  . "</td>
											<td> Médico </td>";
											if($mostraMedic["ID_Status"] == 1){
												echo "<td>
												<form action='alterarFunc.php' method='POST'>
												<input type='hidden' name='tipofunc' value='medico'>
												<button class='btn btn-primary' value='" . $cpfMedico . "' name='alte'>Alterar</button>
												</form>
												<form action='desativaFunc.php' method='POST'>
												<input type='hidden' name='tipofunc' value='medico'>
												<input type='hidden' name='medico' value='" . $cpfMedico . "'>
												<input type='hidden' name='op' value='1'>
												<input type='hidden' name='pesq' value='" . $pesquisa . "'>
												<button class='btn btn-danger' value='0' name='desativa'>Desativar</button>
												</form>";
											} else {
												echo "<td>
												<form action='alterarFunc.php' method='POST'>
												<input type='hidden' name='tipofunc' value='medico'>
												<button disabled class='btn btn-primary' value='" . $cpfMedico . "' name='alte'>Alterar</button>
												</form>
												<form action='desativaFunc.php' method='POST'>
												<input type='hidden' name='tipofunc' value='medico'>
												<input type='hidden' name='op' value='1'>
												<input type='hidden' name='pesq' value='" . $pesquisa . "'>
												<input type='hidden' name='medico' value='" . $cpfMedico . "'>
												<button class='btn btn-success' value='1' name='ativa'>Ativar</button>
												</form>";
											}
											echo "</td>
										</tr>";
										}
										while($mostraEnfe = mysqli_fetch_array($selectEnfe)) {
											$cpfEnfe = $mostraEnfe["NR_Cpf"];
											if($mostraEnfe["ID_Status"] == 1){
												echo "<tr>";
											} else {
												echo "<tr class='desativado'>";
											}
											echo "<td>" . $mostraEnfe["NM_Enfermeiro"] . "</td>
											<td>" . $cpfEnfe . "</td>
											<td> Enfermeiro </td>";
											if($mostraEnfe["ID_Status"] == 1){
												echo "<td>
												<form action='alterarFunc.php' method='POST'>
												<input type='hidden' name='tipofunc' value='enfe'>
												<button class='btn btn-primary' value='" . $cpfEnfe . "' name='alte'>Alterar</button>
												</form>
												<form action='desativaFunc.php' method='POST'>
												<input type='hidden' name='tipofunc' value='enfe'>
												<input type='hidden' name='enfe' value='" . $cpfEnfe . "'>
												<input type='hidden' name='op' value='1'>
												<input type='hidden' name='pesq' value='" . $pesquisa . "'>
												<button class='btn btn-danger' value='0' name='desativa'>Desativar</button>
												</form>";
											} else {
												echo "<td>
												<form action='alterarFunc.php' method='POST'>
												<input type='hidden' name='tipofunc' value='enfe'>
												<button disabled class='btn btn-primary' value='" . $cpfEnfe . "' name='alte'>Alterar</button>
												</form>
												<form action='desativaFunc.php' method='POST'>
												<input type='hidden' name='tipofunc' value='enfe'>
												<input type='hidden' name='op' value='1'>
												<input type='hidden' name='pesq' value='" . $pesquisa . "'>
												<input type='hidden' name='enfe' value='" . $cpfEnfe . "'>
												<button class='btn btn-success' value='1' name='ativa'>Ativar</button>
												</form>";
											}
											echo "</td>
										</tr>";
										}

										echo "</tbody>";
										echo "</table>";
										echo "*Funcionários em cinza estão desativados.";
										echo "</div></div></div>";									
								}									
							} else {
								echo "<center><h4>Escolha uma opção ou faça uma pesquisa em branco.</h2></center>";
							}							
						}		

						if 	($op == 2) {
							if ($pesquisa != ""){
								$selectFunc = mysqli_query($conn, "SELECT NM_Funcionario, NR_Cpf, CD_Nivel, ID_Status FROM Funcionario WHERE NM_Funcionario LIKE '%$pesquisa%'") or die(mysqli_error($conn));
								$selectMedic = mysqli_query($conn, "SELECT NM_Medico, NR_Cpf, ID_Status FROM Medico WHERE NM_Medico LIKE '%$pesquisa%'") or die(mysqli_error($conn));
								$selectEnfe = mysqli_query($conn, "SELECT NM_Enfermeiro, NR_Cpf, ID_Status FROM Enfermeiro WHERE NM_Enfermeiro LIKE '%$pesquisa%'") or die(mysqli_error($conn));
								$resultF = mysqli_num_rows($selectFunc);
								$resultM = mysqli_num_rows($selectMedic);
								$resultE = mysqli_num_rows($selectEnfe);
								if ($resultF == 0 && $resultM == 0 && $resultE == 0){
									echo "<center><h4>Funcionário não Cadastrado.</h2></center>";
								} else {
									echo "<div class='col-xs-12 branco sombra alterarPront'>";
									echo "<div class='row ProntTableRow'>";
									echo "<div class='col-xs-12 formProntBtn'>";
									echo "<table class='table table-hover'>";
									echo "<thead>
											<tr>
												<th>Nome</th>
												<th>CPF</th>
												<th>Nível</th>
												<th></th>
												<th></th>
											</tr>
										</thead>";
										echo "<tbody>";		
										if($resultF > 0){
											while($mostraFunc = mysqli_fetch_array($selectFunc)) {
												if($mostraFunc["CD_Nivel"] == 1 OR $mostraFunc["CD_Nivel"] == 2){
													
												} else {

												$cpfFunc = $mostraFunc["NR_Cpf"];
												if($mostraFunc["ID_Status"] == 1){
													echo "<tr>";
												} else {
													echo "<tr class='desativado'>";
												}
												echo "<td>" . $mostraFunc["NM_Funcionario"] . "</td>
												<td>" . $cpfFunc . "</td>
												<td>";  
												if($mostraFunc["CD_Nivel"] == 0){
													echo "Recepcionista";
												} 
												if($mostraFunc["CD_Nivel"] == 1){
													echo "Chefe de UBS";
												}
												if($mostraFunc["CD_Nivel"] == 2){
													echo "Diretora";
												}
												echo "</td>";
												if($mostraFunc["ID_Status"] == 1){
												echo "<td>
												<form action='alterarFunc.php' method='POST'>
												<input type='hidden' name='tipofunc' value='func'>
												<button class='btn btn-primary' value='" . $cpfFunc . "' name='alte'>Alterar</button>
												</form>
												<form action='desativaFunc.php' method='POST'>
												<input type='hidden' name='tipofunc' value='func'>
												<input type='hidden' name='func' value='" . $cpfFunc . "'>
												<input type='hidden' name='op' value='1'>
												<input type='hidden' name='pesq' value='" . $pesquisa . "'>
												<button class='btn btn-danger' value='0' name='desativa'>Desativar</button>
												</form>";
												} else {
												echo "<td>
												<form action='alterarFunc.php' method='POST'>
												<input type='hidden' name='tipofunc' value='func'>
												<button disabled class='btn btn-primary' value='" . $cpfFunc . "' name='alte'>Alterar</button>
												</form>
												<form action='desativaFunc.php' method='POST'>
												<input type='hidden' name='tipofunc' value='func'>
												<input type='hidden' name='op' value='1'>
												<input type='hidden' name='pesq' value='" . $pesquisa . "'>
												<input type='hidden' name='func' value='" . $cpfFunc . "'>
												<button class='btn btn-success' value='1' name='ativa'>Ativar</button>
												</form>";
											}
												echo "</td>
											</tr>";
												}
											}
										}	
										if($resultM > 0){
											while($mostraMedic = mysqli_fetch_array($selectMedic)) {
											$cpfMedico = $mostraMedic["NR_Cpf"];
											if($mostraMedic["ID_Status"] == 1){
												echo "<tr>";
											} else {
												echo "<tr class='desativado'>";
											}
											echo "<td>" .$mostraMedic["NM_Medico"] . "</td>
											<td>" . $cpfMedico  . "</td>
											<td> Médico </td>";
											if($mostraMedic["ID_Status"] == 1){
												echo "<td>
												<form action='alterarFunc.php' method='POST'>
												<input type='hidden' name='tipofunc' value='medico'>
												<button class='btn btn-primary' value='" . $cpfMedico . "' name='alte'>Alterar</button>
												</form>
												<form action='desativaFunc.php' method='POST'>
												<input type='hidden' name='tipofunc' value='medico'>
												<input type='hidden' name='medico' value='" . $cpfMedico . "'>
												<input type='hidden' name='op' value='1'>
												<input type='hidden' name='pesq' value='" . $pesquisa . "'>
												<button class='btn btn-danger' value='0' name='desativa'>Desativar</button>
												</form>";
											} else {
												echo "<td>
												<form action='alterarFunc.php' method='POST'>
												<input type='hidden' name='tipofunc' value='medico'>
												<button disabled class='btn btn-primary' value='" . $cpfMedico . "' name='alte'>Alterar</button>
												</form>
												<form action='desativaFunc.php' method='POST'>
												<input type='hidden' name='tipofunc' value='medico'>
												<input type='hidden' name='op' value='1'>
												<input type='hidden' name='pesq' value='" . $pesquisa . "'>
												<input type='hidden' name='medico' value='" . $cpfMedico . "'>
												<button class='btn btn-success' value='1' name='ativa'>Ativar</button>
												</form>";
											}
											echo "</td>
										</tr>";
											}
										}	
										if($resultE > 0){
											while($mostraEnfe = mysqli_fetch_array($selectEnfe)) {
												$cpfEnfe = $mostraEnfe["NR_Cpf"];
											if($mostraEnfe["ID_Status"] == 1){
												echo "<tr>";
											} else {
												echo "<tr class='desativado'>";
											}
											echo "<td>" . $mostraEnfe["NM_Enfermeiro"] . "</td>
											<td>" . $cpfEnfe . "</td>
											<td> Enfermeiro </td>";
											if($mostraEnfe["ID_Status"] == 1){
												echo "<td>
												<form action='alterarFunc.php' method='POST'>
												<input type='hidden' name='tipofunc' value='enfe'>
												<button class='btn btn-primary' value='" . $cpfEnfe . "' name='alte'>Alterar</button>
												</form>
												<form action='desativaFunc.php' method='POST'>
												<input type='hidden' name='tipofunc' value='enfe'>
												<input type='hidden' name='enfe' value='" . $cpfEnfe . "'>
												<input type='hidden' name='op' value='1'>
												<input type='hidden' name='pesq' value='" . $pesquisa . "'>
												<button class='btn btn-danger' value='0' name='desativa'>Desativar</button>
												</form>";
											} else {
												echo "<td>
												<form action='alterarFunc.php' method='POST'>
												<input type='hidden' name='tipofunc' value='enfe'>
												<button disabled class='btn btn-primary' value='" . $cpfEnfe . "' name='alte'>Alterar</button>
												</form>
												<form action='desativaFunc.php' method='POST'>
												<input type='hidden' name='tipofunc' value='enfe'>
												<input type='hidden' name='op' value='1'>
												<input type='hidden' name='pesq' value='" . $pesquisa . "'>
												<input type='hidden' name='enfe' value='" . $cpfEnfe . "'>
												<button class='btn btn-success' value='1' name='ativa'>Ativar</button>
												</form>";
											}
											echo "</td>
										</tr>";
											}
										}		
										echo "</tbody>";
										echo "</table>";
										echo "*Funcionários em cinza estão desativados.";
										echo "</div></div></div>";									
								}									
							} else {
								echo "<center><h4>Digite o nome de um Funcionário.</h2></center>";
							}
						}		

						if ($op == 3) {
							if ($pesquisaCpf != ""){
								$selectFunc = mysqli_query($conn, "SELECT NM_Funcionario, NR_Cpf, CD_Nivel, ID_Status FROM Funcionario WHERE NR_Cpf = '$pesquisaCpf'") or die(mysqli_error($conn));
								$selectMedic = mysqli_query($conn, "SELECT NM_Medico, NR_Cpf, ID_Status FROM Medico WHERE NR_Cpf = '$pesquisaCpf'") or die(mysqli_error($conn));
								$selectEnfe = mysqli_query($conn, "SELECT NM_Enfermeiro, NR_Cpf, ID_Status FROM Enfermeiro WHERE NR_Cpf = '$pesquisaCpf'") or die(mysqli_error($conn));
								$resultF = mysqli_num_rows($selectFunc);
								$resultM = mysqli_num_rows($selectMedic);
								$resultE = mysqli_num_rows($selectEnfe);
								if ($resultF == 0 && $resultM == 0 && $resultE == 0){
									echo "<center><h4>Funcionário não Cadastrado.</h2></center>";
								} else {
									echo "<div class='col-xs-12 branco sombra alterarPront'>";
									echo "<div class='row ProntTableRow'>";
									echo "<div class='col-xs-12 formProntBtn'>";
									echo "<table class='table table-hover'>";
									echo "<thead>
											<tr>
												<th>Nome</th>
												<th>CPF</th>
												<th>Nível</th>
												<th></th>
												<th></th>
											</tr>
										</thead>";
										echo "<tbody>";		
										if($resultF > 0){
											while($mostraFunc = mysqli_fetch_array($selectFunc)) {
												if($mostraFunc["CD_Nivel"] == 1 OR $mostraFunc["CD_Nivel"] == 2){
													
												} else {
													$cpfFunc = $mostraFunc["NR_Cpf"];
												if($mostraFunc["ID_Status"] == 1){
													echo "<tr>";
												} else {
													echo "<tr class='desativado'>";
												}
												echo "<td>" . $mostraFunc["NM_Funcionario"] . "</td>
												<td>" . $cpfFunc . "</td>
												<td>";  
												if($mostraFunc["CD_Nivel"] == 0){
													echo "Recepcionista";
												} 
												if($mostraFunc["CD_Nivel"] == 1){
													echo "Chefe de UBS";
												}
												if($mostraFunc["CD_Nivel"] == 2){
													echo "Diretora";
												}
												echo "</td>";
												if($mostraFunc["ID_Status"] == 1){
												echo "<td>
												<form action='alterarFunc.php' method='POST'>
												<input type='hidden' name='tipofunc' value='func'>
												<button class='btn btn-primary' value='" . $cpfFunc . "' name='alte'>Alterar</button>
												</form>
												<form action='desativaFunc.php' method='POST'>
												<input type='hidden' name='tipofunc' value='func'>
												<input type='hidden' name='func' value='" . $cpfFunc . "'>
												<input type='hidden' name='op' value='1'>
												<input type='hidden' name='pesq' value='" . $pesquisa . "'>
												<button class='btn btn-danger' value='0' name='desativa'>Desativar</button>
												</form>";
											} else {
												echo "<td>
												<form action='alterarFunc.php' method='POST'>
												<input type='hidden' name='tipofunc' value='func'>
												<button disabled class='btn btn-primary' value='" . $cpfFunc . "' name='alte'>Alterar</button>
												</form>
												<form action='desativaFunc.php' method='POST'>
												<input type='hidden' name='tipofunc' value='func'>
												<input type='hidden' name='op' value='1'>
												<input type='hidden' name='pesq' value='" . $pesquisa . "'>
												<input type='hidden' name='func' value='" . $cpfFunc . "'>
												<button class='btn btn-success' value='1' name='ativa'>Ativar</button>
												</form>";
											}
												echo "</td>
											</tr>";
												}
											}
										}	
										if($resultM > 0){
											while($mostraMedic = mysqli_fetch_array($selectMedic)) {
												$cpfMedico = $mostraMedic["NR_Cpf"];
											if($mostraMedic["ID_Status"] == 1){
												echo "<tr>";
											} else {
												echo "<tr class='desativado'>";
											}
											echo "<td>" .$mostraMedic["NM_Medico"] . "</td>
											<td>" . $cpfMedico  . "</td>
											<td> Médico </td>";
											if($mostraMedic["ID_Status"] == 1){
												echo "<td>
												<form action='alterarFunc.php' method='POST'>
												<input type='hidden' name='tipofunc' value='medico'>
												<button class='btn btn-primary' value='" . $cpfMedico . "' name='alte'>Alterar</button>
												</form>
												<form action='desativaFunc.php' method='POST'>
												<input type='hidden' name='tipofunc' value='medico'>
												<input type='hidden' name='medico' value='" . $cpfMedico . "'>
												<input type='hidden' name='op' value='1'>
												<input type='hidden' name='pesq' value='" . $pesquisa . "'>
												<button class='btn btn-danger' value='0' name='desativa'>Desativar</button>
												</form>";
											} else {
												echo "<td>
												<form action='alterarFunc.php' method='POST'>
												<input type='hidden' name='tipofunc' value='medico'>
												<button disabled class='btn btn-primary' value='" . $cpfMedico . "' name='alte'>Alterar</button>
												</form>
												<form action='desativaFunc.php' method='POST'>
												<input type='hidden' name='tipofunc' value='medico'>
												<input type='hidden' name='op' value='1'>
												<input type='hidden' name='pesq' value='" . $pesquisa . "'>
												<input type='hidden' name='medico' value='" . $cpfMedico . "'>
												<button class='btn btn-success' value='1' name='ativa'>Ativar</button>
												</form>";
											}
											echo "</td>
										</tr>";
											}
										}	
										if($resultE > 0){
											while($mostraEnfe = mysqli_fetch_array($selectEnfe)) {
												$cpfEnfe = $mostraEnfe["NR_Cpf"];
											if($mostraEnfe["ID_Status"] == 1){
												echo "<tr>";
											} else {
												echo "<tr class='desativado'>";
											}
											echo "<td>" . $mostraEnfe["NM_Enfermeiro"] . "</td>
											<td>" . $cpfEnfe . "</td>
											<td> Enfermeiro </td>";
											if($mostraEnfe["ID_Status"] == 1){
												echo "<td>
												<form action='alterarFunc.php' method='POST'>
												<input type='hidden' name='tipofunc' value='enfe'>
												<button class='btn btn-primary' value='" . $cpfEnfe . "' name='alte'>Alterar</button>
												</form>
												<form action='desativaFunc.php' method='POST'>
												<input type='hidden' name='tipofunc' value='enfe'>
												<input type='hidden' name='enfe' value='" . $cpfEnfe . "'>
												<input type='hidden' name='op' value='1'>
												<input type='hidden' name='pesq' value='" . $pesquisa . "'>
												<button class='btn btn-danger' value='0' name='desativa'>Desativar</button>
												</form>";
											} else {
												echo "<td>
												<form action='alterarFunc.php' method='POST'>
												<input type='hidden' name='tipofunc' value='enfe'>
												<button disabled class='btn btn-primary' value='" . $cpfEnfe . "' name='alte'>Alterar</button>
												</form>
												<form action='desativaFunc.php' method='POST'>
												<input type='hidden' name='tipofunc' value='enfe'>
												<input type='hidden' name='op' value='1'>
												<input type='hidden' name='pesq' value='" . $pesquisa . "'>
												<input type='hidden' name='enfe' value='" . $cpfEnfe . "'>
												<button class='btn btn-success' value='1' name='ativa'>Ativar</button>
												</form>";
											}
											echo "</td>
										</tr>";
											}
										}		
										echo "</tbody>";
										echo "</table>";
										echo "*Funcionários em cinza estão desativados.";
										echo "</div></div></div>";									
								}									
							} else {
								echo "<center><h4>Digite o nome de um Funcionário.</h2></center>";
							}
						}
					?>	
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