<?php
include('mysqli_connect.php');
if(isset($_COOKIE["SESSIONid"])){
if($_COOKIE["SESSIONid"]==md5("UNKNOOWN")){
echo"<H1><CENTER>WELCOME TO ADMIN PANEL</CENTER></H1>";
echo"<head><title>ADMIN PORTAL</title></head>";
echo"<FORM ACTION=\"INSERT.php\" TYPE=\"POST\" ALIGN=\"CENTER\">";
echo"<H1>
TESTid<INPUT TYPE=\"TEXT\"  NAME=\"T\" height=\"48\"><BR><BR>
<INPUT TYPE=\"SUBMIT\" VALUE=\"ADD QUESTIONS\" NAME=\"Q\" height=\"48\">";
echo"<INPUT TYPE=\"SUBMIT\" VALUE=\"VIEW STATISTICS\" NAME=\"Q\" height=\"48\">";
echo"<INPUT TYPE=\"SUBMIT\" VALUE=\"CREATE SIGNUP CODE\" NAME=\"Q\" height=\"48\"></H1>";
echo"</FORM>";
echo"<CENTER>USE TESTid Only whem using the VIEW statistics button</CENTER><BR><BR>";
}else{
echo"Wrong cookie";
}
}else{
echo"SESSION EXPIRED";
}
echo"<center><h1><u>TABLE SHOWING ALL OF YOUR CREATED TEST</u></h1></center>";

$CNAME = $_COOKIE["USER"];
$query = "select * from questions2 where CNAME='$CNAME'";
$que = mysqli_query($db,$query);
while($q = mysqli_fetch_array($que)){
echo"<TABLE align=\"CENTER\" border=\"1px\"  width=\"1000px\">";
echo"<TR align=\"center\"><TD>TESTid</TD><TD>TIME</TD>";
echo"<TR align=\"center\"><TD>".$q["Tid"]."</TD><TD>".$q["TIME"]."</TD></TABLE>";
}
?>