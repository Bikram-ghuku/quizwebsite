<?php

include('mysqli_connect.php');
$query2 = "select * from settings where attribute = 'redirect'";
$que2 = mysqli_query($db,$query2);
$q2 = mysqli_fetch_array($que2);
$redirect = $q2["value"];
if(isset($_COOKIE["SESSIONid"])){
	
	
$session =	$_COOKIE["SESSIONid"];
if($session !==md5("UNKNOOWN")){
setcookie(time,0,time()-3600);
session_start();
$query = "select * from sessions where SESSION = '$session'";
$que = mysqli_query($db,$query);
$q = mysqli_fetch_array($que);
$u=$q["USERNAME"];
$p=$q["password"];
}else{
$u = $_COOKIE["USER"];
$p = $_COOKIE["PASSWORD"];	
	
}

if($redirect == "maintence"){
header("Location:Under_maintenence.htm");
}else{
header("Location:localhost:8080/quiz/LOGIN.php?username=".$u."&pass=".$p."&Id=LOGIN12556");
}	
}else{
    if($redirect == "maintence"){
header("Location:Under_maintenence.htm");
    }else{	
header("Location:homepage.htm");	
    }	
}

?>