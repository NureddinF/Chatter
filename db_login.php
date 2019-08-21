<?php
		
		session_start();
		// header("Location: index.php");

		require "login.php";
		//gets the name from URL string
		$name = $_GET['value'];

		//checks if it is signup (sign up was clicked)
		if($name == "Sign up"){

			//make sure submit was clicked
			if(isset($_POST['submit'])){

				//stores name and password
				$username = $_POST['username'];

				$password = $_POST['password'];

				//query to insert into login table (NOTE: lOGIN TABLE DOES NOT HAVE A FROEIGN KEY CONTRAINT, USER TABLE NOW HAS THE CONTRAINT)
				$sql1 = "INSERT INTO login (username,password) 
						VALUES (?,?)";
				//executes sql2
				$pdo->exec($sql2);
				//sql2 prepares sql1
				$sql2 = $pdo->prepare($sql1);

				// query to make sure username doesnt already exist
				$result = "SELECT * FROM login WHERE username = ?";
				//prepare and bind value
				$resultCheck = $pdo->prepare($result);
				$resultCheck->bindValue(1,$username);
				$resultCheck->execute();

				//checks row count, if 0 user doesnt exist, user exists otherwise
				if($resultCheck->rowCount() != 0){
					$output = "User already exists";
					header("Location: account.php?value=$name&error=$output");
				}

				else{
					//otherwise, grabs prepared sql2 and binds values and executes
					//has hashed password
					$sql2->execute(array($username,password_hash($password, PASSWORD_DEFAULT)));
					//session variables stored
					$_SESSION['username'] = $username;
					$_SESSION['loggedin'] = "true";
					$_SESSION['firstTimeUser'] = "true";
					//redirects to index
					header("Location: index.php");
					
				}
			}	
		}
		// if login is selected

		if($name == "Login"){

			if(isset($_POST['submit'])){
				//store username and password
				$username = $_POST['username'];

				$password = $_POST['password'];
				//make sure that username and password match
				$result = "SELECT * FROM login WHERE username = ?";
				$resultCheck = $pdo->prepare($result);
				//binds and executes
				$resultCheck->execute(array($username));

				//if no rows return
				if($resultCheck->rowCount() == 0){
					//output binded to url and page redirected back to account page with error message
					$output = "Incorrect username or password";
					header("Location: account.php?value=$name&error=$output");
				}
				//user is found in database
				else{
					//gets the password
					$row = $resultCheck->fetch();
					$hash = $row['password'];
					//if password does not match
					if(password_verify($password,$hash) == false){
						//output error
						$output = "Incorrect username or password";
						//back to account page
						header("Location: account.php?value=$name&error=$output");

					}
					else{
					//other wise, set session variables
					$_SESSION['username'] = $username;
					$_SESSION['loggedin'] = "true";

					//selects 
					$sql = "SELECT login.UserID FROM login WHERE username = ?";

					$resultCheck = $pdo->prepare($sql);
					// binds value for userID
					$resultCheck->bindValue(1,$username);
					//executes query
					$resultCheck->execute();

					$row = $resultCheck->fetch();
					//stores id 
					$id = $row['UserID'];

					//query to check is user does not have a user table entry
					$sql2 = "SELECT COUNT(*) FROM Users WHERE userID = ?";

					$resultCheck = $pdo->prepare($sql2);
					// binds value for username
					$resultCheck->bindValue(1,$userID);

					$resultCheck->execute();
					//check is user is a first time user
					if($resultCheck->rowCount() == 0){
						//sets firsttime user to true 
						$_SESSION['firstTimeUser'] = "true";
					}
					//redirect to header
					header("Location: index.php");
				}
			}	
		}
	}
?>