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
    </script>
</head>
<body>
<header>
    <img src="../images/logo.png" alt="logo">
</header>
<main>
    <h1>Ajouter un nouveau model</h1>
    <form action="model.php" method="post">
        <!--<select id="categories" onchange="getCat(this.value);"><option value=" ">Choisisez la catégorie</option>-->
        <label>Choisissez la catégorie</label><br>
        <select name="categories">
            <?php include "connection.php";
            categorieListBO();
            ?>
        </select><br><br>
        Nom du modèle<br>
        <input type="text" name="modelname"><br><br>
        <input type="submit" name="create" value="Ajouter">
    </form>
    <?php
        if (isset($_POST['create'])) {
            $selectedCategorie = $_POST["categories"];
            $modelname = $_POST['modelname'];
            echo "<p>".$selectedCategorie."</p>";
            echo "<p>".$modelname."</p>";
            $result = addModel($modelname, $selectedCategorie);
            echo "<p>".$result."</p>";
        }
    ?>
</main>
<p>© 2020 by FRC-Lausanne</p>
</footer>
</body>
</html>











