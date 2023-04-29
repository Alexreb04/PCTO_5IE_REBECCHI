<?php
    require("validate_user.php");

    $mysqli = require("conn_db.php");

    $ruolo = $_SESSION["ruolo"];

    $queryAux = 'SELECT R.IDAUT
    FROM RuoloValore as R
    WHERE R.ruolo = "'.$ruolo.'"';

    $result = $mysqli -> query($queryAux);

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
        $queryLista = 'SELECT IDNC AS COD_NC,titolo,nome AS tipo,dataInizio,StatoGenerale,StatoReparto FROM NC JOIN Tipo ON(NC.tipo=Tipo.idt)';
    }
    else
    {
        $user_corrente = htmlspecialchars($_SESSION["username"]);
        $queryLista = "SELECT IDNC AS COD_NC,titolo,nome AS tipo,dataInizio,StatoReparto AS Stato FROM NC JOIN Tipo ON(NC.tipo=Tipo.idt) WHERE risolutore = '{$user_corrente}'";
    }
   
    $queryTitoli = $queryLista . 'LIMIT 1';
    $titoli = $mysqli -> query($queryTitoli);

    $nc = $mysqli -> query($queryLista);

    $lista = [];
    foreach($nc as $v) {
        foreach($v as $key => $values)
        {
            array_push($lista, $values);
        }
    }
    
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
    <!--<?php if($is_amministratore) : ?>-->
        <link rel="stylesheet" href="lista_nc.css">
    <!--<?php elseif (!$is_amministratore): ?>
        <link rel="stylesheet" href=".css">
    <?php endif; ?>-->
</head>
<body>
           
           <?php

                $num_titoli=0;
                //TITOLI
                foreach($titoli as $v){
                    foreach($v as $key => $value) {
                        $num_titoli++;
                    }
                }
            ?>
        <ul>
            <?php
                $cursore=0;
                $stringa = "";
                //RECORD
                if($num_titoli==0)
                {
                    echo "Non hai NC da visualizzare";
                }
                else
                {
                    for ($i = 0; $i < sizeof($lista)/$num_titoli; $i++) {
                        $stringa = "<li><a href=\"./gestione_nc.php?NC=";
                        for($j=0; $j < $num_titoli; $j++)
                        {   
                            if($j == 0)
                            {
                                $stringa .= $lista[$cursore] . "\">";
                            }
                            $stringa .= $lista[$cursore] . " ";
                            $cursore++;
                        }
                        $stringa .= "</a></li>";
                        echo $stringa;
                    }  
                }
                   
            ?>
        </ul>
    
</body>
</html>