<?php
    session_start();

    $mysqli = require("conn_db.php");

    $ruolo = $_SESSION["ruolo"];

    $is_amministratore = false;
    foreach($result as $v){
        foreach($v as $key => $value) {
            if($value === '1')
            {
                $is_amministratore = true;
            }
        }
    }

    if($is_amministratore)
    {
        $queryLista = 'SELECT titolo,tipo,dataInizio,StatoGenerale FROM NC';
    }
    else
    {
        $user_corrente = htmlspecialchars($_SESSION["username"]);
        $queryLista = 'SELECT titolo,tipo,dataInizio,StatoReparto FROM NC WHERE risolutore = '.$user_corrente.'';
    }

    $lista = $mysqli -> query($queryLista);

    //DA FINIRE
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LISTA NC</title>
    <!--<?php if($is_amministratore) : ?>
        <link rel="stylesheet" href=".css">
    <?php elseif (!$is_amministratore): ?>
        <link rel="stylesheet" href=".css">
    <?php endif; ?>-->
</head>
<body>
    <!-- gestore non conformita -->
    <?php if($is_amministratore) : ?>
        
    <?php elseif (!$is_amministratore): ?>
        
    <?php endif; ?>
    
</body>
</html>