<?php
	session_start();
	// for database connectiong
	require "login.php";
	require "user_info.php";

	// insert posts created into posts table

	// if(isset($_POST['textareaButton'])){

			if(isset($_POST['textarea'])){
				// retrieves the post
				$post = $_POST['textarea'];
				// inserts it into post
				$sql = "INSERT INTO Posts (UserID,post) VALUES (?,?)";
				//prepare statment
				$resultCheck = $pdo->prepare($sql);
				//executes and binds values to query
				$resultCheck->execute(array($userID,$post));
			}
		// }
			header("location: index.php");

?>