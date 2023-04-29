<?php
    require("../validate_user.php");
    $mysqli = require("../conn_db.php");

    $stmt = $mysqli->prepare("INSERT INTO Users(username, passwd, ruolo, reparto) VALUES (?, ?, ?, ?)");

    $username = $_GET["username"];
    $passwd = $_GET["passwd"];
    $ruolo = $_GET["ruolo"];
    $reparto = $_GET["reparto"];

    $stmt -> bind_param('ssss', $username, $passwd, $ruolo, $reparto);
    $stmt -> execute();

    $status = $mysqli -> error;
    if(strlen($status) === 0)
        header("Location: ./aggiungi_utente.php?error_status=success");
    else 
        header("Location: ./aggiungi_utente.php?error_status=error");
?>