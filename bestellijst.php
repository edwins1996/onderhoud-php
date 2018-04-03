<?php
include 'database.php';
session_start();
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
   <center class="site-titel">BESTELLIJST</center>
        
        <br />
        
     <table>
        
    
         <tr>
        <th>Artikel</th>
        <th>Partnr</th>
        <th>Huidige<br />voorraad</th>
        <th>Min. voorraad</th>
        <th></th>
         </tr>
         
<?php
         
   $select = mysqli_query($connectie, "SELECT * FROM artikelen WHERE voorraad <= minimaal");
         
         while($row = mysqli_fetch_object($select)){
             
             echo "<tr>
             
             <td>$row->artikel</td>
             <td>$row->partnr</td>
             <td>$row->voorraad</td>
             <td>$row->minimaal</td>
             <td></td>
             
             </tr>";
             
         }
         
?>         
         
          
    </table>   
    
    
    </div>
    

<div class="footer">
    
</div>    
</body>


</html>