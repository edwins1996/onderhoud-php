<?php
include 'database.php';
session_start();

if(!isset($_GET['page'])){
    $page = 1;
}elseif(isset($_GET['page'])){
    $page = $_GET['page'];
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
<style>
    #art-td:hover{
        background-color:#DEDEDE;
    }    
    a{
        font-weight:lighter;
        text-decoration:none;
    }
    a:hover{
        text-decoration:underline;
    }
    #add-art{
        display:none;
    }
    
</style>
<script>
    $(document).ready(function(){
    $("#toevoegen").click(function(){
        $("#add-art").slideToggle();
    });
});
    
    </script>
</head>

<body>
    <?php include 'menubar.php'; ?>
    <?php include 'header.php'; ?>



    
    <div class="main-content"><br />
   <center class="site-titel">ARTIKELEN</center>
        <br /><br />
    <table>
        
    <tr>
    
        <th colspan="8">Reeds aangemaakte artikelen</th>
        
    </tr>   
    <tr>
    
        <th colspan="8" align="left"><img src="icons/add.png" width="15" height="15"/> <a href="#" id="toevoegen" >Toevoegen</a>
        
        <div id="add-art">
            <br /><br />
            <form id="artikel-add" action='insertartikel.php' method="POST" style='width:250px;'>
            
             &nbsp;&nbsp;Artikel<input type='text' name='inputartikel' style="float:right;" required autocomplete="off"/>
               <br /><br /> &nbsp;&nbsp;Partnr<input type='text' name='inputcode' style="float:right;" required autocomplete="off"/>
               <br /><br /> &nbsp;&nbsp;NSN<input type='text' name='inputnsn' style="float:right;" required autocomplete="off"/>
               <br /><br /> &nbsp;&nbsp;Voorraad<input type='number' name='inputvoorraad' style="float:right;" required autocomplete="off"/>
               <br /><br /> &nbsp;&nbsp;Minimaal<input type='number' name='inputminimaal' style="float:right;" required autocomplete="off"/>
                <br /> &nbsp;(voorraad)<br /> &nbsp;&nbsp;<input type='submit' value='Opslaan' style="float:right;" style="width:100%;" />
                <input type='hidden' name='page' value='<?php echo $page; ?>'/>
             <br /><br />
            
            
            </form>
            
            
            </div>
        
        </th>
        
    </tr> 
    <tr>
    
        
        <th>Artikel</th>
        <th>Partnr</th>
        <th>NSN</th>
        <th>Voorraad</th>
        <th>Min. Voorraad</th>
        
        <th></th>
        <th></th>
        <th></th>
        
    </tr>
        
        <?php
        
            $artikelen2 = mysqli_query($connectie, "SELECT * FROM artikelen WHERE voorraad = minimaal");
            if(mysqli_num_rows($artikelen2) > 0){
                echo "<script>alert('Een aantal artikelen heeft de minimale voorraad bereikt.                        Deze zijn aan de bestellijst toegevoegd.');</script>";
            }
        
        $offset = ($page-1)*50;
        
        $artikelen = mysqli_query($connectie, "SELECT * FROM artikelen LIMIT 50 OFFSET $offset");
        
        $teller = 0;
    
        while($arti = mysqli_fetch_object($artikelen)){
            

            
            $teller = $teller + 1;

            echo "
            <style>
            #art-text$teller, #art-text1$teller, #art-text2$teller, #art-text3$teller, #art-text4$teller{
        background:transparent;
        border:none;
    }
    #savepic$teller{
    display:none;
    }
            </style>
            <tr id='art-td'>
            <form name='art-form-edit$teller' action='editartikelen.php' method='POST' id='art-form-edit$teller'>
            <input type='hidden' name='idee' value='$arti->id' readonly/>
                <td align='center'><input id='art-text$teller' type='text' name='artik' value='$arti->artikel' size='".strlen($arti->artikel)."' size='10' readonly/></td>
                <td align='center'><input id='art-text1$teller' type='text' name='code' value='$arti->partnr'  readonly/></td>
                <td align='center'><input id='art-text2$teller' type='text' name='nsn' value='$arti->nsn' readonly/></td>
                <td align='center'><input id='art-text3$teller' type='number' name='voorraad' value='$arti->voorraad' readonly/></td>
                <td align='center'><input id='art-text4$teller' type='number' name='minimaal' value='$arti->minimaal' readonly/></td>
                <input type='hidden' name='page' value='$page'/>
              
                
                <td align='center'><img src='icons/edit.png' width='15' height='15' id='editpic$teller' style='cursor:pointer;' />
                <img src='icons/save.png' width='15' height='15' id='savepic$teller' onclick='opslaan$teller();' style='cursor:pointer;' /></td>
                <td align='center'><img src='icons/remove.png' id='deletepic$teller' onclick='delete$teller();' width='15' height='15' style='cursor:pointer;'/></td>
                <td align='center'><a href='phpqrcode/index2.php?data=$arti->nsn&article=$arti->id&page=$page' target='_blank'><img src='icons/pdf.png' width='12' height='15' style='cursor:pointer;'/></a></td>
            </form>
            </tr>
            <script>
            $(document).ready(function(){
            $('#editpic$teller').click(function(){
            $('#art-text$teller').prop('readonly', false);
            
            $('#art-text1$teller').prop('readonly', false);
            
            $('#art-text2$teller').prop('readonly', false);
            
            $('#art-text3$teller').prop('readonly', false);
            
            $('#art-text4$teller').prop('readonly', false);
            
            
            $('#art-text$teller').css('border', 'inset');
            $('#art-text$teller').css('border-width', '1px');
            
            $('#art-text1$teller').css('border', 'inset');
            $('#art-text1$teller').css('border-width', '1px');
            
            $('#art-text2$teller').css('border', 'inset');
            $('#art-text2$teller').css('border-width', '1px');
            
            $('#art-text3$teller').css('border', 'inset');
            $('#art-text3$teller').css('border-width', '1px');
            
            $('#art-text4$teller').css('border', 'inset');
            $('#art-text4$teller').css('border-width', '1px');
            
            $('#savepic$teller').css('display', 'inherit');
            $('#editpic$teller').css('display', 'none');

                });
            });
            
            function delete$teller(){
            var del = confirm('Weet u het zeker?');
            
            var field1 = document.forms['art-form-edit$teller']['art-text$teller'].value;
            var field2 = document.forms['art-form-edit$teller']['art-text1$teller'].value;
            var field3 = document.forms['art-form-edit$teller']['art-text2$teller'].value;
            var field4 = document.forms['art-form-edit$teller']['art-text3$teller'].value;
            var field5 = document.forms['art-form-edit$teller']['art-text4$teller'].value;

            
            
            if(del == true){
              location.replace('deleteartikelen.php?artikel='+field1+'&partnr='+field2+'&nsn='+field3+'&voorraad='+field4);
            }else{
            event.preventDefault();
            }
            }
            
            function opslaan$teller(){
            document.getElementById('art-form-edit$teller').submit();
            }
            </script>
                        
            ";
            
        }
        
      
        
        ?>
        <tr><td colspan=8>&nbsp;</td></tr>
        <tr><td colspan=8>    <?php
        
        $artikelen = mysqli_query($connectie, "SELECT * FROM artikelen");
$teller = 0;
            echo "<center>";
for($x = 1; $x <= mysqli_num_rows($artikelen); $x++){
    
    if($x % 50 === 0){
        $teller = $teller+1;
      
        echo "<a href='artikelen.php?page=$teller'";
        if($page == $teller){
        echo "style='font-weight:bold; color:black;'";
        }
        echo ">$teller</a>&nbsp;&nbsp;";
   
    }
}
            $teller1 = $teller+1;
            echo "<a href='artikelen.php?page=$teller1'";
        if($page == $teller1){
        echo "style='font-weight:bold; color:black;'";
        }
        echo ">$teller1</a>";
            echo "</center>";
        
        
        ?></td></tr>
        
    </table>   
    
    </div>
    

<div class="footer">
    
</div>    
</body>


</html>


?>
