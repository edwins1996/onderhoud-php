<?php
include 'database.php';
$datum = date('Y') . '-' . date('m') . '-' . date('d');

$koppeling = mysqli_query($connectie, "SELECT MAX(koppelid) as id FROM koppelingen");
$koppel = mysqli_fetch_object($koppeling);

if($koppel->id != ''){

//echo mysqli_num_rows($koppeling);
if(mysqli_num_rows($koppeling) == 1) {   
$koppeling2 = mysqli_query($connectie, "SELECT * FROM koppelingen WHERE koppelid = $koppel->id");
$koppel2 = mysqli_fetch_object($koppeling2);


$materieel = mysqli_query($connectie, "SELECT * FROM materieel WHERE tailnr = '$koppel2->mat_tailnr'");
$materi = mysqli_fetch_object($materieel);
}
}
?>

<!doctype html>
<html>

<head>
<link rel="stylesheet" href="style.css" />
<link rel="icon" type="image/png" href="/images/favicon.png">
<title>Beheer</title>
<script src="jquery/jquery.min.js"></script>
<script src="ajax.js"></script>


</head>

<body>
    <?php include 'menubar.php'; ?>
    <?php include 'header.php'; ?>



    
    <div class="main-content"><br />
   <center class="site-titel">INBOEKEN</center>
        
        <br />
        <div id="tabel-materieel">
           <table>
   
        
     <tr>
    <th align="left" valign="top" colspan="3">Omschrijving materieel</th>          
    </tr>    
        
     <tr>
    <th align="left" valign="top" colspan="3">&nbsp;</th>          
    </tr>    
     <tr><th align="left" valign="top" width="200">Type</th>    
         <td align="left" valign="top" width="200"><?php
             if(mysqli_num_rows($koppeling) == 1 && $koppel->id != '') {
             
             echo $materi->type; 
             
             }
             else{
                 echo "";
             }
             
             ?></td>  
    <td rowspan="4" align='center'><?php
        
        if(mysqli_num_rows($koppeling) == 1 && $koppel->id != '') {
        
        echo "<img src='qrcodes/$materi->qrcode' />"; 
        
                     }
             else{
                 echo "";
             }
        ?></td>
    </tr> 
    <tr>
        
    <th align="left" valign="top" width="200">Tailnr<br /><br /><br /></th>     
    <td width="400" valign="top"><?php
        
        if(mysqli_num_rows($koppeling) == 1 && $koppel->id != '') {
        
        echo $materi->tailnr; 
        
                     }
             else{
                 echo "";
             }
        ?></td>  
        
         
    </tr>
        
    
        
</table>
        </div>
    <br /><br />
        <div id="tabel-artikel">

        </div>
    <br /><br />
        

 <table style="border:none">
     <form id="inboekform" action="insertinboeken.php" method="POST">
     <tr style="border:none">
         <td style="border:none">Tailnummer:</td>
         <td style="border:none">
       
             <input type="text" id="materieel" name="materieel" onKeyUp="count();"  autocomplete='off' autofocus />
                 
                 </td>  
         <td style="border:none">Artikel:</td>
         <td style="border:none">
             
             <input type="text" name="artikel" id="artikel" onKeyUp="count2();" autocomplete='off'/>
             
                 </td>  
         
         
         <td style="border:none">Aantal:</td>
           <td style='border:none;'>  <input type='number' value='1' step='1' min='1' id='aantal-inboeken' name='aantal-inboeken' style='width:50px;'/>
             
         </td>

     </tr>
     </form>
    </table>        
        
        
        
<br /><br />        
    <table>
    
        <tr>
        
            <th colspan="6">Reeds ingeboekt - <?php echo $datum; ?></th>
            
        </tr>
        
        <tr>
        
        <th colspan="6">&nbsp;</th>
        
        </tr>
        
        <tr>
        
        <th width="150px">Tailnr Materieel</th>
        <th width="150px">Type mat.</th>
        <th>Artikel</th>
        <th width="150px">Partnr</th>
        <th>NSN</th>
        <th>Aantal</th>
        
        </tr>  
        
        
        
            <?php
            
            $koppelingen = mysqli_query($connectie, "SELECT * FROM koppelingen, artikelen, materieel WHERE koppelingen.art_nsn = artikelen.nsn AND koppelingen.mat_tailnr = materieel.tailnr");
        
            while($row = mysqli_fetch_object($koppelingen)){
                if($row->datum == $datum){
                echo "<tr>
                <td>$row->mat_tailnr</td>
                <td>$row->type</td>
                <td>$row->artikel</td>
                <td>$row->partnr</td>
                <td>$row->art_nsn</td>
                <td>$row->aantal</td>
                </tr>";
                }
            }
            
            ?>
        
       
        
        
    </table>    
        
    </div>
    

<div class="footer">
    
</div>    
</body>


</html>