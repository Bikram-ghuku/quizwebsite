<?php
include('mysqli_connect.php');
$f=mysqli_real_escape_string($db,$_GET["f"]);
$u=$_COOKIE["USER"];
$query667="SELECT * FROM a_code WHERE Code='$f'";


if($con->query($query667) === TRUE){
	echo"Done";
	$que667 = $con->query($query667);
	
}else{
	echo"error".$con->error."";
}
$q667 = $con->mysqli_fetch_assoc($que667);

if($_COOKIE["SESSIONid"]==md5("UNKNOOWN")){
	if($q667["Code"]==$f||$q667["AdminName"]==$u){
		echo"CODE ALREADY PRESENT UNDER THIS ADMIN";
		echo"THE CODE IS".$q667["Code"]."";
	}else{
$query3="INSERT INTO a_code(AdminName,Code) VALUES('$u','$f')";
echo"CODE CREATION SUCCESS";
$que=mysqli_query($db,$query3);
	}
}else{
	echo"session expired";
}

?>