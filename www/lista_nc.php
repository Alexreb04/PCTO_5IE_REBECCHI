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
        $queryLista = 'SELECT IDNC AS COD_NC,titolo,Tipo.nome AS tipo,dataInizio,Stato.nome AS StatoGenerale,Stato.nome AS StatoReparto FROM NC JOIN Tipo ON (NC.tipo=Tipo.idt) JOIN Stato ON (Stato.idst=NC.statoGenerale) AND (Stato.idst=NC.statoReparto)';
    }
    else
    {
        $user_corrente = htmlspecialchars($_SESSION["username"]);
        $queryLista = "SELECT IDNC AS COD_NC,titolo,Tipo.nome AS tipo,dataInizio,Stato.nome AS StatoReparto FROM NC JOIN Tipo ON(NC.tipo=Tipo.idt) JOIN Stato ON (Stato.idst=NC.statoReparto) WHERE risolutore = '{$user_corrente}'";
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
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LISTA NC</title>
    <link rel="stylesheet" href="lista_nc.css">
</head>
<body>
        <table cellspacing="0" cellpadding="0">
            <?php

                    $num_titoli=0;
                    //TITOLI
                    if($titoli!=false)
                    {
                        foreach($titoli as $v){
                            echo "<tr>";
                            foreach($v as $key => $value) {
                                echo "<th>".$key."</th>";
                                $num_titoli++;
                            }
                            echo "</tr>";
                        }
                    }
                    
                ?>
                <?php
                    $cursore=0;
                    $stringa = "";
                    $link = "";
                    //RECORD
                    if($num_titoli!=0)
                    {
                        
                        for ($i = 0; $i < sizeof($lista)/$num_titoli; $i++) {
                            $stringa = "<tr>";
                            for($j=0; $j < $num_titoli; $j++)
                            {   
                                if($j == 0)
                                {
                                    $link = "<a href=\"./gestione_nc.php?NC=" . $lista[$cursore] . "\">";
                                }

                                $stringa .= "<td>". $link . $lista[$cursore] . "</td>";
                                $cursore++;
                                
                            }
                            $stringa .= "</tr></a>";
                            echo $stringa;
                        }  
                    }
                    else{
                        echo "Non hai NC da visualizzare";
                    }    
                ?>
        </table>

        
</body>
</html>