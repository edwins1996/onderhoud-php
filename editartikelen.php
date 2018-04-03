<?php
include 'database.php';

$page = $_POST['page'];
$code = $_POST['code'];
$id = $_POST['idee'];
$artik = $_POST['artik'];
$nsn = $_POST['nsn'];
$voorraad = $_POST['voorraad'];
$minimaal = $_POST['minimaal'];

$update = "UPDATE artikelen SET partnr = '$code', artikel = '$artik', nsn = '$nsn', voorraad = $voorraad, minimaal = $minimaal WHERE id = $id";

$update2 = mysqli_query($connectie, $update);

//echo $update;
header("location: artikelen.php?page=$page");;


?>