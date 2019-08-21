<?php
	
	session_start();

	require "login.php";
	//needs this to get the userID
	require "user_info.php";

	//checks if user clicks submit button
	if(isset($_POST['submit'])){
		
		//checks no check boxes were selected

		if(!empty($_POST['check_box_list'])){
			// loops through checks boxes
			foreach($_POST['check_box_list'] as $selected){
				// inserts each user that was selected to following table
				$sql = "INSERT into Following (User, FollowingUser) VALUES (?,?)";

				$resultCheck = $pdo->prepare($sql);
				//binds values and executes query
				$resultCheck->execute(array($userID,$selected));


			}
		}
		// sets firstTimeUser to false
		$_SESSION['firstTimeUser'] = "false";
		// redirects to index
		header("Location: index.php");

	}

		?>
