<?php
include 'database.php';
$postmat = $_POST['materieel'];
$materieel = mysqli_query($connectie, "SELECT * FROM materieel WHERE tailnr = '$postmat'");
$mat = mysqli_fetch_object($materieel);

if(mysqli_num_rows($materieel) != 0){
?>
<table>
   
        
     <tr>
    <th align="left" valign="top" colspan="3">Omschrijving materieel</th>          
    </tr>    
        
     <tr>
    <th align="left" valign="top" colspan="3">&nbsp;</th>          
    </tr>    
     <tr><th align="left" valign="top" width="200">Type</th>    
         <td align="left" valign="top" width="200"><?php echo $mat->type; ?></td>  
    <td rowspan="4" align=center><img src=qrcodes/<?php echo $mat->qrcode; ?> /></td>
    </tr> 
    <tr>
        
    <th align="left" valign="top" width="200">Tailnr<br /><br /><br /></th>     
    <td width="400" valign="top"><?php echo $mat->tailnr; ?></td>     
         
    </tr>
        
    
        
</table>
    <?php

                                    }
else{
    //echo "<table><tr><td><b>Omschrijving materieel</b></td></tr><tr><td>Geen resultaten</td></tr></table>";
}

?>