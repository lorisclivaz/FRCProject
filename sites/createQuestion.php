<?php
include "../db/connection.php";

//Add a new Question
if(!empty($_POST["cat"]) || !empty($_POST["model"]) || !empty($_POST["rp"]) || !empty($_POST["question"])){
    $catid = $_POST["cat"];
    $modelname = $_POST["model"];
    $rp = $_POST["rp"];
    $question = $_POST["question"];
    $explication = $_POST["explication"];
    echo addQuestion($question, $modelname, $rp, $explication);}