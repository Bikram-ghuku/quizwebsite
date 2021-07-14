<?php
include('mysqli_connect.php');
error_reporting(0);
$USERNAME=mysqli_real_escape_string($db,$_GET['username']);

$PASSWORD_U=mysqli_real_escape_string($db,$_GET['pass']);

$IDENTITY=mysqli_real_escape_string($db,$_GET['Id']);

$TID = mysqli_real_escape_string($db,$_GET['testid']);
echo"<link rel=\"Stylesheet\" href=\"./css/homepage.css\">";
echo"<script src=\"./js/toogle_pswd.js\"></script>";
echo"<script src=\"./js/check_empty.js\"></script>";
echo"<head><title>WELCOME</title></head>";
$PASSWORD = md5($PASSWORD_U);

$query96 = "select * from a_code where Code='$IDENTITY'";

$que96=mysqli_query($db,$query96);

$q96=mysqli_fetch_array($que96);

$query9 = "SELECT * FROM login WHERE USERNAME='$USERNAME'";

$que9=mysqli_query($db,$query9);

$q9=mysqli_fetch_array($que9);

$aabbcc = $q96["AdminName"];

if($IDENTITY==$q96["Code"]){
    //generate unique acccount id
    function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    if($i%7==0){

        $randomString .= '-';
    }
    }
    return $randomString;
    }

	//SIGNUP AREA



if($USERNAME!=$q9["USERNAME"]){
//SUCCESSFUL SIGNUP
    echo" ".$q9["USERNAME"];
	$propwd = generateRandomString(49);

    $query3="INSERT INTO login(USERNAME,profilepwd,PASSWORD,TYPE,ADMINNAME) VALUES('$USERNAME','$propwd','$PASSWORD','USER','$aabbcc')";

    $q3=mysqli_query($db,$query3);

    echo"<H1>SIGNUP SUCCESS<br></H1>";
    echo"<h2><a href=\"./login.htm\">Goto login page to login</a></h2>";

}else{
//FAILED SIGNUP
echo"<CENTER><H1><U>Account already present please login</U></H1></CENTER>";

}

}else if($IDENTITY==="ADMIN9733817"&&$USERNAME!=$q9["USERNAME"]){

	//ADMIN SIGNUP AREA
    $query3="INSERT INTO login(USERNAME,PASSWORD,TYPE) VALUES ('$USERNAME','$PASSWORD','ADMIN')";

    $q3=mysqli_query($db,$query3);

    echo"SIGNUP SUCCESS";



}else if($IDENTITY=="LOGIN12556"){


setcookie("mycookie", "", time() - 3600);
$query = "select * from login where USERNAME='$USERNAME' and PASSWORD='$PASSWORD'";

$que=mysqli_query($db,$query);

$q=mysqli_fetch_array($que);

echo"<script data-ad-client=\"ca-pub-3187147864873704\" async src=\"https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js\"></script>";

if($q["USERNAME"]==$USERNAME && $q["PASSWORD"]==$PASSWORD ){
//LOGIN INITAILSATION
    echo"<div class=\"container\">";
    echo"<div class=\"heading\">";
    echo"<CENTER><H1>LOGIN SUCCESS, WELCOME $USERNAME</H1><br></CENTER>";
    echo"</div>";
    echo"<body class=\"body\"></body>";
    echo"<div class=\"bg-image\"></div>";

if( $q["TYPE"]=="USER"){
//USER LOGIN
echo"<div class=\"side\">";
echo"<h7>Please make a note of your profile pwd in case you need to change password</h7>";


$ppwd = $q["profilepwd"];

echo"<div class=\"profile-pswd-container\">";
echo"<BR>PROFILE PASSWORD: <br><input type=\"password\" value=\"$ppwd\" id=\"account-confidential\" class=\"profile-pswd\">";
echo"<button onclick=\"toogleData()\" class=\"profile-pswd-button\">👁️</button><br>";
echo"</div>";
$sid=md5(rand(1,10000000000000000));

$query2="INSERT INTO sessions(SESSION,USERNAME,IDENTITY,password) VALUES('$sid','$USERNAME','$IDENTITY','$PASSWORD_U')";

$q2=mysqli_query($db,$query2);

setcookie("SESSIONid",$sid);


echo"<div class=\"form\">";
echo"<FORM ACTION=\"quiz.php\" TYPE=\"POST\">";

echo"TEST ID: <INPUT TYPE=\"TEXT\" NAME=\"tid\" value =".$TID." ><br>";

echo"USERNAME: <INPUT TYPE=\"TEXT\" NAME=\"U\" VALUE=".$USERNAME." readonly><br>";

echo"<INPUT TYPE=\"HIDDEN\" NAME=\"sd\" VALUE=".$sid." readonly><br>";

echo"By continuing you accept our quiz policy and instructions.";
echo"<div class=\"sumbit-button-container\">";
echo"<div class=\"sumbit-button-div\">";
echo"<div class=\"btn-bg\"></div>";
echo"<INPUT TYPE=\"SUBMIT\" VALUE=\"LET'S GO\" class=\"submit-button\" onClick=\"check()\">";
echo"</div>";
echo"</div>";
echo"</FORM>";

$val=$q["ADMINNAME"];

echo"FOR TEST ID CONTACT YOUR ADMIN: $val";
echo"</div>";
echo"</div>";
echo"</div>";
}

else{
//LOGIN ADMIN
echo"<CENTER><H1>ADMIN LOGIN</CENTER></H1>";

setcookie("SESSIONid",md5("UNKNOOWN"),time()+1000);

setcookie("USER",$USERNAME,time()+1000);
setcookie("PASSWORD",$PASSWORD_U ,time()+1000);

echo"<a href=\"ADMIN.php\"><CENTER>GOTO ADMIN PANEL</A></CENTER>";

}

}else{

echo"<CENTER><H1>LOGIN FAILED</H1> </CENTER><BR>";

}

}else{

	echo"<CENTER><H1>ACCOUNT ALREADY PRESENT PLEASE LOGIN</H1></CENTER>";

}



?>
