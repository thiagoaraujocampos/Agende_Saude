<?php  
	include_once("conexao.php");
	session_start();
	if(!isset($_SESSION["pront"]) || !isset($_SESSION["senha"])) {
		$_SESSION["loginErro"] = "Prontuario ou Senha inválido.";
		header("Location: index.php");
		die();
	} else {
		$pront = $_SESSION["pront"];
	}
?>
<!doctype html>
<html lang = "pt-br">
	<head>
		<head>
		<!-- META -->
		<meta http-equiv="content-type" content="text/html" charset="UTF-8">
		<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, minimum-scale=1.0, user-scalable=no">
		<title> Agende Saúde </title>
		<meta name="description" content="Site para realização de agendamentos em UBS's de Mongaguá.">
		<meta name="keywords" content="Saúde, UBS, Unidades Básicas de Saúde, Mongaguá, Agendamentos, Consultas">
		<meta name="robots" content="index, follow">
		<meta name="author" content="FINIS">
		<link rel="icon" type="image/png" href="IMG/favicon.png"/>
		<link rel="shortcut icon" href="IMG/favicon.ico" >
		<!-- FONT AWESOME -->
		<link rel="stylesheet" href="css/font-awesome.min.css">
		<!-- FONT LATO -->
		<link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel="stylesheet">
		<!-- BOOTSTRAP CSS -->
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<!-- BOOTSTRAP THEME CSS -->
		<link rel="stylesheet" href="css/bootstrap-theme.min.css">
		<!-- CSS/JS -->
		<link rel="stylesheet" type="text/css" href="style.css"/>
		<!--[if lt IE 9]>
			<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
	</head>
<body>
	<div class="container-fluid cPerfil azul">
		<div class="row rowPerfil">
			<div class="menuPerfil">
				<div class="navimg col-xs-2">
					<img src="IMG/TopPSemfundo.png" alt="">
				</div>
				<div class="nav col-xs-10">
					<ul>
						<li>
							<a href="perfil.php"> INICIO </a>
						</li>
						<li>
							|
						</li>
						<li>
							<a href="agendamento.php"> AGENDAMENTO </a>
						</li>
						<li>
							|
						</li>
						<li>
							<a href="consultas-marcadas.php">  CONSULTAS AGENDADAS </a>
						</li>
						<li>
							|
						</li>
						<li>
							<a href="consultas-efetuadas.php"> CONSULTAS REALIZADAS </a>
						</li>
						<li>
							|
						</li>
						<li>
							<a href="sair.php"> SAIR </a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<div class="container-fluid consultasEfetuadasMain">
		<div class="row cEfetuadasRow">
			<div class="col-xs-8 fundoAg">
				<center><br><h2 style="color: rgba(255, 255, 255, 0.9);">Consultas Realizadas</h2></center>
				<?php 	
							$contaTb = 0;
							$contaAg = 0;
							$selectPac = mysqli_query($conn, "SELECT * FROM Paciente WHERE ID_Prontuario = '$pront'") or die(mysqli_error($conn));
							$resultPac = mysqli_num_rows($selectPac);
							while($mostraPac = mysqli_fetch_array($selectPac)) {
								$cpfPac = $mostraPac["NR_Cpf"];
								$selectAg = mysqli_query($conn, "SELECT * FROM AgendamentoConsulta WHERE ID_Paciente = '$cpfPac' AND NM_Situacao = 'Realizada'") or die(mysqli_error($conn));
								$resultAg = mysqli_num_rows($selectAg);
								if($resultAg > 0){
									if($contaTb == 0){
										?>
											<center><table class="table table-hover tableAgp">
											<thead>
												<tr>
													<th>Paciente</th>
													<th>Dia da Consulta</th>
													<th>Tipo da Consulta</th>
													<th>Horario</th>
													<th></th>
												</tr>
											</thead>
											<tbody>
										<?php
										$contaTb++;
									}		

									while($mostraAg = mysqli_fetch_array($selectAg)) {
										$ag = $mostraAg["CD_AgendamentoConsulta"];
										$consult = $mostraAg["ID_Consulta"];
										$selectConsulta = mysqli_query($conn, "SELECT * FROM Consulta WHERE CD_Consulta = '$consult'") or die(mysqli_error($conn));
										$mostraConsulta = mysqli_fetch_array($selectConsulta);
										$nmConsult = $mostraConsulta["NM_Consulta"];
										$hrConsult = $mostraConsulta["HR_ConsultaInicio"] . " ás " . $mostraConsulta["HR_ConsultaFinal"];
										?>
											<tr>
												<td><?php echo $mostraPac["NM_Paciente"]; ?></td>
												<td><?php echo $mostraAg["DT_AgendamentoConsulta"]; ?></td>
												<td><?php echo $nmConsult; ?></td>
												<td><?php echo $hrConsult; ?></td>
											</tr>
										<?php
									}
									$contaAg++;
									

								} else {

								}
							}

							if($contaAg == 0) {
								echo "<br><br><br><br><br><br><center><h3 style='color: rgba(255, 255, 255, 0.9);'>Nenhuma consulta realizada</h3></center>";
							} else {
								echo "</tbody></table></center>";
							}
						?>
			</div>
			<div class="col-xs-4 infoCol">
				<br><br><p><i class="glyphicon glyphicon-chevron-right"></i> Consultas Realizadas: <br><br><span>Todas as consultas já realizadas por seu prontuário são mostradas aqui.</span>
				</p>
			</div>
		</div>
	</div>
	<!-- JQUERY -->
	<script src="js/jquery-3.1.0.min.js"></script>
	<!-- BOOTSTRAP JS -->
	<script src="js/bootstrap.min.js"></script>
	<!-- JS -->
	<script type="text/javascript" src="js/js.js"></script>
</body>
</html>