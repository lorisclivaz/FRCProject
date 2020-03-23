<?php
include "connection.php";

if (! empty($_POST["categorie_id"])) {
    $idCategorie = $_POST["categorie_id"];
    echo modelList($idCategorie);
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

