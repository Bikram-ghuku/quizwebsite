<?php
include('mysqli_connect.php');
$T=mysqli_real_escape_string($db,$_GET["T"]);
$Q=mysqli_real_escape_string($db,$_GET["Q"]);
echo"<HEAD>
<title>$Q page</title>
<meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
<script src=\"https://cdn.socket.io/4.2.0/socket.io.min.js\" integrity=\"sha384-PiBR5S00EtOj2Lto9Uu81cmoyZqR57XcOna1oAuVuIEjzj0wpqDVfD0JA9eXlRsj\" crossorigin=\"anonymous\"></script>
<link href=\"https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css\" rel=\"stylesheet\" integrity=\"sha384-uWxY/CJNBR+1zjPWmfnSnVxwRheevXITnMqoEIeG1LJrdI0GlVs/9cVSyPYXdcSF\" crossorigin=\"anonymous\">";
if($_SESSION["SESSIONid"]=md5("UNKNOOWN")){
if($Q=="CREATE TEST PAPER"){
echo"<TITLE>Add questions</TITLE>
</HEAD>";
echo"<body><script src=\"https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js\" integrity=\"sha384-kQtW33rZJAHjgefvhyyzcGF3C5TFyBQBA13V1RKPf4uH+bwyzQxZ6CmMZHmNBEfJ\" crossorigin=\"anonymous\"></script></body>";


echo"<H1><CENTER>WELCOME TO CREATE QUIZ TAB</CENTER></H1><BR><BR>";
echo"<FORM ACTION=\"f.php\" TYPE=\"POST\">";
echo"TESTID:<INPUT TYPE=\"TEXT\" NAME=\"td\"><BR><BR><BR><BR>";
echo"Time for test(leave blank for 5mins in sec):<INPUT TYPE=\"TEXT\" NAME=\"tt\"><BR><BR><BR><BR>";
echo"<H4>Please select the radio button corresponding to the correct button</H4>";
echo"Q1:<INPUT TYPE=\"TEXT\" NAME=\"e\"><BR>";
echo"1A:<INPUT TYPE=\"RADIO\" NAME=\"ca\" value=\"a\"><INPUT TYPE=\"RICHTEXT\" NAME=\"ea\"><BR>";
echo"1B:<INPUT TYPE=\"RADIO\" NAME=\"ca\" value=\"b\"><INPUT TYPE=\"TEXT\" NAME=\"eb\"><BR>";
echo"1C:<INPUT TYPE=\"RADIo\" NAME=\"ca\" value=\"c\"><INPUT TYPE=\"TEXT\" NAME=\"ec\"><BR>";
echo"1D:<INPUT TYPE=\"RADIO\" NAME=\"ca\" value=\"d\"><INPUT TYPE=\"TEXT\" NAME=\"ed\"><BR><BR>";

echo"Q2:<INPUT TYPE=\"TEXT\" NAME=\"f\"><BR>";
echo"2A:<INPUT TYPE=\"RADIO\" NAME=\"cb\" value=\"a\"><INPUT TYPE=\"TEXT\" NAME=\"fa\"><BR>";
echo"2B:<INPUT TYPE=\"RADIO\" NAME=\"cb\" value=\"b\"><INPUT TYPE=\"TEXT\" NAME=\"fb\"><BR>";
echo"2C:<INPUT TYPE=\"RADIO\" NAME=\"cb\" value=\"c\"><INPUT TYPE=\"TEXT\" NAME=\"fc\"><BR>";
echo"2D:<INPUT TYPE=\"RADIO\" NAME=\"cb\" value=\"d\"><INPUT TYPE=\"TEXT\" NAME=\"fd\"><BR><BR>";

echo"Q3:<INPUT TYPE=\"TEXT\" NAME=\"g\"><BR>";
echo"3A:<INPUT TYPE=\"RADIO\" NAME=\"cc\" value=\"a\"><INPUT TYPE=\"TEXT\" NAME=\"ga\"><BR>";
echo"3B:<INPUT TYPE=\"RADIO\" NAME=\"cc\" value=\"b\"><INPUT TYPE=\"TEXT\" NAME=\"gb\"><BR>";
echo"3C:<INPUT TYPE=\"RADIO\" NAME=\"cc\" value=\"c\"><INPUT TYPE=\"TEXT\" NAME=\"gc\"><BR>";
echo"3D:<INPUT TYPE=\"RADIO\" NAME=\"cc\" value=\"d\"><INPUT TYPE=\"TEXT\" NAME=\"gd\"><BR><BR>";

echo"Q4:<INPUT TYPE=\"TEXT\" NAME=\"h\"><BR>";
echo"4A:<INPUT TYPE=\"RADIO\" NAME=\"cd\" value=\"a\"><INPUT TYPE=\"TEXT\" NAME=\"ha\"><BR>";
echo"4B:<INPUT TYPE=\"RADIO\" NAME=\"cd\" value=\"b\"><INPUT TYPE=\"TEXT\" NAME=\"hb\"><BR>";
echo"4C:<INPUT TYPE=\"RADIO\" NAME=\"cd\" value=\"c\"><INPUT TYPE=\"TEXT\" NAME=\"hc\"><BR>";
echo"4D:<INPUT TYPE=\"RADIO\" NAME=\"cd\" value=\"d\"><INPUT TYPE=\"TEXT\" NAME=\"hd\"><BR><BR>";

echo"Q5:<INPUT TYPE=\"TEXT\" NAME=\"i\"><BR>";
echo"5A:<INPUT TYPE=\"RADIO\" NAME=\"ce\" value=\"a\"><INPUT TYPE=\"TEXT\" NAME=\"ia\"><BR>";
echo"5B:<INPUT TYPE=\"RADIO\" NAME=\"ce\" value=\"b\"><INPUT TYPE=\"TEXT\" NAME=\"ib\"><BR>";
echo"5C:<INPUT TYPE=\"RADIO\" NAME=\"ce\" value=\"c\"><INPUT TYPE=\"TEXT\" NAME=\"ic\"><BR>";
echo"5D:<INPUT TYPE=\"RADIO\" NAME=\"ce\" value=\"d\"><INPUT TYPE=\"TEXT\" NAME=\"id\"><BR><BR>";


echo"<INPUT TYPE=\"SUBMIT\" VALUE=\"INSERT\" class=\"btn btn-primary btn-lg\">";
echo"</FORM>";
}
else if ($Q=="VIEW STATISTICS"){
	$NAME=$_COOKIE["USER"];
    echo"<h1><CENTER> Marks Of Student Page <CENTER></H1><br><br>";
echo"<table align=\"CENTER\" border=\"1px\" width=\"1000px\" id =\"table_students\" class=\"table table-bordered table-hover table-dark\">";
echo"<tr align=\"center\"><th>Profile PASSWORD</th><th>NAME</th><th>SCORE</th></tr>";
$query="SELECT * FROM login WHERE ADMINNAME='$NAME'";
echo"<body><script src=\"https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js\" integrity=\"sha384-kQtW33rZJAHjgefvhyyzcGF3C5TFyBQBA13V1RKPf4uH+bwyzQxZ6CmMZHmNBEfJ\" crossorigin=\"anonymous\"></script></body>";

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
echo"<br><BR><BR><center><button class=\"btn btn-info btn-lg\" onClick = exportTableToExcel(\"table_students\",\"sudents_stats\")>Download the table as excel</button></center>";
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
    echo"<body><script src=\"https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js\" integrity=\"sha384-kQtW33rZJAHjgefvhyyzcGF3C5TFyBQBA13V1RKPf4uH+bwyzQxZ6CmMZHmNBEfJ\" crossorigin=\"anonymous\"></script></body>";

echo"<CENTER><H1><U>Welcome to create identity</U><br><br>";
echo"Please create a code that is unique and will be used by students for self sign-up. <BR>";
echo"<form action=\"s.php\" TYPE=\"POST\">";
echo"<br>login id:<INPUT TYPE=\"TEXT\" Name=\"f\"><BR><BR>";
echo"<input type=\"submit\" value=\"create\" class=\"btn btn-success btn-lg\">";
echo"</form></H1></CENTER>";
echo"<marquee>Here you create your identity so that your users can signin</marquee>";

}else if($Q=="TOGGLE DATA"){
    $query_data = "SELECT a_response FROM questions2 WHERE tid=\"$T\"";
    $qu_data=mysqli_query($db,$query_data);
    $qu_data_arr = mysqli_fetch_array($qu_data);
    if($qu_data_arr["a_response"]==0){
        $curr = "Activated accepting response for $T";
        $set_curr = 1;
    }else{
        $curr = "Revoked accepting response $T";
        $set_curr = 0;
    } 
    echo $curr; 
    $query_data_update = "UPDATE questions2 SET a_response=$set_curr WHERE tid=\"$T\""; 
    $qu_data_up=mysqli_query($db,$query_data_update);
    header("Location: ./ADMIN.php");
}

}
?>