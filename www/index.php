<?php
	session_start();
	session_regenerate_id();
	if(isset($_SESSION['username']))
	{
		header("Location: home_page.php");
	}

	if(isset($_GET["error"]))
	{
		echo "<div style=\"background-color:red; color: black\">Errore nel login</div>";
	}
?>

<!doctype html>
<html lang="en">
  <head>
  	<title>Login ConformZone</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<link rel="stylesheet" href="css/style.css">

	</head>
	<body>
	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
			</div>
			<div class="row justify-content-center">
				<div class="col-md-12 col-lg-10">
					<div class="wrap d-md-flex">
						<div class="img" style="background-image: url(logo.jpg);">
			      </div>
						<div class="login-wrap p-4 p-md-5">
			      	<div class="d-flex">
			      		<div class="w-100">
			      			<h3 class="mb-4">Log In</h3>
			      		</div>
								
			      	</div>
							<form action="#" class="signin-form">
			      		<div class="form-group mb-3">
			      			<label class="label" for="name">Username</label>
			      			<input type="text" class="form-control" placeholder="Username" id="username" name="username" required>
			      		</div>
		            <div class="form-group mb-3">
		            	<label class="label" for="password">Password</label>
		              <input type="password" id="password" class="form-control" placeholder="Password" name="password" required>
		            </div>
		            <div class="form-group">
		            	<button id="submit" class="form-control btn btn-primary rounded submit px-3">Accedi</button>
		            </div>
		           
		          </form>
		        </div>
		      </div>
				</div>
			</div>
		</div>
	</section>

	<script>
		document.getElementById("submit").addEventListener("click", postRequest);

		function postRequest(event)
		{
			event.preventDefault();
			const text = document.getElementById("password").value;
			
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
				window.location.replace(`./raccolta.php?username=${username}&password=${digestHex}`);
			})
	  }
	</script>

	
	</body>
</html>
