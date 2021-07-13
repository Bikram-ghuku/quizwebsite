<?php

include('mysqli_connect.php');

$a=mysqli_real_escape_string($db,$_GET["f"]);
$b=mysqli_real_escape_string($db,$_GET["g"]);
$c=mysqli_real_escape_string($db,$_GET["h"]);
$d=mysqli_real_escape_string($db,$_GET["i"]);
$e=mysqli_real_escape_string($db,$_GET["j"]);
$tid=mysqli_real_escape_string($db,$_GET["TESTid"]);
//$u=mysqli_real_escape_string($db,$_GET["U"]);
$score=0;
echo"<head><title>STATICS</title></head>";
if(isset($_COOKIE["SESSIONid"])){
	$cookie=$_COOKIE["SESSIONid"];
$query="SELECT * FROM answers2 WHERE Tid='$tid'";
$query2="SELECT * FROM sessions WHERE SESSION='$cookie'";
$qarr2=mysqli_query($db,$query2);
$q2=mysqli_fetch_array($qarr2);
$u=$q2["USERNAME"];
$qarr=mysqli_query($db,$query);
$q=mysqli_fetch_array($qarr);



echo"<H1>STATISTICS FOR ".$u."</h1>.";
echo"<BR><BR>Question1:<BR>";

if($a==$q["a"] || !$q["a"]){
echo"CORRECT";
$score=$score+4;
}else{
echo"WRONG";

}
echo"<BR><BR>Question2:<BR>";
if($b==$q["b"] || !$q["b"]){
echo"CORRECT";
$score=$score+4;
}else{
echo"WRONG";

}
echo"<BR><BR>Question3:<BR>";
if($c==$q["c"] || !$q["c"]){
echo"CORRECT";
$score=$score+4;
}else{
echo"WRONG";

}
echo"<BR><BR>Question4:<BR>";
if($d==$q["d"] || !$q["d"]){
echo"CORRECT";
$score=$score+4;
}else{
echo"WRONG";

}
echo"<BR><BR>Question5:<BR>";
if($e==$q["e"] || !$q["e"]){
echo"CORRECT";
$score=$score+4;
}else{
echo"WRONG";

}
echo"<BR><BR><H1>SCORE is:".$score."</H1>";
$sq="SELECT * FROM login WHERE USERNAME='".$u."'";


$s=$db1->query($sq);

$se=$s->fetch_assoc();
if($se[$tid]=='-1000'){
	
$su=mysqli_query($db,"UPDATE login SET $tid = '$score' WHERE USERNAME='$u'");
}else{
	
echo"<HTML><H1>You have already subbmitted the quiz, So this attempt will not be uploaded</H1></HTML>";
}
setcookie("SESSIONid", "", time() - 3600);
setcookie("mycookie", "", time() - 3600);
$bik="DELETE FROM sessions WHERE USERNAME='$u' ";
}else{
echo"<CENTER><H1>Don't resubmit the quiz, This incident has been infromed to our technical staff</H1></CENTER>";
echo"<BODY BACKGROUND=\"img.jpg\"></BODY>";
mail("bikramghuku05@gamil.com","RESUBMISSION","THERE HAS BEEN A RESUBMISSION IN THE QUIZ WEBSITE");
}
?>