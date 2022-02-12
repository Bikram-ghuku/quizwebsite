<?php

function logerror($TITLE,$text_got){
    $myread = fopen('./erros.txt',"r") or die("Unable to open file");
    $myfile = fopen('./erros.txt',"w") or die("Unable to open file");
    $text = $myread."\n\n".$TITLE."\n"."Date: ".date("d/m/Y")." ,Time: ".date("h:i:sa")." ,Text: ".$text_got."\n";
    fwrite($myfile, $text);
}
?>