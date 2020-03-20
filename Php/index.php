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

        <!-- Mettre les catégories dans la db et faire la liste par rapport à la connection de la db-->

        <form method="post" action="changeValueTemplate.php" >
            <label>Sélectionnez une catégorie:</label><br>
            <?php categorieList(); ?>
            <input type="submit" name="submit" value="Valider">
            <br>
            <br>
            <!--Faire par rapport aux templates du site FRC.ch-->

            <label for="model">Sélectionnez un modèle de lettre:</label><br>
            <?php modelListFromCategorie('Aviation'); ?>
            <br>
            <br>
            <h1>Questions</h1>
            <?php getAnswerandQuestionsFromModel('Bagage : perdu – endommagé - acheminé en retard') ?>
            <br>
            <br>
            <p>Path: <?php getTemplatePathFromCategorie('Aviation') ?></p>
            <h1>Paragraph</h1>
            <?php getParagraphFromAnswer('Mon bagage a été endommagé') ?>
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