<?php
include "connection.php";

if (! empty($_POST["model_name"])) {
    $model = $_POST["model_name"];
    echo getAnswerandQuestionsFromModel($model);

}