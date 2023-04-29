<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aggiungi Utente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>

<?php
    if(isset($_GET["error_status"]) == "success")
	{
		echo "<div style=\"background-color:green; color: white\">Utente inserito Correttamente</div>";
	}
    else if(isset($_GET["error_status"]) == "error")
    {
        echo "<div style=\"background-color:red; color: black\">Errore nell'inserimento dell'utente</div>";
    }

    require("../validate_user.php");
    $mysqli = require("../conn_db.php");

    $queryRuolo = "SELECT R.nome
    FROM Ruolo R";

    $queryReparto = "SELECT Rep.nome
    FROM Reparto Rep";

    $resRuolo = $mysqli -> query($queryRuolo);
    $resReparto = $mysqli -> query($queryReparto);


    $stringa = "<form action=\"#\">";
    $stringa .= "<table class=\"table\"><thead><tr>";
    
    $resultRuolo = [];
    $resultReparto = [];

    foreach ($resRuolo as $v) {
        foreach($v as $key => $value) {
            array_push($resultRuolo, $value);
        }
    }

    foreach ($resReparto as $v) {
        foreach($v as $key => $value) {
            array_push($resultReparto, $value);
        }
    }


    $stringa .= "<th scope=\"col\">username</th><th scope=\"col\">passwd</th><th scope=\"col\">ruolo</th><th scope=\"col\">reparto</th>"; 

    $stringa .= "</tr></thead><tbody><tr>";

    $stringa .= "<td><input type=\"text\" id=\"username\" name=\"username\"></td>";
    $stringa .= "<td><input type=\"password\" id=\"passwd\" name=\"password\"></td>";

    $stringa .= "<td><select name=\"ruolo\" id=\"ruolo\">";
    foreach($resultRuolo as $ruolo) {
            $stringa .=  "<option value=\"$ruolo\">$ruolo</option>";
    }

    $stringa .= "</select></td>";
        
    $stringa .= "<td><select name=\"reparto\" id=\"reparto\">";
    foreach($resultReparto as $reparto) {
        $stringa .=  "<option value=\"$reparto\">$reparto</option>";
    }

    $stringa .= "</select></td>";

    $stringa .= "</tr></tbody></table>";

    $stringa .= "<button id=\"submit\" type=\"button\" class=\"btn btn-primary\" data-toggle=\"button\" aria-pressed=\"false\" autocomplete=\"off\">Crea Utente</button></form>";
    echo $stringa;
?>

<script>
		document.getElementById("submit").addEventListener("click", postRequest);

		function postRequest(event)
		{
			event.preventDefault();
			const text = document.getElementById("passwd").value;
			
			async function digestMessage(message) {
			  const msgUint8 = new TextEncoder().encode(message); // encode as (utf-8) Uint8Array
			  const hashBuffer = await crypto.subtle.digest("SHA-256", msgUint8); // hash the message
			  const hashArray = Array.from(new Uint8Array(hashBuffer)); // convert buffer to byte array
			  const hashHex = hashArray
				.map((b) => b.toString(16).padStart(2, "0"))
				.join(""); // convert bytes to hex string
			  return hashHex;
			}
			
			digestMessage(text).then((digestHex) => {
				let username = document.getElementById("username").value;
                let ruolo = document.getElementById("ruolo").value;
                let reparto = document.getElementById("reparto").value;
				window.location.replace(`./manda_aggiungi_utente.php?username=${username}&passwd=${digestHex}&ruolo=${ruolo}&reparto=${reparto}`);
			})
	  }
    </script>
</body>
</html>