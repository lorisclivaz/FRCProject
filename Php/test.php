

    <?php
    if (isset($_POST["submit"]))
    {
        if (isset($_POST["categorie"]))
        {
            foreach ($_POST['categorie'] as $categories)
            {
                print "vous avez selectionné $categories";
            }
        }
    }
    ?>

    <?php

    if (isset($_POST['enregistrement']))
    {
        $nom = $_POST['lname'];
        $prenom = $_POST['fname'];
        $adresse = $_POST['adresse'];
        $codePostal = $_POST['codepostal'];
        $nrAssure = $_POST['nrAssure'];
        $nameCompanie = $_POST['nameCompany'];




        print "mon nom : $nom" ;
        print "mon prenom : $prenom";
        print "mon adresse : $adresse";
        print "mon code postal: $codePostal";
        print "mon nrAssure : $nrAssure";
        print "mon nom de companie : $nameCompanie";


    }


    ?>





