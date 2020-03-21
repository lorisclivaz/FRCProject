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
                url: "getInfosFromUser.php",
                data:'categorie_id='+val,
                success: function(data){
                    $("#models").html(data);
                }
            });
        }
        function get_question(val){
            $.ajax({
                type: 'POST',
                url: 'getInfosFromUser.php',
                data: 'model_id='+val,
                success: function (data) {
                    $("#formular").html(data);
                }
            });
        }
        function get_next_question(val){
            $.ajax({
                type: 'POST',
                url: 'getInfosFromUser.php',
                data: 'next_question='+val,
                success: function (data) {

                }
            });
        }
    </script>
</head>
<body>
    <header>
        <img src="../images/logo.png" alt="logo">
    </header>
    <main>
        <h1>Lettres modèles</h1>
        <br/>
        <form method="post" id="formular" action="changeValueTemplate.php" >
            <label>Sélectionnez une catégorie</label>
            <br/>
            <select id="categories" onchange="getCat(this.value);"><option value=" ">Sélectionnez une catégorie</option>
            <?php include "connection.php";
            categorieList();
            ?>
            </select>
            <br/><br/>
            <label>Sélectionnez un modèle</label>
            <br/>
            <select  id="models" onchange="get_question(this.value);" ><option value=" ">Sélectionnez un modèle</option>
            </select>
            <br/><br/>
        </form>
    </main>
    <footer>
        <p>© 2020 by FRC-Lausanne</p>
    </footer>
</body>
</html>











