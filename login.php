<?php
		session_start();

		try{	
			//connection created throug pdo object 
			$pdo = new PDO('mysql:host=localhost;dbname=Chat','root','root');
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			$sql6 = "CREATE TABLE IF NOT EXISTS login(
 					UserID INT(4) NOT NULL AUTO_INCREMENT PRIMARY KEY,
 					username VARCHAR(255) NOT NULL,
 					password VARCHAR(255) NOT NULL)";

 			$pdo->exec($sql6);
			
			// query for table Users
			$sql = "CREATE TABLE IF NOT EXISTS Users(
 					id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
 					userID INT(11) NOT NULL,
 					name VARCHAR(100) NOT NULL,
 					profile TEXT NOT NULL,
 					FOREIGN KEY (userID) REFERENCES login(UserID))";
			
			$pdo->exec($sql);

			// query for table Posts

			$sql2 = "CREATE TABLE IF NOT EXISTS Posts(
 					PostID INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
 					UserID INT(11) NOT NULL,
 					date timestamp default current_Timestamp on update current_Timestamp NOT NULL,
 					post TEXT NOT NULL,
 					FOREIGN KEY (UserID) REFERENCES Users(userID))";

 			$pdo->exec($sql2);

 			// query for table following 

 			$sql3 = "CREATE TABLE IF NOT EXISTS Following(
 					FollowingID INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
 					User INT(11) NOT NULL,
 					FollowingUser INT(11) NOT NULL,
 					FOREIGN KEY (User) REFERENCES Users(userID),
 					FOREIGN KEY (FollowingUser) REFERENCES Users(userID))";

 			$pdo->exec($sql3);


		}	
		catch(PDOException $e){
			// if connection cannot be established prints and error
			echo"DB not connected";
			exit();
		}
?>