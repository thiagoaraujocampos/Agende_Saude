<?php  
	include_once("../conexao.php");
	session_start();
	if(!isset($_SESSION["cpf"]) || !isset($_SESSION["senha"])) {
		$_SESSION["loginErro"] = "CPF ou Senha inválido.";
		header("Location: ../login.php");
		die();
	}
	$cpf = $_SESSION["cpf"];
	$_SESSION["op"] = $_POST["op"];
	$_SESSION["pesq"] = $_POST["pesq"];
	$tipo = $_POST["tipofunc"];

	if ($tipo == "func"){
		$func = $_POST["func"];

		if(!isset($_POST["desativa"])){
			$sit = $_POST["ativa"];
		} else {
			$sit = $_POST["desativa"];
		}

		$updateAg = mysqli_query($conn, "UPDATE Funcionario SET ID_Status = '$sit' WHERE NR_Cpf = '$func'") or die(mysqli_error($conn));
	}

	if ($tipo == "medico"){
		$medico = $_POST["medico"];

		if(!isset($_POST["desativa"])){
			$sit = $_POST["ativa"];
		} else {
			$sit = $_POST["desativa"];
		}

		$updateAg = mysqli_query($conn, "UPDATE Medico SET ID_Status = '$sit' WHERE NR_Cpf = '$medico'") or die(mysqli_error($conn));
	}

	if ($tipo == "enfe"){
		$enfe = $_POST["enfe"];

		if(!isset($_POST["desativa"])){
			$sit = $_POST["ativa"];
		} else {
			$sit = $_POST["desativa"];
		}

		$updateAg = mysqli_query($conn, "UPDATE Enfermeiro SET ID_Status = '$sit' WHERE NR_Cpf = '$enfe'") or die(mysqli_error($conn));
	}


	//$updateAg = mysqli_query($conn, "UPDATE AgendamentoConsulta SET NM_Situacao = '$sit' WHERE CD_AgendamentoConsulta = '$ag'") or die(mysqli_error($conn));
	
	header("Location: gerenciarFunc.php");

?>