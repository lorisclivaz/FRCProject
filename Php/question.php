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
        var catid;
        var modelname;
        var rp = 1;

        function getCat(val) {
            catid = val;
            $.ajax({
                type: "POST",
                url: "getInfosFromUser.php",
                data:'categorie_id_bo='+val,
                success: function(data){
                    $("#models").html(data);
                }
            });
        }

        function getModel(val){
            modelname = val;
        }

        function getPR(val){
            rp = val;
        }

        function createQuestion(){
            var question = $("#question").val();
            var explication = $("#explication").val();
            $.ajax({
                type: "POST",
                url: "getInfosFromUserCreateQuestion.php",
                dataType: "json",
                data:{cat:catid, model:modelname, rp:rp, question:question, explication:explication},
                success: function(data) {
                    $("#message").html(data);
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
                    <a href="answer.php"><li class="list-group-item">Ajouter une nouvelle réponse</li></a>
                    <a href="paragraphe.php"><li class="list-group-item">Ajouter un nouveau paragraphe</li></a>
                    <a href="fields.php"><li class="list-group-item">Ajouter de nouveau champs</li></a>
                </ul>
            </div>

            <div class="card col-md-9">
                <div class="card-body">
                    <h1>Ajouter une question</h1>
                    <br>
                    <form action="question.php" method="post">
                        <label>Choisissez la catégorie</label><br>
                        <select name="categories" onchange="getCat(this.value);"><option value=" ">Sélectionnez une catégorie</option>>
                            <?php include "connection.php";
                            categorieList();
                            ?>
                        </select><br><br>
                        <label>Choisissez le modèle</label><br>
                        <select id="models" onchange="getModel(this.value);"><option value=" ">Sélectionnez un modèle</option>
                        </select><br><br>
                        Réponse précédente (facultatif)<br>
                        <select name="rp" onchange="getPR(this.value);">
                            <option value="1">Qui</option>
                            <option value="2">Non</option>
                        </select><br><br>
                        Question<br>
                        <input type="text" id="question" name="question"><br><br>
                        Explications (facultatif)<br>
                        <input type="text" id="explication" name="explication"><br><br>
                        <input type="submit" onclick="createQuestion()" name="create" value="Ajouter"><br>
                        <p id="message"></p>
                    </form>
                </div>
            </div>
        </div>
    </div>

</main>
<p>© 2020 by FRC-Lausanne</p>
</footer>
</body>
</html>











