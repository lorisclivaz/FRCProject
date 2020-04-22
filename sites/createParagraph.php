<?php
include "../db/connection.php";

//Add a new Paragraph
if(!empty($_POST["paragraph"]) || !empty($answer = $_POST["answer"]) || !empty($_POST["categorie"]) || !empty($_POST["number"]) || !empty(json_decode(stripslashes($_POST['data'])))){

    $catid = $_POST["categorie"];
    $answer = $_POST["answer"];
    $paragraph = $_POST["paragraph"];
    $number = $_POST["number"];
    $data = json_decode(stripslashes($_POST['data']));
    echo addParagraph($catid, $answer, $paragraph, $number, $data);
}