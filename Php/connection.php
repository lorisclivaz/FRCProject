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
            echo "<option value=".$row["name"].">".$row["name"]."</option>";
        }
        echo "</select>";
    } else {
        echo "<option>Aucun modèles</option>";
    }
    $conn->close();
}

function getAnswerandQuestionsFromModel($modelName){
    $conn = connection();
    $sqlQuestions = "SELECT question FROM question as q, models as m WHERE q.models_idmodels = m.idmodels AND m.name='$modelName'";
    $result = $conn->query($sqlQuestions);

    if ($result->num_rows > 0) {
        if($result->num_rows == 1){
            $row = $result->fetch_assoc();
            $question = $row["question"];
            echo "<p>".$question."</p>";
            $sqlAnswers = "SELECT answer FROM answers as a, question as q WHERE q.idquestion = a.question_idquestion and q.question='$question'";
            $result = $conn->query($sqlAnswers);

                echo "<select name='answers[]'>";
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    echo "<option value=".$row["answer"].">".$row["answer"]."</option>";
                }
                echo "</select><br>";

        }
        else{
            while($row = $result->fetch_assoc()) {
                $question = $row["question"];
                echo "<p>".$question."</p>";
                $sqlAnswers = "SELECT answer FROM answers as a, question as q WHERE q.idquestion = a.question_idquestion and q.question='$question'";
                $result = $conn->query($sqlAnswers);
                if($result->num_rows > 0){
                    echo "<select name='answers[]'>";
                    // output data of each row
                    while($row = $result->fetch_assoc()) {
                        echo "<option vlaue=".$row["answer"].">".$row["answer"]."</option>";
                    }
                    echo "</select><br>";
                }
            }
        }
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
        echo "<p>".$row['path']."</p>";
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

    if (isset($_POST['enregistrement'])) {
        $nom = $_POST['lname'];
        $prenom = $_POST['fname'];
        $adresse = $_POST['adresse'];
        $codePostal = $_POST['codepostal'];
        $nrAssure = $_POST['nrAssure'];
        $nameCompanie = $_POST['nameCompany'];
        $adresseCompagnie = $_POST['adresseCompany'];
        $codePostalCompagnie = $_POST['codePostalCompany'];
        $lieu = $_POST['lieu'];


        print "mon nom : $nom";
        print "mon prenom : $prenom";
        print "mon adresse : $adresse";
        print "mon code postal: $codePostal";
        print "mon nrAssure : $nrAssure";
        print "mon nom de companie : $nameCompanie";
        print "mon adresse de companie : $adresseCompagnie";
        print "mon code postal de companie : $codePostalCompagnie";
        print "mon lieu  : $lieu";

        //salutations


        $templateProcessor = new PhpOffice\PhpWord\TemplateProcessor('../Template/Aviation.docx');

        $templateProcessor->setValue('nom', $nom);
        $templateProcessor->setValue('prenom', $prenom);
        $templateProcessor->setValue('rue', $adresse);
        $templateProcessor->setValue('codepostal', $codePostal);
        $templateProcessor->setValue('nAssure', $nrAssure);
        $templateProcessor->setValue('nomSociete', $nameCompanie);
        $templateProcessor->setValue('adresseSociete', $adresseCompagnie);
        $templateProcessor->setValue('codePostalSociete', $codePostalCompagnie);
        $templateProcessor->setValue('lieu', $lieu);
        $templateProcessor->saveAs('Aviation-Copie.docx');
    }
}
