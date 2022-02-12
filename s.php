<?php
include('mysqli_connect.php');
$f=mysqli_real_escape_string($db,$_GET["f"]);
$u=$_COOKIE["USER"];
$query667="SELECT * FROM a_code WHERE Code='$f'";
$que667="";

if($que667=mysqli_query($db,$query667)){
	echo"Done: <BR>";
}else{
	echo"error".$con->error."";
}
$q667 =mysqli_fetch_array($que667);

if($_COOKIE["SESSIONid"]==md5("UNKNOOWN")){
	if($q667["Code"]==$f||$q667["AdminName"]==$u){
		echo"<div class=\"messages\">";
		echo"\tCODE ALREADY PRESENT UNDER THIS ADMIN";
		echo"\t THE CODE IS: ".$q667["Code"]."";
		echo"<div>";
	}else{
		$query3="INSERT INTO a_code(AdminName,Code) VALUES('$u','$f')";
		echo"CODE CREATION SUCCESS";
		$que=mysqli_query($db,$query3);
	}
}else{
	echo"session expired";
}

?>