<?php
include "connection.php";

$next = $_POST["next"];
$question = $_POST["question"];
$answer = $_POST["answer"];

if(!empty($next) || !empty($question) || !empty(answer)){
    echo addAnswer($answer, $next, $question);
}
?>