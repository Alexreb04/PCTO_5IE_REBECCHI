<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aggiorna Utente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
<?php
    require("../validate_user.php");
    $mysqli = require("../conn_db.php");

    $username = $_GET["username"];

    $queryUtente = "SELECT *
    FROM Users
    WHERE Users.username=\"{$username}\"";

    $resultUtente = $mysqli -> query($queryUtente);

    $stringa = "<table class=\"table\"><thead><tr>";
    foreach($resultUtente as $v){
        foreach($v as $key => $value) {
            $stringa .= "<th scope=\"col\">$key</th>"; 
        }

        $stringa .= "</tr></thead><tbody><tr>";

        foreach($v as $key => $value) {
            $stringa .= "<td>$value</td>"; 
        }

        $stringa .= "</tr></tbody></table>";
    }

    
    echo $stringa;
?>
</body>
</html>