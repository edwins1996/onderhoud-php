<?php
include 'database.php';
$inputtype = $_POST['inputtype'];
$inputtailnr = $_POST['inputtailnr'];

$insert = "INSERT INTO materieel(type, tailnr) VALUES('$inputtype', '$inputtailnr')";
$insert2 = mysqli_query($connectie, $insert);
echo $insert;
header("location: ./phpqrcode/index.php?data=$inputtailnr");
?>