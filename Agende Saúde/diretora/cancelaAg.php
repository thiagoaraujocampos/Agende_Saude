<?php  
	include_once("../conexao.php");
	session_start();
	if(!isset($_SESSION["cpf"]) || !isset($_SESSION["senha"])) {
		$_SESSION["loginErro"] = "CPF ou Senha inválido.";
		header("Location: ../login.php");
		die();
	}
	$cpf = $_SESSION["cpf"];
	$ag = $_POST["ag"];
	$_SESSION["data"] = $_POST["data"];
	
	if(!isset($_POST["can"])){
		$sit = $_POST["rea"];
	} else {
		$sit = $_POST["can"];
	}

	$updateAg = mysqli_query($conn, "UPDATE AgendamentoConsulta SET NM_Situacao = '$sit' WHERE CD_AgendamentoConsulta = '$ag'") or die(mysqli_error($conn));
	
	header("Location: gerenciarAgenda.php");

?>