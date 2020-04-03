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
    <script>
        let para;
        function getCat(val) {
            $.ajax({
                type: "POST",
                url: "getInfosFromUser.php",
                data:'categorie_id_bo='+val,
                success: function(data){
                    $("#models").html(data);
                }
            });
        }
    </script>
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
                    <a href="paragraphe.php"><li class="list-group-item">Ajouter un nouveau paragraphe</li></a>
                    <a href="champs.php"><li class="list-group-item">Ajouter de nouveau champs</li></a>
                </ul>
            </div>

            <div class="card col-md-9">
                <div class="card-body">
                    <h1>Ajouter un paragraphe</h1>
                    <br>
                    <!--<form enctype="multipart/form-data" action="__URL__" method="POST">-->
                    <form action="paragraphe.php" method="post" enctype="multipart/form-data">
                        <label>Choisissez la catégorie</label><br>
                        <select id="categories" onchange="getCat(this.value);"><option value=" ">Sélectionnez une catégorie</option>
                            <?php include "connection.php";
                            categorieList();
                            ?>
                        </select><br><br>
                        <label>Choisissez le modèle</label><br>
                        <select  id="models"><option value="">Sélectionnez un modèle</option>
                        </select><br><br>
                        <label>Paragraphe</label><br>
                        <textarea id="paragraph" rows="4" cols="50"></textarea><br><br>
                        <label>Champs</label><br>
                        <input type="text" name="champs"><input type="submit" name="newchamp" value="+"><br><br>
                        <label>Résponse précédente</label><br>
                        <select id="rp">
                            <option>Je confirme avoir subisont</option>
                        </select><br><br>
                        <input type="submit" name="create" value="Ajouter">
                    </>
                </div>
            </div>
        </div>
    </div>
    <?php
        if(isset($_POST["newchamp"])){
            header('Location: champs.php');
        }
    ?>
</main>
<p>© 2020 by FRC-Lausanne</p>
</footer>
</body>
</html>










