<?php
include 'database.php';
$postmat = $_POST['artikel'];
$artikelen = mysqli_query($connectie, "SELECT * FROM artikelen WHERE nsn = '$postmat'");
$art = mysqli_fetch_object($artikelen);


if(mysqli_num_rows($artikelen) != 0){
?>    

<table>
   
        
     <tr>
    <th align="left" valign="top" colspan="3">Omschrijving artikel</th>          
    </tr>    
        
     <tr>
    <th align="left" valign="top" colspan="3">&nbsp;</th>          
    </tr>    
        
    <tr>
    <th align="left" valign="top" width="200">Postnummer</th>     
    <td width="400"><?php echo $art->postnr; ?></td>     
    <td rowspan="4">test</td>     
    </tr>
        
    <tr>
    <th align="left" valign="top" width="200">Artikel</th>     
    <td width="400"><?php echo $art->artikel; ?></td>     
    </tr>
        
    <tr>
    <th align="left" valign="top" width="200">Partnumber</th>     
    <td width="400"><?php echo $art->partnr; ?></td>     
    </tr>
        
    <tr>
    <th align="left" valign="top" width="200">NSN</th>     
    <td width="400"><?php echo $art->nsn; ?></td>     
    </tr>
        
    </table>
<?php

                                    }
else{
    echo "<table><tr><td><b>Omschrijving artikel</b></td></tr><tr><td>Geen resultaten</td></tr></table>";
}

?>