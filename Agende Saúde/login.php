<?php  
	include_once("conexao.php");
	session_start();
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
	<div class="container-fluid lPrincipal">
		<div class="row lImgRow">
			<div class="col-xs-4 col-xs-offset-4 lImg">
				<img src="IMG/ASLogo.png" alt="">
			</div>
		</div>
		<div class="row lFormRow">
			<div class="col-xs-2 col-xs-offset-5 lForm">
				<form action="valida-func.php" method="POST">
					<div class="form-group">
						<input type="text" class="form-control simple-field-data-mask" maxlength="14" data-mask="000.000.000-00" id="cpfInput" placeholder="CPF" autocomplete="off" name="cpf">
						<input type="password" class="form-control" id="senhaInput" placeholder="Senha" autocomplete="off" name="senha">
						<p class=" text-center">
						<?php 
							if(isset($_SESSION['loginErro'])){
								echo "<p class='erroFunc'>" . $_SESSION["loginErro"] . "</p>";
								unset($_SESSION['loginErro']);
							} else {
								
							}
							session_destroy();
						?>
						</p>
					</div>
					<button type="submit" class="btn btn-primary">Entrar</button><br>
					<a href="index.php" class="btn btn-default">Voltar</a>
				</form>
			</div>
		</div>
	</div>
	<!-- JQUERY -->
	<script src="js/jquery-3.1.0.min.js"></script>
	<!-- MASCARA CPF -->
	<script type="text/javascript" src="js/jquery.mask.js"></script>
	<!-- BOOTSTRAP JS -->
	<script src="js/bootstrap.min.js"></script>
	<!-- JS -->
	<script type="text/javascript" src="js/js.js"></script>
</body>
</html>