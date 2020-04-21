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
                    <h1>Ajouter un nouveau template</h1>
                    <br>
                    <!--<form enctype="multipart/form-data" action="__URL__" method="POST">-->
                    <form action="template.php" method="post" enctype="multipart/form-data">
                        <label>Choisissez la catégorie</label><br>
                        <select name="categories" required>
                            <?php include "../db/connection.php";
                            categorieListBO();
                            ?>
                        </select><br><br>
                        Select template to upload:
                        <input type="file" name="fileToUpload" id="fileToUpload" required><br><br>
                        <input type="submit" value="Upload Template" name="create">
                    </>
                    <?php
                    // Check if image file is a actual image or fake image
                    if(isset($_POST["create"])) {
                        $selectedCategorie = $_POST["categories"];
                        $target_dir = "../Template/";
                        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
                        $uploadOk = 1;
                        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

                        // Check if file already exists
                        if (file_exists($target_file)) {
                            echo "Sorry, file already exists.";
                            $uploadOk = 0;
                        }
                        // Check file size
                        if ($_FILES["fileToUpload"]["size"] > 500000) {
                            echo "Sorry, your file is too large.";
                            $uploadOk = 0;
                        }
                        // Allow certain file formats
                        if($imageFileType != "docx") {
                            echo "Sorry, only docx files allowed.";
                            $uploadOk = 0;
                        }
                        // Check if $uploadOk is set to 0 by an error
                        if ($uploadOk == 0) {
                            echo "Sorry, your file was not uploaded.";
                            // if everything is ok, try to upload file
                        }
                        else {
                            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                                //echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
                                $templateName = str_replace(".docx","", basename($_FILES["fileToUpload"]["name"]));
                                $result = addTemplate($templateName, $target_file, $selectedCategorie);
                                echo "<p>".$result."</p>";
                            } else {
                                echo "Sorry, there was an error uploading your file.";
                            }
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











