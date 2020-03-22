<?php

    include "../vendor/autoload.php";
    include "index.php";


    //Récupération des valaeurs pour le changement du template

    if (isset($_POST['Enregistrement'])) {

        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $rue = $_POST['rue'];
        $n_rue=$_POST['n°_rue'];
        $lieu_codepostal = $_POST['lieu_codepostal'];

        $nom_societe = $_POST['nom_societe'];
        $adresse_societe_n = $_POST['adresse_societe_n°'];
        $lieu_codepostal_societe = $_POST['lieu_codepostal_societe'];
        $lieu_envoie = $_POST['lieu_envoie'];

        $paragraph = $_POST['paragraphe_conditionnel'];
        $problematique = $_POST['problematique'];



        //récupération du path mais faire ca dynamiquement
        $templateProcessor = new PhpOffice\PhpWord\TemplateProcessor(getTemplatePathFromCategorie('Aviation'));

        //Set des valeurs dans le template champs de base
        $templateProcessor->setValue('nom', $nom);
        $templateProcessor->setValue('prenom', $prenom);
        $templateProcessor->setValue('rue', $rue);
        $templateProcessor->setValue('numero', $n_rue);
        $templateProcessor->setValue('codepostal', $lieu_codepostal);


        $templateProcessor->setValue('nomSociete', $nom_societe);
        $templateProcessor->setValue('adresseSociete', $adresse_societe_n);
        $templateProcessor->setValue('codePostalSociete', $lieu_codepostal_societe);
        $templateProcessor->setValue('lieu', $lieu_envoie);

        $templateProcessor->setValue('paragraphe_conditionnel', $paragraph);
        $templateProcessor->setValue('problematique', $problematique);


        $templateProcessor->saveAs(' Aviation-Copie.docx');






    }





