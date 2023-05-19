<?php
    define("HOST", "10.0.1.252");
	define("USER", "5ie17");
	define("PASSWORD", "5ie17");
	define("DB", "5ie17");
	
	mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
	
	$mysqli = new mysqli(HOST, USER, PASSWORD, DB) or die($mysqli -> connect_error);

    return $mysqli;
?>