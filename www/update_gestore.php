
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

    $update = "UPDATE NC SET risolutore='{$_POST['resp']}' WHERE IDNC={$_GET['NC']}";
    echo $update;
    $up = $mysqli -> query($update);

    header("Location: ./lista_nc.php");
?>