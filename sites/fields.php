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
                    <h1>Ajouter un champs</h1>
                    <form action="fields.php" method="post">
                        <label for="categories">Choisissez la catégorie:</label><br>
                        <select name="categories" required>
                            <option value="0"></option>
                            <?php include "../db/connection.php";
                            categorieList();
                            ?>
                        </select><br><br>

                        <label for="fields">File Name:</label><br>
                        <input type="text" name="fields" required><br><br>

                        <label for="bname">Balise Name:</label><br>
                        <input type="text" name="bname" required><br><br>

                        <input type="submit" name="create" value="Ajouter"><br>
                    </form>
                    <?php
                    if (isset($_POST['create'])) {
                        $categorie = $_POST["categories"];
                        $field = $_POST["fields"];
                        $bname = $_POST["bname"];

                        if(!empty($field) || !empty($bname))
                        {
                            addField($field, $categorie, $bname);
                        }
                        else{
                            echo "<p>Fill out all Fields</p>";
                        }
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











