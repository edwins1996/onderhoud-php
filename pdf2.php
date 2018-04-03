<?php
require('fpdf181/fpdf.php');


$pdf = new FPDF('P','mm','A4');
$pdf->AddPage();
$pdf->SetFont('Arial','',12);
$pdf->SetTopMargin(3);



$rij=1;
$pdf->SetY(20);

$data="";

$x=$pdf->GetX();
$y=$pdf->GetY();
//$pdf->Image('qrcodes/qr7cea38b7983dcb974e518ef772c96d7d.png',$x,$y,-120);
$pdf->SetXY($x+34,$y);
$pdf->Multicell(40,9.3,"Test\n123\ntest",1,1);
$pdf->Ln();
$pdf->Multicell(40,9.3,"Test\n123\ntest",1,1);
$rij=$rij+1;
if($rij==8){$rij=1;$pdf->AddPage();$pdf->SetY(20);}

$pdf->Output();
?>