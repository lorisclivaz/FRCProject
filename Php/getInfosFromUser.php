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

if (! empty($_POST["next_question"])) {
    $idQuestion = $_POST["next_question"];

    if (strlen($idQuestion) == 1)
    {
        echo get_next_question_2($idQuestion);

    }else
    {
        get_Paragraph_From_id($idQuestion);
    }
}

