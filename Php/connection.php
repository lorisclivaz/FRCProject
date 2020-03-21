<?php

$conn = null;

function connection(){
    $servername = "krmg.myd.infomaniak.com";
    $username = "krmg_lm2020";
    $password = "JOkFkZdgk3cE";
    $dbname = "krmg_lm2020bd";

// Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
}

function categorieList(){
    $conn = connection();
    $sql = "SELECT idcategories, categoriename FROM categories";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<option value=".$row["idcategories"].">".$row["categoriename"]."</option>";
        }
    } else {
        echo "<option>Aucune catégories</option>";
    }
    $conn->close();
}

function modelList($idCategorie){

    $conn = connection();
    $sql = "SELECT * FROM models WHERE categories_idcategories = ".$idCategorie;
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<option value=".$row["idmodels"].">".$row["name"]."</option>";
        }
        echo "</select>";
    } else {
        echo "<option>Aucun modèles</option>";
    }
    $conn->close();
}

function getFirstAnswerAndQuestion($idModel){

    $conn = connection();
    $sqlQuestions = "SELECT * FROM question WHERE models_idmodels ='$idModel' AND priority = 1";
    $result = $conn->query($sqlQuestions);

    if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $idQuestion = $row["idquestion"];
            echo "<p>".$row["question"]."</p>";
            $sqlAnswers = "SELECT * FROM answers WHERE question_idquestion ='$idQuestion' AND next_question > 0";
            $result = $conn->query($sqlAnswers);

                echo "<select name='answers[]' onChange='get_next_question(this.value);'>";
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    echo "<option value=".$row["next_question"].">".$row["answer"]."</option>";
                }
                echo "</select><br>";
    } else {
        echo "0 results";
    }
    $conn->close();
}

function getTemplatePathFromCategorie($categorieName){

    $conn = connection();
    $sql = "SELECT path FROM template as t, categories as c WHERE t.categories_idcategories = c.idcategories AND c.categoriename = '$categorieName'";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['path'];
    } else {
        echo "0 results";
    }

    $conn->close();
}

function getParagraphFromAnswer($answerName){
    $conn = connection();
    $number = "SELECT number FROM answers WHERE answer = '$answerName'";
    $result = $conn->query($number);

    $rowNumber = $result->fetch_assoc();
    $num = $rowNumber['number'];

    $paragraph = "SELECT name FROM paragraphs WHERE number = '$num'";
    $result = $conn->query($paragraph);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo "<p>".$row['name']."</p>";
    } else {
        echo "0 results";
    }
    $conn->close();
}

function aviation()
{
    include "../vendor/autoload.php";
    include "index.php";


    //Récupération des valaeurs pour le changement du template

    if (isset($_POST['enregistrement'])) {
        $nom = $_POST['lname'];
        $prenom = $_POST['fname'];
        $rue_n° = $_POST['rue_n°'];
        $domicile_codePostal = $_POST['domicile_codepostal'];

        $nom_societe = $_POST['nom_societe'];
        $rue_n°_societe = $_POST['rue_n°_societe'];
        $domicile_codePostal_societe = $_POST['domicile_codePostal_societe'];
        $lieu_envoie = $_POST['lieu_envoie'];



        //récupération
        $templateProcessor = new PhpOffice\PhpWord\TemplateProcessor(getTemplatePathFromCategorie('Aviation'));

        //Set des valeurs dans le template champs de base
        $templateProcessor->setValue('nom', $nom);
        $templateProcessor->setValue('prenom', $prenom);
        $templateProcessor->setValue('rue', $rue_n°);
        $templateProcessor->setValue('codepostal', $domicile_codePostal);

        $templateProcessor->setValue('nomSociete', $nom_societe);
        $templateProcessor->setValue('adresseSociete', $rue_n°_societe);
        $templateProcessor->setValue('codePostalSociete',  $domicile_codePostal_societe);
        $templateProcessor->setValue('lieu', $lieu_envoie);

        $templateProcessor->saveAs('Aviation-Copie.docx');
    }
}
