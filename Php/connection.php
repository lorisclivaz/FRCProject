<?php
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

    $sql = "SELECT id, firstname, lastname FROM testtable";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table><tr><th>ID</th><th>Name</th></tr>";
        // output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<tr><td>".$row["id"]."</td><td>".$row["firstname"]." ".$row["lastname"]."</td></tr>";
        }
        echo "</table>";
    } else {
        echo "0 results";
    }
    $conn->close();
}
?>

<!-- Aviation -->
<?php

include "../vendor/autoload.php";

if (isset($_POST['enregistrement']))
{
    $nom = $_POST['lname'];
    $prenom = $_POST['fname'];
    $adresse = $_POST['adresse'];
    $codePostal = $_POST['codepostal'];
    $nameCompanie = $_POST['nameCompany'];
    $adresseCompagnie = $_POST['adresseCompany'];
    $codePostalCompagnie = $_POST['codePostalCompany'];
    $lieu = $_POST['lieu'];
    $dateAchat = $_POST['dateAchat'];
    $destination = $_POST['destination'];
    $chiffrePerte = $_POST['chiffrePerte'];
    $iban = $_POST['iban'];



    print "mon nom : $nom" ;
    print "mon prenom : $prenom";
    print "mon adresse : $adresse";
    print "mon code postal: $codePostal";
    print "mon nom de companie : $nameCompanie";
    print "mon adresse de companie : $adresseCompagnie";
    print "mon code postal de companie : $codePostalCompagnie";
    print "mon lieu  : $lieu";
    print "mon date achat: $dateAchat";
    print "mon destination: $destination";
    print "mon chiffre la perte: $chiffrePerte";
    print "mon IBAN: $iban";


    $templateProcessor = new PhpOffice\PhpWord\TemplateProcessor('../Template/Aviation.docx');

    $templateProcessor->setValue('nom', $nom);
    $templateProcessor->setValue('prenom', $prenom);
    $templateProcessor->setValue('rue', $adresse);
    $templateProcessor->setValue('codepostal', $codePostal);
    $templateProcessor->setValue('nomSociete', $nameCompanie);
    $templateProcessor->setValue('adresseSociete', $adresseCompagnie);
    $templateProcessor->setValue('codePostalSociete', $codePostalCompagnie);
    $templateProcessor->setValue('lieu', $lieu);
    $templateProcessor->setValue('dateAchat', $dateAchat);
    $templateProcessor->setValue('destination', $destination);
    $templateProcessor->setValue('chiffrePerte', $chiffrePerte);
    $templateProcessor->setValue('iban', $iban);

}


?>
