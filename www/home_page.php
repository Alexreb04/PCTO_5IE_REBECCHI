<?php
    session_start();

    $mysqli = require("conn_db.php");

    $ruolo = $_SESSION["ruolo"];
    $queryAux = 'SELECT R.IDAUT
    FROM RuoloValore as R
    WHERE R.ruolo = "'.$ruolo.'"';

    $result = $mysqli -> query($queryAux);

    foreach($result as $v){
        foreach($v as $key => $value) {
            echo "$key $value <br>";
        }
    }

    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HOME PAGE</title>
    <link rel="stylesheet" href="HOMEPAGECSS.css">
</head>
<body>
<div class="buttonGrid">
        <div class="button" onclick="">Button 1</div>
        <div class="button" onclick="">Button 2</div>
        <div class="button" onclick="">Button 3</div>
        <div class="button" onclick="">Button 4</div>
        <div class="button" onclick="">Button 5</div>
        <div class="button" onclick="">Button 6</div>
    </div>
    
</body>
</html>