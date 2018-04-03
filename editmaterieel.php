<?php
include 'database.php';

$idee = $_POST['idee'];
$type = $_POST['type'];
$tailnr = $_POST['tailnr'];

$update = "UPDATE materieel SET type = '$type', tailnr = '$tailnr' WHERE materieelid = $idee";
$update2 = mysqli_query($connectie, $update);

header("location: ./phpqrcode/index.php?data=$tailnr");



?>