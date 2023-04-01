<?php
	$mysqli = require("conn_db.php");
	$user = htmlspecialchars($_GET["username"]);
	$passwd = htmlspecialchars($_GET["password"]);

	$query = 'SELECT *
	FROM Users U
	WHERE U.username = "'.$user.'" AND U.passwd = "'.$passwd.'"';


	$result = $mysqli -> query($query);

	session_start();

	if($result -> num_rows === 0)
	{
		header("Location: index.php?error=\"errore_nel_login\"");
		exit;
	}
	else 
	{
		foreach($result as $v){
			foreach($v as $key => $value) {
				$_SESSION += [ 
					$key => $value
				];
			}
		}
		header("Location: home_page.php");
	}
?>
