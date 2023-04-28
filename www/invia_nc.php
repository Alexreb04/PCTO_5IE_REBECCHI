<?php
    require("validate_user.php");
    $mysqli = require("conn_db.php");

    //DA FARE INSERT PER MANDARE NC AL DATABASE
    $creatore = htmlspecialchars($_SESSION["username"]);
    $tipo = htmlspecialchars($_POST["tipo"]);
    $titolo = htmlspecialchars($_POST["titolo"]);
    $descrizione = htmlspecialchars($_POST["descrizione"]);

    $stmt = $mysqli->prepare("INSERT INTO NC(IDNC, tipo, creatore, risolutore, azioneCorrettiva, titolo, descrizione, dataInizio, dataFine, statoGenerale, statoReparto) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    $idnc = NULL;
    $risolutore = NULL;
    $azioneC = NULL;
    $dataInizio = "" . date("Y-m-d") . " " . date("H:i:s");
    $dataF = NULL;
    $statoG = 1;
    $statoR = 1;
    $stmt -> bind_param('iisssssssii', $idnc, $tipo, $creatore, $risolutore, $azioneC, $titolo, $descrizione, $dataInizio, $dataF, $statoG, $statoR);
    $stmt -> execute();

    $status = $mysqli -> error;
    if(strlen($status) === 0)
        header("Location: ./nc.php?error_status=success");
    else 
        header("Location: ./nc.php?error_status=error");
?>