<?php
    session_start();

    $mysqli = require("conn_db.php");

    //prendo il nome dello user che crea la nc per metterlo poi nell'INSERT che farò
    $creatore = $_SESSION["creatore"];

   /* $queryAux = 'SELECT R.IDAUT
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
    
    session_destroy();*/
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INSERISCI NC</title>
    
</head>
<body>

    <form action="invia_nc.php" method="post">
        <label>TIPO </label>
        <input type="text" name="tipo"  required>
        <br>
        <label>TITOLO </label>
        <input type="text" name="titolo"  required>
        <br>
        <label>DESCRIZIONE </label>
        <input type="text" name="descrizione"  required>
        <br>
        <input type="submit" name="submit" value="Submit">  
    </form>

    
    
    
</body>
</html>