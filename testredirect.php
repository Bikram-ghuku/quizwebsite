<?php
include('mysqli_connect.php');
$tid = mysqli_real_escape_string($db,$_GET["tid"]);
error_reporting(0);
$sid = $_COOKIE["SESSIONid"];

if(strlen($sid)+1>=0){ 
$query = "select * from sessions where SESSION = '$sid'";
$que = mysqli_query($db,$query);
$q = mysqli_fetch_array($que);
$u=$q["USERNAME"];
$p=$q["password"];
echo($tid);
header("Location:LOGIN.php?username=".$u."&pass=".$p."&Id=LOGIN12556");
}else{
	echo("<SCRIPT>alert(\"You must be logged in\")</SCRIPT>");
	echo("<H1><CENTER>You must be logged in</CENTER></H1>");
	
}
?>