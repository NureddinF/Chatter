<?php

	session_start();
	//check if they are logged in to make sure someone who already is logged in cant force themselves back to login page
	if($_SESSION["loggedin"] == "true"){
		header("location:index.php");
		exit;
	}
	//checks if a user is logged in and is a firstTime User cant come back to this page and sends them to profile page
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
	<?php
		// require "db_login.php";
	?>

	<nav class="bg-info p-3">
		<h1 class="text-center"> Welcome to Chatter</h1>

		<!-- <h2> Chit Chat for all</h2> -->

	</nav>
<div class="bg-light h-100 pb-5">
	<div class="container w-25 pb-5 pt-5">
		<div class="row text-center">
			<div class="col-md-12">
				<img src="images/chatterIcon.png" alt="chatter">
			</div>
			<div class="col-md-12">
				<!-- url string to print if they are on sign on or log in page -->
				<h3 class= "text-primary"> <?php echo $_GET['value']; ?></h3>
			</div>

		</div>
		<?php
		// form that that calls db_login that handles the insert to login table, has a query string to return any erros that occur during login
		//also calls validate javascript to validate the paswoord length, has a number and ensure the fields arent empty
			echo '<form method="post" action="db_login.php?value='.$_GET['value'].'" id="submitForm" onsubmit = "return validateForm();">';
		?>
		<div class="row text-center m-3">
				<div class="col-md-12">
					<input type="text" maxlength="32" name="username" id="username" placeholder="username">
					<div id="usernameError" class="error mt-3"></div>
				</div>
		</div>
		<div class="row text-center m-3">
			<div class="col-md-12">
				<input type="password" maxlength="32" name="password" id="password" placeholder="password">
				<div id="passwordError" class="error mt-3"></div>
			</div>
		</div>
		<div class="row text-center m-3 pb-3">
			<div class="col-md-12">
				<button class="btn-primary" type="submit" name="submit">Submit</button>
				<!-- if an error recieved from the database gets printed here -->
				<div class="error mt-3" id=error> <?php echo $_GET['error'];?></div>
				<div class="error mt-3" id="passwordRules"></div>
			</div>
		</div>
		</form>
	</div>
</div>
	<footer class="bg-info block-inline p-3 mb-2">
		<p> &copy 2018 Nureddin Farhat, All Rights Reserved.</p>

	</footer>
	<!-- javascript to validate -->
	<script src="js/validate.js?newversion2"></script>
</body>
</html>