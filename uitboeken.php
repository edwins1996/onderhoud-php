<?php
include 'database.php';
session_start();
$datum = date('d') . '/' . date('m') . '/' . date('Y');

$koppeling = mysqli_query($connectie, "SELECT MAX(koppelid) as id FROM koppelingen");
$koppel = mysqli_fetch_object($koppeling);

$koppeling2 = mysqli_query($connectie, "SELECT * FROM koppelingen WHERE koppelid = $koppel->id");
$koppel2 = mysqli_fetch_object($koppeling2);

$materieel = mysqli_query($connectie, "SELECT * FROM materieel WHERE tailnr = '$koppel2->mat_tailnr'");
$materi = mysqli_fetch_object($materieel);

if(!isset($_GET['mat'])){
    $mater = '';
}
elseif(isset($_GET['mat'])){
    $mater = $_GET['mat'];
}
if(!isset($_GET['art'])){
    $art = '';
}
elseif(isset($_GET['art'])){
    $art = $_GET['art'];
}

if(!isset($_GET['startdate']) && !isset($_GET['einddate'])){

}elseif(isset($_GET['startdate']) && isset($_GET['einddate'])){
    unset($_SESSION['wkjr']);
    $_SESSION['startdate'] = $_GET['startdate'];
    $_SESSION['einddate'] = $_GET['einddate'];
}

if(!isset($_GET['wkjr'])){
 
}elseif(isset($_GET['wkjr'])){
    unset($_SESSION['startdate']); 
unset($_SESSION['einddate']);
    $_SESSION['wkjr'] = $_GET['wkjr'];
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
    <script>
    
        
    function datumsearch(){
        var begindate = document.getElementById("begindatum").value;
        var einddate = document.getElementById("einddatum").value;
        
        
        var span = document.getElementById('change').innerHTML;
        if(span == 'artikel'){
            var materieel = document.getElementById("materieel1").value;
            location.replace("uitboeken.php?startdate="+begindate+"&einddate="+einddate+"&art="+materieel);
        }else if(span == 'tailnummer'){
        var materieel = document.getElementById("materieel").value;
            location.replace("uitboeken.php?startdate="+begindate+"&einddate="+einddate+"&mat="+materieel);
        }
        
    }
        function weeksearch(){
            var weekjaar = document.getElementById("week-select-select").value;
            
                    var span = document.getElementById('change').innerHTML;
        if(span == 'artikel'){
            var materieel = document.getElementById("materieel1").value;
            location.replace("uitboeken.php?wkjr="+weekjaar+"&art="+materieel);
        }else if(span == 'tailnummer'){
        var materieel = document.getElementById("materieel").value;
            location.replace("uitboeken.php?wkjr="+weekjaar+"&mat="+materieel);
        }
            
            
        }

        
        $(document).ready(function(){
            $("#date-button").click(function(){
                $("#date-select").css("display", "inherit");
                $("#week-select").css("display", "none");
            });
            $("#week-button").click(function(){
                $("#date-select").css("display", "none");
                $("#week-select").css("display", "inherit");
            });
        });
    </script>
        <script>
    
    function check(){
       var check = confirm("Weet u het zeker?");
        
        if(check == true){
            
        }else{
            event.preventDefault();
        }
    }
    </script>

</head>

<body 
      
      <?php if(isset($_GET['mat'])){ ?>
      onLoad="ajax('materieel', 'materieel', 'tabel-materieel', 'uitboekenajax.php');"
              <?php } 
              if(isset($_GET['art'])){
              ?>
              onLoad="ajax('materieel1', 'materieel1', 'tabel-materieel', 'uitboekenajax.php'); changer();"
              <?php } ?>
                  >
    <?php include 'menubar.php'; ?>
    <?php include 'header.php'; ?>



    
    <div class="main-content"><br />
   <center class="site-titel">UITBOEKEN</center>
        
        <br />
        
        

 <table style="border:none">
     <form id="inboekform" action="insertinboeken.php" method="POST">
     <tr style="border:none">
         <td style="border:none">Sorteren op <span id='change' style='margin:0px;'>tailnummer</span>:
         
       
             <input type="text" id="materieel" name="materieel" 
                    <?php if(isset($_GET['mat'])){ ?>
                    onKeyUp="ajax('materieel', 'materieel', 'tabel-materieel', 'uitboekenajax.php');" onfocus="ajax('materieel', 'materieel', 'tabel-materieel', 'uitboekenajax.php');"  
                    <?php } ?>
                    autocomplete='off' value='<?php echo $mater; ?>' autofocus />
             
             <input type="text" id="materieel1" name="materieel1"
                    <?php if(isset($_GET['art'])){ ?>
                    onKeyUp="ajax('materieel1', 'materieel1', 'tabel-materieel', 'uitboekenajax.php');"  onfocus="ajax('materieel1', 'materieel1', 'tabel-materieel', 'uitboekenajax.php');" 
                    <?php } ?>
                    autocomplete='off' value='<?php echo $art; ?>' autofocus style='display:none;'/>
             
             
             
             
             | <a href='#' id='mat-art' style='cursor:pointer; margin:0px; color:blue;' onclick='changer()'>artikel</a>
                
             
             <script>
                 
           
                 
             function changer(){
                 
                 var span = document.getElementById('change').innerHTML;
                 
                 if(span == 'artikel'){
                     document.getElementById('change').innerHTML = 'tailnummer';
                     document.getElementById('mat-art').innerHTML = 'artikel';
                     document.getElementById('materieel').style.display = 'inherit';
                     document.getElementById('materieel1').style.display = 'none';
                   
                     
                 }
                 else if(span == 'tailnummer'){
                     document.getElementById('change').innerHTML = 'artikel';
                     document.getElementById('mat-art').innerHTML = 'tailnummer';
                     document.getElementById('materieel').style.display = 'none';
                     document.getElementById('materieel1').style.display = 'inherit';
                     

                     
                 }
                 
             }
             
             </script>
                 </td> 
         <td style="border:none" align=right>Sorteren op: <button type='button' id='week-button'>Week</button><button type='button' id='date-button'>Datum</button></td>
     

     </tr>
         <tr style="border:none">
          
                  <td style="border:none">
             <div id='date-select'
                  <?php
                  
                  if(!isset($_GET['startdate']) && !isset($_GET['einddate'])){
                  
                  
                 echo "style='display:none;'";
                  }else{
                      echo "";
                  }
                  
                  ?>
                  >
                 <form id='date-select-form' method='GET' action="">
                     <?php
                
                     $week_start = new DateTime();
                     $week_start->setISODate(date('Y'),date('W'));
                     $datum = $week_start->format('Y-m-d');
                     
                     ?>
         Begindatum:
             <input type='text' id='begindatum' name='begindatum' value='<?php
if(isset($_SESSION['startdate'])){
    echo $_SESSION['startdate'];
}else{
    echo $datum; } ?>' size='10'/>
                     
        Einddatum:
             <input type='text' id='einddatum' name='einddatum' size='10' value='<?php
if(isset($_SESSION['einddate'])){
     echo $_SESSION['einddate'];
}else{
                                                                                 
     echo date("Y-m-d",strtotime("+4 days",strtotime($datum)));
 }
                                                                                 ?>'/>
                     &nbsp;
                     <input type='button' value='Zoeken' onclick="datumsearch();"/>
                 </form>
                    </div>
                      <div id="week-select"
                           <?php
                           
                           if(!isset($_GET['wkjr'])){
                           echo "style='display:none;'";
                           }else{
                               echo "";
                           }
                           
                           ?>
                           >
                      <form id='week-select-form' method='GET' action="">
                          Week:
                          <select id='week-select-select'>
                          
                          <?php
                              $kopdate = mysqli_query($connectie, "SELECT * FROM koppelingen GROUP BY datum ORDER BY datum");
                              
                              $weekje2 = array();
                              
                              while($datekop = mysqli_fetch_object($kopdate)){
                                  
                              $ddate = $datekop->datum;
                              $date = new DateTime($ddate);
                              $week = $date->format("W-Y");
                             
                                  
                                  $weekje2[] = $week;
                                  
                              }
                                  foreach(array_unique($weekje2) as $row){
                                  echo "<option value='$row'";
                                  
                                      if(isset($_SESSION['wkjr'])){
                                      
                                  if($_SESSION['wkjr'] == $row){ echo " selected"; }
                                 
                                  }else{
                                      
                                  }
                                  echo ">".str_replace("-"," - ",$row)."</option>";
                                  }
                              
                              
                              
                              ?>
                          
                          </select>
                          &nbsp;
                     <input type='button' id='zoek-button' value='Zoeken' onclick='weeksearch();' />
                          
                          </form>
                      
                      
                      
                      
                      </div>
         </td>
         
         </tr>
     </form>
    </table>        
        
        
        
<br /><br />        
    
    <div id="tabel-materieel">
        
        
        
        </div>    
    </div>
    

<div class="footer">
    
</div>    
</body>


</html>
<?php

?>