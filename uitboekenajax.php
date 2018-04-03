<?php
include 'database.php';
session_start();

if(isset($_POST['materieel'])){
$materieel = $_POST['materieel'];
//echo $materieel;
if($_POST['materieel'] != ''){
if(isset($_SESSION['wkjr']) && isset($_POST['materieel'])){
    
$weekjr = substr($_SESSION['wkjr'], 0, 2);    
$wkjaar = substr($_SESSION['wkjr'], 3, 200);    
    
$week_start = new DateTime();
$week_start->setISODate($wkjaar,$weekjr);
$datum = $week_start->format('Y-m-d');
$weekeinde = date("Y-m-d",strtotime("+4 days",strtotime($datum)));
    
$matkop1 = "SELECT * FROM koppelingen WHERE mat_tailnr = '$materieel' AND datum >= '$datum' AND datum <= '$weekeinde'";
$matkop = mysqli_query($connectie, $matkop1);
 
//unset($_SESSION['wkjr']); 
}
elseif(isset($_SESSION['startdate']) && isset($_SESSION['einddate']) && isset($_POST['materieel'])){
$matkop1 = "SELECT * FROM koppelingen WHERE mat_tailnr = '$materieel' AND datum >= '".$_SESSION['startdate']."' AND datum <= '".$_SESSION['einddate']."'";
$matkop = mysqli_query($connectie, $matkop1);

 
    
}
}else{

}
}
elseif(isset($_POST['materieel1'])){
    $materieel = $_POST['materieel1'];
    

if($_POST['materieel1'] != ''){
if(isset($_SESSION['wkjr']) && isset($_POST['materieel1'])){
    
$weekjr = substr($_SESSION['wkjr'], 0, 2);    
$wkjaar = substr($_SESSION['wkjr'], 3, 200);    
    
$week_start = new DateTime();
$week_start->setISODate($wkjaar,$weekjr);
$datum = $week_start->format('Y-m-d');
$weekeinde = date("Y-m-d",strtotime("+4 days",strtotime($datum)));
    
$matkop1 = "SELECT * FROM koppelingen WHERE art_nsn = '$materieel' AND datum >= '$datum' AND datum <= '$weekeinde'";
$matkop = mysqli_query($connectie, $matkop1);
// echo $matkop1;
//unset($_SESSION['wkjr']); 
}
elseif(isset($_SESSION['startdate']) && isset($_SESSION['einddate']) && isset($_POST['materieel1'])){
$matkop1 = "SELECT * FROM koppelingen WHERE art_nsn = '$materieel' AND datum >= '".$_SESSION['startdate']."' AND datum <= '".$_SESSION['einddate']."'";
$matkop = mysqli_query($connectie, $matkop1);
//echo $matkop1;
 
    
}
}else{

}
}

?>

<table>
    
        <tr>
        
            <th colspan="7">Ingeboekte artikelen</th>
            
        </tr>
        
        <tr>
        
        <th colspan="7">&nbsp;</th>
        
        </tr>
        
        <tr>
        
        <th width="150px">Materieel</th>
        <th width="150px">Artikel</th>
        
        <th width="150px">Partnr</th>
        <th>NSN</th>
        <th>Aantal</th>
        <th>Datum</th>
        <th></th>
        
        </tr>  
        

            <?php
if(isset($_POST['materieel'])){      
  if($_POST['materieel'] != '' && strlen($_POST['materieel']) > 5){
        
            while($row = mysqli_fetch_object($matkop)){
                $selectie = "SELECT * FROM artikelen WHERE nsn = '$row->art_nsn'";
                $selectie2 = mysqli_query($connectie, $selectie);
                $select = mysqli_fetch_object($selectie2);
                
                $selection = "SELECT * FROM materieel WHERE tailnr = '$row->mat_tailnr'";
                $selection2 = mysqli_query($connectie, $selection);
                $selectione = mysqli_fetch_object($selection2);
                
                echo "<tr>
                <td>$selectione->type</td>
                <td>$select->artikel</td>
                <td>$select->partnr</td>
                <td>$row->art_nsn</td>
                <td align=center>$row->aantal</td>
                <td>$row->datum</td>
                <td align='center'><a href='uitboekenremove.php?id=$row->koppelid' onclick='check();'><img src='icons/remove.png' id='deletepic' width='15' height='15' style='cursor: pointer;'/></a></td>
                </tr>";
                }
            
  }
}
elseif(isset($_POST['materieel1'])){      
  if($_POST['materieel1'] != '' && strlen($_POST['materieel1']) > 5){
        
      
      $totaal = 0;
      
            while($row = mysqli_fetch_object($matkop)){
                $selectie = "SELECT * FROM artikelen WHERE nsn = '$row->art_nsn'";
                $selectie2 = mysqli_query($connectie, $selectie);
                $select = mysqli_fetch_object($selectie2);
                
                $selection = "SELECT * FROM materieel WHERE tailnr = '$row->mat_tailnr'";
                $selection2 = mysqli_query($connectie, $selection);
                $selectione = mysqli_fetch_object($selection2);
                
                echo "<tr>
                <td>$selectione->type</td>
                <td>$select->artikel</td>
                <td>$select->partnr</td>
                <td>$row->art_nsn</td>
                <td align=center>$row->aantal</td>
                <td>$row->datum</td>
                <td align='center'><a href='uitboekenremove.php?id=$row->koppelid' onclick='check();'><img src='icons/remove.png' id='deletepic' width='15' height='15' style='cursor: pointer;'/></a></td>
                </tr>
";
                
                $totaal = $totaal + $row->aantal;
                
                }
      echo "    
                <tr><td colspan=7>&nbsp;</td></tr>
                <tr>
                
                <td colspan=3 style='border:none;'></td>
                <td align=right style='border:none;'><b>Totaal:</b></td>
                <td style='border:none;' align=center>$totaal</td>
                <td colspan=2 style='border:none;'></td>
                
                </tr>";
            
  }
}
            ?>
        
       
        
        
    </table> 
<?php


?>