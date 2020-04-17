<?php
include "connection.php";

$catid = $_POST["categorie"];
$answer = $_POST["answer"];
$paragraph = $_POST["paragraph"];
$number = $_POST["number"];
$data = json_decode(stripslashes($_POST['data']));
if(!empty($paragraph) || !empty($question) || !empty($catid) || !empty($number)){
    echo addParagraph($catid, $answer, $paragraph, $number, $data);
}
?>