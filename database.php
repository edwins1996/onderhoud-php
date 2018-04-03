<?php

$user = 'root';
$ww = 'root';
$host = 'localhost';
$database = 'vliegonderhoud';
$connectie = mysqli_connect($host, $user, $ww, $database);

if (mysqli_connect($host, $user, $ww, $database)){
	//echo 'You have succesfully connected to the database...<br />';
}
else{
	echo 'Failed to connect to database... <br />';
}

?>