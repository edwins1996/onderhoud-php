function ajax(veld1,veldnaam,veld2,scriptnaam)
{
var veld1 = document.getElementById(veld1).value;
var xhr;
 if (window.XMLHttpRequest) { // Mozilla, Safari, ...
    xhr = new XMLHttpRequest();
} else if (window.ActiveXObject) { // IE 8 and older
    xhr = new ActiveXObject("Microsoft.XMLHTTP");
}
var data = veldnaam + "=" + veld1;
     xhr.open("POST", scriptnaam, true); 
     xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");                  
     xhr.send(data);
	 xhr.onreadystatechange = display_data;
	function display_data() {
	 if (xhr.readyState == 4) {
      if (xhr.status == 200) {
       //alert(xhr.responseText);	   
	  document.getElementById(veld2).innerHTML = xhr.responseText;
      } else {
        alert('There was a problem with the request.');
      }
     }
	}
}