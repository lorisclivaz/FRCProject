<?php
include "connection.php";

if (! empty($_POST["categorie_id"])) {
    $idCategorie = $_POST["categorie_id"];
    echo modelList($idCategorie);

}

