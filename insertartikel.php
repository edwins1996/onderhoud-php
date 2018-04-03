<?php
include 'database.php';

$page = $_POST['page'];
$inputartikel = $_POST['inputartikel'];
$inputcode = $_POST['inputcode'];
$inputnsn = $_POST['inputnsn'];
$inputvoorraad = $_POST['inputvoorraad'];
$inputminimaal = $_POST['inputminimaal'];

$insert = "INSERT INTO artikelen(artikel, nsn, partnr, voorraad, minimaal) VALUES('$inputartikel', '$inputnsn', '$inputcode', $inputvoorraad, $inputminimaal)";
$insert2 = mysqli_query($connectie, $insert); 
echo $page;
//echo $insert;
header("location: artikelen.php?page=$page");
?>