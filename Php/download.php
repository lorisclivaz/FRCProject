

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css" media="screen" />
    <style>
        a:link, a:visited {
            background-color: #f44336;
            color: white;
            padding: 25px 100px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
        }

        a:hover, a:active {
            background-color: red;
        }
        h1
        {

            text-decoration: underline;
            font-size: 29px;
            text-align: center;
        }
    </style>
</head>

<body>
<header>
    <img src="../images/logo.png" alt="logo">
</header>
<br>
<br>
<h1 style="alignment: center">Vous pouvez télécharger votre lettre en cliquant sur le bouton ci-dessous :</h1>

<div class="centre">
    <a id="download" href="../final_template/template.docx" class="boxed-btn3-line">Download </a>

</div>

<div>

    <?php
    readDocx('../final_template/template.docx');
    ?>

</div>



</body>
</html>


<?php
//FUNCTION :: read a docx file and return the string
function readDocx($filePath) {
    // Create new ZIP archive
    $zip = new ZipArchive;
    $dataFile = 'word/document.xml';
    // Open received archive file
    if (true === $zip->open($filePath)) {
        // If done, search for the data file in the archive
        if (($index = $zip->locateName($dataFile)) !== false) {

            // If found, read it to the string
            $data = $zip->getFromIndex($index);

            // Close archive file
            $zip->close();
            // Load XML from a string
            // Skip errors and warnings
            $xml = DOMDocument::loadXML($data, LIBXML_NOENT | LIBXML_XINCLUDE | LIBXML_NOERROR | LIBXML_NOWARNING);
            // Return data without XML formatting tags

            $contents = explode('\n',strip_tags($xml->saveXML()));
            $text = '';
            foreach($contents as $i=>$content) {
                $text .= $contents[$i];
            }
            print $text;
            return $text;
        }
        $zip->close();
    }
    // In case of failure return empty string
    return "";
}