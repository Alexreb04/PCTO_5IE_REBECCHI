<?php 
    session_start();
    session_regenerate_id();
    if(!isset($_SESSION['username']))
    {
        header("Location: /");
    }  
?>