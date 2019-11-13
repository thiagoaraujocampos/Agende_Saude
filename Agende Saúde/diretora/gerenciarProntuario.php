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
						<h1 class="text-center">Gerenciar Prontuários</h1>
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
										<td><label><input type="radio" name="optionsRadios" value="1" onClick="mudaRadio(1)" checked> Pesquisar por prontuário</label></td>
										<td><label><input type="radio" name="optionsRadios" value="2" onClick="mudaRadio(2)"> Pesquisar por nome</label></td>
										<td><label><input type="radio" name="optionsRadios" value="3" onClick="mudaRadio(3)"> Pesquisar por CPF</label></td>
									</tr>
								</table>					
						</form>						
					</div>
				</div>		
				<?php 
						$pesquisa = @$_POST["pesquisa"];
						$pesquisaCpf = @$_POST["pesquisaCpf"];
						$op = @$_POST["optionsRadios"];

						if(!isset($_POST["pesqNmAlt"])){
							
						} else {							
							$pesquisa = $_POST["pesqNmAlt"];
							$op = 2;
						}

						if(!isset($_POST["btnAD"])){
							
						} else {
							$btnAD = $_POST["btnAD"];
							$pesquisa = $_POST["pesqPront"];
							$op = $_POST["opBtn"];
							$updateStatus = mysqli_query($conn, "UPDATE Prontuario SET ID_Status = '$btnAD' WHERE CD_Prontuario = '$pesquisa';") or die(mysqli_error($conn));
						}
						
						if ($op == 1) {
							if ($pesquisa != ""){
								$selectNrPront = mysqli_query($conn, "SELECT CD_Prontuario, ID_Status FROM Prontuario WHERE CD_Prontuario = '$pesquisa'") or die(mysqli_error($conn));
								$mostraNrPront = mysqli_fetch_array($selectNrPront);
								$resultPront = mysqli_num_rows($selectNrPront);
								if ($resultPront == 0){
									echo "<center><h4>Prontuário não existe</h2></center>";
								} else {
									$selectPront = mysqli_query($conn, "SELECT NR_Cpf, NR_Sus, NM_Paciente, ID_Chefe, ID_Prontuario FROM Paciente, Prontuario WHERE ID_Prontuario = CD_Prontuario AND ID_Prontuario = '$pesquisa' ORDER BY ID_Chefe DESC, NM_Paciente ASC") or die(mysqli_error($conn));
									if($mostraNrPront["ID_Status"] == 1){
										// ========================================================================
										echo "<div class='col-xs-12 branco sombra alterarPront'>";
										echo "<div class='row ProntTableRow'>";
										echo "<div class='col-xs-12 formProntBtn'>";
										echo "<h1>Prontuário nº " . $pesquisa . "<form action='' method='post'> <button class='btn btn-danger pull-right' value='0' name='btnAD'>Desativar</button><input type='hidden' name='pesqPront' value='" . $pesquisa . "'><input type='hidden' name='opBtn' value='". $op . "'></form>";
										echo "<form action='alterarPront.php' method='post'><button class='btn btn-primary pull-right' value='" . $pesquisa . "' name='alteraPront' style='margin-right: 5px;'>Alterar</button></form></h1>";
										echo "<table class='table table-hover'>";
										echo "<thead>
											<tr>
												<th>Nome</th>
												<th>CPF</th>
												<th>SUS</th>
												<th>Chefe de Familia</th>
											</tr>
										</thead>";
										echo "<tbody>";									
										while($mostraPront = mysqli_fetch_array($selectPront)) {
											echo "<tr>
											<td>" . $mostraPront["NM_Paciente"] . "</td>
											<td>" . $mostraPront["NR_Cpf"] . "</td>
											<td>" . $mostraPront["NR_Sus"] . "</td>
											<td>"; if($mostraPront["ID_Chefe"] == 1){ echo "SIM"; } else {  echo "NÃO"; }  echo "</td>
										</tr>";
										}

										echo "</tbody>";
										echo "</table>";
										echo "</div></div></div>";
										// =========================================================================
									} else {
										// =========================================================================
										echo "<div class='col-xs-12 desativado sombra alterarPront'>";
										echo "<div class='row ProntTableRow'>";
										echo "<div class='col-xs-12 formProntBtn'>";
										echo "<h1>Prontuário nº " . $pesquisa . " - <span style='color: red;'> DESATIVADO</span><form action='' method='post'><button class='btn btn-success pull-right' value='1' name='btnAD'>Ativar</button><input type='hidden' name='pesqPront' value='" . $pesquisa . "'><input type='hidden' name='opBtn' value='". $op . "'></form></h1>";
										echo "<table class='table table-hover'>";
										echo "<thead>
											<tr>
												<th>Nome</th>
												<th>CPF</th>
												<th>SUS</th>
												<th>Chefe de Familia</th>
											</tr>
										</thead>";
										echo "<tbody>";									
										while($mostraPront = mysqli_fetch_array($selectPront)) {
											echo "<tr>
											<td>" . $mostraPront["NM_Paciente"] . "</td>
											<td>" . $mostraPront["NR_Cpf"] . "</td>
											<td>" . $mostraPront["NR_Sus"] . "</td>
											<td>"; if($mostraPront["ID_Chefe"] == 1){ echo "SIM"; } else {  echo "NÃO"; }  echo "</td>
										</tr>";
										}

										echo "</tbody>";
										echo "</table>";
										echo "</div></div></div>";
										// =========================================================================
									}										
								}									
							} else {
								echo "<center><h4>Digite um número de prontuário</h2></center>";
							}							
						}		

						if 	($op == 2) {
							if ($pesquisa != ""){
								$nomePesq = $pesquisa;
								$selectNrPront = mysqli_query($conn, "SELECT ID_Prontuario FROM Paciente WHERE NM_Paciente = '$pesquisa'") or die(mysqli_error($conn));
								$mostraNrPront = mysqli_fetch_array($selectNrPront);
								$resultPront = mysqli_num_rows($selectNrPront);
								if ($resultPront == 0){
									echo "<center><h4>Nome não cadastrado em nenhum prontuário</h2></center>";
								} else {
									$pesquisa = $mostraNrPront["ID_Prontuario"];
									$selectNrPront = mysqli_query($conn, "SELECT CD_Prontuario, ID_Status FROM Prontuario WHERE CD_Prontuario = '$pesquisa'") or die(mysqli_error($conn));
									$mostraNrPront = mysqli_fetch_array($selectNrPront);
									$selectPront = mysqli_query($conn, "SELECT NR_Cpf, NR_Sus, NM_Paciente, ID_Chefe, ID_Prontuario FROM Paciente, Prontuario WHERE ID_Prontuario = CD_Prontuario AND ID_Prontuario = '$pesquisa' ORDER BY ID_Chefe DESC, NM_Paciente ASC") or die(mysqli_error($conn));
									if($mostraNrPront["ID_Status"] == 1){
										// =========================================================================
										echo "<div class='col-xs-12 branco sombra alterarPront'>";
										echo "<div class='row ProntTableRow'>";
										echo "<div class='col-xs-12 formProntBtn'>";
										echo "<h1>Prontuário nº " . $pesquisa . "<form action='' method='post'><button class='btn btn-danger pull-right' value='0' name='btnAD'>Desativar</button><input type='hidden' name='pesqPront' value='" . $pesquisa . "'><input type='hidden' name='opBtn' value='1'></form></h1>";
										echo "<table class='table table-hover'>";
										echo "<thead>
											<tr>
												<th>Nome</th>
												<th>CPF</th>
												<th>SUS</th>
												<th>Chefe de Familia</th>
												<th></th>
											</tr>
										</thead>";
										echo "<tbody>";									
										while($mostraPront = mysqli_fetch_array($selectPront)) {
											echo "<tr>
											<td>" . $mostraPront["NM_Paciente"] . "</td>
											<td>" . $mostraPront["NR_Cpf"] . "</td>
											<td>" . $mostraPront["NR_Sus"] . "</td>
											<td>"; if($mostraPront["ID_Chefe"] == 1){ echo "SIM"; } else {  echo "NÃO"; }  echo "</td>
											<td><button class='btn btn-primary'>Alterar</button></td>
										</tr>";
										}

										echo "</tbody>";
										echo "</table>";
										echo "</div></div></div>";
										// =======================================================================
									} else {
										// =========================================================================
										echo "<div class='col-xs-12 desativado sombra alterarPront'>";
										echo "<div class='row ProntTableRow'>";
										echo "<div class='col-xs-12 formProntBtn'>";
										echo "<h1>Prontuário nº " . $pesquisa . " - <span style='color: red;'> DESATIVADO</span><form action='' method='post'><button class='btn btn-success pull-right' value='1' name='btnAD'>Ativar</button><input type='hidden' name='pesqPront' value='" . $pesquisa . "'><input type='hidden' name='opBtn' value='1'></form></h1>";
										echo "<table class='table table-hover'>";
										echo "<thead>
											<tr>
												<th>Nome</th>
												<th>CPF</th>
												<th>SUS</th>
												<th>Chefe de Familia</th>
												<th></th>
											</tr>
										</thead>";
										echo "<tbody>";									
										while($mostraPront = mysqli_fetch_array($selectPront)) {
											echo "<tr>
											<td>" . $mostraPront["NM_Paciente"] . "</td>
											<td>" . $mostraPront["NR_Cpf"] . "</td>
											<td>" . $mostraPront["NR_Sus"] . "</td>
											<td>"; if($mostraPront["ID_Chefe"] == 1){ echo "SIM"; } else {  echo "NÃO"; }  echo "</td>
											<td><button class='btn btn-primary' disabled>Alterar</button></td>
										</tr>";
										}

										echo "</tbody>";
										echo "</table>";
										echo "</div></div></div>";
										// =========================================================================
									}		
								}						
							} else {
								echo "<center><h4>Digite o nome do paciente</h2></center>";
							}
						}		

						if ($op == 3) {
							if ($pesquisaCpf != ""){
								$cpfPesq = $pesquisa;
								$selectNrPront = mysqli_query($conn, "SELECT ID_Prontuario FROM Paciente WHERE NR_Cpf = '$pesquisaCpf'") or die(mysqli_error($conn));
								$mostraNrPront = mysqli_fetch_array($selectNrPront);
								$resultPront = mysqli_num_rows($selectNrPront);
								$pesquisa = $mostraNrPront["ID_Prontuario"];
								$selectNrPront = mysqli_query($conn, "SELECT CD_Prontuario, ID_Status FROM Prontuario WHERE CD_Prontuario = '$pesquisa'") or die(mysqli_error($conn));
								$mostraNrPront = mysqli_fetch_array($selectNrPront);
								if ($resultPront == 0){
									echo "<center><h4>CPF não pertence a nenhum paciente</h2></center>";
								} else {
									$selectPront = mysqli_query($conn, "SELECT NR_Cpf, NR_Sus, NM_Paciente, ID_Chefe, ID_Prontuario FROM Paciente, Prontuario WHERE ID_Prontuario = CD_Prontuario AND ID_Prontuario = '$pesquisa' ORDER BY ID_Chefe DESC, NM_Paciente ASC") or die(mysqli_error($conn));
									if($mostraNrPront["ID_Status"] == 1){
										// =========================================================================
										echo "<div class='col-xs-12 branco sombra alterarPront'>";
										echo "<div class='row ProntTableRow'>";
										echo "<div class='col-xs-12 formProntBtn'>";
										echo "<h1>Prontuário nº " . $pesquisa . "<form action='' method='post'><button class='btn btn-danger pull-right' value='0' name='btnAD'>Desativar</button><input type='hidden' name='pesqPront' value='" . $pesquisa . "'><input type='hidden' name='opBtn' value='1'></form></h1>";
										echo "<table class='table table-hover'>";
										echo "<thead>
											<tr>
												<th>Nome</th>
												<th>CPF</th>
												<th>SUS</th>
												<th>Chefe de Familia</th>
												<th></th>
											</tr>
										</thead>";
										echo "<tbody>";									
										while($mostraPront = mysqli_fetch_array($selectPront)) {
											echo "<tr>
											<td>" . $mostraPront["NM_Paciente"] . "</td>
											<td>" . $mostraPront["NR_Cpf"] . "</td>
											<td>" . $mostraPront["NR_Sus"] . "</td>
											<td>"; if($mostraPront["ID_Chefe"] == 1){ echo "SIM"; } else {  echo "NÃO"; }  echo "</td>
											<td><button class='btn btn-primary'>Alterar</button></td>
										</tr>";
										}

										echo "</tbody>";
										echo "</table>";
										echo "</div></div></div>";
										// =========================================================================
									} else {
										// =========================================================================
										echo "<div class='col-xs-12 desativado sombra alterarPront'>";
										echo "<div class='row ProntTableRow'>";
										echo "<div class='col-xs-12 formProntBtn'>";
										echo "<h1>Prontuário nº " . $pesquisa . " - <span style='color: red;'> DESATIVADO</span><form action='' method='post'><button class='btn btn-success pull-right' value='1' name='btnAD'>Ativar</button><input type='hidden' name='pesqPront' value='" . $pesquisa . "'><input type='hidden' name='opBtn' value='1'></form></h1>";
										echo "<table class='table table-hover'>";
										echo "<thead>
											<tr>
												<th>Nome</th>
												<th>CPF</th>
												<th>SUS</th>
												<th>Chefe de Familia</th>
												<th></th>
											</tr>
										</thead>";
										echo "<tbody>";									
										while($mostraPront = mysqli_fetch_array($selectPront)) {
											echo "<tr>
											<td>" . $mostraPront["NM_Paciente"] . "</td>
											<td>" . $mostraPront["NR_Cpf"] . "</td>
											<td>" . $mostraPront["NR_Sus"] . "</td>
											<td>"; if($mostraPront["ID_Chefe"] == 1){ echo "SIM"; } else {  echo "NÃO"; }  echo "</td>
											<td><button class='btn btn-primary' disabled>Alterar</button></td>
										</tr>";
										}

										echo "</tbody>";
										echo "</table>";
										echo "</div></div></div>";
										// =========================================================================
									}		
								}
							} else {
								echo "<center><h4>Digite o CPF do paciente</h2></center>";
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