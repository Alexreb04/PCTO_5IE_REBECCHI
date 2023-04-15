<?php
    session_start();
    $mysqli = require("conn_db.php");

    //DA FARE INSERT PER MANDARE NC AL DATABASE
    $creatore = $_SESSION["username"];
    $tipo = htmlspecialchars($_POST["tipo"]);
    $titolo = htmlspecialchars($_POST["titolo"]);
    $descrizione = htmlspecialchars($_POST["descrizione"]);

    $queryInsert = "INSERT INTO NC(IDNC, tipo, creatore, risolutore, azioneCorrettiva, 
    titolo, descrizione, dataInizio, dataFine, statoGenerale, statoReparto) VALUES 
    (NULL, \'$tipo\', \'$creatore\', NULL, NULL, \'$titolo\', \'$descrizione\', \'CURRDATE()\, NULL, \'1\', \'1\'";

    $result = $mysqli -> query($queryInsert);
    
    header("Location: ./nc.php");
?>