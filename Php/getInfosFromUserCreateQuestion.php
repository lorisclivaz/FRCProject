<?php
include "connection.php";

$catid = $_POST["cat"];
$modelname = $_POST["model"];
$rp = $_POST["rp"];
$question = $_POST["question"];
$explication = $_POST["explication"];
if(!empty($catid) || !empty($modelname) || !empty($rp) || !empty($question)){
    echo addQuestion($question, $modelname, $rp, $explication);
}
?>