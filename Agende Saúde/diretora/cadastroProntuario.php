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
		header("Location: ../login.php");
		die();
	} else if ($mostraFunc["CD_Nivel"] == 1) {
		header("Location: ../login.php");
		die();
	} else if ($mostraFunc["CD_Nivel"] == 2) {
		
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
							<div class="panel-heading" role="tab" id="headingFive">
								<h4 class="panel-title">
									<a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
										Funcionários
									</a>
								</h4>
							</div>
							<div id="collapseFive" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFive">
								<ul class="list-group">
									<a href="cadastroFunc.php"><li class="list-group-item">Novo Funcionário</li></a>
									<a href="gerenciarFunc.php"><li class="list-group-item">Gerenciar Funcionário</li></a>
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
					echo $mostraFunc["NM_Funcionario"] . ".";
				?>
				</span>
				<a href="../sair.php">Sair</a>
			</div>
			<div class="col-xs-9 col-xs-offset-3 text-justify fMain">
				<div class="col-xs-12 branco sombra cadastroPront">
					<h1 class="text-center">Cadastro de Prontuário</h1>	
					<center>
						<h1>
							<small>
								Prontuário nº 
								<?php 
									$selectPront = mysqli_query($conn, "SELECT CD_Prontuario FROM Prontuario")  or die(mysqli_error($conn));
									$resultPront = mysqli_num_rows($selectPront);
									$prontAtual = $resultPront + 1;
									echo $prontAtual;
								?>
							</small>
						</h1>
						<?php
							if(isset($_SESSION["cadastroProntErro"])){
								echo "<p class='text-center text-danger' style='font-size:1.4em; margin:12px 0 0 0;'>" . $_SESSION["cadastroProntErro"] . "</p>";
								unset($_SESSION["cadastroProntErro"]);
							}
						?>
					</center>
					<form action="valida-pront.php" method="POST">
						<input type="hidden" name="prontAtual" value="<?php echo $prontAtual; ?>">
						<h2>Dados Pessoais <small>(Chefe Residencial)</small></h2>
						<div class="row">
							<div class="col-xs-6">
								<div class="form-group">
									<label for="nome1">Nome</label>
									<input type="text" class="form-control" id="nome1" placeholder="Nome" autocomplete="off" value="<?php echo @$_SESSION["nomeChefe"]; unset($_SESSION['nomeChefe']); ?>" name="nomeChefe" required>
								</div>
							</div>
							<div class="col-xs-6">
								<div class="form-group" id="sexo1">
									<label for="sexo1">Sexo</label>
									<select class="form-control" name="sexoChefe" required>
										<option value="" disabled selected>Escolha uma opção</option>
										<option value="Masculino">Masculino</option>
										<option value="Feminino">Feminino</option>
									</select>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-6">
								<div class="form-group">
									<label for="cpf1">CPF</label>
									<input onblur="valida();" type="text" class="form-control simple-field-data-mask" maxlength="14" data-mask="000.000.000-00" id="cpf1" placeholder="CPF" autocomplete="off" value="<?php echo @$_SESSION["cpfChefe"]; unset($_SESSION['cpfChefe']); ?>" name="cpfChefe" required>
									<p id="errow" class="text-center text-danger" style="margin:12px 0 0 0;"></p>
								</div>
							</div>
							<div class="col-xs-6">
								<div class="form-group">
									<label for="sus1">SUS</label>
									<input type="text" class="form-control simple-field-data-mask" id="sus1" placeholder="SUS" maxlength="18" data-mask="000 0000 0000 0000" autocomplete="off" value="<?php echo @$_SESSION["susChefe"]; unset($_SESSION['susChefe']); ?>" name="susChefe" required>
								</div>
							</div>
						</div>		
						<h2>Endereço</h2>
						<div class="row">
							<div class="col-xs-6">
								<div class="form-group">
									<label for="endereço1">Endereço</label>
									<input type="text" class="form-control" id="endereço1" placeholder="Endereço" autocomplete="off" value="<?php echo @$_SESSION["endereco"]; unset($_SESSION['endereco']); ?>" name="endereco" required>
								</div>
							</div>
							<div class="col-xs-6">
								<div class="form-group">
									<label for="bairro1">Bairro</label>
									<input type="text" class="form-control" id="bairro1" placeholder="Bairro" autocomplete="off" value="<?php echo @$_SESSION["bairro"]; unset($_SESSION['bairro']); ?>" name="bairro" required>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-6">
								<div class="form-group">
									<label for="complemento1">Complemento</label>
									<input type="text" class="form-control" id="complemento1" placeholder="Complemento" autocomplete="off" value="<?php echo @$_SESSION["complemento"]; unset($_SESSION['complemento']);?>" name="complemento">
								</div>
							</div>
							<div class="col-xs-6">
								<div class="form-group">
									<label for="numero1">Número</label>
									<input type="text" class="form-control" id="numero1" placeholder="Número" autocomplete="off" value="<?php echo @$_SESSION["numero"]; unset($_SESSION['numero']); ?>" name="numero" required>
								</div>
							</div>
						</div>		
						<h2>Contatos</h2>
						<div class="row">
							<div class="col-xs-6">
								<div class="form-group">
									<label for="telefone1">Telefone</label>
									<input type="text" class="form-control simple-field-data-mask" id="telefone1" placeholder="(xx) xxxx-xxxx" maxlength="14" data-mask="(00) 0000-0000" autocomplete="off" value="<?php echo @$_SESSION["numTel"]; unset($_SESSION['numTel']); ?>" name="numTel">
								</div>
							</div>
							<div class="col-xs-6">
								<div class="form-group">
									<label for="celular1">Celular</label>
									<input type="text" class="form-control simple-field-data-mask" id="celular1" maxlength="15" data-mask="(00) 00000-0000" placeholder="(xx) xxxxx-xxxx" autocomplete="off" value="<?php echo @$_SESSION["numCel"]; unset($_SESSION['numCel']); ?>" name="numCel">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-6">
								<div class="form-group">
									<label for="email1">Email</label>
									<input type="email" class="form-control" autocomplete="off" id="email" placeholder="Email" value="<?php echo @$_SESSION["email"]; unset($_SESSION['email']); ?>" onblur="habilita();" name="email">
								</div>
							</div>	
							<div class="col-xs-6">
								<div class="form-group">
									<label for="senha">Senha</label>
									<input type="password" class="form-control" autocomplete="off" id="senha" placeholder="Senha" name="senha">
								</div>
							</div>		
						</div>
						<h2>Membros Residenciais</h2>
						<div id="dynamicDiv">
		    			</div>					
						<div class="row rowBtn">
							<div class="col-xs-12">
								<input id="qnt" type="hidden" name="qnt" value="0">
								<a class="btn btn-default" href="javascript:void(0)" id="addInput">Adicionar Membro</a>
								<button type="submit" class="btn btn-primary" id="concluirPront">Concluir</button>
							</div>
						</div>						
					</form>
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
	<script type="text/javascript">
		function validarCPF(cpf) {  
		    cpf = cpf.replace(/[^\d]+/g,'');    
		    if(cpf == '') return false; 
		    // Elimina CPFs invalidos conhecidos    
		    if (cpf.length != 11 || 
		        cpf == "00000000000" || 
		        cpf == "11111111111" || 
		        cpf == "22222222222" || 
		        cpf == "33333333333" || 
		        cpf == "44444444444" || 
		        cpf == "55555555555" || 
		        cpf == "66666666666" || 
		        cpf == "77777777777" || 
		        cpf == "88888888888" || 
		        cpf == "99999999999")
		            return false;       
		    // Valida 1o digito 
		    add = 0;    
		    for (i=0; i < 9; i ++)       
		        add += parseInt(cpf.charAt(i)) * (10 - i);  
		        rev = 11 - (add % 11);  
		        if (rev == 10 || rev == 11)     
		            rev = 0;    
		        if (rev != parseInt(cpf.charAt(9)))     
		            return false;       
		    // Valida 2o digito 
		    add = 0;    
		    for (i = 0; i < 10; i ++)        
		        add += parseInt(cpf.charAt(i)) * (11 - i);  
		    rev = 11 - (add % 11);  
		    if (rev == 10 || rev == 11) 
		        rev = 0;    
		    if (rev != parseInt(cpf.charAt(10)))
		        return false;       
		    return true;   
		};

		$(document).ready(function(){
		    $("#cpf1").blur(function(){
		    	var cpf = $(this).val();
		    	if(validarCPF(cpf)) {
					$("#errow").text("");
				} else if(cpf == "") {
					$("#errow").text("");
				} else {
					$("#errow").text("CPF Inválido.");
				}		    
			});
		});

	</script>
	<script>
			$(function () {
			    var scntDiv = $('#dynamicDiv');
			    var num = 0;

			    $(document).on('click', '#addInput', function () {
			    	num++;
			        $('<div class="row" id="membro-mais" style="">' + 
			        		'<div class="col-xs-6">' + 
			        			'<div class="form-group">' + 
			        				'<label for="nomeMembro">Nome</label>' + 
			        				'<input type="text" class="form-control" autocomplete="off" id="nomeMembro" placeholder="Nome" value="" name="nomeMembro' + num + '" required>' + 
			        			'</div>' + 
			        		'</div>' + 
			        		'<div class="col-xs-5">' + 
			        			'<div class="form-group">' + 
			        				'<label for="cpfMembro">CPF</label>' + 
			        				'<input type="text" class="form-control cpf" id="cpfMembro" placeholder="CPF" autocomplete="off" value="" name="cpfMembro' + num + '" required>' + 
			        			'</div>' + 
			        		'</div>' + 
			        		'<div class="col-xs-6">' + 
				        		'<div class="form-group">' + 
				        			'<label for="susMembro">SUS</label>' + 
				        			'<input type="text" class="form-control sus" id="susMembro" placeholder="SUS" autocomplete="off" value="" name="susMembro' + num + '" required>' + 
				        		'</div>' + 
			        		'</div>' + 
			        		'<div class="col-xs-5">' + 
			        		'<div class="form-group" id="sexo1">' + 
			        			'<label for="sexoMEmbro">Sexo</label>' + 
			        			'<select class="form-control" name="sexoMembro' + num + '" required>' + 
			        				'<option value="" disabled selected>Escolha uma opção</option>' + 
			        				'<option value="Masculino">Masculino</option><option value="Feminino">Feminino</option>' + 
			        			'</select>' + 
			        		'</div>' + 
			       	 	'</div>' + 
			        	'<a href="javascript:void(0)" id="remInput" class="remove text-danger"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a>' + 
			       '</div>').appendTo(scntDiv);
			        $('#qnt').val(num);
					$('.cpf').mask('000.000.000-00');
					$('.sus').mask('000 0000 0000 0000');
			        return false;
			    });

			    $(document).on('click', '#remInput', function () {
		            $(this).parents('#membro-mais').remove();
		            num--;
		            $('#qnt').val(num);
			        return false;
			    });
			});
		</script>
</body>
</html>