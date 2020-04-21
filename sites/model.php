<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="../css/style.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="../css/backoffice.css" media="screen" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
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
    <a href="backoffice.php"><img src="../images/logo.png" alt="logo"></a>
</header>
<main>
    <h1>Back Office</h1>
    <br/>
    <div class="container-fluid">
        <div class="row">
            <?php include "navBackoffice.html";?>
            <div class="card col-md-12 col-xl-9">
                <div class="card-body">
                    <h1>Ajouter un nouveau model</h1>
                    <form action="model.php" method="post">
                        <label>Choisissez la catégorie:</label><br>
                        <select name="categories">
                            <option value="" disabled selected> Choisissez la catégorie</option>
                            <?php include "../db/connection.php";
                            categorieListBO();
                            ?>
                        </select><br><br>
                        <label for="modelname">Nom du modèle:</label><br>
                        <input type="text" name="modelname" required><br><br>
                        <input type="submit" name="create" value="Ajouter">
                    </form>
                    <?php
                    if (isset($_POST['create'])) {
                        $selectedCategorie = $_POST["categories"];
                        $modelname = $_POST['modelname'];
                        $result = addModel($modelname, $selectedCategorie);
                        echo "<p>".$result."</p>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

</main>
<footer>
<p>© 2020 by FRC-Lausanne</p>
</footer>
</body>
</html>











