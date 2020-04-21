<?php
include "../db/connection.php";

if (! empty($_POST["categorie_id"])) {
    $idCategorie = $_POST["categorie_id"];
    echo modelList($idCategorie);
}

if (! empty($_POST["categorie_id_2"])) {
    $idCategorie = $_POST["categorie_id_2"];
    echo modelList2($idCategorie);
}

if (! empty($_POST["categorie_id_bo"])) {
    $idCategorie = $_POST["categorie_id_bo"];
    echo modelListBO($idCategorie);
}

if (! empty($_POST["model_id_bo"])) {
    $idModel = $_POST["model_id_bo"];
    echo questionListBO($idModel);
}

if (! empty($_POST["model_id"])) {
    $idmodel = $_POST["model_id"];
    echo getFirstAnswerAndQuestion($idmodel);
}

if (! empty($_POST["categorie_field"])) {
    $idCategorie = $_POST["categorie_field"];
    echo getFieldFromCategorie($idCategorie);
}

if (! empty($_POST["paragraphe_number"])) {
    $para_number = $_POST["paragraphe_number"];
    echo getFieldFromParaNumber($para_number);
}

if (! empty($_POST["next_question"])) {
    $idQuestion = $_POST["next_question"];

    echo get_next_question_2($idQuestion);
}

if (! empty($_POST["paragraph_number"])) {
    $idPara = $_POST["paragraph_number"];

    echo get_Paragraph_From_id($idPara);
}

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


