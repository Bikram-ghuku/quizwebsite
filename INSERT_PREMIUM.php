<?php
include('mysqli_connect.php');
$chars = 'abcdefghijklmnopqrstuvwxyz';
$T=mysqli_real_escape_string($db,$_GET["T"]);
$Q=mysqli_real_escape_string($db,$_GET["Q"]);
if($_SESSION["SESSIONid"]=md5("UNKNOOWN")){
if($Q=="CREATE TEST PAPER"){

echo"<H1><CENTER>WELCOME TO CREATE QUIZ TAB</CENTER></H1><BR><BR>";
echo"<FORM ACTION=\"f.php\" TYPE=\"POST\">";
echo"TESTID:<INPUT TYPE=\"TEXT\" NAME=\"td\"><BR><BR><BR><BR>";
echo"Time for test(leave blank for 5mins in sec):<INPUT TYPE=\"TEXT\" NAME=\"tt\"><BR><BR><BR><BR>";
echo"<H4>Please select the radio button corresponding to the correct button</H4>";
for($x=0; $x<=10; $x++){
    $y = $x+1;
    echo"Q".$y.":<INPUT TYPE=\"TEXT\" NAME=\"".$chars[$x]."\"><BR>";
    echo"".$y."A:<INPUT TYPE=\"RADIO\" NAME=\"c".$chars[$x]."\" value=\"a\"><INPUT TYPE=\"TEXT\" NAME=\"".$chars[$x]."a\"><BR>";
    echo"".$y."B:<INPUT TYPE=\"RADIO\" NAME=\"c".$chars[$x]."\" value=\"b\"><INPUT TYPE=\"TEXT\" NAME=\"".$chars[$x]."b\"><BR>";
    echo"".$y."C:<INPUT TYPE=\"RADIO\" NAME=\"c".$chars[$x]."\" value=\"c\"><INPUT TYPE=\"TEXT\" NAME=\"".$chars[$x]."c\"><BR>";
    echo"".$y."D:<INPUT TYPE=\"RADIO\" NAME=\"c".$chars[$x]."\" value=\"d\"><INPUT TYPE=\"TEXT\" NAME=\"".$chars[$x]."d\"><BR><BR>";
}

echo"<INPUT TYPE=\"SUBMIT\" VALUE=\"INSERT\">";
echo"</FORM>";
}
else if ($Q=="VIEW STATISTICS"){
	$NAME=$_COOKIE["USER"];
echo"<table align=\"CENTER\" border=\"1px\" width=\"1000px\" id =\"table_students\">";
echo"<tr><th>Profile PASSWORD</th><th>NAME</th><th>SCORE</th></tr>";
$query="SELECT * FROM login WHERE ADMINNAME='$NAME'";

$qu=mysqli_query($db,$query);


while($q1=mysqli_fetch_array($qu)){
if($q1["TYPE"]=="ADMIN" || $T == "PASSWORD" || $T == "TYPE"){
echo"SOMETHING IS NOT CORRECT";
}else{
	if($q1["$T"]=='-1000'){
	$q1["$T"]="NOT ATTEMPTED";
	}

echo"<tr align=\"center\" height=\"50px\"><td>".$q1["profilepwd"]."</td><td>".$q1["USERNAME"]."</td><td>".$q1["$T"]."</td></tr>";
}
}
echo"</table>";
echo"<br><BR><BR><center><button onClick = exportTableToExcel(\"table_students\",\"sudents_stats\")>Download the table as excel</button></center>";
echo"<script>
	function exportTableToExcel(tableID, filename = ''){
    var downloadLink;
    var dataType = 'application/vnd.ms-excel';
    var tableSelect = document.getElementById(tableID);
    var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');
    
    // Specify file name
    filename = filename?filename+'.xls':'excel_data.xls';
    
    // Create download link element
    downloadLink = document.createElement(\"a\");
    
    document.body.appendChild(downloadLink);
    
    if(navigator.msSaveOrOpenBlob){
        var blob = new Blob(['\ufeff', tableHTML], {
            type: dataType
        });
        navigator.msSaveOrOpenBlob( blob, filename);
    }else{
        downloadLink.href = 'data:' + dataType + ', ' + tableHTML;
        downloadLink.download = filename;
        downloadLink.click();
    }
}
</script>";

echo"</table>";
}else if ($Q=="CREATE SIGNUP CODE"){
echo"<CENTER><H1><U>Welcome to create identity</U><br>";
echo"PLEASE CREATE A CODE THAT IS UNIQUE.";
echo"<form action=\"s.php\" TYPE=\"POST\">";
echo"login id:<INPUT TYPE=\"TEXT\" Name=\"f\"><BR><BR>";
echo"<input type=\"submit\" value=\"go\">";
echo"</form></H1></CENTER>";
echo"<marquee>Here you create your identity so that your users can signin</marquee>";

}

}
?>