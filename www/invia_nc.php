<?php
    session_start();
    $mysqli = require("conn_db.php");

    //DA FARE INSERT PER MANDARE NC AL DATABASE
    $creatore = htmlspecialchars($_SESSION["username"]);
    $tipo = htmlspecialchars($_POST["tipo"]);
    $titolo = htmlspecialchars($_POST["titolo"]);
    $descrizione = htmlspecialchars($_POST["descrizione"]);

    /*
    $queryInsert = "INSERT INTO NC(IDNC, tipo, creatore, risolutore, azioneCorrettiva, titolo, descrizione, dataInizio, dataFine, statoGenerale, statoReparto) 
    VALUES (NULL, $tipo, $creatore, NULL, NULL, $titolo, $descrizione, 21/04/2022, NULL, 1, 1)";
    */

    //$result = $mysqli -> query($queryInsert);

    $stmt = $mysqli->prepare("INSERT INTO NC(IDNC, tipo, creatore, risolutore, azioneCorrettiva, titolo, descrizione, dataInizio, dataFine, statoGenerale, statoReparto) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    $idnc = 'NULL';
    $risolutore = 'NULL';
    $azioneC = 'NULL';
    $dataInizio = "CURDATE()";
    $dataF = 'NULL';
    $statoG = 1;
    $statoR = 1;
    $stmt -> bind_param('iisssssssii', $idnc, $tipo, $creatore, $risolutore, $azioneC, $titolo, $descrizione, $dataInizio, $dataF, $statoG, $statoR);
    $stmt -> execute();

    var_dump($mysqli -> error);
    //header("Location: ./nc.php");
?>