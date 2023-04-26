<?php
    session_start();

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
        $queryLista = 'SELECT titolo,nome AS tipo,dataInizio,StatoGenerale,StatoReparto FROM NC JOIN Tipo ON(NC.tipo=Tipo.idt)';
    }
    else
    {
        $user_corrente = htmlspecialchars($_SESSION["username"]);
        $queryLista = "SELECT titolo,nome AS tipo,dataInizio,StatoReparto AS Stato FROM NC JOIN Tipo ON(NC.tipo=Tipo.idt) WHERE risolutore = '{$user_corrente}'";
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
    <!--<?php if($is_amministratore) : ?>
        <link rel="stylesheet" href=".css">
    <?php elseif (!$is_amministratore): ?>
        <link rel="stylesheet" href=".css">
    <?php endif; ?>-->
</head>
<body>
    <table>        
            <?php

                $num_titoli=0;
                //TITOLI
                foreach($titoli as $v){
                    echo "<tr>";
                    foreach($v as $key => $value) {
                        echo "<th>".$key."</th>";
                        $num_titoli++;
                    }
                    echo "</tr>";
                }
            ?>
            <?php
                $cursore=0;
                //RECORD
                for ($i = 0; $i < sizeof($lista)/$num_titoli; $i++) {
                    echo "<tr>";
                    for($j=0; $j < $num_titoli; $j++)
                    {   
                        echo "<td>".$lista[$cursore]."</td>";
                        $cursore++;
                    }
                    echo "</tr>";
                }     
            ?>
    </table>
    
</body>
</html>