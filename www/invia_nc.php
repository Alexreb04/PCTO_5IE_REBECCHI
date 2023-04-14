<?php
    session_start();
    $mysqli = require("conn_db.php");

    //DA FARE INSERT PER MANDARE NC AL DATABASE


    header("Location: ./nc.php");
?>