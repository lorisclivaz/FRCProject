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
        var modelid;
        var answerid;

        function getCat(val) {
            catid = val;
            $.ajax({
                type: "POST",
                url: "getInfosFromUser.php",
                data:'categorie_id_2='+val,
                success: function(data){
                    $("#models").html(data);
                }
            });
        }

        function getAnswer(val){
            answerid = val;
        }

        function createParagraphe(){
            var paragraph = $("#paragraph").val();
            var number = $("#number").val();
            var fieldsname = [];
            var p = "";
            var anfang = false;
            var dollar = false;
            alert("CAT " + catid + " ANSWER " + answerid + " PARAGRAPH " + paragraph);
            for(var i=0; i<paragraph.length; i++){
                if(anfang && dollar){
                    if(paragraph.charAt(i)==']'){}else{
                        p += paragraph.charAt(i);
                    }
                }
                if(paragraph.charAt(i)=='[')
                    anfang = true;
                if(paragraph.charAt(i)=='$')
                    dollar = true;
                if(paragraph.charAt(i)==']'){
                    anfang = false;
                    dollar = false;
                    fieldsname.push(p);
                    p = "";
                }
            }
            if($('#paragraph').val() == '') {
                $("#message").html("Please enter a paragraph");
            }
            else{
                var jsonString = JSON.stringify(fieldsname);
                $.ajax({
                    type: "POST",
                    url: "getInfosFromUserCreateParagraph.php",
                    dataType: "json",
                    data:{answer:answerid, categorie:catid, paragraph:paragraph, number:number, data : jsonString},
                    success: function(data) {
                        $("#message").html(data);
                    }
                });
            }
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
            <div class="card col-md-12 col-xl-3">
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

            <div class="card col-md-12 col-xl-9">
                <div class="card-body">
                    <h1>Ajouter un paragraphe</h1>
                    <br>
                    <!--<form enctype="multipart/form-data" action="__URL__" method="POST">-->
                    <form action="paragraphe.php" method="post" enctype="multipart/form-data">
                        <label for="categories">Choisissez la catégorie:</label><br>
                        <select id="categories" onchange="getCat(this.value);" required>
                            <option value=" " disabled selected>Sélectionnez une catégorie</option>
                            <?php include "connection.php";
                            categorieList();
                            ?>
                        </select><br><br>

                        <label for="answer">Résponse précédente:</label><br>
                        <select id="answer" onchange="getAnswer(this.value);" required>
                            <?php answerList() ?>
                        </select><br><br>

                        <label for="number">Number:</label><br>
                        <input type="text" id="number" name="number" required><br><br>

                        <label for="paragraph">Paragraphe:</label><br>
                        <textarea class="textinput" id="paragraph" rows="10" cols="100" required></textarea><br><br>

                        <input type="submit" onclick="createParagraphe()" name="create" value="Ajouter"><br>
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











