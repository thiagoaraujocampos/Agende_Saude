<?php 
	include_once("conexao.php");
	session_start();

	//VALIDA DADOS
	if( isset($_POST["pront"]) && isset($_POST["senha"]) ){
		$pront = mysqli_real_escape_string($conn, $_POST["pront"]); //SQL Inject
		$senha = mysqli_real_escape_string($conn, $_POST["senha"]);
		//$senha = sha1($senha);
		$sql = mysqli_query($conn, "SELECT CD_Prontuario, NM_Senha, ID_Status FROM Prontuario WHERE CD_Prontuario LIKE '$pront' AND NM_Senha LIKE '$senha'") or die(mysqli_error($conn));
		$result = mysqli_num_rows($sql);
		$status = mysqli_fetch_array($sql);
		if ($result > 0) {
			if ($status["ID_Status"] == 1){
				$_SESSION['pront'] = $pront;
				$_SESSION['senha'] = $senha;
				header("Location: perfil.php");	
			} else {
				$_SESSION["loginErro"] = "Prontuário desativado (Entre em contato com sua UBS).";
				header("Location: index.php");	
			}
		} else {
			$_SESSION["loginErro"] = "Prontuario ou Senha inválido.";
			header("Location: index.php");	
		}
	} else {
		$_SESSION["loginErro"] = "Prontuario ou Senha inválido.";
		header("Location: index.php");		
	}
?>