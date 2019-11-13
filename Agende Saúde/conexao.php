<?php  
	$servidor = "localhost";
	$usuario = "finis_finis";
	$senha = "berecanograu123";
	$dbnome = "finis_AgendeSaude";

	//CONEXÃO
	$conn = mysqli_connect($servidor, $usuario, $senha, $dbnome);

	if(!$conn){
		die("Falha na conexão: " . mysqli_connect_error());
	} else {
		//echo "Conexão Realizada com Sucesso."
	}
?>