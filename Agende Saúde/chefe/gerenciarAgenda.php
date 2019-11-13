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
		
	} else if ($mostraFunc["CD_Nivel"] == 2) {
		header("Location: ../login.php");
		die();
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
</head>
<body>
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
				<div class="row rowPesquisarPront">
					<div class="col-xs-12">
						<h1 class="text-center">Gerenciar Agendamento</h1>
						<form action="" method="POST">
							<div class="form-group">
								<div class="input-group date">
									<input type="text" class="form-control" autocomplete="off" name="nmDia" id="nmDia" style="z-index: 0;">
									<span class="input-group-addon">
										<i class="glyphicon glyphicon-th"></i>
									</span>									
								</div>
								<center><button type="submit" class="btn btn-primary" style="margin-top: 10px;">Pesquisar</button></center>
							</div>
						</form>						
					</div>
				</div>			
				<?php 
					$nmDia = @$_POST["nmDia"];
					if(!isset($_SESSION["data"])){

					} else {
						$nmDia = $_SESSION["data"];
						UNSET($_SESSION["data"]);
					}
					$selectAg = mysqli_query($conn, "SELECT * FROM AgendamentoConsulta WHERE DT_AgendamentoConsulta = '$nmDia' ORDER BY NM_Situacao DESC, ID_Paciente ASC") or die(mysqli_error($conn));
					$resultAg = mysqli_num_rows($selectAg);
					$qnt = mysqli_query($conn, "SELECT * FROM AgendamentoConsulta WHERE DT_AgendamentoConsulta = '$nmDia' AND NM_Situacao = 'Em Aberto'") or die(mysqli_error($conn));
					$qnt = mysqli_num_rows($qnt);
					if($resultAg == 0 and $nmDia == ""){
						
					} else if($resultAg == 0){
						echo "<center><h4>Nenhum agendamento no dia: " . $nmDia . ".</h4></center>";
					} else {
						echo "<div class='col-xs-12 branco sombra alterarPront'>";
					echo "<h1>" . $nmDia . " - Agendamentos Em Aberto: " . $qnt . "</h1>";
					echo "<div class='row ProntTableRow'><div class='col-xs-12'><table class='table table-hover'>";
					echo "<thead>
									<tr>
										<th>CPF</th>
										<th>Prontuário</th>
										<th>Nome</th>
										<th>Consulta</th>
										<th></th>
									</tr>
								</thead><tbody>";
					echo "</tbody>";
					while($mostraAg = mysqli_fetch_array($selectAg)) {
						$cdAg = $mostraAg["CD_AgendamentoConsulta"];
						if($mostraAg["NM_Situacao"] == "Cancelada" or $mostraAg["NM_Situacao"] == "Realizada"){
							$pac = $mostraAg["ID_Paciente"];
							$selectPac = mysqli_query($conn, "SELECT NM_Paciente, ID_Prontuario FROM Paciente WHERE NR_Cpf = '$pac'") or die(mysqli_error($conn));
							$mostraPac = mysqli_fetch_array($selectPac);
							$con = $mostraAg["ID_Consulta"];
							$selectCon = mysqli_query($conn, "SELECT NM_Consulta FROM Consulta WHERE CD_Consulta = '$con'") or die(mysqli_error($conn));
							$mostraCon = mysqli_fetch_array($selectCon);
							if($mostraAg["NM_Situacao"] == "Realizada"){
								echo "<tr class='bg-info'>";
							} else {
								echo "<tr class='desativado'>";
							}
							echo "<td>" . $mostraAg["ID_Paciente"] . "</td>
							<td>" . $mostraPac["ID_Prontuario"] . "</td>
							<td>" . $mostraPac["NM_Paciente"] . "</td>
							<td>" . $mostraCon["NM_Consulta"] . "</td>
							<td>";
							if($mostraAg["NM_Situacao"] == "Realizada"){
								echo "REALIZADA";
							} else {
								echo "CANCELADA";
							}
							echo "</td>
							</tr>";
						} else {
							$pac = $mostraAg["ID_Paciente"];
							$selectPac = mysqli_query($conn, "SELECT NM_Paciente, ID_Prontuario FROM Paciente WHERE NR_Cpf = '$pac'") or die(mysqli_error($conn));
							$mostraPac = mysqli_fetch_array($selectPac);
							$con = $mostraAg["ID_Consulta"];
							$selectCon = mysqli_query($conn, "SELECT NM_Consulta FROM Consulta WHERE CD_Consulta = '$con'") or die(mysqli_error($conn));
							$mostraCon = mysqli_fetch_array($selectCon);
							echo "<tr>
							<td>" . $mostraAg["ID_Paciente"] . "</td>
							<td>" . $mostraPac["ID_Prontuario"] . "</td>
							<td>" . $mostraPac["NM_Paciente"] . "</td>
							<td>" . $mostraCon["NM_Consulta"] . "</td>
							<td><form action='cancelaAg.php' method='POST'>
							<input type='hidden' name='data' value='" . $nmDia . "'>
							<input type='hidden' name='ag' value='" . $cdAg . "'>
							<button class='btn btn-success' value='Realizada' name='rea'>Realizada</button>
							<button class='btn btn-danger' value='Cancelada' name='can'>Cancelar</button>
							</form></td>
							</tr>";
						}
					}
					echo "</tbody></table>*Consultas em cinza estão canceladas<br>*Consultas em azul já foram realizadas</div></div></div>";
					}					
				?>
			</div>
		</div>
	</div>
	<!-- JQUERY -->
	<script src="../js/jquery-3.1.0.min.js"></script>
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
			$('.input-group.date').datepicker({
				format: "dd/mm/yyyy",
				startDate: "",
				maxViewMode: 2,
				language: "pt-BR",
				todayHighlight: true,
				datesDisabled: [''],
				daysOfWeekDisabled: "0,6",
				daysOfWeekHighlighted: 0,
				toggleActive: true
			});
		});
	</script>
</body>
</html>