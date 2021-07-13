<?php

include('mysqli_connect.php');
$chars = 'abcdefghijklmnopqrstuvwxyz';
error_reporting(E_ALL & ~E_NOTICE);
$tid=mysqli_real_escape_string($db,$_GET["TESTid"]);
$tid = "DUMMY";
for($i=0;$i<=100000;$i++){
if($_GET[$chars[$i]]){
	$$chars[$i] = mysqli_real_escape_string($db,$_GET[$chars[$i]]); 
}else{
break;
}	
}	
//$u=mysqli_real_escape_string($db,$_GET["U"]);
$score=0;
echo"<head><title>STATICS</title></head>";
if(isset($_COOKIE["SESSIONid"])){
	$cookie=$_COOKIE["SESSIONid"];
$query="SELECT * FROM answers_premium WHERE Testid='$tid'";
$query2="SELECT * FROM sessions WHERE SESSION='$cookie'";
$qarr2=mysqli_query($db,$query2);
$q2=mysqli_fetch_array($qarr2);
$u=$q2["USERNAME"];
$qarr=mysqli_query($db,$query);
$q=mysqli_fetch_array($qarr);
echo"<H1>STATISTICS FOR ".$u."</h1>.";
echo"<h1>";
for($i=0;$i<=100000;$i++){
if(strlen($$chars[$i])>0){
$j = $i+1;
echo"<BR><BR>Question".$j.":";	
if($$chars[$i]==$q[$chars[$i]] || !$q[$chars[$i]]){
echo"<a style=\"color:Green\">Correct</a>";
$score = $score+1;
}else{
echo"<a style=\"color:Red\">Wrong</a>";	
}	
}else{
break;
}	
}
echo"</H1>";

echo"<BR><BR><H1>SCORE is:".$score."</H1>";
$sq="SELECT * FROM login WHERE USERNAME='".$u."'";


$s=$db1->query($sq);

$se=$s->fetch_assoc();
if($se[$tid]=='-1000'){
	
$su=mysqli_query($db,"UPDATE login SET $tid = '$score' WHERE USERNAME='$u'");
}else{
	
echo"<HTML><H1>You have already subbmitted the quiz, So this attempt will not be uploaded</H1></HTML>";
}
//setcookie("SESSIONid", "", time() - 3600);
//setcookie("mycookie", "", time() - 3600);
$bik="DELETE FROM sessions WHERE USERNAME='$u' ";
}else{
echo"<CENTER><H1>Don't resubmit the quiz, This incident has been infromed to our technical staff</H1></CENTER>";
echo"<BODY BACKGROUND=\"img.jpg\"></BODY>";
mail("bikramghuku05@gamil.com","RESUBMISSION","THERE HAS BEEN A RESUBMISSION IN THE QUIZ WEBSITE");
}
?>