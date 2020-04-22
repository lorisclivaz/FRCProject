<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="../css/style.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="../css/backoffice.css" media="screen" />

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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

        #warning{
            margin-left: 5px;
            font-size: 20px;
            color:red;
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
                    <h1>Ajouter une catégorie</h1><br>
                    <form action="categorie.php" method="post">
                        <label for="categorie">Nom de la catégorie</label><br>
                        <input type="text" name="categorie" id="categorie" required><br><br>
                        <input type="submit" name="create" value="Ajouter" />
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php
    include "../db/connection.php";
    if (isset($_POST['create'])) {
        $categroeiname = $_POST['categorie'];
        $result = addCategorie($categroeiname);
        echo "<p>".$result."</p>";
    }
    ?>

</main>

<footer>
<p>© 2020 by FRC-Lausanne</p>
</footer>
</body>
</html>











