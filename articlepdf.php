<?php
require('fpdf181/fpdf.php');
include 'database.php';
session_start();


//$GET
$article = $_GET['article'];
$filename = $_GET['file'];

//SQL
$SQL = mysqli_query($connectie, "SELECT * FROM artikelen WHERE id = $article");
$fetch = mysqli_fetch_object($SQL);


$array = array(88,35);
$pdf = new FPDF('L','mm',$array);
$pdf->AddPage();
$pdf->SetFont('Arial','B',10);
$pdf->SetAutoPageBreak(false);


$pdf->Image($filename,65,13,-120);


// Start Pagina


$pdf->SetY(0);
$pdf->SetX(0);
$pdf->Cell(88,5,'',0,1,'L');
$pdf->SetX(0);
$pdf->Cell(88,3,'',0,1,'L');


$pdf->SetX(4);
$pdf->Cell(15,6,'Artikel',0,0,'L');
$pdf->Cell(3,6,':',0,0,'L');
$pdf->Cell(40,6,"$fetch->artikel",0,0,'L');
$pdf->Cell(20,21,"",0,1,'L');


$pdf->SetY(15);
$pdf->SetX(4);
$pdf->Cell(15,6,'Partnr',0,0,'L');
$pdf->Cell(3,6,':',0,0,'L');
$pdf->Cell(40,6,"$fetch->partnr",0,1,'L');


$pdf->SetY(22);
$pdf->SetX(4);
$pdf->Cell(15,6,'NSN',0,0,'L');
$pdf->Cell(3,6,':',0,0,'L');
$pdf->Cell(40,6,"$fetch->nsn",0,1,'L');








$pdf->Output('');

unlink($filename);
?>