<!-- <html oncontextmenu="return false" onkeydown="return false;" > -->
<?php

echo"<title>Quiz is being taken</title>
<script src=\"https://cdn.socket.io/4.2.0/socket.io.min.js\" integrity=\"sha384-PiBR5S00EtOj2Lto9Uu81cmoyZqR57XcOna1oAuVuIEjzj0wpqDVfD0JA9eXlRsj\" crossorigin=\"anonymous\"></script>
<script src=\"https://cdn.jsdelivr.net/npm/@tensorflow/tfjs\"></script>
<script src=\"https://cdn.jsdelivr.net/npm/@tensorflow-models/blazeface\"></script>
";
include('mysqli_connect.php');
include("error_log.php");
$sid=mysqli_real_escape_string($db,$_GET["sd"]);
$uid=mysqli_real_escape_string($db,$_GET["U"]);
$tid=mysqli_real_escape_string($db,$_GET["tid"]);
echo"<link rel = \"stylesheet\" href = \"styles.css\">";
echo"<body onload=\"go()\"></body>";
if(isset($_COOKIE["SESSIONid"])){
	
	$que="SELECT * FROM sessions WHERE USERNAME='$uid'";
	
$query=mysqli_query($db,$que);
$q1=mysqli_fetch_array($query);
//echo"query result=".$query."query=".$q1."";
$sess=$q1["SESSION"];
$se=$_COOKIE["SESSIONid"];
if( $sid == $se || $sess==$sid || $sess==$se || 1==1){
  echo"<div class=\"info_container\" id=\"info_box_container\">";
  echo"<div class=\"info_box\">";
  echo"<div class=\"header_box\">";
  echo"<h1>Test Guidelines </h1>";
  echo"</div>";
  echo"<div class=\"data\">";
  echo"
  1) Do not switch tabs, it will be considered as a suspicious activity and will be made known to your invigilator<br>
  2) Do not refresh the tab in wich you are giving the test, doing so will also be made known to the invigilator<br>
  3) Your camera and microphone data will be streamed to your invigilator.<br>
  4) Invigilator can chat with you<br>
  5) Invigilator can pause or end your test<br>
  6) The test will automatically submit after the time runs out<br>
  7) <strong>Click on start</strong> to start the test.
  <button onClick=\"startQuiz()\" style=\"float:right; height:30px; width:100px; border-radius:15px\" id=\"start_button\">Start</button>
  ";
  echo"</div>";
  echo"</div>";
  echo"</div>";
  echo"<script>
  function startQuiz(){
    var d = new Date()
    document.getElementById(\"info_box_container\").style.display=\"none\";
    anti_cheat();
    socket.emit(\"logs\",{
      user: \"$uid\",
      date: d.getDate()+\":\"+(d.getMonth()+1)+\":\"+d.getFullYear(),
      time: d.getHours()+\"/\"+d.getMinutes()+\"/\"+d.getSeconds(),
      testid: \"$tid\",
      type: \"test_started\"
    });
    isPause=false;
    form.style.display = \"block\";
    document.documentElement.requestFullscreen();
  }
  </script>";
echo"<div id=\"fullScreen\">";
echo"<h1>GET READY FOR QUIZ<h1>";
setcookie("tid",$tid);
setcookie("time", 0, time() + (86400 * 30), "/");
$questionquery="select * from questions2 where Tid='$tid' AND a_response=1";
$questionarr=mysqli_query($db,$questionquery);
$q=mysqli_fetch_array($questionarr);
if($q==null){
  echo"<script>alert(\"No test with that testid or it is not accepting response!\");
  window.location.href = \"./login.htm\";
  </script>";
}
if($q["TIME"]<=0){
$_COOKIE["time"]=300000;
}else{
$_COOKIE["time"]=$q["TIME"]*1000;	
}
$qpass = $q["Tpwd"];

echo"<p id=\"timer\" height=\"100px\" font-size=\"100px\"></p>
<p id=\"num_faces\" height=\"100px\" font-size=\"100px\"></p>
<p id=\"cookie_tabactive\" height=\"100px\" font-size=\"100px\"></p>";

echo"<script>

var button = document.getElementById(\"something\");
var form = document.getElementById(\"fullScreen\");
var cook = document.cookie.indexOf('mycookie');	

function go(){
  form.style.display = \"none\";
  isPause = true;

  

if(document.cookie.indexOf('mycookie')==-1) {
    // cookie doesn't exist, create it now
    document.cookie = 'mycookie=1';
    document.cookie = 'refresh=0';
  }
  else {
    document.cookie = 'refresh=1';
    //var x = setInterval(function(){alert(\"you refreshed !\");}, 500);
		
	}
	}	
window.onfocus = function () { 
  document.cookie = 'tabactive=1'; 
  console.log(\"tab_cookie_set\");
}; 
window.onblur = function () { 
  document.cookie = 'tabactive=0';
  //var x = setInterval(function(){alert(\"you switched tab !\");}, 500);
}; 	

var countDownDate = new Date().getTime()+".$_COOKIE["time"].";
var isPause = false;
var x = setInterval(function() {
  if(!isPause){
    var now = new Date().getTime();
    var distance = countDownDate - now;
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    document.getElementById(\"timer\").innerHTML =  minutes + \"m \" + seconds + \"s \";
    if (performance.navigation.type == 1) {
        
      } else {
        
      }
      
      if (distance < 0) {
      
        document.getElementById(\"myForm\").submit();
      }
}}, 500);";
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
</FORM>

<dialog id=\"modal_op\">
You escaped fullscreen click the below button to go back to full screen
<br>
<button onClick=\"fullScreenExit()\" >fullscreen</button>
</dialog>";
echo"<BUTTON VALUE=\"CHAT\" id=\"chat\" style=\"border-radius: 50px; width:50px; height:50px;\">💬</BUTTON>";
echo"<div class=\"video_container\"><video id=\"video\" width=\"400\" height=\"300\" autoplay></video></div>";
// echo"<div class=\"video_container\"><video id=\"video-remote\" width=\"400\" height=\"300\" autoplay></video></div>";
echo"</div>";
?>
<script src="./js/video.js"></script>
<style>
.video_container{
  float: right;
}
</style>
<?php
}else{
echo"TOTAL WEB PORTAL ERROR , OUR IT STAFF HAS BEEN INFORMED";
echo"<BODY BACKGROUND=\"img.jpg\"></BODY>";
logerror("INTERNAL ERROR","THERE IS AN INTERNAL ERROR NO RELATION BETWEEN SESSION DATABASE QUERY AND PHP GET SESSION ID=".$sid.",".$_COOKIE["SESSIONid"]." CURRENT USER IS".$uid."");
}
}else{
echo"don't try to open quiz without proper authorisation";
echo"<BODY BACKGROUND=\"img.jpg\"></BODY>";
logerror("HACK ALERT","SOMEONE JUST TRIED TO ENTER THE QUIZ SYSTEM WITHOUT PIRIOR AUTHORISTAION");
}
?>
</html>