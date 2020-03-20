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
                url: "get_categorie_models.php",
                data:'categorie_id='+val,
                success: function(data){
                    $("#models").html(data);
                }
            });
        }
    </script>
</head>
<body>
<?php include "connection.php"?>
    <header>
        <img src="../images/logo.png" alt="logo">
    </header>

    <main>
        <h1>Lettres modèles</h1>
        <br/>
        <form method="post" action="changeValueTemplate.php" >
            <label>Sélectionnez une catégorie</label>
            <br/>
            <select id="categories" onchange="getCat(this.value);"><option value=" ">Sélectionnez une catégorie</option>
            <?php
            categorieList();
            ?>
            </select>
            <br/><br/>
            <label>Sélectionnez un modèle</label>
            <br/>
            <select id="models"><option value=" ">Sélectionnez un modèle</option>
            </select>
            <br/><br/>
    </main>

    <footer>
        <p>© 2020 by FRC-Lausanne</p>
    </footer>

</body>
</html>