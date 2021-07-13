<?php
echo"<head><title>quiz creation confirmation</title></head>";
include('mysqli_connect.php');


$td=mysqli_escape_string($db,$_GET["td"]);
$tt=mysqli_escape_string($db,$_GET["tt"]);
$e=mysqli_escape_string($db,$_GET["e"]);
$ea=mysqli_real_escape_string($db,$_GET["ea"]);
$eb=mysqli_real_escape_string($db,$_GET["eb"]);
$ec=mysqli_real_escape_string($db,$_GET["ec"]);
$ed=mysqli_real_escape_string($db,$_GET["ed"]);
$f=mysqli_real_escape_string($db,$_GET["f"]);
$fa=mysqli_real_escape_string($db,$_GET["fa"]);
$fb=mysqli_real_escape_string($db,$_GET["fb"]);
$fc=mysqli_real_escape_string($db,$_GET["fc"]);
$fd=mysqli_real_escape_string($db,$_GET["fd"]);
$g=mysqli_real_escape_string($db,$_GET["g"]);
$ga=mysqli_real_escape_string($db,$_GET["ga"]);
$gb=mysqli_real_escape_string($db,$_GET["gb"]);
$gc=mysqli_real_escape_string($db,$_GET["gc"]);
$gd=mysqli_real_escape_string($db,$_GET["gd"]);
$h=mysqli_real_escape_string($db,$_GET["h"]);
$ha=mysqli_real_escape_string($db,$_GET["ha"]);
$hb=mysqli_real_escape_string($db,$_GET["hb"]);
$hc=mysqli_real_escape_string($db,$_GET["hc"]);
$hd=mysqli_real_escape_string($db,$_GET["hd"]);
$i=mysqli_real_escape_string($db,$_GET["i"]);
$ia=mysqli_real_escape_string($db,$_GET["ia"]);
$ib=mysqli_real_escape_string($db,$_GET["ib"]);
$ic=mysqli_real_escape_string($db,$_GET["ic"]);
$id=mysqli_real_escape_string($db,$_GET["id"]);
$cora=mysqli_real_escape_string($db,$_GET["ca"]);
$corb=mysqli_real_escape_string($db,$_GET["cb"]);
$corc=mysqli_real_escape_string($db,$_GET["cc"]);
$cord=mysqli_real_escape_string($db,$_GET["cd"]);
$core=mysqli_real_escape_string($db,$_GET["ce"]);
$CNAME = $_COOKIE["USER"];
$query="INSERT INTO questions2(Tid,TIME,CNAME,a,aa,ab,ac,ad,b,ba,bb,bc,bd,c,ca,cb,cc,cd,d,da,db,dc,dd,e,ea,eb,ec,ed) VALUES ('$td','$tt','$CNAME','$e','$ea','$eb','$ec','$ed','$f','$fa','$fb','$fc','$fd','$g','$ga','$gb','$gc','$gd','$h','$ha','$hb','$hc','$hd','$i','$ia','$ib','$ic','$id')";
$query2="ALTER TABLE login ADD COLUMN $td INT NOT NULL ";
$query3="UPDATE login SET $td = '-1000' WHERE 1";
$query4="INSERT INTO answers2(Tid,a,b,c,d,e) VALUES('$td','$cora','$corb','$corc','$cord','$core')";
$query5="ALTER TABLE login ALTER $td SET DEFAULT '-1000'";
if($con->query($query2) === TRUE){
	echo"COLUMN TO RECORD DATA :DONE<BR><BR>";
}else{
	echo "Error:COLUMN TO RECORD DATA  " . $query2 . "<br>" . $con->error."<BR>";
}

if($con->query($query) === TRUE){
	echo"QUIZ INSERTION:DONE<BR><BR>";
}else{
	echo "Error:QUIZ INSERTION " . $query . "<br>" . $con->error."<BR>";
}
if($con->query($query3) === TRUE){
	echo"INITAL VALUE OF THE QUIZ SCORE:DONE<BR><BR>";
}else{
	echo "Error:INITAL VALUE OF THE QUIZ SCORE " . $query3 . "<br>" . $con->error."<BR>";
}
if($con->query($query4) === TRUE){
	echo"CORRECT ANSWER :DONE<BR><BR>";
}else{
	echo "Error:CORRECT ANSWER " . $query4 . "<br>" . $con->error."<BR>";
}
if($con->query($query5) === TRUE){
	echo"INITIALIZATION :DONE<BR><BR>";
}else{
	echo "<BR>Error:CORRECT ANSWER " . $query5 . "<br>" . $con->error."<BR>";
}
echo"<BR><BR>IF THERE ARE 5 DONE YOUR QUIZ IS GOOD TO GO";

?>
