<script>
$(document).ready(function(){
        $("#menu-button").click(function(){
        $(".menu-bar").animate({width: "toggle"}, 350);        
            });    
          });
    setTimeout(function(){
            $("#cross").click(function(){
            $(".menu-bar").animate({width: "toggle"}, 350);                
            });    

          });
       
function count(){
    var counter = document.getElementById("materieel").value;
    var lengte = counter.length;
    
    if(lengte == 16){
        //alert("Test");
        ajax('materieel', 'materieel', 'tabel-materieel', 'materieellijst.php');
        document.getElementById("artikel").focus();
    }
}
    function count2(){
        var counter2 = document.getElementById("materieel").value;
        var subcount = document.getElementById("artikel").value;
        var counterlengte = counter2.length;
        var sublengte = subcount.length;
        
        if(sublengte == 16){
            if(counterlengte == 16){
            document.getElementById("inboekform").submit();
            }
            }
    }
</script>    


<div class="header">
   <button id="menu-button">&#9776;</button> 
    <center class="header-text">
        BEHEER VLIEGTUIGONDERHOUD
    </center>
    
</div>