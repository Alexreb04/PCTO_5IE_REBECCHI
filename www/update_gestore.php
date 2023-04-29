
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

    if($is_amministratore)
    {
        $update = "UPDATE NC SET risolutore='{$_POST['resp']}' WHERE IDNC={$_GET['NC']}";
    
    }
    else if($is_responsabile)
    {
        $update = "UPDATE NC SET risolutore='{$_POST['dipend']}' WHERE IDNC={$_GET['NC']}";   
    }
    else
    {
        $update = "UPDATE NC SET statoGenerale=3, statoReparto=3, azioneCorrettiva=\"{$_POST['azioneCorrettiva']}\" WHERE IDNC={$_GET['NC']}";
    }

    $up = $mysqli -> query($update);
    var_dump($up);

    //header("Location: ./lista_nc.php");
?>