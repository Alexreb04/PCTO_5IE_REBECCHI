<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aggiorna Tipo NC</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>

<?php
    require("../validate_user.php");
    
    $mysqli = require("../conn_db.php");

    $queryTipo = "SELECT *
    FROM Tipo";

    $resultTipo = $mysqli -> query($queryTipo);

    $stringa = "<form action=\"update_tipo_nc.php\" method=\"POST\">";
    $stringa .= "<table class=\"table\"><thead><tr>";

    $alreadyInside = false;
    foreach($resultTipo as $v) {
        if(!$alreadyInside) {
            foreach($v as $key => $value) {
                $stringa .= "<th scope=\"col\">$key</th>"; 
            }
            $alreadyInside = true;
        }

        $stringa .= "</tr></thead><tbody><tr>";

        foreach($v as $key => $value) {
            $stringa .= "<td><input type=\"text\" name=\"update[$key][]\" value=\"$value\"></td>";
        }
    }

    $stringa .= "</tr></thead><tbody><tr>";
    $stringa .= "<td><input type=\"text\" name=\"new_idt\"></td>";
    $stringa .= "<td><input type=\"text\" name=\"new_nome\"></td>";

    $stringa .= "</tr></tbody></table>";
    $stringa .= "<button id=\"submit\" type=\"submit\" class=\"btn btn-primary\" data-toggle=\"button\" aria-pressed=\"false\" autocomplete=\"off\">Update</button></form>";

    echo $stringa;
?>

</body>