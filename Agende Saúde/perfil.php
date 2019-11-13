<?php  
	include_once("conexao.php");
	session_start();
	if(!isset($_SESSION["pront"]) || !isset($_SESSION["senha"])) {
		$_SESSION["loginErro"] = "Prontuario ou Senha inválido.";
		header("Location: index.php");
		die();
	} else {

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
							<a href="#"> INICIO </a>
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
	<div class="container-fluid perfilMain">
		<div class="row perfilPrincipal">
			<div class="familia col-xs-3">
				<h2>Grupo Residencial</h2>
				<?php 
					$pront = $_SESSION["pront"];
					$selectMembro 	= mysqli_query($conn, "SELECT NM_Paciente, ID_Chefe FROM Paciente, Prontuario WHERE ID_Prontuario = CD_Prontuario AND ID_Prontuario LIKE '$pront' ORDER BY ID_Chefe DESC, NM_Paciente ASC") or die(mysqli_error($conn));
					$result 		= mysqli_num_rows($selectMembro);						
					while($mostraMembro = mysqli_fetch_array($selectMembro)) {
						echo "<div class='membro'><i class='fa fa-user fa-lg' aria-hidden='true'></i>" . $mostraMembro["NM_Paciente"]; 
							if ($mostraMembro["ID_Chefe"] == 1) { 
								echo "<small class='chefe'> (Chefe)</small>"; 
							}
						echo "</div>";
					}
				?>
			</div>
			<div class="sliderPerfil col-xs-9" style="height: 100%;">
				<div id="carousel-example-generic" class="carousel slide" data-ride="carousel" style="height: 100%;">
					<!-- Indicators -->
					<ol class="carousel-indicators">
						<li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
						<li data-target="#carousel-example-generic" data-slide-to="1"></li>
						<li data-target="#carousel-example-generic" data-slide-to="2"></li>
						<li data-target="#carousel-example-generic" data-slide-to="3"></li>
					</ol>
					<!-- Wrapper for slides -->
					<div class="carousel-inner" role="listbox" style="height: 100%;">
						<div class="item active" style="height: 100%;">
							<img src="IMG/1.jpg" style="height: 100%; width: 100%;">
							<div class="carousel-caption">
								<h2>Pré-Natal</h2>
								<h3>Acompanhamento da gestante durante a gravidez.</h3>
							</div>
						</div>
						<div class="item" style="height: 100%;">
							<img src="IMG/2.jpg" style="height: 100%; width: 100%;">
							<div class="carousel-caption">
								<h2>Exames Laboratoriais</h2>
								<h3>Testes realizados em laboratórios de ánalises clínicas.</h3>
							</div>
						</div>
						<div class="item" style="height: 100%;">
							<img src="IMG/3.jpg" style="height: 100%; width: 100%;">
							<div class="carousel-caption">
								<h2>Pediatria</h2>
								<h3>Assistência à criança e ao adolescente.</h3>
							</div>
						</div>
						<div class="item" style="height: 100%;">
							<img src="IMG/4.jpg" style="height: 100%; width: 100%;">
							<div class="carousel-caption">
								<h2>Clínico Geral</h2>
								<h3>Verifica os sintomas dos pacientes.</h3>
							</div>
						</div>
					</div>
					<!-- Controls -->
					<a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
						<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
						<span class="sr-only">Previous</span>
					</a>
					<a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
						<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
						<span class="sr-only">Next</span>
					</a>
				</div>
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