<?php  
	include_once("../conexao.php");
	session_start();
	if(!isset($_SESSION["cpf"]) || !isset($_SESSION["senha"])) {
		$_SESSION["loginErro"] = "CPF ou Senha inválido.";
		header("Location: ../login.php");
		die();
	}
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

   function gerar_senha($tamanho, $maiusculas, $minusculas, $numeros, $simbolos){
      $ma = "ABCDEFGHIJKLMNOPQRSTUVYXWZ"; // $ma contem as letras maiusculas
      $mi = "abcdefghijklmnopqrstuvyxwz"; // $mi contem as letras minusculas
      $nu = "0123456789"; // $nu contem os numeros
      $si = "!@#$%¨&*()_+="; // $si contem os sibolos
                                        
      if ($maiusculas){
            // se $maiusculas for "true", a variavel $ma é embaralhada e adicionada para a variavel $senha
            @$senha .= str_shuffle($ma);
      }
        
        if ($minusculas){
            // se $minusculas for "true", a variavel $mi é embaralhada e adicionada para a variavel $senha
            @$senha .= str_shuffle($mi);
        }
        
        if ($numeros){
            // se $numeros for "true", a variavel $nu é embaralhada e adicionada para a variavel $senha
            @$senha .= str_shuffle($nu);
        }
        
        if ($simbolos){
            // se $simbolos for "true", a variavel $si é embaralhada e adicionada para a variavel $senha
            @$senha .= str_shuffle($si);
        }
        
        // retorna a senha embaralhada com "str_shuffle" com o tamanho definido pela variavel $tamanho
        return substr(str_shuffle($senha),0,$tamanho);
    }

	function verifica_CPF($valor) //987767546543
	{

		$n[1] = substr($valor,0,1);
		$n[2] = substr($valor,1,1);
		$n[3] = substr($valor,2,1);
		$n[4] = substr($valor,4,1);
		$n[5] = substr($valor,5,1);
		$n[6] = substr($valor,6,1);
		$n[7] = substr($valor,8,1);
		$n[8] = substr($valor,9,1);
		$n[9] = substr($valor,10,1);
		$n[10] = substr($valor,12,1);
		$n[11] = substr($valor,13,1);
		
		$soma1 = ($n[1] * 10 +
				  $n[2] *  9 +
				  $n[3] *  8 +
				  $n[4] *  7 +
				  $n[5] *  6 +
				  $n[6] *  5 +
				  $n[7] *  4 +
				  $n[8] *  3 +
				  $n[9] *  2 );
				  
		$d1 = 11 - ($soma1 % 11);
		
		if( $d1 == 10 or $d1 == 11)
		{
			$d1 = 0;
		}
		
		$soma2 = ($n[1] * 11 +
				  $n[2] * 10 +
				  $n[3] *  9 +
				  $n[4] *  8 +
				  $n[5] *  7 +
				  $n[6] *  6 +
				  $n[7] *  5 +
				  $n[8] *  4 +
				  $n[9] *  3 +
				  $d1   *  2 );
				  
		$d2 = 11 - ($soma2 % 11);
		
		if( $d2 == 10 or $d2 == 11)
		{
			$d2 = 0;
		}
		
		if(($d1 <> $n[10]) or ($d2 <> $n[11]) or $valor == "000.000.000-00" or $valor == "111.111.111-11" or $valor == "222.222.222-22" or $valor == "333.333.333-33" or $valor == "444.444.444-44" or $valor == "555.555.555-55" or $valor == "666.666.666-66" or $valor == "777.777.777-77" or $valor == "888.888.888-88" or $valor == "999.999.999-99")
		{
			$erro = true;
		}
		else
		{
			$erro = false;
		}
		return $erro;
	}

	if( !isset($_POST["cpfChefe"]) ){
		$_SESSION["cadastroProntErro"] = "Digite o CPF do Chefe residencial.";
		header("Location: cadastroProntuario.php");
		die();
	} else {
		$cpfChefe = $_POST["cpfChefe"];
		$_SESSION["cpfChefe"] = $cpfChefe;
	}

	if( !isset($_POST["nomeChefe"]) ){
		$_SESSION["cadastroProntErro"] = "Digite o Nome do Chefe residencial.";
		header("Location: cadastroProntuario.php");
		die();
	} else {
		$nomeChefe = $_POST["nomeChefe"];
		$_SESSION["nomeChefe"] = $nomeChefe;
	}

	if( !isset($_POST["sexoChefe"]) ){
		$_SESSION["cadastroProntErro"] = "Selecione o Sexo do Chefe residencial.";
		header("Location: cadastroProntuario.php");
		die();
	} else {
		$sexoChefe = $_POST["sexoChefe"];
	}

	if( !isset($_POST["susChefe"]) ){
		$_SESSION["cadastroProntErro"] = "Selecione o SUS do Chefe residencial.";
		header("Location: cadastroProntuario.php");
		die();
	} else {
		$susChefe = $_POST["susChefe"];
		$_SESSION["susChefe"] = $susChefe;
	}

	if( !isset($_POST["endereco"]) ){
		$_SESSION["cadastroProntErro"] = "Digite o endereco da residencia.";
		header("Location: cadastroProntuario.php");
		die();
	} else {
		$endereco = $_POST["endereco"];
		$_SESSION["endereco"] = $endereco;
	}

	if( !isset($_POST["bairro"]) ){
		$_SESSION["cadastroProntErro"] = "Digite o bairro da residencia.";
		header("Location: cadastroProntuario.php");
		die();
	} else {
		$bairro = $_POST["bairro"];
		$_SESSION["bairro"] = $bairro;
	}

	$complemento = $_POST["complemento"];
	$_SESSION["complemento"] = $complemento;

	if( !isset($_POST["numero"]) ){
		$_SESSION["cadastroProntErro"] = "Digite o numero da residencia.";
		header("Location: cadastroProntuario.php");
		die();
	} else {
		$numero = $_POST["numero"];
		$_SESSION["numero"] = $numero;
	}

	if( $_POST["numTel"] == "" && $_POST["numCel"] == "" && $_POST["email"] == ""){
		$_SESSION["cadastroProntErro"] = "Digite pelo menos um meio de contato.";
		header("Location: cadastroProntuario.php");
		die();
	} else {
		$numTel = @$_POST["numTel"];
		$_SESSION["numTel"] = $numTel;
		$numCel = @$_POST["numCel"];
		$_SESSION["numCel"] = $numCel;
		$email = @$_POST["email"];
		$_SESSION["email"] = $email;
	}

	if ($_POST["email"] == "") {
		if( !isset($_POST["senha"]) ){
			$_SESSION["cadastroProntErro"] = "Digite uma senha ou insira uma email.";
			header("Location: cadastroProntuario.php");
			die();
		} else {
			$senha = $_POST["senha"];
			//$senha = sha1($senha);
		}
	} else {
		$senha = gerar_senha(8, true, true, true, false);
		//$senha = sha1($senha);
	}

	if(verifica_CPF($cpfChefe))
	{
		$_SESSION["cadastroProntErro"] = "CPF inválido.";
		header("Location: cadastroProntuario.php");
		die();
	}

	$qnt = $_POST["qnt"];
	$prontAtual = $_POST["prontAtual"];

	$queryPront = mysqli_query($conn, "SELECT NM_Paciente, NR_Cpf, ID_Prontuario FROM Paciente WHERE NR_Cpf = '$cpfChefe'") or die(mysqli_error($conn));
	$resultPront = mysqli_num_rows($queryPront);

	$mostraPacPront = mysqli_fetch_array($queryPront);
	if ($resultPront > 0){
		$_SESSION["cadastroProntErro"] = $mostraPacPront["NM_Paciente"] . " portador do CPF " . $mostraPacPront["NR_Cpf"] . " já está cadastrado no Prontuário " . $mostraPacPront["ID_Prontuario"] . ".";
		header("Location: cadastroProntuario.php");
		die();
	}


	if($qnt != 0){
		for($x = 1; $x <= $qnt; $x++){

			$nomeMembro[$x] = $_POST["nomeMembro" . $x];
			$cpfMembro[$x] = $_POST["cpfMembro" . $x];
			$susMembro[$x] = $_POST["susMembro" . $x];
			$sexoMembro[$x] = $_POST["sexoMembro" . $x];

			if( !isset($_POST["nomeMembro" . $x]) ){
				$_SESSION["cadastroProntErro"] = "Digite o Nome do Membro.";
				header("Location: cadastroProntuario.php");
				die();
			} else {
				$nomeMembro[$x] = $_POST["nomeMembro" . $x];
			}

			if( !isset($_POST["cpfMembro" . $x]) ){
			$_SESSION["cadastroProntErro"] = "Digite o CPF do " . $nomeMembro[$x] . ".";
			header("Location: cadastroProntuario.php");
			die();
			} else {
				$cpfMembro[$x] = $_POST["cpfMembro" . $x];
			}

			if(verifica_CPF($cpfMembro[$x]))
			{
				$_SESSION["cadastroProntErro"] = "CPF de " . $nomeMembro[$x] . " está inválido.";
				header("Location: cadastroProntuario.php");
				die();
			}

			$vCpfExiste = $cpfMembro[$x];

			$queryCpf = mysqli_query($conn, "SELECT NM_Paciente, NR_Cpf, ID_Prontuario FROM Paciente WHERE NR_Cpf = '$vCpfExiste'") or die(mysqli_error($conn));

			$resultvCpf = mysqli_num_rows($queryCpf);

			$mostravCpf = mysqli_fetch_array($queryCpf);

			if ($resultvCpf > 0){
				$_SESSION["cadastroProntErro"] = $mostravCpf["NM_Paciente"] . " portador do CPF " . $mostravCpf["NR_Cpf"] . " já está cadastrado no Prontuário " . $mostravCpf["ID_Prontuario"] . ".";
				header("Location: cadastroProntuario.php");
				die();
			}

			if( !isset($_POST["susMembro" . $x]) ){
				$_SESSION["cadastroProntErro"] = "Digite o SUS do Membro.";
				header("Location: cadastroProntuario.php");
				die();
			} else {
				$susMembro[$x] = $_POST["susMembro" . $x];
			}

			if( !isset($_POST["sexoMembro" . $x]) ){
				$_SESSION["cadastroProntErro"] = "Selecione o Sexo do Membro.";
				header("Location: cadastroProntuario.php");
				die();
			} else {
				$sexoMembro[$x] = $_POST["sexoMembro" . $x];
			}
		}
	}

	$ubs = $mostraFunc["ID_Ubs"];

	$insertPront = mysqli_query($conn, "INSERT INTO Prontuario VALUES (NULL, '$endereco', '$bairro', '$complemento', '$numero', '$numTel', '$numCel', '$email', '$senha', '1', '$ubs')") or die(mysqli_error($conn));

	$insertPacienteChefe = mysqli_query($conn, "INSERT INTO Paciente VALUES ('$cpfChefe', '$susChefe', '$nomeChefe', '$sexoChefe', '1', '1', '$prontAtual')") or die(mysqli_error($conn));

	if($qnt != 0){
		for($x = 1; $x <= $qnt; $x++){
			$insertPaciente = mysqli_query($conn, "INSERT INTO Paciente VALUES ('$cpfMembro[$x]', '$susMembro[$x]', '$nomeMembro[$x]', '$sexoMembro[$x]', '0', '1', '$prontAtual')") or die(mysqli_error($conn));
		}
	}
	

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
	<link rel="icon" type="image/png" href="../IMG/favicon.png"/>
	<link rel="shortcut icon" href="../IMG/favicon.ico" >
	<!-- FONT AWESOME -->
	<link rel="stylesheet" href="../css/font-awesome.min.css">
	<!-- FONT LATO -->
	<link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel="stylesheet">
	<!-- BOOTSTRAP CSS -->
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<!-- BOOTSTRAP THEME CSS -->
	<link rel="stylesheet" href="../css/bootstrap-theme.min.css">
	<!-- CSS/JS -->
	<link rel="stylesheet" type="text/css" href="../style.css"/>
	<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	<script type="text/javascript">
	function habilita() {
		var habilita = document.getElementById('email');
		if (habilita.value != ""){
			document.getElementById('senha').disabled = true;
		} else {
			document.getElementById('senha').disabled = false;
		}
	};
	</script>
</head>
<body onload="habilita();">
	<div class="container-fluid fPrincipal">
		<div class="row fRow">
			<div class="col-xs-3 fMenuCol">
				<div class="col-xs-8 col-xs-offset-2">
					<a href="principalFunc.php"><img src="../IMG/ASLogo.png" alt=""></a>
				</div>
				<div class="col-xs-10 col-xs-offset-1" id="menuPesquisar">
					<div class="input-group">
						<input type="text" class="form-control" placeholder="Procurar ...">
						<span class="input-group-btn">
							<button class="btn btn-primary" type="button"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
						</span>
					</div>
				</div>
				<div class="col-xs-12 menuFunc">
					<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
						<div class="panel panel-primary panel-teste">
							<div class="panel-heading" role="tab" id="headingOne">
								<h4 class="panel-title">
									<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
										Prontuário
									</a>
								</h4>
							</div>
							<div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
								<ul class="list-group">
									<a href="cadastroProntuario.php"><li class="list-group-item">Cadastrar</li></a>
									<a href="gerenciarProntuario.php"><li class="list-group-item">Gerenciar</li></a>
								</ul>
							</div>
						</div>
						<div class="panel panel-primary">
							<div class="panel-heading" role="tab" id="headingTwo">
								<h4 class="panel-title">
									<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
										Especialidade Médica
									</a>
								</h4>
							</div>
							<div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
								<ul class="list-group">
									<a href="cadastrarConsulta.php"><li class="list-group-item">Cadastrar</li></a>
									<a href="gerenciarConsulta.php"><li class="list-group-item">Gerenciar</li></a>
								</ul>
							</div>
						</div>
						<div class="panel panel-primary">
							<div class="panel-heading" role="tab" id="headingThree">
								<h4 class="panel-title">
									<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
										Agendamento
									</a>
								</h4>
							</div>
							<div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
								<ul class="list-group">
									<a href="agendarNovo.php"><li class="list-group-item">Novo</li></a>
									<a href="gerenciarAgenda.php"><li class="list-group-item">Gerenciar</li></a>
								</ul>
							</div>
						</div>
						<div class="panel panel-primary">
							<div class="panel-heading" role="tab" id="headingFour">
								<h4 class="panel-title">
									<a class="collapsed" role="button" href="relatorio.php">
										Relatório
									</a>
								</h4>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-9 col-xs-offset-3 fTopCol bg-primary">
				<span>Bem-vindo(a) 
				<?php 
					$cpf = $_SESSION["cpf"];
					$sql = mysqli_query($conn, "SELECT NR_Cpf, NM_Funcionario, CD_Nivel FROM Funcionario WHERE NR_Cpf = '$cpf'") or die(mysqli_error($conn));
					$mostraFunc = mysqli_fetch_array($sql);
					echo $mostraFunc["NM_Funcionario"] . ".";
				?>
				</span>
				<a href="../login.php">Sair</a>
			</div>
			<div class="col-xs-9 col-xs-offset-3 text-justify fMain">
				<div class="col-xs-12 branco sombra cadastroPront">
					<h1 class="text-center">Prontuário cadastrado com sucesso.</h1>	
					<center>
						<h1>
							<small>
								Prontuário nº 
								<?php 
									echo $prontAtual;
								?>
							</small>
						</h1>
						<div class="row">
							<div class="col-xs-12">
								<?php 

									$_SESSION["cpfChefe"] = "";
									$_SESSION["nomeChefe"] = "";
									$_SESSION["susChefe"] = "";
									$_SESSION["endereco"] = "";
									$_SESSION["bairro"] = "";
									$_SESSION["numero"] = "";
									$_SESSION["numTel"] = "";
									$_SESSION["numCel"] = "";
									$_SESSION["email"] = "";
									$_SESSION["complemento"] = "";

									if($_POST["email"] != ""){
										echo "<p style='font-size: 1.5em; margin-top: 50px;'>Sua senha foi enviada para seu e-mail.</p>";
									} else {
										
									}
								?>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-12 btnSucesso">
							<a class="btn btn-default" href="cadastroProntuario.php" role="button">Cadastrar outro Prontuário</a>
								<a class="btn btn-default" href="principalFunc.php" role="button">Voltar para Inicio</a>
							</div>
						</div>
					</center>					
				</div>
			</div>
		</div>
	</div>
	<!-- JQUERY -->
	<script src="../js/jquery-3.1.0.min.js"></script>
	<!-- MASCARA CPF -->
	<script type="text/javascript" src="../js/jquery.mask.js"></script>
	<!-- BOOTSTRAP JS -->
	<script src="../js/bootstrap.min.js"></script>
	<!-- JS -->
	<script type="text/javascript" src="../js/js.js"></script>
</body>
</html>