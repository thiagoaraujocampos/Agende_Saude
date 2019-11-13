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
	$func = $mostraFunc["NM_Funcionario"];

require('../pdf/fpdf.php');

class PDF extends FPDF
{

// Page header
function Header()
{
    // Logo
    $this->Image('../IMG/ASLogo.png',10,6,30);
    // Arial bold 15
    $this->SetFont('Arial','B',15);
    // Move to the right
    $this->Cell(80);
    // Title
    $this->Cell(50,10,utf8_decode('Relatório Diário'),1,0,'C');
    // Line break
    $this->Ln(20);
}

// Page footer
function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Page number
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
}

// Instanciation of inherited class
$pdf = new PDF();
$pdf->SetTitle(utf8_decode('Relatório Diário'));
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','',12);
$pdf->Cell(0,20, utf8_decode('Relatório emitido por ' . $func . '.'),0,1,"C");

$hoje = date("d/m/Y");

$pdf->Cell(0,10,'',0,1);
$pdf->Cell(0,5,'Agendamentos ',"B",1);
$pdf->Cell(0,5,'',0,1);

$selectConC = mysqli_query($conn, "SELECT * FROM AgendamentoConsulta WHERE DT_AgendamentoConsulta = '$hoje' AND NM_Situacao = 'Cancelada'") or die(mysqli_error($conn));
$resultConC = mysqli_num_rows($selectConC);
$pdf->Cell(0,10,'Cancelados: ' . $resultConC,0,1);

$selectConA = mysqli_query($conn, "SELECT * FROM AgendamentoConsulta WHERE DT_AgendamentoConsulta = '$hoje' AND NM_Situacao = 'Em Aberto'") or die(mysqli_error($conn));
$resultConA = mysqli_num_rows($selectConA);
$pdf->Cell(0,10,'Em Aberto: ' . $resultConA,0,1);

$selectConR = mysqli_query($conn, "SELECT * FROM AgendamentoConsulta WHERE DT_AgendamentoConsulta = '$hoje' AND NM_Situacao = 'Realizada'") or die(mysqli_error($conn));
$resultConR = mysqli_num_rows($selectConR);
$pdf->Cell(0,10,'Realizados: ' . $resultConR,0,1);

$selectAllCon = mysqli_query($conn, "SELECT * FROM AgendamentoConsulta WHERE DT_AgendamentoConsulta = '$hoje' ORDER BY NM_Situacao DESC") or die(mysqli_error($conn));
$resultAllCon = mysqli_num_rows($selectAllCon);
$pdf->Cell(0,10,'Total: ' . $resultAllCon, 0,1);

$pdf->Cell(0,20,'',0,1);
$pdf->Cell(0,5,'Todos Agendamentos ',"B",1);
$pdf->Cell(0,10,"",0,1);

while($mostraCon = mysqli_fetch_array($selectAllCon)) {
	$cd = $mostraCon["CD_AgendamentoConsulta"];
	$dataCon = $mostraCon["DT_AgendamentoConsulta"];
	$sit = $mostraCon["NM_Situacao"];
	$funcR = $mostraCon["ID_Funcionario"];
	$paciente = $mostraCon["ID_Paciente"];

	$selectPac = mysqli_query($conn, "SELECT * FROM Paciente WHERE NR_Cpf = '$paciente'") or die(mysqli_error($conn));
	$mostraNmPac = mysqli_fetch_array($selectPac);
	$nmpaciente = $mostraNmPac["NM_Paciente"];

	$consulta = $mostraCon["ID_Consulta"];
	$selectConsulta = mysqli_query($conn, "SELECT * FROM Consulta WHERE CD_Consulta = '$consulta'") or die(mysqli_error($conn));
	$mostraNmCon = mysqli_fetch_array($selectConsulta);

	$consulta = $mostraNmCon["NM_Consulta"];
	$pdf->Cell(0,5,"",0,1);
	$pdf->Cell(0,10,"Especialidade: " . utf8_decode($consulta),"TRL",1);
	$pdf->Cell(0,10,"Paciente: " . utf8_decode($nmpaciente),"LR",1);
	$pdf->Cell(0,10,"CPF Paciente: " . utf8_decode($paciente),"LR",1);
	$pdf->Cell(0,10,utf8_decode("Situação: ") . utf8_decode($sit),"LR",1);
	$pdf->Cell(0,10,"Data: " . utf8_decode($dataCon),"BRL",1);
	$pdf->Cell(0,5,"",0,1);
}

$pdf->Output();
?>