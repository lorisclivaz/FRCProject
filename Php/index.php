<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="../css/style.css" media="screen" />
    <title>Lettres modèles</title>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" type="text/javascript"></script>
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
    <script>
        function getCat(val) {
            $.ajax({
                type: "POST",
                url: "getInfosFromUser.php",
                data:'categorie_id='+val,
                success: function(data){
                    $("#models").html(data);
                }
            });
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

                    let elem = document.createElement('div');
                    elem.innerHTML = data;
                    if (elem.innerText.length < 200)
                    {
                        document.getElementsByName('formular')[0].appendChild(elem);
                        console.log(elem.innerText.length);
                    }
                    if (elem.innerText.length > 200)
                    {
                        let paragraph = elem.innerText;
                        //a voir selon les différents cas, pas vraiment optimisé (david et loris)
                        document.getElementById("cache").style.display='block';
                        console.log(paragraph);
                        let paragraphFinal = paragraph.replace("$[date_vol]","19.19.2020");
                        console.log(paragraphFinal);
                        document.getElementById("paragraph").value=paragraphFinal;
                    }

                }
            });
        }
        function deleteSibling(obj){

            let dd = obj.parentNode;
            var ns;

            while(ns = dd.nextSibling)
                dd.nextSibling.remove();
        }

        // Function to download data to a file
        function download(data, filename, type) {
            var file = new Blob([data], {type: type});
            if (window.navigator.msSaveOrOpenBlob) // IE10+
                window.navigator.msSaveOrOpenBlob(file, filename);
            else { // Others
                var a = document.createElement("a"),
                    url = URL.createObjectURL(file);
                a.href = url;
                a.download = filename;
                document.body.appendChild(a);
                a.click();
                setTimeout(function() {
                    document.body.removeChild(a);
                    window.URL.revokeObjectURL(url);
                }, 0);
            }
        }



    </script>
</head>
<body>
    <header>
        <img src="../images/logo.png" alt="logo">
    </header>
    <main>
        <h1>Lettres modèles</h1>

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
                <textarea id="paragraph" name="paragraphe_conditionnel" type="text"  rows="25" cols="30" style="display: none"></textarea>
                <br>
                <input id="problematique" name="problematique" type="text" style="display: none"/>
                <br>

                <button name="Enregistrement" type="submit">Créer la lettre</button>



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

    $templateProcessor->saveAs('../final_template/template.docx');

    echo "<script type='text/javascript'>document.location.replace('download.html');</script>";

    return false;



}
?>











