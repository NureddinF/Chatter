<?php

	session_start();

	//make sure user is not alreasy logged in
	if($_SESSION["loggedin"] != "true"){
		header("location:chatter.php");
		exit;
	}
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

	</nav>
	<div class="bg-light h-100 pb-5">
	<div class="container">
		<div class="row text-left">
			<div class="col-md-2">
				<img src="images/chatterIcon.png" alt="chatter">
			</div>
			<div class="col-md-10">
				<!-- prints user name of current user from session -->
				<h1 class="pt-5 mt-3 text-primary">Welcome <?php echo $_SESSION['username']  ?>! Please fill in the following.</h1>
			</div>
		</div>	
		<!-- calls registration php script to insert into database -->
	<form method="post" action="registration.php" id="submitForm">
		<div class="row m-3">
			<!-- first name field -->
				<div class="col-md-12">
					<label class="pr-3"><b>First Name</b></label>
					<input type="text" maxlength="32" name="firstname" id="firstname" required>
					<div id="firstnameError" class="error"></div>
				</div>
		</div>
		<div class="row m-3">
			<!-- last name field -->
			<div class="col-md-12">
				<label class="pr-3"><b>Last Name</b></label>
				<input class= "block-inline" type="text" maxlength="32" name="lastname" id="lastname" required>
			</div>
		</div>
		<div class="row m-3">
			<!-- bio field -->
			<div class="col-md-12">
				<label><b>Tell us about yourself</b></label>
				<textarea class="form-control mr-2" type="input" rows="3" cols="80" name="textareaProfile" id="textareaProfile" required></textarea>
			</div>
		</div>
		<div class="row text-center m-3 pb-3">
			<div class="col-md-12">
				<button class="btn-primary" type="submit" name="submit">Next</button>
			</div>
		</div>
	</form>
	</div>
</div>

	<footer class="bg-info block-inline p-3 mb-2">
		<p> &copy 2018 Nureddin Farhat, All Rights Reserved.</p>

	</footer>

</body>

</html>