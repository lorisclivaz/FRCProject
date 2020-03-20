<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="../css/style.css" media="screen" />
    <title>Lettres modèles</title>
</head>
<body>
<?php include "connection.php"?>
    <header>
        <img src="../images/logo.png" alt="logo">
    </header>

    <main>
        <h1>Lettres modèles</h1>

        <form method="post" action="changeValueTemplate.php" >
            <label>Sélectionnez une catégorie</label>
            <br/>
            <select id="categories" onchange='getValue(this.value)'><option value=" ">Sélectionnez une catégorie</option>
            <?php
            categorieList();
            ?>
            </select>

            <div id="test"></div>

            <!-- Prendre les questions de la db par rapport au template choisi-->

            <p>Veuillez répondre à toutes les questions ci-dessous:</p>
            <p>Question1</p>
            <input type="radio" id="answer1" name="answer1" value="oui">
            <label for="answer1">Oui</label>
            <input type="radio" id="answer2" name="answer2" value="non">
            <label for="answer2">Non</label>
            <br>
            <br>
            <p>Question2</p>
            <input type="radio" id="answer3" name="answer3" value="oui">
            <label for="answer3">Oui</label>
            <input type="radio" id="answer4" name="answer4" value="non">
            <label for="answer4">Non</label>
            <br>
            <br>

            <!--Les champs de base qui sont repris pour changer le template WORD-->

            <p>Complétez tous les champs</p>

            <label for="lname">Nom:</label><br>
            <input type="text" id="lname" name="lname" value="Doe"><br>
            <label for="fname">Prénom:</label><br>
            <input type="text" id="fname" name="fname" value="Doe"><br>
            <label for="adresse">Adresse:</label><br>
            <input type="text" id="adresse" name="adresse" value="Doe"><br>
            <label for="codePostal">code postal et lieu</label><br>
            <input type="text" id="codePostal" name="codepostal" value="Doe"><br>
            <label for="nrAssure">Nr. Assuré:</label><br>
            <input type="text" id="nrAssure" name="nrAssure" value="Doe"><br>
            <label for="nameCompany">Nom de la Companie:</label><br>
            <input type="text" id="nameCompany" name="nameCompany" value="Doe"><br>
            <label for="adresseCompany">Adresse Compagnie:</label><br>
            <input type="text" id="adresseCompany" name="adresseCompany" value="Doe"><br>
            <label for="codePostalCompany">Code postal compagnie et lieu:</label><br>
            <input type="text" id="codePostalCompany" name="codePostalCompany" value="Doe"><br>
            <label for="lieu">Lieu:</label><br>
            <input type="text" id="lieu" name="lieu" value="Doe"><br>
            <label for="nrVole">Numero Vole:</label><br>
            <input type="text" id="nrVole" name="nrVole" value="Doe"><br>
            <label for="dateAchat">Date Achat:</label><br>
            <input type="date" id="dateAchat" name="dateAchat" value="Doe"><br>
            <label for="destination">Destination:</label><br>
            <input type="text" id="destination" name="destination" value="Doe"><br>
            <label for="chiffrePerte">Chiffre la perte:</label><br>
            <input type="text" id="chiffrePerte" name="chiffrePerte" value="Doe"><br>
            <label for="iban">IBAN:</label><br>
            <input type="text" id="iban" name="iban" value="Doe"><br>
            <input type="submit" name="enregistrement" value="Enregistrer en word">
        </form>

    </main>

    <footer>
        <p>© 2020 by FRC-Lausanne</p>
    </footer>

</body>
</html>
<script>
    function getValue() {

        var dropdown = document.getElementById('categories');
        var str = dropdown.options[dropdown.selectedIndex].value;


    }
</script>