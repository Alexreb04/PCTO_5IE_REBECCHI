<?php
    session_start();

    $mysqli = require("conn_db.php");

    //prendo il nome dello user che crea la nc per metterlo poi nell'INSERT che farò

    $queryTipo = 'SELECT *
    FROM Tipo as T';

    $result = $mysqli -> query($queryTipo);

    foreach($result as $v) {
        foreach($v as $key => $value) {
            echo "$key $value\n"; 
        }
    }     
    
    session_destroy();
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
        <!--
        <select name="tipo">
            <?php foreach($result as $v) {
                    foreach($v as $key => $value) {
                        echo "htmlspecialchars(<option value=\"$value\">$value</option>)";
                    }
                }      
            ?>  
        </select>
            -->
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