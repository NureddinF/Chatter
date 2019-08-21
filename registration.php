<?php

	session_start();

	require "login.php";
	//gets username from session variable
	$username = $_SESSION['username'];

	//query to get userID from login whee the username is equal to session username
	$sql= "SELECT UserID FROM login where username = ?";
	//prepare statment for query
	$resultCheck = $pdo->prepare($sql);

	$resultCheck->bindValue(1,$username);
	$resultCheck->execute();

	//second query to insert the users info into users table (NOTE: USER TABLE HAS BEEN CHANGED)
	$sql2 = "INSERT INTO Users (userID,name,profile) Values(?,?,?)";

	//Storing the data that needs to be placed into database
	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
	$fullname = $firstname." ".$lastname;
	$profile = $_POST['textareaProfile'];
	//uses the first query and stores array into row var
	$row = $resultCheck->fetch();
	//stored the is from row associative array
	$id= $row["UserID"];

	//storing into database using prepare statments
	$pdo->exec($sql3);
	$sql3 = $pdo->prepare($sql2); 
	$sql3->execute(array($id,$fullname,$profile));

	//stores fullname to session name variable

	$_SESSION["name"] = $fullname;

	//redirects to findPeople page
	header("Location: findPeople.php");




?>