<?php
//Doing sql connection
function connection()
{
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


function categorieListBO()
{
    $conn = connection();
    $sql = "SELECT idcategories, categoriename FROM categories";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            echo "<option value=" . $row["categoriename"] . ">" . $row["categoriename"] . "</option>";
        }
    } else {
        echo "<option>Aucune catégories</option>";
    }
    $conn->close();
}

function questionListBO($idModel)
{
    $conn = connection();
    $sql = "SELECT * FROM question WHERE models_idmodels = " . $idModel;
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            echo "<option value='0'>Sélectionez une question</option>";
            echo "<option value=" . $row["idquestion"] . ">" . $row["question"] . "</option>";
        }
    } else {
        echo "<option>Aucune questions</option>";
    }
    $conn->close();
}

function categorieList()
{
    $conn = connection();
    $sql = "SELECT idcategories, categoriename FROM categories";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            echo "<option value=" . $row["idcategories"] . ">" . $row["categoriename"] . "</option>";
        }
    } else {
        echo "<option>Aucune catégories</option>";
    }
    $conn->close();
}

function addCategorie($categoriename)
{
    $conn = connection();
    $sql = "INSERT INTO categories (categoriename) VALUES ('$categoriename')";
    if ($conn->query($sql) === TRUE) {
        return "la nouvelle catégorie a été ajoutée correctement";
    } else {
        return "Erreur: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
}

function modelListBO($idCategorie)
{
    $conn = connection();
    $sql = "SELECT * FROM models WHERE categories_idcategories = " . $idCategorie;
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        echo "<option value='0'>Sélectionez un modèl</option>";
        while ($row = $result->fetch_assoc()) {
            echo "<option value=" . $row["name"] . ">" . $row["name"] . "</option>";
        }
    } else {
        echo "<option value='0'>Aucune models</option>";
    }
    $conn->close();
}

function modelList2($idCategorie)
{
    $conn = connection();
    $sql = "SELECT * FROM models WHERE categories_idcategories = " . $idCategorie;
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            echo "<option value=" . $row["idmodels"] . ">" . $row["name"] . "</option>";
        }
    } else {
        echo "<option>Aucune models</option>";
    }
    $conn->close();
}

function fieldList()
{
    $conn = connection();
    $sql = "SELECT * FROM fields";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            echo "<option value=" . $row["idfield"] . ">" . $row["balise_name"] . "</option>";
        }
    } else {
        echo "<option>Aucune models</option>";
    }
    $conn->close();
}

function modelList($idCategorie)
{

    $conn = connection();
    $sql = "SELECT * FROM models WHERE categories_idcategories = " . $idCategorie;
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        echo "<option> Selectionnez un champ</option>";
        while ($row = $result->fetch_assoc()) {
            echo "<option value=" . $row["idmodels"] . ">" . $row["name"] . "</option>";
        }
    } else {
        echo "<option>Aucun modèles</option>";
    }
    $conn->close();
}

function answerList()
{

    $conn = connection();
    $sql = "SELECT * FROM answers WHERE next_question='x'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        echo "<option value=' ' disabled selected>Selectionnez une réponse</option>";
        while ($row = $result->fetch_assoc()) {
            echo "<option value=" . $row["idanswer"] . ">" . $row["answer"] . "</option>";
        }
    } else {
        echo "<option>Aucun réponse</option>";
    }
    $conn->close();
}

function getCategorieIdByName($categorieName)
{
    $conn = connection();
    $sql = "SELECT idcategories FROM categories WHERE categoriename = '" . $categorieName . "'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row["idcategories"];
    } else {
        return null;
    }
}

function addModel($modelname, $categoriename)
{
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

function getModelIdByName($modelName)
{
    $conn = connection();
    $sql = "SELECT idmodels FROM models WHERE name = '" . $modelName . "'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row["idmodels"];
    } else {
        return null;
    }
}

function addTemplate($templatename, $path, $categoriename)
{
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

function getQuestionIdByName($question)
{
    $conn = connection();
    $sql = "SELECT idquestion FROM question WHERE question = '" . $question . "'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row["idquestion"];
    } else {
        return null;
    }
}

//Add a new Question
function addQuestion($question, $modelname, $prio, $text)
{
    $conn = connection();
    $id = getModelIdByName($modelname);
    if ($prio == "2") {
        $sql = "INSERT INTO question (question, models_idmodels, Priority) VALUES ('$question', '$id', '1')";
    } else {
        $sql = "INSERT INTO question (question, models_idmodels) VALUES ('$question', '$id')";
    }

    if ($conn->query($sql) === TRUE) {
        $questionid = getQuestionIdByName($question);
        $sql = "UPDATE question SET question_number= '$questionid' WHERE idquestion= '$questionid'";
        if ($conn->query($sql) === TRUE) {
            if (empty($text)) {
                echo "<p>New Question added successfully</p>";
            } else {
                $sql = "INSERT INTO explanations (text) VALUES ('$text')";
                if ($conn->query($sql) === TRUE) {
                    $explanationsid = getExplanationIdByName($text);
                    updateQuestionIdInfo($questionid, $explanationsid);
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}

function getExplanationIdByName($text){
    $conn = connection();
    $sql = "SELECT idexplanations FROM explanations WHERE text = '" . $text . "'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row["idexplanations"];
    } else {
        return null;
    }
}

function updateQuestionIdInfo($questionid, $explanationid){
    $conn = connection();
    $sql = "UPDATE question SET id_info= '$explanationid' WHERE idquestion= '$questionid'";
    if ($conn->query($sql) === TRUE) {
        return "<p>New Question added successfully</p>";
    }
    else{
        return "<p> ERROR</p>";
    }
}

//Add a new Question
function addAnswer($answer, $next, $qustionid)
{
    $conn = connection();
    if ($next == "0") {
        $sql = "INSERT INTO answers (answer, next_question, question_idquestion) VALUES ('$answer', 'x', '$qustionid')";
    } else {
        $sql = "INSERT INTO answers (answer, next_question, question_idquestion) VALUES ('$answer', '$next', '$qustionid')";
    }

    if ($conn->query($sql) === TRUE) {
        echo "<p>New Answer added successfully</p>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}

function getTemplateIdByCategorie($catid)
{
    $conn = connection();
    $sql = "SELECT idtemplate FROM template WHERE categories_idcategories = '" . $catid . "'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row["idtemplate"];
    } else {
        return null;
    }
}

function UpdateAnswerNextQuestion($answerid, $nextQuestion)
{
    $conn = connection();
    $sql = "UPDATE answers SET next_question= '$nextQuestion' WHERE idanswer= '$answerid'";

    if ($conn->query($sql) === TRUE) {
        return true;
    } else {
        return false;
    }

    $conn->close();
}

function checkEveryFieldExist($data)
{
    echo "alert('TEST')";
    $conn = connection();
    $idfield = [];
    $counter = 0;
    foreach ($data as $field) {
        $sql = "SELECT idfield FROM fields WHERE balise_name = '" . $field . "'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $idfield[$counter] = $row["idfield"];
            $counter++;
        } else {
            $idfield = null;
            return;
        }
    }
    return $idfield;
}

function getParagraphIdByNumber($number)
{
    $conn = connection();
    $sql = "SELECT idparagraphs FROM paragraphs WHERE number = '" . $number . "'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row["idparagraphs"];
    } else {
        return null;
    }
}

function getQuestionIdFromAnswerId($answerid){
    $conn = connection();
    $sql = "SELECT question_idquestion FROM answers WHERE idanswer = '" . $answerid . "'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row["question_idquestion"];
    } else {
        return null;
    }
}

function getInfodFromQuestionId($questionid){
    $conn = connection();
    $sql = "SELECT id_info FROM question WHERE idquestion = '" . $questionid . "'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row["id_info"];
    } else {
        return null;
    }
}

function updateParagraphInfoId($answerid, $idpara){
    $questionid = getQuestionIdFromAnswerId($answerid);
    $infoid = getInfodFromQuestionId($questionid);
    $conn = connection();
    $sql = "UPDATE paragraphs SET id_info= '$infoid' WHERE idparagraphs= '$idpara'";
    if ($conn->query($sql) === TRUE) {
        return true;
    }
    else{
        return false;
    }
}

//Add new Paragraph
function addParagraph($catid, $answer, $paragraph, $number, $data)
{
    $conn = connection();
    $tempid = getTemplateIdByCategorie($catid);

    if (empty($data)) {
        if (UpdateAnswerNextQuestion($answer, $number)) {
            $sql = "INSERT INTO paragraphs (name, number, template_idtemplate) VALUES ('$paragraph', '$number', '$tempid')";
            if ($conn->query($sql) === TRUE) {
                $paraid = getParagraphIdByNumber($number);
                if(updateParagraphInfoId($answer, $paraid)){
                    echo "<p>le nouveau paragraph a été ajouté avec succès</p>";
                }
                else{
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
            $conn->close();
        }
    } else {
        $fieldsId = checkEveryFieldExist($data);
        if ($fieldsId) {
            if (UpdateAnswerNextQuestion($answer, $number)) {
                $sql = "INSERT INTO paragraphs (name, number, template_idtemplate) VALUES ('$paragraph', '$number', '$tempid')";
                if ($conn->query($sql) === TRUE) {
                    $paraid = getParagraphIdByNumber($number);
                    updateParagraphInfoId($answer, $paraid);
                    foreach ($fieldsId as $id) {
                        $sql = "INSERT INTO paragraphs_fields (fk_field, fk_paragraph) VALUES ('$id', '$paraid')";
                        if ($conn->query($sql) === TRUE) {
                            echo "<p>le nouveau paragraph a été ajouté avec succès</p>";
                        } else {
                            echo "Error";
                        }
                    }
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
                $conn->close();
            }
        } else {
            echo "<p>All fields dosent exist please add firstly the field of the paragraphs</p>";
        }
    }
}

//Add a new Field
function addField($fieldname, $idcategorie, $bname)
{
    $conn = connection();
    if ($idcategorie == "0") {
        $sql = "INSERT INTO fields (name, balise_name) VALUES ('$fieldname', '$bname')";
    } else {
        $sql = "INSERT INTO fields (name, id_categorie, balise_name) VALUES ('$fieldname', '$idcategorie', '$bname')";
    }

    if ($conn->query($sql) === TRUE) {
        echo "<p>New Field added successfully</p>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}

function getFirstAnswerAndQuestion($idModel)
{
    $conn = connection();
    $sqlQuestions = "SELECT * FROM question WHERE models_idmodels ='$idModel' AND priority = 1";
    $result = $conn->query($sqlQuestions);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $idQuestion = $row["idquestion"];
        echo "<span>" . $row["question"] . " </span>";
        getInfosQuestions($row["id_info"]);
        $sqlAnswers = "SELECT * FROM answers WHERE question_idquestion ='$idQuestion' AND next_question > 0";
        $result = $conn->query($sqlAnswers);

        echo "<select name='answers[]' onChange='get_next_question(this.value, this);'>";
        echo "<option value='Selectionnez un champ'>Selectionnez un champ</option>";
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            echo "<option value=" . $row["next_question"] . ">" . $row["answer"] . "</option>";
        }
        echo "</select><br><br>";
    } else {
        echo "0 results";
    }
    $conn->close();
}

function getInfosQuestions($idexplanation)
{
    $conn = connection();
    $sqlQuestions = "SELECT * FROM explanations WHERE idexplanations ='$idexplanation'";
    $result = $conn->query($sqlQuestions);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $title = $row["text"];
        echo "<img src='../images/info.png' width='15px' title=" . "'$title'" . " onmouseover='showInfos(this);'><br/>";
    } else
        echo "<br/>";
}

function get_next_question_db($id)
{
    $conn = connection();
    $sql = "SELECT * FROM question WHERE question_number ='$id'";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $idQuestion = $row["idquestion"];
        echo "<span>" . $row["question"] . " </span>";
        getInfosQuestions($row["id_info"]);
        $sqlAnswers = "SELECT * FROM answers WHERE question_idquestion ='$idQuestion'";
        $result = $conn->query($sqlAnswers);
        echo "<select name='answers[]' onChange='get_next_question(this.value, this);'>";
        echo "<option value='Selectionnez un champ'>Selectionnez un champ</option>";
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            echo "<option value=" . $row["next_question"] . ">" . $row["answer"] . "</option>";
        }
        echo "</select><br><br>";
    } else {
        echo "null";
    }

    $conn->close();
}

function getTemplatePathFromCategorie($categorieName)
{

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

function get_Paragraph_From_id($id)
{
    $conn = connection();
    $paragraph = "SELECT * FROM paragraphs WHERE number = '$id'";
    $result = $conn->query($paragraph);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo "<label>Paragraphe qui remplacera la variable
                    $[paragraphe_conditionel] </label>";
        getInfosQuestions($row['id_info']);
        echo "<textarea name='paragraph_conditionnel' id='paragrapheLolo' type='text' rows='18' cols='60'>" . $row['name'] . "</textarea>";

    }
    $conn->close();
}

function getFieldFromCategorie($id)
{
    $conn = connection();
    $paragraph = "SELECT * FROM fields WHERE id_categorie = '$id'";
    $result = $conn->query($paragraph);

    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            echo "<label>" . $row["name"] . ":</label><br/>";
            echo "<input name=" . $row["balise_name"] . " type='text'/><br/>";
        }
    }

    $conn->close();
}

function getFieldFromParaNumber($number)
{
    $conn = connection();
    $paragraph = "SELECT f.name, f.balise_name FROM fields f, paragraphs p, paragraphs_fields pf WHERE p.idparagraphs = pf.fk_paragraph AND f.idfield = pf.fk_field AND p.number = '$number'";

    $result = $conn->query($paragraph);

    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            echo "<label>" . $row["name"] . ":</label><br/>";
            echo "<input name=" . $row["balise_name"] . " type='text'/><br/>";
        }
    }

    $conn->close();
}



