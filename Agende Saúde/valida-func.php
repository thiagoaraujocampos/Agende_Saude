<?php 
	include_once("conexao.php");
	session_start();

	//VALIDA DADOS
	if( isset($_POST["cpf"]) && isset($_POST["senha"]) ){
		$cpf = mysqli_real_escape_string($conn, $_POST["cpf"]); //SQL Inject
		$senha = mysqli_real_escape_string($conn, $_POST["senha"]);
		//$senha = sha1($senha);
		$sql = mysqli_query($conn, "SELECT * FROM Funcionario WHERE NR_Cpf = '$cpf' AND NM_Senha = '$senha'") or die(mysqli_error($conn));
		$result = mysqli_num_rows($sql);
		$mostraFunc = mysqli_fetch_array($sql);
		if ($result > 0) {
			$_SESSION['cpf'] = $cpf;
			$_SESSION['senha'] = $senha;
			if ($mostraFunc["ID_Status"] == 0) {
				$_SESSION["loginErro"] = "Funcionário desativado.";
				header("Location: login.php");	
				die();
			}
			if ($mostraFunc["CD_Nivel"] == 0) {
				header("Location: recepcao/principalFunc.php");
			} else if ($mostraFunc["CD_Nivel"] == 1) {
				header("Location: chefe/principalFunc.php");
			} else if ($mostraFunc["CD_Nivel"] == 2) {
				header("Location: diretora/principalFunc.php");
			}
		} else {
			$_SESSION["loginErro"] = "CPF ou Senha inválido.";
			header("Location: login.php");	
		}
	} else {
		$_SESSION["loginErro"] = "CPF ou Senha inválido.";
		header("Location: login.php");		
	}
?>