<?php
	session_start();

	if($_SESSION['loggedin'] != "true"){
		header("Location: chatter.php");
		exit;
	}

	if($_SESSION["firstTimeUser"] == "true"){
		header("Location: profile.php");
		exit;
	}


?>


<!DOCTYPE html>
<html lang ="en">
<head>
	<meta charset="utf-8">
	<title>Chatter</title>
	<meta name="viewport" content="width=device-width, initial-scale= 1">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/style.css">
</head>

<body>
	<?php
		//inclused the login for the connection to database
		require "login.php";
		//includes the post to save the posts to the database
		include "post.php";

	?>
	<nav class="navbar navbar-expand-sm bg-info navbar-light">
		<div class="navbar-header">
			<a class="navbar-brand" href="index.php">Chatter</a>
		</div>
		<ul class="navbar-nav">
			<li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
			<li class="nav-item"><a class="nav-link" href="chats.php?Name=<?php   echo $mainUser;?>">MyChats</a></li>
		</ul>
		<form class="form-inline my-2 ml-auto" method="post" id="searchBar" action="search.php">
			<input class="form-control mr-sm-2" type="text" placeholder="Search..." method="post" name="searchText">
		</form>	
		<!-- SEE REFRENCES FOR MODAL WINDOW TUTORIAL I USED -->
		<button type="button" class="btn btn-white" data-toggle="modal" data-target="#myModal">Chat</button>
		<button class="btn btn-danger ml-2" onclick="location.href= 'logout.php'">Log out</button>
	</nav>

	<div class="modal" id="myModal" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">New Chat</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
					<!-- Same form used for saving posts -->
					<form class="form-inline" method="post" id="textareaForm">
							<textarea class="form-control mr-2" type="input" placeholder="Chat..." rows="3" cols="80" name="textarea"></textarea>
							<div class = "pt-2">
								<button class="btn btn-primary " type="submit" name="textareaButton">Submit</button>
							</div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="close" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>
	<!-- MODAL WINDOW -->

	<div class="bg-light ">
		<div class="text-center">
			<img src="images/chatterIcon.png" alt="chatter">
			<h1> ... Chatter ...</h1>
			<h2> Chit Chat for all</h2>
		</div>

	</div>

	<section>
		<div class="container-fluid m-2">
			<div class="row mr-2">
				<div class="col-md-4">
					<div class="row bg-info">
						<div class="col-md-2">
							<img src="images/userHead.png" alt="userHead">
						</div>
						<div class="col-md-10">
							<h1 class="text-center"><?php echo $mainUser; ?></h1>
						</div>
					</div>
					<div class="row bg-light p-3">
						<div class="col-md-8">
							<?php
								echo '<h4><a href="chats.php?Name='.$mainUser.'">Chats</a></h4>';
								echo '<h4><a href="follow.php?Page=Followers& Name='.$mainUser.'">Followers</a></h4>';
								echo '<h4><a href="follow.php?Page=Following& Name='.$mainUser.'">Following</a></h4>'; 

							?>
						</div>
						<div class="col-md-4 text-right">
							<?php
								echo '<h4><a href="chats.php?Name='.$mainUser.'">'.$chatsCount.'</a></h4>';
								echo '<h4><a href="follow.php?Page=Followers& Name='.$mainUser.'">'.$followerCount.'</a></h4>';
								echo '<h4><a href="follow.php?Page=Following& Name='.$mainUser.'">'.$followingCount.'</a></h4>'; 
							?>
						</div>
					</div>
				</div>
 
				<div class="col-md-8">
					<div class="row bg-info ml-3">
						<div class="col-md-12">
							<form class="form-inline p-3" method="post" id="textareaForm">
								<textarea class="form-control mr-2" type="input" placeholder="Chat..." rows="3" cols="80" name="textarea"></textarea>
								<button class="btn btn-white" type="submit" name="textareaButton">Submit</button>
							</form>
						</div>
					
					</div>
					<div class="row bg-light ml-3">
						<div class="col-md-12">
							<?php
							// prints the search word
								echo "<h2>".$_POST['searchText']."</h2>";
							?>
							
					<div class="container">

						<?php
						// Searches the post table and prints the results
							if(isset($_POST['searchText'])){
									
								$search = $_POST['searchText'];

								// query to find the posts the are like the search word
								$sql = "SELECT Posts.UserID, post, Users.name, Posts.date FROM Posts, Users WHERE post like ? AND Users.userID = Posts.UserID";
								
								//prepare sql with search term
								$resultCheck = $pdo->prepare($sql);
								// binds value for search
								$resultCheck->bindValue(1,$search);
								// executes query
								$resultCheck->execute();
								
								// Loop to go through the results
								while($row = $resultCheck->fetch()){
									//stores the values in name,post, and date
									$name = $row['name'];
									$post = $row['post'];
									$date = $row['date'];

									// prints the results
									echo "<div class='row p-3'>
											<div class='col-md-2'>
											<img src='images/userHead.png' alt='userHead'>
											</div>
											<div class='col-md-8'>
											<h5 id='username'><a href='chats.php?Name=$name'>$name</a></h5>
											<p>$post</p>
											<h6>$date</h6>
											</div>
											</div>";
								}
							}
						?>
					</div>
				</div>
			</div>
		</div>
	</section>
</body>
<!-- NEEDED FOR MODAL WINDOW SEE REFRENCES FOR TUTORIAL ON MODAL WINDOW I USED -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
	</script>

<script src="js/bootstrap.min.js"></script>
</html>