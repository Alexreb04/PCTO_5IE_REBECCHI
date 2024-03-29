<?php
    require("validate_user.php");
    
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
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HOME PAGE</title>
    <?php if($is_amministratore) : ?>
        <link rel="stylesheet" href="home_page_admin.css">
    <?php elseif (!$is_amministratore): ?>
        <link rel="stylesheet" href="home_page_hp.css">
    <?php endif; ?>
</head>
<body>
    <!-- gestore non conformita -->
    <?php if($is_amministratore) : ?>
        <div class="buttonGrid">
            <div class="button" onclick=""><a href="./lista_nc.php">LISTA NC</a></div>
            <div class="button" onclick="">Button 2</div>
            <div class="button" onclick="">Button 3</div>
            <div class="button" onclick="">Button 4</div>
            <div class="button" onclick=""><a href="./impostazioni_amm/index.php">Impostazioni Amministratore</a></div>
            <div class="button" onclick="">Button 6</div>
        </div>
    <?php elseif (!$is_amministratore): ?>
        <div class="container">
            <div class="buttonGrid">
                <div class="button" onclick=""><a href="./lista_nc.php">LISTA NC</a></div>
                <div class="button" onclick="">Button 2</div>
                <div class="button" onclick="">Button 3</div>
            </div>
            <div class="sottoGriglia">
                <?php if ($is_responsabile): ?>
                    <div class="button largo" onclick="">Button 5</div>
                <?php else: ?>
                    <div class="button largo" onclick=""><a href="./apri_nc.php">APRI NC</a></div>    
                <?php endif; ?>
                <div class="button medio" onclick="">Button 5</div>
            </div>
        </div>
    <?php endif; ?>
    
</body>
</html>