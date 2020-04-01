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
    <h1>Back Office</h1>

    <br/>

    <form action="categorie.php" method="get">
        <input type="submit" value="Ajouter une catégorie">
    </form>
    <br>
    <form action="template.php" method="get">
        <input type="submit" value="Ajouter un nouveau template">
    </form>
    <br>
    <form action="model.php" method="get">
        <input type="submit" value="Ajouter un nouveau model">
    </form>
    <br>
    <form action="question.php" method="get">
        <input type="submit" value="Ajouter une nouvelle question">
    </form>
    <br>
    <form action="paragraphe.php" method="get">
        <input type="submit" value="Ajouter un nouveau paragraphe">
    </form>
    <br>
    <form action="champs.php" method="get">
        <input type="submit" value="Ajouter de nouveau champs">
    </form>
</main>
<p>© 2020 by FRC-Lausanne</p>
</footer>
</body>
</html>











