<?php
    require("../validate_user.php");
    $mysqli = require("../conn_db.php");

    $queryUtente = "UPDATE Users
    SET username='{$_GET['username']}', passwd='{$_GET['passwd']}', ruolo='{$_GET['ruolo']}', reparto='{$_GET['reparto']}' 
    WHERE username='{$_GET['usernameDaModificare']}' ";

    $resultUtente = $mysqli -> query($queryUtente);

    echo $queryUtente;
    
    $status = $mysqli -> error;
    if(strlen($status) === 0)
        header("Location: ./cambia_utente.php?error_status=success");
    else 
        header("Location: ./cambia_utente.php?error_status=error");
?>