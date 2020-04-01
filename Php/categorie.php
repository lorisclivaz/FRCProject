<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="../css/style.css" media="screen" />
    <title>Back Office</title>
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
</head>
<body>
<header>
    <img src="../images/logo.png" alt="logo">
</header>
<main>
    <h1>Ajouter une catégorie</h1><br>
    <form action="categorie.php" method="post">
        Nom de la catégorie<br>
        <input type="text" name="categoriename"><br><br>
        <input type="submit" name="create" value="Créer">
    </form>
    <?php
    include "connection.php";
    if (isset($_POST['create'])) {
        $categroeiname = $_POST['categoriename'];
        $result = addCategorie($categroeiname);
        echo "<p>".$result."</p>";
    }
    ?>
</main>


<p>© 2020 by FRC-Lausanne</p>
</footer>
</body>
</html>











