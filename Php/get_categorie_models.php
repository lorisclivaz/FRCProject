<?php
include "connection.php";
echo "<option>working</option>";
if (! empty($_POST["categorie_id"])) {
    $idCategorie = $_POST["categorie_id"];
    echo $idCategorie;
}

