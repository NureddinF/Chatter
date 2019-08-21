<?php
	// starts session
	session_start();
	// check if user is not logged in 
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
				<!-- displays the name of user from session -->
				<h1 class="pt-5 mt-3 text-primary text-center"><?php echo $_SESSION['name']  ?> find people to follow</h1>
			</div>
		</div>
		<!-- form that calls db_AddFollowing php script to capture the check boxes clicked and store into following table -->
		<form method="POST" id="checkBox" action="db_addFollowing.php">
			<div class="row m-3">
				<div class="col-md-12">
					
					<?php
						require "login.php";
						// query to get all names and userids for Users tables
						$sql = "SELECT name,userID FROM Users";
						// selects userid from login table where the username is equal to the current username
						$sql2 = "SELECT login.userID FROM login where username = ?";
						// prepare statement
						$resultCheck = $pdo->prepare($sql2);
						// binds the username value
						$resultCheck->bindValue(1,$_SESSION['username']);
						// executes the query
						$resultCheck->execute();
						// queries the first sql statement
						$result = $pdo->query($sql);


						$row = $resultCheck->fetch();
						// stores the userID
						$thisUserID = $row['userID'];
						// loops through the query associative array
						while($row = $result->fetch()){
							// stores name and id
							$name = $row['name'];
							$id = $row['userID'];
							// checks to make sure not to display the current user
							if($id != $thisUserID){
								// displays the check boxes
								echo "<div class='checkbox p-3 border'>
										<input type='checkbox' name='check_box_list[]' value='$id'><img class='p-3'src='images/userHead.png' alt='userHead'></input>
										<label class='p-3'><h2>$name</h2></label>
									</div>";
							}
						}

					?>
					<button class="btn btn-primary mt-2 float-right" type="submit" name="submit">Next</button>
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