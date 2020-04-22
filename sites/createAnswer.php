<?php
include "../db/connection.php";
//BACKOFFICE PART
//Add a new Answer
if(!empty($_POST["next"]) || !empty($_POST["question"]) || !empty($_POST["answer"])){
    $next = $_POST["next"];
    $question = $_POST["question"];
    $answer = $_POST["answer"];
    echo addAnswer($answer, $next, $question);
}