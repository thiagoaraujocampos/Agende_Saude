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
							<h1 class="text-center">Gerenciar Especialidade Médica</h1>
							<form action="" method="post">
								<div class="input-group pesquisaPront">
									<input type="text" class="form-control" placeholder="Procurar ..." autocomplete="off" id="pesq" name="pesquisa">
									<input type="hidden" class="form-control simple-field-data-mask" maxlength="14" data-mask="000.000.000-00" placeholder="Procurar ..." autocomplete="off" id="pesqcpf" name="pesquisaCpf">
									<span class="input-group-btn">
										<button class="btn btn-primary" type="submit"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
									</span>
								</div>				
							</form>	
						</div>
					</div>	
					<?php 

					if ( @$_POST["pesquisa"] == "" ){
						$selectAllCon = mysqli_query($conn, "SELECT * FROM Consulta") or die(mysqli_error($conn));
						$resultCon = mysqli_num_rows($selectAllCon);
						echo "<div class='col-xs-12 branco sombra alterarPront'>
						<h1>Especialidades</h1>
						<div class='row ProntTableRow'>
							<div class='col-xs-12'>
								<table class='table table-hover'>
									<thead>
										<tr>
											<th>Cod.</th>
											<th>Nome</th>
											<th>Dia</th>
											<th>Horário</th>
											<th></th>
										</tr>
									</thead>
									<tbody>";
										while($mostraCon = mysqli_fetch_array($selectAllCon)) {
											$cd = $mostraCon["CD_Consulta"];
											if($mostraCon["ID_Status"] == 0){
												echo "<tr class='desativado'>";
											} else {
												echo "<tr>";
											}
											echo "<td>" . $cd . "</td>
											<td>" . $mostraCon["NM_Consulta"] . "</td>
											<td>"; 
												$valor = $mostraCon["NM_DiasSemana"];
												$dia = "";

												$n[0] = substr($valor,0,1);
												$n[1] = substr($valor,1,1);
												$n[2] = substr($valor,2,1);
												$n[3] = substr($valor,3,1);
												$n[4] = substr($valor,4,1);
												$n[5] = substr($valor,5,1);
												$n[6] = substr($valor,6,1);

												$conta = $n[0] + $n[1] + $n[2] + $n[3] + $n[4] + $n[5] + $n[6];
												$num = 1;

												if($n[0] == "1"){
													if($conta == 1){
														$dia .= "Domingo.";
													}
													else if($num == 1 && $conta == 2){
														$dia .= "s";
													}
													else if($conta == $num){
														$dia .= " e Domingo.";
													}
													else if ($num < $conta){
														$dia .= "Domingo, ";
													} 
													$num++;
												} 

												if($n[1] == "1"){
													if($conta == 1){
														$dia .= "Segunda-Feira.";
													}
													else if($num == 1 && $conta == 2){
														$dia .= "Segunda-Feira";
													}
													else if($conta == $num){
														$dia .= " e Segunda-Feira.";
													}
													else if ($num < $conta){
														$dia .= "Segunda-Feira, ";
													} 
													$num++;
												} 

												if($n[2] == "1"){
													if($conta == 1){
														$dia .= "Terça-Feira.";
													}
													else if($num == 1 && $conta == 2){
														$dia .= "Terça-Feira";
													}
													else if($conta == $num){
														$dia .= " e Terça-Feira.";
													}
													else if ($num < $conta){
														$dia .= "Terça-Feira, ";
													} 
													$num++;
												} 

												if($n[3] == "1"){
													if($conta == 1){
														$dia .= "Quarta-Feira.";
													}
													else if($num == 1 && $conta == 2){
														$dia .= "Quarta-Feira";
													}
													else if($conta == $num){
														$dia .= " e Quarta-Feira.";
													}
													else if ($num < $conta){
														$dia .= "Quarta-Feira, ";
													} 
													$num++;
												} 

												if($n[4] == "1"){
													if($conta == 1){
														$dia .= "Quinta-Feira.";
													}
													else if($num == 1 && $conta == 2){
														$dia .= "Quinta-Feira";
													}
													else if($conta == $num){
														$dia .= " e Quinta-Feira.";
													}
													else if ($num < $conta){
														$dia .= "Quinta-Feira, ";
													} 
													$num++;
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
												} 

												if($n[6] == "1"){
													if($conta == 1){
														$dia .= "Sabado.";
													}
													else if($num == 1 && $conta == 2){
														$dia .= "Sabado";
													}
													else if($conta == $num){
														$dia .= " e Sabado.";
													}
													else if ($num < $conta){
														$dia .= "Sabado, ";
													} 
													$num++;
												} 

												echo $dia;
												echo "</td>
												<td>" . $mostraCon["HR_ConsultaInicio"] . " ás " . $mostraCon["HR_ConsultaFinal"] . "</td>
												<td><form action='alterarConsult.php' method='POST'><button value='$cd' class='btn btn-primary pull-right' name='altBtn'>Alterar</button></form></td>
											</tr>"; 
										}								
										echo "<h3><small>*Especialidades em cinza estão desativadas</small></h3></tbody>
									</table>
								</div>
							</div>					
						</div>";
					} else {
						$pesquisa = @$_POST["pesquisa"];
						$selectAllCon = mysqli_query($conn, "SELECT * FROM Consulta WHERE CD_Consulta = '$pesquisa'") or die(mysqli_error($conn));
						$resultCon = mysqli_num_rows($selectAllCon);
						if($resultCon == 0){
							$selectAllCon = mysqli_query($conn, "SELECT * FROM Consulta WHERE NM_Consulta LIKE '%$pesquisa%'") or die(mysqli_error($conn));
							$resultCon = mysqli_num_rows($selectAllCon);
							if ($resultCon == 0 ) {
								echo "<center><h4>Consulta não existe</h4></center>";
							} else {
								echo "<div class='col-xs-12 branco sombra alterarPront'>
								<h1>Especialidades</h1>
								<div class='row ProntTableRow'>
									<div class='col-xs-12'>
										<table class='table table-hover'>
											<thead>
												<tr>
													<th>Cod.</th>
													<th>Nome</th>
													<th>Dia</th>
													<th>Horário</th>
													<th></th>
												</tr>
											</thead>
											<tbody>";
												while($mostraCon = mysqli_fetch_array($selectAllCon)) {
													$cd = $mostraCon["CD_Consulta"];
													if($mostraCon["ID_Status"] == 0){
														echo "<tr class='desativado'>";
													} else {
														echo "<tr>";
													}
													echo "<td>" . $cd . "</td>
													<td>" . $mostraCon["NM_Consulta"] . "</td>
													<td>"; 
														$valor = $mostraCon["NM_DiasSemana"];
														$dia = "";

														$n[0] = substr($valor,0,1);
														$n[1] = substr($valor,1,1);
														$n[2] = substr($valor,2,1);
														$n[3] = substr($valor,3,1);
														$n[4] = substr($valor,4,1);
														$n[5] = substr($valor,5,1);
														$n[6] = substr($valor,6,1);

														$conta = $n[0] + $n[1] + $n[2] + $n[3] + $n[4] + $n[5] + $n[6];
														$num = 1;

														if($n[0] == "1"){
															if($conta == 1){
																$dia .= "Domingo.";
															}
															else if($num == 1 && $conta == 2){
																$dia .= "s";
															}
															else if($conta == $num){
																$dia .= " e Domingo.";
															}
															else if ($num < $conta){
																$dia .= "Domingo, ";
															} 
															$num++;
														} 

														if($n[1] == "1"){
															if($conta == 1){
																$dia .= "Segunda-Feira.";
															}
															else if($num == 1 && $conta == 2){
																$dia .= "Segunda-Feira";
															}
															else if($conta == $num){
																$dia .= " e Segunda-Feira.";
															}
															else if ($num < $conta){
																$dia .= "Segunda-Feira, ";
															} 
															$num++;
														} 

														if($n[2] == "1"){
															if($conta == 1){
																$dia .= "Terça-Feira.";
															}
															else if($num == 1 && $conta == 2){
																$dia .= "Terça-Feira";
															}
															else if($conta == $num){
																$dia .= " e Terça-Feira.";
															}
															else if ($num < $conta){
																$dia .= "Terça-Feira, ";
															} 
															$num++;
														} 

														if($n[3] == "1"){
															if($conta == 1){
																$dia .= "Quarta-Feira.";
															}
															else if($num == 1 && $conta == 2){
																$dia .= "Quarta-Feira";
															}
															else if($conta == $num){
																$dia .= " e Quarta-Feira.";
															}
															else if ($num < $conta){
																$dia .= "Quarta-Feira, ";
															} 
															$num++;
														} 

														if($n[4] == "1"){
															if($conta == 1){
																$dia .= "Quinta-Feira.";
															}
															else if($num == 1 && $conta == 2){
																$dia .= "Quinta-Feira";
															}
															else if($conta == $num){
																$dia .= " e Quinta-Feira.";
															}
															else if ($num < $conta){
																$dia .= "Quinta-Feira, ";
															} 
															$num++;
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
														} 

														if($n[6] == "1"){
															if($conta == 1){
																$dia .= "Sabado.";
															}
															else if($num == 1 && $conta == 2){
																$dia .= "Sabado";
															}
															else if($conta == $num){
																$dia .= " e Sabado.";
															}
															else if ($num < $conta){
																$dia .= "Sabado, ";
															} 
															$num++;
														} 

														echo $dia;
														echo "</td>
														<td>" . $mostraCon["HR_ConsultaInicio"] . " ás " . $mostraCon["HR_ConsultaFinal"] . "</td>
														<td><form action='alterarConsult.php' method='POST'><button value='$cd' class='btn btn-primary pull-right' name='altBtn'>Alterar</button></form></td>
													</tr>"; 
												}								
												echo "<h3><small>*Especialidades em cinza estão desativadas</small></h3></tbody>
											</table>
										</div>
									</div>					
								</div>";
							}						
						} else {
							echo "<div class='col-xs-12 branco sombra alterarPront'>
							<h1>Consultas</h1>
							<div class='row ProntTableRow'>
								<div class='col-xs-12'>
									<table class='table table-hover'>
										<thead>
											<tr>
												<th>Cod.</th>
												<th>Nome</th>
												<th>Dia</th>
												<th>Horário</th>
												<th></th>
											</tr>
										</thead>
										<tbody>";
											while($mostraCon = mysqli_fetch_array($selectAllCon)) {
												$cd = $mostraCon["CD_Consulta"];
													if($mostraCon["ID_Status"] == 0){
														echo "<tr class='desativado'>";
													} else {
														echo "<tr>";
													}
													echo "<td>" . $cd . "</td>
												<td>" . $mostraCon["NM_Consulta"] . "</td>
												<td>"; 
													$valor = $mostraCon["NM_DiasSemana"];
													$dia = "";

													$n[0] = substr($valor,0,1);
													$n[1] = substr($valor,1,1);
													$n[2] = substr($valor,2,1);
													$n[3] = substr($valor,3,1);
													$n[4] = substr($valor,4,1);
													$n[5] = substr($valor,5,1);
													$n[6] = substr($valor,6,1);

													$conta = $n[0] + $n[1] + $n[2] + $n[3] + $n[4] + $n[5] + $n[6];
													$num = 1;

													if($n[0] == "1"){
														if($conta == 1){
															$dia .= "Domingo.";
														}
														else if($num == 1 && $conta == 2){
															$dia .= "s";
														}
														else if($conta == $num){
															$dia .= " e Domingo.";
														}
														else if ($num < $conta){
															$dia .= "Domingo, ";
														} 
														$num++;
													} 

													if($n[1] == "1"){
														if($conta == 1){
															$dia .= "Segunda-Feira.";
														}
														else if($num == 1 && $conta == 2){
															$dia .= "Segunda-Feira";
														}
														else if($conta == $num){
															$dia .= " e Segunda-Feira.";
														}
														else if ($num < $conta){
															$dia .= "Segunda-Feira, ";
														} 
														$num++;
													} 

													if($n[2] == "1"){
														if($conta == 1){
															$dia .= "Terça-Feira.";
														}
														else if($num == 1 && $conta == 2){
															$dia .= "Terça-Feira";
														}
														else if($conta == $num){
															$dia .= " e Terça-Feira.";
														}
														else if ($num < $conta){
															$dia .= "Terça-Feira, ";
														} 
														$num++;
													} 

													if($n[3] == "1"){
														if($conta == 1){
															$dia .= "Quarta-Feira.";
														}
														else if($num == 1 && $conta == 2){
															$dia .= "Quarta-Feira";
														}
														else if($conta == $num){
															$dia .= " e Quarta-Feira.";
														}
														else if ($num < $conta){
															$dia .= "Quarta-Feira, ";
														} 
														$num++;
													} 

													if($n[4] == "1"){
														if($conta == 1){
															$dia .= "Quinta-Feira.";
														}
														else if($num == 1 && $conta == 2){
															$dia .= "Quinta-Feira";
														}
														else if($conta == $num){
															$dia .= " e Quinta-Feira.";
														}
														else if ($num < $conta){
															$dia .= "Quinta-Feira, ";
														} 
														$num++;
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
													} 

													if($n[6] == "1"){
														if($conta == 1){
															$dia .= "Sabado.";
														}
														else if($num == 1 && $conta == 2){
															$dia .= "Sabado";
														}
														else if($conta == $num){
															$dia .= " e Sabado.";
														}
														else if ($num < $conta){
															$dia .= "Sabado, ";
														} 
														$num++;
													} 

													echo $dia;
													echo "</td>
													<td>" . $mostraCon["HR_ConsultaInicio"] . " ás " . $mostraCon["HR_ConsultaFinal"] . "</td>
													<td><form action='alterarConsult.php' method='POST'><button value='$cd' class='btn btn-primary pull-right' name='altBtn'>Alterar</button></form></td>
												</tr>"; 
											}								
											echo "<h3><small>*Especialidades em cinza estão desativadas</small></h3></tbody>
										</table>
									</div>
								</div>					
							</div>";
						}
					}

					?>		
				</div>
			</div>
		</div>
		<!-- JQUERY -->
		<script src="../js/jquery-3.1.0.min.js"></script>
		<!-- BOOTSTRAP JS -->
		<script src="../js/bootstrap.min.js"></script>
		<!-- JS -->
		<script type="text/javascript" src="../js/js.js"></script>
	</body>
	</html>