<?php

    include "../vendor/autoload.php";

    if (isset($_POST['enregistrement']))
    {
        $nom = $_POST['lname'];
        $prenom = $_POST['fname'];
        $adresse = $_POST['adresse'];
        $codePostal = $_POST['codepostal'];
        $nrAssure = $_POST['nrAssure'];
        $nameCompanie = $_POST['nameCompany'];
        $adresseCompagnie = $_POST['adresseCompany'];
        $codePostalCompagnie = $_POST['codePostalCompany'];
        $lieu = $_POST['lieu'];



        print "mon nom : $nom" ;
        print "mon prenom : $prenom";
        print "mon adresse : $adresse";
        print "mon code postal: $codePostal";
        print "mon nrAssure : $nrAssure";
        print "mon nom de companie : $nameCompanie";
        print "mon adresse de companie : $adresseCompagnie";
        print "mon code postal de companie : $codePostalCompagnie";
        print "mon lieu  : $lieu";


        $templateProcessor = new PhpOffice\PhpWord\TemplateProcessor('../Template/Assurance.docx');

        $templateProcessor->setValue('nom', $nom);
        $templateProcessor->setValue('prenom', $prenom);
        $templateProcessor->setValue('rue', $adresse);
        $templateProcessor->setValue('codepostal', $codePostal);
        $templateProcessor->setValue('nAssure', $nrAssure);
        $templateProcessor->setValue('nomSociete', $nameCompanie);
        $templateProcessor->setValue('adresseSociete', $adresseCompagnie);
        $templateProcessor->setValue('codePostalSociete', $codePostalCompagnie);
        $templateProcessor->setValue('lieu', $lieu);

        $templateProcessor->saveAs('loris.docx');






    }


    ?>





