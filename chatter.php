<?php

	session_start();
	//checks if login is true and redirects to index
	if($_SESSION["loggedin"] == "true"){
		header("location:index.php");
		exit;
	}
	//checks if firstTime User is true and redirects to profile page
	if($_SESSION["firstTimeUser"] == "true"){
		header("Location: profile.php");
		exit;
	}

	require "login.php";

?>
<!DOCTYPE html>
<html lang='en'>
<head>
	<meta charset="utf-8">
	<title>Chatter</title>
	<meta name="viewport" content="width=device-width, initial-scale= 1">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/style.css">
</head>

<body>

	<nav class="bg-info p-3">
		<h1 class="text-center"> Welcome to Chatter</h1>
		<!-- <h2> Chit Chat for all</h2> -->

	</nav>
<div class="bg-light h-100 pb-5">
	<div class="container w-25 pt-5">
		<div class="row text-center">
			<div class="col-md-12">
				<img src="images/chatterIcon.png" alt="chatter">
			</div>
			<div class="col-md-12">
				<h3 class= "text-primary"> Join Chatter Today.</h3>
			</div>

		</div>
		<div class="row text-center m-3">
				<div class="col-md-12">
					<!-- buttons to pick sign up and sends sign up in url string -->
					<form method="post" action="account.php?value=Sign up">
						<button class="btn btn-primary btn-block" type="submit">Sign up</button>	
					</form>
				</div>
			</div>
		<div class="row text-center m-3 pb-5">
			<div class="col-md-12 pb-5">
				<!-- buttons to pick login and sends login in url string -->
				<form method="post" action="account.php?value=Login">
					<button class="btn btn-secondary btn-block" type="submit">Login</button>
				</form>
			</div>
		</div>
	</div>
</div>
	<footer class="bg-info block-inline p-3 mb-2">
		<p> &copy 2018 Nureddin Farhat, All Rights Reserved.</p>

	</footer>

</body>
</html>