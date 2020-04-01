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

    <div class="container-fluid">
        <div class="row">
            <nav class="col-md-5 d-none d-md-block bg-light sidebar">
                <div class="sidebar-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" href="categorie.php">
                                <span data-feather="home"></span>
                                Ajouter une catégorie <span class="sr-only">(current)</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="template.php">
                                <span data-feather="file"></span>
                                Ajouter un nouveau template
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="model.php">
                                <span data-feather="shopping-cart"></span>
                                Ajouter un nouveau model
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="question.php">
                                <span data-feather="users"></span>
                                Ajouter une nouvelle question
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="paragraphe.php">
                                <span data-feather="bar-chart-2"></span>
                                Ajouter un nouveau paragraphe
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="champs.php">
                                <span data-feather="layers"></span>
                                Ajouter de nouveau champs
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

</main>
<p>© 2020 by FRC-Lausanne</p>
</footer>
</body>
</html>











