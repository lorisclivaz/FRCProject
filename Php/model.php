<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="../css/style.css" media="screen" />
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
            <div class="card col-md-3">
                <ul class="list-group list-group-flush">
                    <a href="categorie.php"><li class="list-group-item">Ajouter une catégorie</li></a>
                    <a href="template.php"><li class="list-group-item">Ajouter un nouveau template</li></a>
                    <a href="model.php"><li class="list-group-item">Ajouter un nouveau model</li></a>
                    <a href="question.php"><li class="list-group-item">Ajouter une nouvelle question</li></a>
                    <a href="answer.php"><li class="list-group-item">Ajouter une nouvelle réponse</li></a>
                    <a href="paragraphe.php"><li class="list-group-item">Ajouter un nouveau paragraphe</li></a>
                    <a href="champs.php"><li class="list-group-item">Ajouter de nouveau champs</li></a>
                </ul>
            </div>

            <div class="card col-md-9">
                <div class="card-body">
                    <h1>Ajouter un nouveau model</h1>
                    <form action="model.php" method="post">
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
                        $result = addModel($modelname, $selectedCategorie);
                        echo "<p>".$result."</p>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

</main>
<p>© 2020 by FRC-Lausanne</p>
</footer>
</body>
</html>











