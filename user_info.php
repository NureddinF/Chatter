<?php
	// THIS PAGE WAS MADE TO MINIMIZE CODE REDUNDANCY
	session_start();

	require "login.php";

	//query to select userid from login table where the username is equal to session username

	$sql2 = "SELECT login.userID FROM login where username = ?";
		// prepare statement
		$resultCheck = $pdo->prepare($sql2);
		// binds value for username
		$resultCheck->bindValue(1,$_SESSION['username']);

		$resultCheck->execute();
		// gets associative array from query result
		$row = $resultCheck->fetch();
		// stores userID from login table
		$userID = $row['userID'];


		//gets the name of the user
		$sql1 = "SELECT name FROM Users WHERE id = ?";

		$resultCheck = $pdo->prepare($sql1);
		// binds value for username
		$resultCheck->bindValue(1,$userID);

		$resultCheck->execute();

		//Account holder name saved here
		$mainUser = $resultCheck->fetchColumn();
	

		//Count for number of chats
 		$sql3 = "SELECT COUNT(*) FROM Posts where UserID= ?";

 		$resultCheck = $pdo->prepare($sql3);
		// binds value for username
		$resultCheck->bindValue(1,$userID);

		$resultCheck->execute();

		$chatsCount = $resultCheck->fetchColumn();
		
 		//Count for number followers
 		$sql4 = "SELECT COUNT(*) FROM Following WHERE User = ?";
 		
 		$resultCheck = $pdo->prepare($sql4);
		// binds value for username
		$resultCheck->bindValue(1,$userID);

		$resultCheck->execute();

		$followingCount = $resultCheck->fetchColumn();

 		//Count for number of following
 		$sql5 = "SELECT COUNT(*) FROM Following WHERE FollowingUser = ?";
 		
 		$resultCheck = $pdo->prepare($sql5);
		// binds value for userid
		$resultCheck->bindValue(1,$userID);

		$resultCheck->execute();

		$followerCount = $resultCheck->fetchColumn();




?>