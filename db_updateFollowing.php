<?php
	// THIS PAGE WAS MADE TO SEPERATE SOME OF THE PHP FROM THE HTML
	session_start();

	require "login.php";
	require "user_info.php";

	//gets the name from the URL
	$name = $_GET['Name'];
	// find the id of the name, and the profile
	$sql = "SELECT id, profile FROM Users WHERE name = ?";
	//prepare statement
	$resultCheck = $pdo->prepare($sql);
	// binds value for name
	$resultCheck->bindValue(1,$name);

	$resultCheck->execute();
	
	$row = $resultCheck->fetch();
	// stores the id an profile to be used later
	$id = $row['id'];
	//checks if follow button was clicked
	if(isset($_POST['followButton'])){
		//insert into following 
		$sql = "INSERT into Following (User,FollowingUser) VALUES (?,?)";
		//prepare statement
		$resultCheck = $pdo->prepare($sql);
		//binds value and executes query
		$resultCheck->execute(array($userID, $id));
		//back to page to refresh and remove follow button
		header("Location: chats.php?Name=$_GET[Name]");
	}

?>