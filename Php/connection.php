<?php

$conn = null;

//Doing sql connection
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


function categorieListBO(){
    $conn = connection();
    $sql = "SELECT idcategories, categoriename FROM categories";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<option value=".$row["categoriename"].">".$row["categoriename"]."</option>";
        }
    } else {
        echo "<option>Aucune catégories</option>";
    }
    $conn->close();
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

function addCategorie($categoriename){
    $conn = connection();
    $sql = "INSERT INTO categories (categoriename) VALUES ('$categoriename')";
    if ($conn->query($sql) === TRUE) {
        return "la nouvelle catégorie a été ajoutée correctement";
    } else {
        return "Erreur: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
}

function modelListBO($idCategorie){
    $conn = connection();
    $sql = "SELECT * FROM models WHERE categories_idcategories = ".$idCategorie;
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<option value=".$row["name"].">".$row["name"]."</option>";
        }
    } else {
        echo "<option>Aucune models</option>";
    }
    $conn->close();
}

function modelList($idCategorie){

    $conn = connection();
    $sql = "SELECT * FROM models WHERE categories_idcategories = ".$idCategorie;
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        echo "<option> Selectionnez un champ</option>";
        while($row = $result->fetch_assoc()) {
            echo "<option value=".$row["idmodels"].">".$row["name"]."</option>";
        }
    } else {
        echo "<option>Aucun modèles</option>";
    }
    $conn->close();
}

function getCategorieIdByName($categorieName){
    $conn = connection();
    $sql = "SELECT idcategories FROM categories WHERE categoriename = '".$categorieName."'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row["idcategories"];
    } else {
        return null;
    }
}

function addModel($modelname, $categoriename){
    $conn = connection();
    $id = getCategorieIdByName($categoriename);
    $sql = "INSERT INTO models (name, categories_idcategories) VALUES ('$modelname', '$id')";

    if ($conn->query($sql) === TRUE) {
        echo "le nouveau modèle a été ajouté avec succès";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}

function addTemplate($templatename, $path, $categoriename){
    $conn = connection();
    $id = getCategorieIdByName($categoriename);
    $sql = "INSERT INTO template (name, path, categories_idcategories) VALUES ('$templatename', '$path', '$id')";

    if ($conn->query($sql) === TRUE) {
        echo "New Template uploaded successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
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

        echo "<select name='answers[]' onChange='get_next_question(this.value, this);'>";
        echo "<option value='Selectionnez un champ'>Selectionnez un champ</option>";
        // output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<option value=".$row["next_question"].">".$row["answer"]."</option>";
        }
        echo "</select><br><br>";
    } else {
        echo "0 results";
    }
    $conn->close();
}

function get_next_question_2($id)
{
    $conn = connection();
    $sql = "SELECT * FROM question WHERE question_number ='$id'";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $idQuestion = $row["idquestion"];
        echo "<p>".$row["question"]."</p>";
        $sqlAnswers = "SELECT * FROM answers WHERE question_idquestion ='$idQuestion'";
        $result = $conn->query($sqlAnswers);

        echo "<select name='answers[]' onChange='get_next_question(this.value, this);'>";
        echo "<option value='Selectionnez un champ'>Selectionnez un champ</option>";
        // output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<option value=".$row["next_question"].">".$row["answer"]."</option>";
        }
        echo "</select><br><br>";
    }
    else{
        echo "null";
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

function get_Paragraph_From_id($id){
    $conn = connection();
    $paragraph = "SELECT name FROM paragraphs WHERE number = '$id'";
    $result = $conn->query($paragraph);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo $row['name'];
    }
    $conn->close();
}

function getFieldFromCategorie($id){
    $conn = connection();
    $paragraph = "SELECT * FROM fields WHERE id_categorie = '$id'";
    $result = $conn->query($paragraph);

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<label>".$row["name"].":</label><br/>";

            echo "<input name=".$row["balise_name"]." type='text'/><br/>";
        }
    }

    $conn->close();
}

function getFieldFromParaNumber($number){
    $conn = connection();
    $paragraph = "SELECT f.name, f.balise_name FROM fields f, paragraphs p, paragraphs_fields pf WHERE p.idparagraphs = pf.fk_paragraph AND f.idfield = pf.fk_field AND p.number = '$number'";

    $result = $conn->query($paragraph);

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<label>".$row["name"].":</label><br/>";
            echo "<input name=".$row["balise_name"]." type='text'/><br/>";
        }
    }

    $conn->close();
}



