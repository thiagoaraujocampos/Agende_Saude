<?php  
	include_once("conexao.php");
	session_start();
	if(!isset($_SESSION["pront"]) || !isset($_SESSION["senha"])) {
		$_SESSION["loginErro"] = "Prontuario ou Senha inválido.";
		header("Location: index.php");
		die();
	} else {

	}

	if( !isset($_POST["membro"]) ){
		$_SESSION["erroConsulta"] = "Escolha um membro.";
		header("Location: agendamento.php");
		die();
	} else {
		$membro = $_POST["membro"];
	}

	if( !isset($_POST["nmConsulta"]) ){
		$_SESSION["erroConsulta"] = "Escolha uma consulta.";
		header("Location: agendamento.php");
		die();

	} else {
		$nmConsulta = $_POST["nmConsulta"];
	}

	if( $_POST["nmDia"] == "" ){
		$_SESSION["erroConsulta"] = "Escolha um dia.";
		header("Location: agendamento.php");
		die();

	} else {
		$nmDia = $_POST["nmDia"];
	}
	$query = mysqli_query($conn, "SELECT CD_AgendamentoConsulta, ID_Paciente, ID_Consulta, DT_AgendamentoConsulta, NM_Situacao FROM AgendamentoConsulta WHERE ID_Paciente = '$membro' AND ID_Consulta = '$nmConsulta' AND DT_AgendamentoConsulta = '$nmDia' AND NM_Situacao = 'Em Aberto'") or die(mysqli_error($conn));
	$resultAgendamento = mysqli_num_rows($query);
	if ($resultAgendamento > 0){
		$_SESSION["erroConsulta"] = "Está consulta já foi marcada.";
		header("Location: agendamento.php");
		die();
	}

	$queryNum = mysqli_query($conn, "SELECT * FROM AgendamentoConsulta WHERE DT_AgendamentoConsulta = '$nmDia'") or die(mysqli_error($conn));
	$resultNum = mysqli_num_rows($queryNum);
	if ($resultNum == 15){
		$_SESSION["erroConsulta"] = "Este dia já tem o limite de consultas.";
		header("Location: agendamento.php");
		die();
	}

	$insert = mysqli_query($conn, "INSERT INTO AgendamentoConsulta VALUES (NULL, '$nmDia', 'Em Aberto', NULL, '$membro', '$nmConsulta')") or die(mysqli_error($conn));
?>
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
		<!-- BOOTSTRAP DATAPICKER -->
		<link rel="stylesheet" href="css/bootstrap-datepicker3.min.css">
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
							<a href="consultas-marcadas.php">  CONSULTAS MARCADAS </a>
						</li>
						<li>
							|
						</li>
						<li>
							<a href="consultas-efetuadas.php"> CONSULTAS EFETUADAS </a>
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
	<div class="container-fluid agendamentoMain">
		<div class="row agendamentoRow">
			<div class="col-xs-7 formCol">
				<div class="row">
					<div class="sucesso col-xs-12">
						<h1>Agendamento realizado com sucesso</h1>
						<table>							
							<tbody>
								<tr>
									<td>
										<h2>
											Unidade Básica: 
										</h2>
									</td>
									<td>
										<h2>
											<?php  
												if ($_SESSION["CD_Ubs"] == 1){
													echo "<a href='https://www.google.com/maps?ll=-24.112192,-46.659059&z=16&t=m&hl=pt-BR&gl=US&mapclient=embed&q=Av.+Monteiro+Lobato,+6092+-+Balneario+Anchieta+Mongagu%C3%A1+-+SP+11730-000+Brasil' target='_blank'>";
												}
												echo $_SESSION["NM_Ubs"];
											?> </a>
										</h2>
									</td>
								</tr>	
								<tr>
									<td>
										<h2>
											Nome do Paciente: 
										</h2>
									</td>
									<td>
										<h2>
											<?php 
												$selectPac = mysqli_query($conn, "SELECT NM_Paciente, NR_Cpf FROM Paciente WHERE NR_Cpf = '$membro'") or die(mysqli_error($conn));
												$resultPac = mysqli_fetch_array($selectPac);
												echo $resultPac["NM_Paciente"]; 
											?>			
										</h2>
									</td>
								</tr>
								<tr>
									<td>
										<h2>
											CPF do Paciente: 
										</h2>
									</td>
									<td>
										<h2>
											<?php
												echo $resultPac["NR_Cpf"]; 
											?>		
										</h2>
									</td>
								</tr>	
								<tr>
									<td>
										<h2>
											Consulta: 
										</h2>
									</td>
									<td>
										<h2>
											<?php
												$selectCon = mysqli_query($conn, "SELECT NM_Consulta FROM Consulta WHERE CD_Consulta = '$nmConsulta'") or die(mysqli_error($conn));
												$resultCon = mysqli_fetch_array($selectCon);
												echo $resultCon["NM_Consulta"]; 
											?>		
										</h2>
									</td>
								</tr>
								<tr>
									<td>
										<h2>
											Dia marcado:  
										</h2>
									</td>
									<td>
										<h2>
											<?php
												echo $nmDia;
											?>		
										</h2>
									</td>
								</tr>						
							</tbody>
						</table>
					</div>
				</div>	
				<div class="row">
					<div class="col-xs-12 btnSucesso">
						<a class="btn btn-default" href="agendamento.php" role="button">Agendar outra Consulta</a>
						<a class="btn btn-default" href="perfil.php" role="button">Voltar para Inicio</a>
					</div>
				</div>
			</div>
			<div class="col-xs-5 infoCol">
				<p><i class="glyphicon glyphicon-chevron-right"></i> Membro do grupo residencial: <span>Escolha o membro de seu grupo residencial a qual irá realizar a consulta.</span></p>
				<p><i class="glyphicon glyphicon-chevron-right"></i> Tipo de consulta: <span>Escolha a consulta que precisa.</span></p>
				<p><i class="glyphicon glyphicon-chevron-right"></i> Dia do agendamento: <span>Escolha um dia disponivel a qual será realizado a consulta.</span></p>
				<p><i class="glyphicon glyphicon-chevron-right"></i> Consultas: <span>As consultas serão feitas por ordem de chegada a UBS.</span></p>
			</div>
		</div>
	</div>
	<!-- JQUERY -->
	<script src="js/jquery-3.1.0.min.js"></script>
	<!-- BOOTSTRAP JS -->
	<script src="js/bootstrap.min.js"></script>
	<!-- BOOTSRAP DATAPICKER -->
	<script src="js/bootstrap-datepicker.min.js"></script>
	<!-- BOOTSRAP DATAPICKER -->
	<script src="js/bootstrap-datepicker.pt-BR.min.js"></script>
	<!-- JS -->
	<script type="text/javascript" src="js/js.js"></script>
</body>
</html>