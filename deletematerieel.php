<?php
include 'database.php';

$type = $_GET['type'];
$tailnr = $_GET['tailnr'];

$select = mysqli_query($connectie, "SELECT * FROM materieel WHERE type = '$type' AND tailnr = '$tailnr'");
$sel = mysqli_fetch_object($select);

unlink("qrcodes/$sel->qrcode");

echo "qrcodes/$sel->qrcode";

$delete = "DELETE FROM materieel WHERE type = '$type' AND tailnr = '$tailnr'";
$delete2 = mysqli_query($connectie, $delete);


header("location: materieel.php");

?>