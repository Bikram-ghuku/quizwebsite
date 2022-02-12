<?php
include('mysqli_connect.php');

$allowedTags='<p><strong><em><u><h1><h2><h3><h4><h5><h6><img>';
$allowedTags.='<li><ol><ul><span><div><br><ins><del>'; 

$question = mysqli_real_escape_string($db, $_GET["question"]);
$cor_ans = mysqli_real_escape_string($db, $_GET["cor_ans"]);
$option_a = mysqli_real_escape_string($db, $_GET["option_a"]);
$option_b = mysqli_real_escape_string($db, $_GET["option_b"]);
$option_c = mysqli_real_escape_string($db, $_GET["option_c"]);
$option_d = mysqli_real_escape_string($db, $_GET["option_d"]);
$explanation = mysqli_real_escape_string($db, $_GET["explanation"]);
$c_name = $_COOKIE['USER'];

$question = strip_tags(stripslashes($question),$allowedTags);
$option_a = strip_tags(stripslashes($option_a),$allowedTags);
$option_b = strip_tags(stripslashes($option_b),$allowedTags);
$option_c = strip_tags(stripslashes($option_c),$allowedTags);
$option_d = strip_tags(stripslashes($option_d),$allowedTags);
$explanation = strip_tags(stripslashes($explanation),$allowedTags);

$question_id_query = "SELECT question_id FROM questions WHERE c_name=$c_name";
$arr_ques_id_quer=mysqli_query($db,$question_id_query);

if($arr_ques_id_quer!=null){
    $ques_arr_id=mysqli_fetch_array($arr_ques_id_quer);
    $question_id=max($question_id_query['question_id']);
    $question_id+=$question_id;
}else{
    $question_id=1;
}

$query = "INSERT INTO questions(question, option_a, option_b, option_c, option_d, explanation, question_id, cor_ans, c_name) VALUES('$question', '$option_a', '$option_b', '$option_c', '$option_d', '$explanation', '$question_id', '$cor_ans', '$c_name')";
echo $query;
$q3=mysqli_query($db,$query);
echo"error raised: " . mysqli_error($db);
?>