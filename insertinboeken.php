<?php
include 'database.php';
$materieel = $_POST['materieel'];
$artikel = $_POST['artikel'];
$aantal = $_POST['aantal-inboeken'];

$datum = date('Y') . '-' . date('m') . '-' . date('d');

$insert = "INSERT INTO koppelingen(mat_tailnr, art_nsn, datum, aantal) VALUES ('$materieel', '$artikel', '$datum', $aantal)";
$insert2 = mysqli_query($connectie, $insert);

$select2 = "SELECT * FROM artikelen WHERE nsn = '$artikel'";
$select = mysqli_query($connectie, $select2);
$fetch = mysqli_fetch_object($select);

$nieuwaantal = $fetch->voorraad-$aantal;
//echo $nieuwaantal;
$update = "UPDATE artikelen SET voorraad = $nieuwaantal WHERE nsn = '$artikel'";
$update2 = mysqli_query($connectie, $update);

//echo $update;
//echo $fetch->voorraad . '<br />';
//echo $select2 . '<br />';
//echo $insert;
header("location: inboeken.php");



?>