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

	$ag = $_POST["cancelAg"];

	$updateAg = mysqli_query($conn, "UPDATE AgendamentoConsulta SET NM_Situacao = 'Cancelada' WHERE CD_AgendamentoConsulta = '$ag'") or die(mysqli_error($conn));
	
	header("Location: consultas-marcadas.php");

?>