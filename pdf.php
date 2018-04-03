<?php
require('fpdf181/fpdf.php');
include 'database.php';


$pdf = new FPDF('P','mm', 'A4');
$pdf->AddPage();
$pdf->SetFont('Arial','B',10);

$SQL = mysqli_query($connectie, "SELECT id FROM artikelen");

/*for($x = 1; $x <= mysqli_num_rows($SQL); $x++){
    
    if($x % 2 === 0){
        
        $y = $x-1;
$pdf->SetX(5);
        
$art1 = mysqli_query($connectie, "SELECT artikel, partnr, nsn FROM artikelen WHERE id = $y");
$fetch1 = mysqli_fetch_object($art1);
$pdf->Cell(98.5,38,"$fetch1->artikel",1,0,'L');
$pdf->Cell(2.5,38,"",1,0,'L');
        
$art2 = mysqli_query($connectie, "SELECT artikel, partnr, nsn FROM artikelen WHERE id = $x");
$fetch2 = mysqli_fetch_object($art2);        
$pdf->Cell(98.5,38,"$fetch2->artikel",1,1,'L');
    }
}*/
$pdf->SetX(5);

//$pdf->Image('qrcodes/qr7cea38b7983dcb974e518ef772c96d7d.png',$x,$y,-120);
$pdf->Multicell(98.5,12.66666667,"Test\n123\ntest",1,1);
$y = $pdf->GetY();
$x = $pdf->GetX();

$y = $y - 38;
$x = $x + 93.5;

$pdf->SetY($y);
$pdf->SetX($x);
$pdf->Cell(2.5,38,"",1,0,'L');
$pdf->Multicell(98.5,12.66666667,"Test\n123\ntest",1,1);
//$pdf->Cell(98.5,38,"",1,1,'L');



$pdf->Output('');
?>