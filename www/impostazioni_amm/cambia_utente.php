<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aggiorna Utente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
<?php
    require("../validate_user.php");
    $mysqli = require("../conn_db.php");

    $username = $_GET["username"];

    $queryUtente = "SELECT *
    FROM Users
    WHERE Users.username=\"{$username}\"";

    $resultUtente = $mysqli -> query($queryUtente);
    $passwordVecchia = "";
    $stringa = "<form action=\"#\">";
    $stringa .= "<table class=\"table\"><thead><tr>";
    foreach($resultUtente as $v){
        foreach($v as $key => $value) {
            $stringa .= "<th scope=\"col\">$key</th>"; 
        }

        $stringa .= "</tr></thead><tbody><tr>";

        foreach($v as $key => $value) {
            if($key == "passwd") {
                $stringa .= "<td><input type=\"text\" id=\"$key\" name=\"$key\"></td>";
                $passwordVecchia = $value;
            }
            else
                $stringa .= "<td><input type=\"text\" id=\"$key\" name=\"$key\" value=$value></td>";
        }

        $stringa .= "</tr></tbody></table>";
    }

    $stringa .= "<button id=\"submit\" type=\"button\" class=\"btn btn-primary\" data-toggle=\"button\" aria-pressed=\"false\" autocomplete=\"off\">Update</button></form>";
    echo $stringa;
?>
</body>

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
                let passwordV = <?php echo $passwordVecchia; ?>;
                if (text === )
                {
                    digestHex = passwordV
                }

				let username = document.getElementById("username").value;
                let ruolo = document.getElementById("ruolo").value;
                let reparto = document.getElementById("reparto").value;
				window.location.replace(`./manda_update.php?username=${username}&passwd=${digestHex}&ruolo=${ruolo}&reparto=${reparto}&usernameDaModificare=<?php echo $username; ?>`);
			})
	  }
</script>

</html>