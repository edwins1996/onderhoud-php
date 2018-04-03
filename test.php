<?php
include 'database.php';

$artikelen = mysqli_query($connectie, "SELECT * FROM artikelen");
$teller = 0;
for($x = 1; $x <= mysqli_num_rows($artikelen); $x++){
    
    if($x % 50 === 0){
        $teller = $teller+1;
        echo $x . ' / ' . $teller . '<br />';
    }
}
?>