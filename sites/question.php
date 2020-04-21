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
                url: "getInfosFormUserBO.php",
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
            <?php include "navBackoffice.html";?>
            <div class="card col-md-12 col-xl-9">
                <div class="card-body">
                    <h1>Ajouter une question</h1>
                    <br>
                    <form action="question.php" method="post">
                        <label>Choisissez la catégorie:</label><br>
                        <select name="categories" onchange="getCat(this.value);" required>
                            <option value=" " disabled selected>Sélectionnez une catégorie</option>
                            <?php include "../db/connection.php";
                            categorieList();
                            ?>
                        </select><br><br>
                        <label>Choisissez le modèle:</label><br>
                        <select id="models" onchange="getModel(this.value);" required>
                            <option value=" " disabled selected>Sélectionnez un modèle</option>
                        </select><br><br>
                        <label for="rp">Réponse précédente (facultatif):</label><br>
                        <select name="rp" onchange="getPR(this.value);" required>
                            <option value="1">Qui</option>
                            <option value="2">Non</option>
                        </select><br><br>
                        <label for="question">Question:</label><br>
                        <input type="text" id="question" name="question" required><br><br>
                        Explications (facultatif):<br>
                        <input type="text" id="explication" name="explication"><br><br>
                        <input type="submit" onclick="createQuestion()" name="create" value="Ajouter"><br>
                        <p id="message"></p>
                    </form>
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











