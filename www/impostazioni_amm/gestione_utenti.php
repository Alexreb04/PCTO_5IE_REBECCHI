<?php
    require("../validate_user.php");

    $mysqli = require("../conn_db.php");

    $queryUtenti = "SELECT username
    FROM Users";

    $resultUtenti = $mysqli -> query($queryUtenti);

    $stringa = "<ul>";
	foreach($resultUtenti as $v){
		foreach($v as $key => $value) {
            $stringa .= "<a href=\"cambia_utente.php?username={$value}\"><li>$value</li></a>";
		}
	}
    $stringa .= "<a href=\"aggiungi_utente.php\"><li>AGGIUNGI UTENTE</li></a>";
    $stringa .= "</ul>";

    $stringa .=  "<a href=\"index.php\">Vai indietro</a>";
    echo $stringa;
?>