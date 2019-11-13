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
		
	} else if ($mostraFunc["CD_Nivel"] == 1) {
		header("Location: ../login.php");
		die();
	} else if ($mostraFunc["CD_Nivel"] == 2) {
		header("Location: ../login.php");
		die();
	}
	}

	$cpfPaciente = $_POST["cpfPac"];
	$prontAtual = $_POST["prontDel"];
	$_SESSION["prontAtual"] = $prontAtual;

	$sqlPac = mysqli_query($conn, "SELECT * FROM Paciente WHERE NR_Cpf = '$cpfPaciente'") or die(mysqli_error($conn));
	$mostraPac = mysqli_fetch_array($sqlPac);
	
	if($mostraPac["ID_Chefe"] == 1){
		$_SESSION["cadastroAlProntErro"] = "Não é possivel excluir o Chefe Residencial, altere antes de excluir.";
		header("Location: alterarPront.php");
		die();
	}

	$sqlDelCon = mysqli_query($conn, "DELETE FROM AgendamentoConsulta WHERE ID_Paciente = '$cpfPaciente'") or die(mysqli_error($conn));
	$sqlDelPac = mysqli_query($conn, "DELETE FROM Paciente WHERE NR_Cpf = '$cpfPaciente'") or die(mysqli_error($conn));
	header("Location: alterarPront.php");

?>