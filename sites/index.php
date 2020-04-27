<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" type="text/css" href="../css/style.css" media="screen"/>
    <title>Lettres modèles</title>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" type="text/javascript"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <script>

        function getCat(val) {
            $.ajax({
                type: "POST",
                url: "getInfosFromUser.php",
                data: 'categorie_id=' + val,
                success: function (data) {
                    $("#models").html(data);
                }
            });
            getFieldsFromCat(val);

            let preview = document.getElementById("apercu");
            preview.style.visibility = "visible";
        }

        function get_question(val) {
            $.ajax({
                type: 'POST',
                url: 'getInfosFromUser.php',
                data: 'model_id=' + val,
                success: function (data) {

                    $("#firstQuestion").html(data);

                    let test = document.getElementById("models").options[document.getElementById('models').selectedIndex].text;

                    document.getElementById("problematique").value = test;
                }
            });
        }

        function get_next_question(val, obj) {
            deleteSibling(obj);
            if (document.getElementById("cache").style.display === "block")
                document.getElementById("cache").style.display = "none"
            $.ajax({
                type: 'POST',
                url: 'getInfosFromUser.php',
                data: 'next_question=' + val,
                success: function (data) {
                    if (data === "null") {
                        document.getElementById("cache").style.display = 'block';
                        getParagraph(val);
                        getFieldsFromParagraph(val);
                    } else {
                        let elem = document.createElement('div');
                        elem.innerHTML = data;
                        document.getElementsByName('formular')[0].appendChild(elem);
                    }
                }
            });
        }

        //salut
        function getParagraph(val) {
            $.ajax({
                type: 'POST',
                url: 'getInfosFromUser.php',
                data: 'paragraph_number=' + val,
                success: function (data) {
                    $("#paragraph").html(data);
                }
            });
        }

        function getInputValueforParagraph() {

            let para;

            para = document.getElementById("paragrapheLolo").value;


            // Selecting the input element and get its value
            if (document.getElementsByName("date_vol").length == 1) {
                let date_vol = document.getElementsByName("date_vol")[0].value;
                para = para.replace("$[date_vol]", date_vol);
            }

            if (document.getElementsByName("nbr_heures_retard").length == 1) {
                let nbr_heures_retard = document.getElementsByName("nbr_heures_retard")[0].value;
                para = para.replace("$[nbr_heures_retard]", nbr_heures_retard);
            }

            if (document.getElementsByName("montant").length == 1) {
                let montant = document.getElementsByName("montant")[0].value;
                para = para.replace("$[montant]", montant);
            }

            document.getElementById("paragrapheLolo").value = para;


        }

        function getFieldsFromCat(val) {
            $.ajax({
                type: "POST",
                url: "getInfosFromUser.php",
                data: 'categorie_field=' + val,
                success: function (data) {

                    $("#cat_fields").html(data);
                }
            });
        }

        function getFieldsFromParagraph(val) {
            $.ajax({
                type: "POST",
                url: "getInfosFromUser.php",
                data: 'paragraphe_number=' + val,
                success: function (data) {
                    $("#para_fields").html(data);
                }
            });
        }

        function deleteSibling(obj) {
            let dd = obj.parentNode;
            var ns;
            while (ns = dd.nextSibling)
                dd.nextSibling.remove();
        }

        function showInfos(obj) {
            obj.tooltip();
        }
    </script>
</head>
<body>
<header>
    <img src="../images/logo.png" alt="logo">
</header>
<main>
    <div id="splitScreen">
        <h1>Lettres modèles</h1><a href="backoffice.php">Back Office</a>
        <br/>
        <br/>
        <form method="post" name="formular">
            <label>Sélectionnez une catégorie</label>
            <br/>
            <select id="categories" onchange="getCat(this.value);">
                <option value=" ">Sélectionnez une catégorie</option>
                <?php include "../db/connection.php";
                categorieList();
                ?>
            </select>
            <br/><br/>
            <label>Sélectionnez un modèle</label>
            <br/>
            <select id="models" onchange="get_question(this.value);">
                <option value="">Sélectionnez un modèle</option>
            </select>
            <br/><br/>
            <div id="firstQuestion">
            </div>
    </div>
    <div id="apercu" style="visibility: hidden">
        <h1>Aperçu de votre lettre</h1>
        <br/>
        <iframe id="iframeApercu" src="../Apercu/AviationApercu.htm" frameborder='0'></iframe>
    </div>
    </form>
    <div id="cache" onload="cache(this)" style="display: none">
        <form id="ClientForm" enctype="multipart/form-data" method="post" style="margin-bottom: 50px">
            <h1>Formulaire</h1><br/>
            <br/>
            <div id="infoClient">
                <h2>Informations personnelles</h2>
                <br/>
                <input required class="formFields" name="nom" type="text" placeholder="Nom"/>
                <input required class="formFields" name="prenom" type="text" placeholder="Prénom"/>
                <br/><br/>
                <input required class="formFields" name="rue" type="text" placeholder="Rue"/>
                <input required class="formFields" name="n°_rue" type="text" placeholder="N°"/>
                <br/><br/>
                <input required class="formFields" id="cp" name="lieu_codepostal" type="text"
                       placeholder="Lieu & Code Postal"/>
            </div>
            <div id="infoSoc">
                <h2>Informations de la société</h2>
                <br/>
                <input required class="formFields" name="nom_societe" type="text" placeholder="Nom de la société"/>
                <br/><br/>
                <input required class="formFields" name="adresse_societe_n°" type="text"
                       placeholder="Adresse & n° de la société"/>
                <br/><br/>
                <input required class="formFields" name="lieu_codepostal_societe" type="text"
                       placeholder="Lieu & Code Postal de la société"/>
                <br/><br/>
                <input required class="formFields" name="lieu_envoie" type="text"
                       placeholder="Lieu d'envoi de la lettre"/>
                <br/><br/>
            </div>
            <div id="infoSup">
                <h2>Informations complémentaires</h2>
                <br/>
                <div id="cat_fields"></div>
                <div id="para_fields"></div>
            </div>
            <br/>
            <div id="paragraph"></div>
            <br/>
            <button name="Enregistrement" type="submit" onclick="getInputValueforParagraph()">Créer la lettre
            </button>
            <input id="problematique" name="problematique" type="text" style="display: none"/>
        </form>
    </div>
</main>
<div class="footer">© 2020 by FRC-Lausanne</div>
</footer>
</body>
</html>

<?php
require_once '../vendor/autoload.php';

use PhpOffice\PhpWord\TemplateProcessor;

include "../vendor/autoload.php";

//Récupération des valaeurs pour le changement du template
if (isset($_POST['Enregistrement'])) {

    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $rue = $_POST['rue'];
    $n_rue = $_POST['n°_rue'];
    $lieu_codepostal = $_POST['lieu_codepostal'];
    $nom_societe = $_POST['nom_societe'];
    $adresse_societe_n = $_POST['adresse_societe_n°'];
    $lieu_codepostal_societe = $_POST['lieu_codepostal_societe'];
    $lieu_envoie = $_POST['lieu_envoie'];
    $paragraph = $_POST['paragraph_conditionnel'];
    $problematique = $_POST['problematique'];
    $no_vol = $_POST["no_vol"];
    $date_achat = $_POST["date_achat"];
    $ville_destination = $_POST["ville_destination"];
    $coor_banque = $_POST["coor_banque"];
    $perte = $_POST["perte"];

    //récupération du path mais faire ca dynamiquement
    $templateProcessor = new TemplateProcessor(getTemplatePathFromCategorie('Aviation'));

    //Set des valeurs dans le template champs de base
    $templateProcessor->setValue('nom', $nom);
    $templateProcessor->setValue('prenom', $prenom);
    $templateProcessor->setValue('rue', $rue);
    $templateProcessor->setValue('numero', $n_rue);
    $templateProcessor->setValue('codepostal', $lieu_codepostal);

    $templateProcessor->setValue('nomSociete', $nom_societe);
    $templateProcessor->setValue('adresseSociete', $adresse_societe_n);
    $templateProcessor->setValue('codePostalSociete', $lieu_codepostal_societe);
    $templateProcessor->setValue('lieu', $lieu_envoie);

    $templateProcessor->setValue('paragraphe_conditionnel', $paragraph);
    $templateProcessor->setValue('problematique', $problematique);

    //Valeur selon la categorie
    $templateProcessor->setValue('no_vol', $no_vol);
    $templateProcessor->setValue('date_achat', $date_achat);
    $templateProcessor->setValue('ville_destination', $ville_destination);
    $templateProcessor->setValue('perte', $perte);
    $templateProcessor->setValue('coor_banque', $coor_banque);

    $templateProcessor->saveAs('../final_template/Template.docx');

    echo "<script type='text/javascript'>document.location.replace('download.php');</script>";

    return false;

}
?>











