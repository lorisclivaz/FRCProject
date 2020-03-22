<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="../css/style.css" media="screen" />
    <title>Lettres modèles</title>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" type="text/javascript"></script>
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
            if(document.getElementById("cache").style.display == "block")
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


    </script>
</head>
<body>
    <header>
        <img src="../images/logo.png" alt="logo">
    </header>
    <main>
        <h1>Lettres modèles</h1>
        <br/>
        <form method="post" name="formular" action="changeValueTemplate.php">
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
            <form enctype="multipart/form-data" action="changeValueTemplate.php" method="post">
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
                <input name="Enregistrement" type="submit" value="Enregistrement" />
            </form>
        </div>
    </main>
    <footer>
        <p>© 2020 by FRC-Lausanne</p>
    </footer>
</body>
</html>











