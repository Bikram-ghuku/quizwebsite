<?php
include('mysqli_connect.php');
echo"<head>";
if(isset($_COOKIE["SESSIONid"])){
if($_COOKIE["SESSIONid"]==md5("UNKNOOWN")){
echo"<H1><CENTER>WELCOME TO ADMIN PANEL</CENTER></H1>";
echo"<title>ADMIN PORTAL</title>
<meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">

<link href=\"https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css\" rel=\"stylesheet\" integrity=\"sha384-uWxY/CJNBR+1zjPWmfnSnVxwRheevXITnMqoEIeG1LJrdI0GlVs/9cVSyPYXdcSF\" crossorigin=\"anonymous\">
</head>";
echo"<FORM ACTION=\"INSERT.php\" TYPE=\"POST\" ALIGN=\"CENTER\">";
echo"<H1>
<INPUT TYPE=\"hidden\" NAME=\"T\">
<INPUT TYPE=\"SUBMIT\" VALUE=\"CREATE TEST PAPER\" NAME=\"Q\" height=\"48\" class=\"btn btn-primary btn-lg shadow-lg p-3 mb-5 rounded\" padding=\"10px\">";
echo"<INPUT TYPE=\"SUBMIT\" VALUE=\"CREATE SIGNUP CODE\" NAME=\"Q\" height=\"48\" class=\"btn btn-success btn-lg shadow-lg p-3 mb-5 rounded\"></H1>";
echo"</FORM>";
}else{
echo"Wrong cookie";
}
}else{
echo"SESSION EXPIRED";
}
echo"<center><h1><u>TABLE SHOWING ALL OF YOUR CREATED TEST</u></h1></center>";
echo"<body><script src=\"https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js\" integrity=\"sha384-kQtW33rZJAHjgefvhyyzcGF3C5TFyBQBA13V1RKPf4uH+bwyzQxZ6CmMZHmNBEfJ\" crossorigin=\"anonymous\"></script></body>";
$CNAME = $_COOKIE["USER"];
$query = "select * from questions2 where CNAME='$CNAME'";
$que = mysqli_query($db,$query);
echo"<TABLE align=\"CENTER\" border=\"1px\"  width=\"1000px\" class=\"table table-hover table-bordered\">";
echo"<TR align=\"center\"><TD scope=\"col\">TESTid</TD><TD scope=\"col\">TIME</TD><TD scope=\"col\">ACCEPTING RESPONSE</TD><TD scope=\"col\">ACTIONS</TD>";
while($q = mysqli_fetch_array($que)){
    if($q['TIME']==0){
        $q['TIME']="300sec";
    }else{
        $q['TIME']=$q['TIME'].'sec';
    }

    if($q['a_response']==1){
        $q['a_response']="<div class=\"text-success border border-success rounded w-25 p-3\">Yes</div>";
        
    }else{
        $q['a_response']="<div class=\"text-danger border border-danger rounded w-25 p-3\">No</div>"; 
    }

    echo"<TR align=\"center\"><TD>".$q["Tid"]."</a></TD><TD>".$q["TIME"]."</TD><TD>".$q['a_response']."</TD><td><button class=\"btn btn-danger btn-sm\" onclick=\"location.href='./proctor?tid=".$q["Tid"]."'\" type=\"button\" title=\"Video Proctoring\">🔎</button>
    <button class=\"btn btn-primary btn-sm\" onclick=\"location.href='./INSERT.php?T=".$q["Tid"]."&Q=VIEW+STATISTICS'\" title=\"Show Result\">✔️</button>
    <button class=\"btn btn-primary btn-sm\" onclick=\"location.href='./INSERT.php?T=".$q["Tid"]."&Q=TOGGLE+DATA'\" title=\"Toggle accept response\">🔄</button></td>";
}
echo"</TABLE>";
?>
