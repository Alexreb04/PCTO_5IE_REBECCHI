<?php
    session_start();

    $mysqli = require("conn_db.php");

    $ruolo = $_SESSION["ruolo"];

    $queryAux = 'SELECT R.IDAUT
    FROM RuoloValore as R
    WHERE R.ruolo = "'.$ruolo.'"';

    $result = $mysqli -> query($queryAux);

    $is_amministratore = false;
    $is_responsabile = false;
    foreach($result as $v){
        foreach($v as $key => $value) {
            if($value === '1')
            {
                $is_amministratore = true;
            }

            if($value === '7')
            {
                $is_responsabile = true;
            }
        }
    }
    
    $id_nc = $_GET['NC'];

    $queryNC = "SELECT creatore,dataInizio,titolo,descrizione FROM NC WHERE IDNC='{$id_nc}'";
    $NC = $mysqli -> query($queryNC);

?>

<!DOCTYPE html>
<html lang="en">
    <style>
    table, th, td {
    border:1px solid black;
    }
    </style>
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
  
        <?php

        foreach($NC as $v){
            foreach($v as $key => $value) {
                echo htmlspecialchars($value. " ");
            }
        }
        ?>

        <?php
            if($is_amministratore)
            {
                $queryResp= "SELECT username,reparto FROM Users WHERE ruolo='responsabile_reparto'";
                $resp = $mysqli -> query($queryResp);

                $lista = [];
                foreach($resp as $v) {
                    foreach($v as $key => $values)
                    {
                        array_push($lista, $values);
                    }
                }

                echo "<form action=\"./update_gestore.php?NC='{$id_nc}'\" method=\"post\"><select name=\"resp\">";

                for($i=0; $i < sizeof($lista); $i=$i+2)
                {
                    echo "<option value='{$lista[$i]}'>{$lista[$i]} - {$lista[$i+1]}</option>";
                }
                
                echo "<input type=\"submit\" value=\"smista\">";
                echo "</select></form>";
                    
                
            }
            else if($is_responsabile)
            {
                $queryDip= "SELECT username,reparto FROM Users WHERE ruolo='dipendente' AND reparto='{$_SESSION["reparto"]}'";
                $dipend = $mysqli -> query($queryDip);

                $lista = [];
                foreach($dipend as $v) {
                    foreach($v as $key => $values)
                    {
                        array_push($lista, $values);
                    }
                }

                echo "<form action=\"./update_gestore.php?NC='{$id_nc}'\" method=\"post\"><select name=\"dipend\">";

                for($i=0; $i < sizeof($lista); $i=$i+2)
                {
                    echo "<option value='{$lista[$i]}'>{$lista[$i]} - {$lista[$i+1]}</option>";
                }
                
                echo "<input type=\"submit\" value=\"smista\">";
                echo "</select></form>";
            }
            else
            {
                echo "<form action=\"./update_gestore.php?NC='{$id_nc}'\" method=\"post\">";

                echo "<input type=\"text\" name=\"azioneCorrettiva\" maxlength=255>";
                
                echo "<input type=\"submit\" value=\"chiudi\">";
                echo "</form>";
            }
            //DA FINIRE

        ?>

    
</body>
</html>