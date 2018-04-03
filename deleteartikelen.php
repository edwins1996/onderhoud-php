<?php
include 'database.php';

$postnr = $_GET['postnr'];
$artikel = $_GET['artikel'];
$partnr = $_GET['partnr'];
$nsn = $_GET['nsn'];


$delete = mysqli_query($connectie, "DELETE FROM artikelen WHERE postnr = '$postnr' AND artikel = '$artikel' AND partnr = '$partnr' AND nsn = '$nsn'");

header('location: artikelen.php');
?>