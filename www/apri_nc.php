<?php
    require("validate_user.php");

    if(isset($_GET["error_status"]) == "success")
	{
		echo "<div style=\"background-color:green; color: white\">NC Inserita Correttamente</div>";
	}
    else if(isset($_GET["error_status"]) == "error")
    {
        echo "<div style=\"background-color:red; color: black\">Errore nell'inserimento della NC</div>";
    }

    $mysqli = require("conn_db.php");

    $queryTipo = 'SELECT *
    FROM Tipo as T';

    $result = $mysqli -> query($queryTipo);
    $lista = [];
    foreach($result as $v) {
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
    <title>INSERISCI NC</title>
    
</head>
<body>

    <form action="invia_nc.php" method="post">
        <select name="tipo">
            <?php 
                for ($i = 1; $i < sizeof($lista); $i+=2) {
                    $indice = $lista[$i - 1];
                    echo "htmlspecialchars(<option value=\"$indice\">$lista[$i]</option>)";
                 }     
            ?>  
        </select>
        
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