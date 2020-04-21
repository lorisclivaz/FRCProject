<?php
//BACKOFFICE PART
//Add a new Answer
if(!empty($_POST["next"]) || !empty($_POST["question"]) || !empty($_POST["answer"])){
    $next = $_POST["next"];
    $question = $_POST["question"];
    $answer = $_POST["answer"];
    echo addAnswer($answer, $next, $question);
}

//Add a new Paragraph
if(!empty($_POST["paragraph"]) || !empty($answer = $_POST["answer"]) || !empty($_POST["categorie"]) || !empty($_POST["number"]) || !empty(json_decode(stripslashes($_POST['data'])))){

    $catid = $_POST["categorie"];
    $answer = $_POST["answer"];
    $paragraph = $_POST["paragraph"];
    $number = $_POST["number"];
    $data = json_decode(stripslashes($_POST['data']));
    echo addParagraph($catid, $answer, $paragraph, $number, $data);
}

//Add a new Question
if(!empty($_POST["cat"]) || !empty($_POST["model"]) || !empty($_POST["rp"]) || !empty($_POST["question"])){
    $catid = $_POST["cat"];
    $modelname = $_POST["model"];
    $rp = $_POST["rp"];
    $question = $_POST["question"];
    $explication = $_POST["explication"];
    echo addQuestion($question, $modelname, $rp, $explication);
}
