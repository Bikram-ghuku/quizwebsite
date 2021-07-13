<?php
echo"<title>Quiz is being taken</title>";
include('mysqli_connect.php');
$sid=mysqli_real_escape_string($db,$_GET["sd"]);
$uid=mysqli_real_escape_string($db,$_GET["U"]);
$tid=mysqli_real_escape_string($db,$_GET["tid"]);
echo"<body onload=\"go()\"></body>";
if(isset($_COOKIE["SESSIONid"])){
	
	$que="SELECT * FROM sessions WHERE USERNAME='$uid'";
	
$query=mysqli_query($db,$que);
$q1=mysqli_fetch_array($query);
//echo"query result=".$query."query=".$q1."";
$sess=$q1["SESSION"];
$se=$_SESSION["SESSIONid"];
if( $sid == $se || $sess==$sid || $sess==$se || 1==1){
echo"</div class=\"hat\"><h1>GET READY FOR QUIZ<h1></div>";
setcookie("time", 0, time() + (86400 * 30), "/");
$questionquery="select * from questions2 where Tid='$tid'";
$questionarr=mysqli_query($db,$questionquery);
$q=mysqli_fetch_array($questionarr);
if($q["TIME"]<=0){
$_COOKIE["time"]=300000;
}else{
$_COOKIE["time"]=$q["TIME"]*1000;	
}
$qpass = $q["Tpwd"];
echo"<link rel = \"stylesheet\" href = \"styles.css\">";
echo"<p id=\"timer\" height=\"100px\" font-size=\"100px\"></P>";
echo"<script>
var button = document.getElementById(\"something\");
var form = document.getElementById(\"form\");
var cook = document.cookie.indexOf('mycookie');	
function go(){
if(document.cookie.indexOf('mycookie')==-1) {
    // cookie doesn't exist, create it now
    document.cookie = 'mycookie=1';
  }
  else {
    var x = setInterval(function(){alert(\"you refreshed !\");}, 500);
		
	}
	}	
window.onfocus = function () { 
  document.cookie = 'tabactive=1'; 
}; 
window.onblur = function () { 
  document.cookie = 'tabactive=0';
  var x = setInterval(function(){alert(\"you switched tab !\");}, 500);
}; 	

var countDownDate = new Date().getTime()+".$_COOKIE["time"].";

var x = setInterval(function() {
var now = new Date().getTime();
var distance = countDownDate - now;
var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
var seconds = Math.floor((distance % (1000 * 60)) / 1000);
document.getElementById(\"timer\").innerHTML =  minutes + \"m \" + seconds + \"s \";
    if (performance.navigation.type == 1) {
    console.info( \"This page is reloaded\" );
  } else {
    console.info( \"This page is not reloaded\");
  }
  
  if (distance < 0) {
   
	document.getElementById(\"myForm\").submit();
  }
}, 500);";
echo"</script>";

echo"<FORM ACTION=\"STATICS.php\" TYPE=\"POST\" ID=\"myForm\">
<div class=\"questions\">Q1)".$q["a"]."<BR></div>
<div class=\"answer-box\">
<div class=\"options\"><INPUT TYPE=\"RADIO\" NAME=\"f\" VALUE=\"a\">A)".$q["aa"]."<BR></div>
<div class=\"options\"><INPUT TYPE=\"RADIO\" NAME=\"f\" VALUE=\"b\">B)".$q["ab"]."<BR></div>
<div class=\"options\"><INPUT TYPE=\"RADIO\" NAME=\"f\" VALUE=\"c\">C)".$q["ac"]."<BR></div>
<div class=\"options\"><INPUT TYPE=\"RADIO\" NAME=\"f\" VALUE=\"d\">D)".$q["ad"]."<BR><BR></div>
</div>

<div class=\"questions\">Q2)".$q["b"]."<BR></div>
<div class=\"answer-box\">
<div class=\"options\"><INPUT TYPE=\"RADIO\" NAME=\"g\" VALUE=\"a\">A)".$q["ba"]."<BR></div>
<div class=\"options\"><INPUT TYPE=\"RADIO\" NAME=\"g\" VALUE=\"b\">B)".$q["bb"]."<BR></div>
<div class=\"options\"><INPUT TYPE=\"RADIO\" NAME=\"g\" VALUE=\"c\">C)".$q["bc"]."<BR></div>
<div class=\"options\"><INPUT TYPE=\"RADIO\" NAME=\"g\" VALUE=\"d\">D)".$q["bd"]."<BR><BR></div>
</div>

<div class=\"questions\">Q3)".$q["c"]."<BR></div>
<div class=\"answer-box\">
<div class=\"options\"><INPUT TYPE=\"RADIO\" NAME=\"h\" VALUE=\"a\">A)".$q["ca"]."<BR></div>
<div class=\"options\"><INPUT TYPE=\"RADIO\" NAME=\"h\" VALUE=\"b\">B)".$q["cb"]."<BR></div>
<div class=\"options\"><INPUT TYPE=\"RADIO\" NAME=\"h\" VALUE=\"c\">C)".$q["cc"]."<BR></div>
<div class=\"options\"><INPUT TYPE=\"RADIO\" NAME=\"h\" VALUE=\"d\">D)".$q["cd"]."<BR><BR></div>
</div>

<div class=\"questions\">Q4)".$q["d"]."<BR></div>
<div class=\"answer-box\">
<div class=\"options\"><INPUT TYPE=\"RADIO\" NAME=\"i\" VALUE=\"a\">A)".$q["da"]."<BR></div>
<div class=\"options\"><INPUT TYPE=\"RADIO\" NAME=\"i\" VALUE=\"b\">B)".$q["db"]."<BR></div>
<div class=\"options\"><INPUT TYPE=\"RADIO\" NAME=\"i\" VALUE=\"c\">C)".$q["dc"]."<BR></div>
<div class=\"options\"><INPUT TYPE=\"RADIO\" NAME=\"i\" VALUE=\"d\">D)".$q["dd"]."<BR><BR></div>
</div>

<div class=\"questions\">Q5)".$q["e"]."<BR></div>
<div class=\"answer-box\">
<div class=\"options\"><INPUT TYPE=\"RADIO\" NAME=\"j\" VALUE=\"a\">A)".$q["ea"]."<BR></div>
<div class=\"options\"><INPUT TYPE=\"RADIO\" NAME=\"j\" VALUE=\"b\">B)".$q["eb"]."<BR></div>
<div class=\"options\"><INPUT TYPE=\"RADIO\" NAME=\"j\" VALUE=\"c\">C)".$q["ec"]."<BR></div>
<div class=\"options\"><INPUT TYPE=\"RADIO\" NAME=\"j\" VALUE=\"d\">D)".$q["ed"]."<BR><BR></div>
</div>

<INPUT TYPE=\"HIDDEN\" VALUE=\"$tid\" NAME=\"TESTid\" readonly><BR>

<BUTTON VALUE=\"SUBMIT\" id=\"something\" class=\"button-style\">SUBMIT</BUTTON>
<!----<button onClick=\"nextpage\">Next page</button>--->
</FORM>";

}else{
echo"TOTAL WEB PORTAL ERROR , OUR IT STAFF HAS BEEN INFORMED";
echo"<BODY BACKGROUND=\"img.jpg\"></BODY>";
mail("bikramghuku05@gamil.com","INTERNAL ERROR","THERE IS AN INTERNAL ERROR NO RELATION BETWEEN SESSION DATABASE QUERY AND PHP GET SESSION ID=".$sid.",".$_COOKIE["SESSIONid"]." CURRENT USER IS".$uid."");
}
}else{
echo"don't try to open quiz without proper authorisation";
echo"<BODY BACKGROUND=\"img.jpg\"></BODY>";
mail("bikramghuku05@gmail.com","HACK ALERT","SOMEONE JUST TRIED TO ENTER THE QUIZ SYSTEM WITHOUT PIRIOR AUTHORISTAION");
}
?>
