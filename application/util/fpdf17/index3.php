<?php
define('FPDF_FONTPATH','font/');
require('fpdf.php');

class PDF extends FPDF
{
// Page header
function Header()
{
    // Logo
    $this->Image('img/logo.jpg',10,6,30);
    // Arial bold 15
    $this->SetFont('angsana','',15);

    // Move to the right
    //$this->Cell(80);
    // Title
    //$this->Cell(30,10,'Title',1,0,'C');
    $this->Ln(30);
    $this->SetFillColor(204,204,204);
	$this->Cell(20,10,'name',1,0,'C',1);
	$this->Cell(20,10,'group',1,0,'C',1);
	$this->Cell(20,10,'No.',1,0,'C',1);
	$this->Cell(20,10,'Amount',1,0,'C',1);
	$this->Cell(20,10,'date',1,0,'C',1);
	$this->Cell(20,10,'type',1,0,'C',1);
	$this->Cell(20,10,'memo',1,1,'C',1);

    // Line break
    $this->Ln(1);
}

// Page footer
function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('angsana','I',10);
    // Page number
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
}

// Instanciation of inherited class
$pdf = new PDF();

$pdf->AddFont('angsana','','angsa.php');
$pdf->AddFont('angsana','B','angsab.php');
$pdf->AddFont('angsana','I','angsai.php');
$pdf->AddFont('angsana','BI','angsaz.php');

$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('angsana','',15);
for($i=1;$i<=40;$i++){
    //$pdf->Cell(0,10,'Printing line number '.$i,0,1);
   $pdf->Cell(20,10,'visa');
   $pdf->Cell(20,10,'beka');
   $pdf->Cell(20,10,'0001');
   $pdf->Cell(20,10,'1,200');
   $pdf->Cell(20,10,'01072011');
   $pdf->Cell(20,10,'admin');
   $pdf->Cell(20,10,'donbosco');
   $pdf->Ln(10);
   
}

$pdf->Output();
?>