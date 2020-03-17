<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="../css/style.css" media="screen" />
    <title>Lettres modèles</title>
</head>
<body>
    <header>
        <img src="../images/logo.png" alt="logo">
    </header>

    <main>
        <h1>Lettres modèles</h1>

        <!-- Mettre les catégories dans la db et faire la liste par rapport à la connection de la db-->

        <form method="post" action="changeValueTemplate.php" >
            <label>Sélectionnez une catégorie:</label><br>
            <select  name="categorie[]">
                <option value = "1">one</option>
                <option value = "2">two</option>
                <option value = "3">three</option>
                <option value = "4">four</option>
            </select>
            <input type="submit" name="submit" value="Valider">
            <br>

            <br>

            <!--Faire par rapport aux templates du site FRC.ch-->


            <label for="model">Sélectionnez un modéle de lettre:</label><br>
            <select id = "model">
                <option value = "1">one</option>
                <option value = "2">two</option>
                <option value = "3">three</option>
                <option value = "4">four</option>
            </select>
            <br>
            <br>

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
            <input type="submit" name="enregistrement" value="Enregistrer en word">
        </form>
        <?php
        include "connection.php";
        connection();
        ?>
    </main>

    <footer>
        <p>© 2020 by FRC-Lausanne</p>
    </footer>

</body>
</html>