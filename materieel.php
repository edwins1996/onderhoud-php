<?php
include 'database.php';


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
   <center class="site-titel">MATERIEEL</center>
        <br /><br />
    <table>
        
    <tr>
    
        <th colspan="7">Reeds aangemaakte toestellen</th>
        
    </tr>   
    <tr>
    
        <th colspan="7" align="left"><img src="icons/add.png" width="15" height="15"/> <a href="#" id="toevoegen" >Toevoegen</a>
        
        <div id="add-art">
            <br /><br />
            <form id="artikel-add" action='insertmaterieel.php' method="POST" style='width:250px;'>
            
             &nbsp;&nbsp;Type<input type='text' name='inputtype' style="float:right;" required autocomplete="off"/>
               
               <br /><br /> &nbsp;&nbsp;Tailnr<input type='text' name='inputtailnr' style="float:right;" required autocomplete="off"/>
                <br /><br /> &nbsp;&nbsp;<input type='submit' value='Opslaan' style="float:right;" style="width:100%;" />
             <br /><br />
            
            
            </form>
            
            
            </div>
        
        </th>
        
    </tr> 
    <tr>
    
        
        <th>Type</th>
        <th>Tailnr</th>
        <th>QR code</th>
        
        <th></th>
        <th></th>
        <th></th>
        
    </tr>
        
        <?php
        $materieel = mysqli_query($connectie, "SELECT * FROM materieel LIMIT 50");
        $teller = 0;

        while($mate = mysqli_fetch_object($materieel)){
            $teller = $teller + 1;

            echo "
            <style>
            #art-text$teller, #art-text1$teller, #art-text2$teller, #art-text3$teller{
        background:transparent;
        border:none;
    }
    #savepic$teller{
    display:none;
    }
            </style>
            <tr id='art-td'>
            <form name='art-form-edit$teller' action='editmaterieel.php' method='POST' id='art-form-edit$teller'>
            <input type='hidden' name='idee' value='$mate->materieelid' readonly/>
                <td align='center'><input id='art-text$teller' type='text' name='type' value='$mate->type' size='".strlen($mate->type)."' size='10' readonly/></td>
                <td align='center'><input id='art-text1$teller' type='text' name='tailnr' value='$mate->tailnr'  readonly/></td>
                <td align='center'><img src='qrcodes/$mate->qrcode' width=50 height=50 /></td>
              
                
                <td align='center'><img src='icons/edit.png' width='15' height='15' id='editpic$teller' />
                <img src='icons/save.png' width='15' height='15' id='savepic$teller' onclick='opslaan$teller();'/></td>
                <td align='center'><img src='icons/remove.png' id='deletepic$teller' onclick='delete$teller();' width='15' height='15'/></td>
                <td align='center'><a href='phpqrcode/index3.php?data=$mate->tailnr&article=$mate->materieelid' target='_blank'><img src='icons/pdf.png' width='12' height='15' style='cursor:pointer;'/></a></td>
            </form>
            </tr>
            <script>
            $(document).ready(function(){
            $('#editpic$teller').click(function(){
            $('#art-text$teller').prop('readonly', false);
            
            $('#art-text1$teller').prop('readonly', false);
            
            $('#art-text2$teller').prop('readonly', false);
            
            $('#art-text3$teller').prop('readonly', false);
            
            
            $('#art-text$teller').css('border', 'inset');
            $('#art-text$teller').css('border-width', '1px');
            
            $('#art-text1$teller').css('border', 'inset');
            $('#art-text1$teller').css('border-width', '1px');
            
            $('#art-text2$teller').css('border', 'inset');
            $('#art-text2$teller').css('border-width', '1px');
            
            $('#art-text3$teller').css('border', 'inset');
            $('#art-text3$teller').css('border-width', '1px');
            
            $('#savepic$teller').css('display', 'inherit');
            $('#editpic$teller').css('display', 'none');

                });
            });
            
            function delete$teller(){
            var del = confirm('Weet u het zeker?');
            
            var field1 = document.forms['art-form-edit$teller']['art-text$teller'].value;
            var field2 = document.forms['art-form-edit$teller']['art-text1$teller'].value;


            
            
            if(del == true){
              location.replace('deletematerieel.php?type='+field1+'&tailnr='+field2);
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
        
        
    </table>   
        
    </div>
    

<div class="footer">
    
</div>    
</body>


</html>