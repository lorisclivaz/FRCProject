<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="../css/style.css" media="screen" />
    <title>Lettres modèles</title>
    <style>
        button
        {
            background-color: #e4032e;
            border: none;
            color: white;
            padding: 16px 32px;
            text-decoration: none;
            margin: 4px 2px;
            cursor: pointer;
        }
    </style>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" type="text/javascript"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        let para;
        function getCat(val) {
            $.ajax({
                type: "POST",
                url: "getInfosFromUser.php",
                data:'categorie_id='+val,
                success: function(data){
                    $("#models").html(data);
                }
            });
            getFieldsFromCat(val);
        }
        function get_question(val){
            $.ajax({
                type: 'POST',
                url: 'getInfosFromUser.php',
                data: 'model_id='+val,
                success: function (data) {

                    $("#firstQuestion").html(data);

                  let test =  document.getElementById("models").options[document.getElementById('models').selectedIndex].text;

                  document.getElementById("problematique").value=test;
                }
            });
        }
        function get_next_question(val, obj) {
            deleteSibling(obj);
            if(document.getElementById("cache").style.display === "block")
                document.getElementById("cache").style.display = "none"
            $.ajax({
                type: 'POST',
                url: 'getInfosFromUser.php',
                data: 'next_question=' + val,
                success: function (data) {
                    if (data === "null")
                    {
                        document.getElementById("cache").style.display='block';
                        getParagraph(val);
                        getFieldsFromParagraph(val);
                    }
                    else
                    {
                        let elem = document.createElement('div');
                        elem.innerHTML = data;
                        document.getElementsByName('formular')[0].appendChild(elem);
                    }
                }
            });
        }
        function getParagraph(val) {
            $.ajax({
                type: 'POST',
                url: 'getInfosFromUser.php',
                data: 'paragraph_number=' + val,
                success: function (data) {
                    para=data;

                    console.log(para);
                }
            });
        }
        function getInputValueforParagraph(){

            // Selecting the input element and get its value


            if (document.getElementsByName("date_vol").length == 1)
            {
                alert("salut");
                let date_vol = document.getElementsByName("date_vol").value.text;

                para = para.replace("$[date_vol]",date_vol);

            }

            if (document.getElementsByName("nbr_heures_retard").length == 1)
            {
                let nbr_heures_retard = document.getElementsByName("nbr_heures_retard").value;
                para = para.replace("$[nbr_heures_retard]",nbr_heures_retard);

            }

            if (document.getElementsByName("montant").length == 1)
            {

                let montant = document.getElementsByName("montant").value;
                para = para.replace("$[montant]",montant);

            }

            document.getElementById("paragraph").value=para;
        }
        function getFieldsFromCat(val){
            $.ajax({
                type: "POST",
                url: "getInfosFromUser.php",
                data:'categorie_field='+val,
                success: function(data){

                    $("#cat_fields").html(data);
                }
            });
        }
        function getFieldsFromParagraph(val){
            $.ajax({
                type: "POST",
                url: "getInfosFromUser.php",
                data:'paragraphe_number='+val,
                success: function(data){
                    $("#para_fields").html(data);
                }
            });
        }
        function deleteSibling(obj){
            let dd = obj.parentNode;
            var ns;
            while(ns = dd.nextSibling)
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
        <h1>Lettres modèles</h1><a href="backoffice.php">Back Office</a>

        <br/>
        <form method="post" name="formular">
            <label>Sélectionnez une catégorie</label>
            <br/>
            <select id="categories" onchange="getCat(this.value);"><option value=" ">Sélectionnez une catégorie</option>
            <?php include "connection.php";
            categorieList();
            ?>
            </select>
            <br/><br/>
            <label>Sélectionnez un modèle</label>
            <br/>
            <select  id="models" onchange="get_question(this.value);" ><option value="">Sélectionnez un modèle</option>
            </select>
            <br/><br/>
            <div id="firstQuestion"></div>
        </form>
        <div id="cache" onload="cache(this)" style="display: none">
            <form enctype="multipart/form-data"  method="post">
                <br>
                <label>Entrez votre nom:</label>
                <br>
                <input name="nom" type="text"/>
                <br>
                <label>Entrez votre prénom:</label>
                <br>
                <input name="prenom" type="text"/>
                <br>
                <label>Entrez votre rue:</label>
                <br>
                <input name="rue" type="text"/>
                <br>
                <label>Entrez votre n° de rue:</label>
                <br>
                <input name="n°_rue" type="text"/>
                <br>
                <label>Entrez le lieu et le code postal:</label>
                <br>
                <input name="lieu_codepostal" type="text"/>
                <br>
                <label>Entrez le nom de la société:</label>
                <br>
                <input name="nom_societe" type="text"/>
                <br>
                <label>Entrez l'adresse et le n° de la société:</label>
                <br>
                <input name="adresse_societe_n°" type="text"/>
                <br>
                <label>Entrez le lieu et le code postal de la société:</label>
                <br>
                <input name="lieu_codepostal_societe" type="text"/>
                <br>
                <label>Entrez le lieu d'envoie de la lettre:</label>
                <br>
                <input name="lieu_envoie" type="text"/>
                <br>
                <div id="cat_fields"></div>
                <div id="para_fields"></div>
                <button name="Enregistrement" type="submit" onclick="getInputValueforParagraph()">Créer la lettre</button>
                <input id="problematique" name="problematique" type="text" style="display: none"/>
                <textarea id="paragraph" name="paragraphe_conditionnel" type="text"  rows="25" cols="30" style="display: none"></textarea>
            </form>
        </div>
    </main>
        <p>© 2020 by FRC-Lausanne</p>
    </footer>
</body>
</html>

<?php

include "../vendor/autoload.php";

//Récupération des valaeurs pour le changement du template
if (isset($_POST['Enregistrement'])) {

    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $rue = $_POST['rue'];
    $n_rue=$_POST['n°_rue'];
    $lieu_codepostal = $_POST['lieu_codepostal'];
    $nom_societe = $_POST['nom_societe'];
    $adresse_societe_n = $_POST['adresse_societe_n°'];
    $lieu_codepostal_societe = $_POST['lieu_codepostal_societe'];
    $lieu_envoie = $_POST['lieu_envoie'];
    $paragraph = $_POST['paragraphe_conditionnel'];
    $problematique = $_POST['problematique'];
    $no_vol= $_POST["no_vol"];
    $date_achat=$_POST["date_achat"];
   $ville_destination=$_POST["ville_destination"];

    $coor_banque=$_POST["coor_banque"];

    $perte=$_POST["perte"];





    //récupération du path mais faire ca dynamiquement
    $templateProcessor = new PhpOffice\PhpWord\TemplateProcessor(getTemplatePathFromCategorie('Aviation'));

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

    $templateProcessor->saveAs('../final_template/template.docx');


    echo "<script type='text/javascript'>document.location.replace('download.php');</script>";

    return false;
}
?>











