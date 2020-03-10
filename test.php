<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Lettres modèles</title>
</head>
<body>

<h1>My first PHP page</h1>

<?php


require_once __DIR__ . '/vendor/autoload.php';

$template = new \PhpOffice\PhpWord\TemplateProcessor('Template/Assurance.docx');

$template->setValue('rue', 'Chemin des planettes');
$template->setValue('numero', '20');
$template->setValue('prenom', 'Loris');
$template->setValue('nom', 'clivaz');
$template->setValue('codepostal', '3973 Venthone');
$template->setValue('nAssure', '223172');






?>

</body>
</html>
