<?php
include 'database.php';
$id = $_GET['id'];


$del = mysqli_query($connectie, "DELETE FROM koppelingen WHERE koppelid = $id");

header('location: uitboeken.php');


?>