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
	$ubs = $mostraFunc["ID_Ubs"];
	$pront = @$_POST["pront"];
	$cpfP = @$_POST["cpf"];
	if($cpfP != "") {
		$selectCpf = mysqli_query($conn, "SELECT ID_Prontuario FROM Paciente WHERE NR_Cpf = '$cpfP'") or die(mysqli_error($conn));
		$mostraCpf = mysqli_fetch_array($selectCpf);
		$pront = $mostraCpf["ID_Prontuario"];
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
	<!-- BOOTSTRAP DATAPICKER -->
	<link rel="stylesheet" href="../css/bootstrap-datepicker3.min.css">
	<!-- CSS/JS -->
	<link rel="stylesheet" type="text/css" href="../style.css"/>
	<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
	<script type="text/javascript">
	function habilita() {
		var habilita = document.getElementById('prontAg');
		if (habilita.value != ""){
			document.getElementById('cpfAg').disabled = true;
			document.getElementById('cpfAg').value = "<?php if($cpfP != ""){ echo $cpfP; } ?>";
		} else {
			document.getElementById('cpfAg').disabled = false;
			document.getElementById('cpfAg').value = "";
		}
	};

	function habilitaP() {
		var habilita = document.getElementById('cpfAg');
		if (habilita.value != ""){
			document.getElementById('prontAg').disabled = true;
			document.getElementById('prontAg').value = "<?php if($pront != ""){ echo $pront; } ?>";
		} else {
			document.getElementById('prontAg').disabled = false;
			document.getElementById('prontAg').value = "";
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
						echo $mostraFunc["NM_Funcionario"] . ".";
						?>
					</span>
					<a href="../sair.php">Sair</a>
				</div>
				<div class="col-xs-9 col-xs-offset-3 text-justify fMain">
					<div class="col-xs-12 branco sombra cadastroPront">
						<h1 class="text-center">Novo Agendamento</h1>
						<?php
						$selectPo = mysqli_query($conn, "SELECT CD_Prontuario, ID_Status, ID_Ubs FROM Prontuario WHERE CD_Prontuario = '$pront'") or die(mysqli_error($conn));
						$resultPo = mysqli_num_rows($selectPo);
						if($resultPo == 0){
							if($pront == "" and $cpfP == ""){
								$erroP = 0;
							} else if ($cpfP != ""){
								$_SESSION["erroPo"] = "Digite um CPF válido.";
								$erroP = 0;
							} else {
								$_SESSION["erroPo"] = "Digite um prontuário válido.";
								$erroP = 0;
							}									
						}
						if(isset($_SESSION["erroPo"])){
							echo "<p class='text-center text-danger' style='font-size:1.4em; margin:12px 0 0 0;'>" . $_SESSION["erroPo"] . "</p>";
							unset($_SESSION["erroPo"]);
						}
						?>
						<h2>Dados da Consulta</h2>
						<form action="" method="POST">
							<div class="row">
								<div class="col-xs-6">
									<div class="form-group">									
										<label for="prontAgendamento">Prontuário</label>
										<div class="input-group">
											<input type="text" class="form-control" id="prontAg" placeholder="Prontuário" autocomplete="off" value="<?php if($pront != ""){ echo $pront; } ?>" name="pront" required onblur="habilita();">
											<span class="input-group-btn">
												<button type="submit" class="btn btn-primary">
													<span class="glyphicon glyphicon-search" aria-hidden="true"></span>
												</button>
											</span>
										</div>
									</div>
								</div>
								<div class="col-xs-6">
									<div class="form-group">									
										<label for="cpfAgendamento">CPF</label>
										<div class="input-group">
											<input type="text" class="form-control simple-field-data-mask" data-mask="000.000.000-00" id="cpfAg" placeholder="CPF" autocomplete="off" value="" name="cpf" value="<?php if($cpfP != ""){ echo $cpfP; } ?>" required onblur="habilitaP();">
											<span class="input-group-btn">
												<button type="submit" class="btn btn-primary">
													<span class="glyphicon glyphicon-search" aria-hidden="true"></span>
												</button>
											</span>
										</div>
									</div>
								</div>
							</div>
						</form>
						<form action="valida-agendamento.php" method="post">
							<div class="row">
								<input type="hidden" name="cdPront" value=" <?php echo $pront; ?> ">
								<div class="col-xs-6">
									<div class="form-group" id="membroResi">
										<label for="membroResi">Membro da Residencia</label>
										<select class="form-control" name="membro" <?php if($erroP == 0){	echo "disabled"; } ?> >
											<option value="" disabled selected>Ecolha uma opção</option>
											<?php  
											$selectMembro 	= mysqli_query($conn, "SELECT NR_Cpf, NM_Paciente, ID_Chefe FROM Paciente, Prontuario WHERE ID_Prontuario = '$pront' AND ID_Prontuario = CD_Prontuario") or die(mysqli_error($conn));
											$result 		= mysqli_num_rows($selectMembro);						
											while($mostraMembro = mysqli_fetch_array($selectMembro)) {
												echo "<option value='" . $mostraMembro["NR_Cpf"] . "'>" . $mostraMembro["NM_Paciente"] . "</option>";
												if ($mostraMembro["ID_Chefe"] == 1) {
													$cpfChefe = $mostraMembro["NR_Cpf"];
												}
											}
											?>
										</select>
									</div>
								</div>	
								<div class="col-xs-6">
									<div class="form-group">
										<label for="nomeConsult">CPF do Chefe Residencial <small>(preenchido automaticamente)</small></label>
										<input type="text" class="form-control" id="nomeConsult" placeholder="CPF" value=" <?php echo @$cpfChefe; ?> " disabled>							
									</div>
								</div>	
							</div>
							<div class="row">
								<div class="col-xs-6">
									<div class="form-group" id="tipoConsult">
										<label for="tipoConsult">Tipo da Consulta</label>
										<select id="tipoConsulta" class="form-control" name="nmConsulta" <?php if($erroP == 0){	echo "disabled"; } ?> required>
											<option disabled selected>Selecione ...</option>
											<?php
											$selectConsulta 	= mysqli_query($conn, "SELECT * FROM Consulta WHERE ID_Ubs = '$ubs'") or die(mysqli_error($conn));
											$resultConsulta		= mysqli_num_rows($selectConsulta);
											$semana = array();
											$desabilita = array();
											$s = 0;
											$d = 1;

											for ($i = 0; $i <= $resultConsulta; $i++){
												$semana[$i][0] = "";
												$semana[$i][1] = "";
												$semana[$i][2] = "";
												$semana[$i][3] = "";
												$semana[$i][4] = "";
												$semana[$i][5] = "";
												$semana[$i][6] = "";
											}

											while($mostraConsulta = mysqli_fetch_array($selectConsulta)) {

												$status = $mostraConsulta["ID_Status"];
												$valor = $mostraConsulta["NM_DiasSemana"];
												$dia = " / ";

												$n[0] = substr($valor,0,1);
												$n[1] = substr($valor,1,1);
												$n[2] = substr($valor,2,1);
												$n[3] = substr($valor,3,1);
												$n[4] = substr($valor,4,1);
												$n[5] = substr($valor,5,1);
												$n[6] = substr($valor,6,1);

												$conta = $n[0] + $n[1] + $n[2] + $n[3] + $n[4] + $n[5] + $n[6];
												$num = 1;
												$desabilita[$d] = "";

												if($n[0] == "1"){
													if($conta == 1){
														$dia .= "Domingo.";
													}
													else if(($num + 1) == $conta){
														$dia .= "s";
													}
													else if($conta == $num){
														$dia .= " e Domingo.";
													}
													else if ($num < $conta){
														$dia .= "Domingo, ";
													} 
													$num++;
													$semana[$s][0] = "0,";
												} else {
													$desabilita[$d] .= "0";
												}

												if($n[1] == "1"){
													if($conta == 1){
														$dia .= "Segunda-Feira.";
													}
													else if(($num + 1) == $conta){
														$dia .= "Segunda-Feira";
													}
													else if($conta == $num){
														$dia .= " e Segunda-Feira.";
													}
													else if ($num < $conta){
														$dia .= "Segunda-Feira, ";
													} 
													$num++;
													$semana[$s][1] = "1,";
												} else {
													$desabilita[$d] .= "1";
												}

												if($n[2] == "1"){
													if($conta == 1){
														$dia .= "Terça-Feira.";
													}
													else if(($num + 1) == $conta){
														$dia .= "Terça-Feira";
													}
													else if($conta == $num){
														$dia .= " e Terça-Feira.";
													}
													else if ($num < $conta){
														$dia .= "Terça-Feira, ";
													} 
													$num++;
													$semana[$s][2] = "2,";
												} else {
													$desabilita[$d] .= "2";
												}

												if($n[3] == "1"){
													if($conta == 1){
														$dia .= "Quarta-Feira.";
													}
													else if(($num + 1) == $conta){
														$dia .= "Quarta-Feira";
													}
													else if($conta == $num){
														$dia .= " e Quarta-Feira.";
													}
													else if ($num < $conta){
														$dia .= "Quarta-Feira, ";
													} 
													$num++;
													$semana[$s][3] = "3";
												} else {
													$desabilita[$d] .= "3";
												}

												if($n[4] == "1"){
													if($conta == 1){
														$dia .= "Quinta-Feira.";
													}
													else if(($num + 1) == $conta){
														$dia .= "Quinta-Feira";
													}
													else if($conta == $num){
														$dia .= " e Quinta-Feira.";
													}
													else if ($num < $conta){
														$dia .= "Quinta-Feira, ";
													} 
													$num++;
													$semana[$s][4] = "4,";
												} else {
													$desabilita[$d] .= "4";
												}

												if($n[5] == "1"){
													if($conta == 1){
														$dia .= "Sexta-Feira.";
													}
													else if($num == 1 && $conta == 2){
														$dia .= "Sexta-Feira";
													}
													else if($conta == $num){
														$dia .= " e Sexta-Feira.";
													}
													else if ($num < $conta){
														$dia .= "Sexta-Feira, ";
													} 
													$num++;
													$semana[$s][5] = "5,";
												} else {
													$desabilita[$d] .= "5";
												}

												if($n[6] == "1"){
													if($conta == 1){
														$dia .= "Sabado.";
													}
													else if(($num + 1) == $conta){
														$dia .= "Sabado";
													}
													else if($conta == $num){
														$dia .= " e Sabado.";
													}
													else if ($num < $conta){
														$dia .= "Sabado, ";
													} 
													$num++;
													$semana[$s][6] = "6,";
												} else {
													$desabilita[$d] .= "6";
												}

												if($status == 1) {
													echo "<option value='" . $mostraConsulta["CD_Consulta"] . "'>" . $mostraConsulta["NM_Consulta"] . " - " . $mostraConsulta["HR_ConsultaInicio"] . " ás " . $mostraConsulta["HR_ConsultaFinal"] . $dia . "</option>";
												} else {
													
												}
												
												$s++;
												$d++;
											}
											?>
										</select>
									</div>
								</div>
								<div class="col-xs-6">
									<div class="form-group">
										<?php 
										$t = 1;
										for ($i = 0; $i < $resultConsulta; $i++){
											$mostrasemana[$t] = $semana[$i][0] . " " . $semana[$i][1] . " " . $semana[$i][2] . " " . $semana[$i][3] . " " . $semana[$i][4] . " " . $semana[$i][5] . " " . $semana[$i][6];
											$t++;
										}
										?>
										<label for="datepicker">Selecione o dia da consulta:</label>
										<div class="input-group date">
											<input type="text" class="form-control" autocomplete="off" name="nmDia" id="nmDia" required disabled>
											<span class="input-group-addon">
												<i class="glyphicon glyphicon-th"></i>
											</span>
										</div>
									</div>
								</div>
							</div>
							<div class="row rowBtn">
								<div class="col-xs-12">				
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
		<!-- BOOTSRAP DATAPICKER -->
		<script src="../js/bootstrap-datepicker.min.js"></script>
		<!-- BOOTSRAP DATAPICKER -->
		<script src="../js/bootstrap-datepicker.pt-BR.min.js"></script>
		<!-- JS -->
		<script type="text/javascript" src="../js/js.js"></script>
		<script type="text/javascript">
			$(document).ready(function() {
				$("#tipoConsulta").change(function(){
					$('.input-group.date').datepicker('destroy');
					$("#nmDia").val("");
		        // pega o valor do select selecionado
		        $("#nmDia").prop("disabled", true);
		        var valor = $(this).val();
		        var sem = ['',<?php for ($i=1; $i <= $resultConsulta ; $i++) { 
		        	echo "'" . $mostrasemana[$i] . "',";
		        } ?>];
		        var des = ['',<?php for ($i=1; $i <= $resultConsulta ; $i++) { 
		        	echo "'" . $desabilita[$i] . "',";
		        } ?>];
		        if (valor > 0){
		        	$("#nmDia").prop("disabled", false);
		        }
		        //$("#nmDia").val(teste[valor]);
		       	// alert(teste[1]);
		        // insere o valor no input desejado
		        // alert(title);
		        $('.input-group.date').datepicker({
		        	format: "dd/mm/yyyy",
		        	startDate: "today",
		        	maxViewMode: 1,
		        	language: "pt-BR",
		        	todayHighlight: true,
		        	datesDisabled: [''],
		        	daysOfWeekDisabled: des[valor],
		        	daysOfWeekHighlighted: sem[valor],
		        	toggleActive: true
		        });
		    });
			});
		</script>
	</body>
	</html>