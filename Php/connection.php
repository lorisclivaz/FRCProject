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
        echo "<select name='categorie[]'>";
        // output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<option vlaue=".$row[categoriename].">".$row["categoriename"]."</option>";
        }
        echo "</select>";
    } else {
        echo "0 results";
    }
    $conn->close();
}

function modelList(){
    $conn = connection();
    $sql = "SELECT modelname FROM models";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<select name='models[]'>";
        // output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<option vlaue=".$row[modelname].">".$row["modelname"]."</option>";
        }
        echo "</select>";
    } else {
        echo "0 results";
    }
    $conn->close();
}

?>

<!-- Aviation -->
<?php
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

    }
}
?>
