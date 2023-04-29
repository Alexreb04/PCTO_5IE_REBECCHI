<?php
    require("../validate_user.php");
    $mysqli = require("../conn_db.php");

    $queryUtente = "UPDATE Users
    SET username='{$_GET['username']}', passwd='{$_GET['passwd']}', ruolo='{$_GET['ruolo']}', reparto='{$_GET['reparto']}' 
    WHERE username='{$_GET['usernameDaModificare']}' ";

    $resultUtente = $mysqli -> query($queryUtente);

    echo $queryUtente;
    var_dump($resultUtente);
?>