<?php

	session_start();

	if($_SESSION["loggedin"] != "true"){
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

		//include the login for the connection to database
		require "login.php";
		//gets all the user info from this page such as mainuser,followingCount,followerCount, and chatsCount
		require "user_info.php";
	?>
	<nav class="navbar navbar-expand-sm bg-info navbar-light">
		<div class="navbar-header">
			<a class="navbar-brand" href="index.php">Chatter</a>
		</div>
		<ul class="navbar-nav">
			<li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
			<li class="nav-item"><a class="nav-link" href="chats.php?Name=<?php   echo $mainUser; ?>">MyChats</a></li>
		</ul>

		<form class="form-inline my-2 ml-auto" action="search.php" method="post" id="searchBar">
			<input class="form-control mr-sm-2" type="text" placeholder="Search..." method="post" name="searchText">
		</form>	
		<button type="button" class="btn btn-white" data-toggle="modal" data-target="#myModal">Chat</button>
		<!-- log out button calls log out php -->
		<button class="btn btn-danger ml-2" onclick="location.href='logout.php'">Log out</button>
	</nav>
	<!-- SEE REFRENCES FOR MODAL WINDOW TUTORIAL I USED -->
	<div class="modal" id="myModal" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">New Chat</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
					<form class="form-inline" method="post" id="textareaForm" action="post.php">
							<textarea class="form-control mr-2" type="input" placeholder="Chat..." rows="3" cols="80" name="textarea"></textarea>
							<div class = "pt-2">
								<button class="btn btn-primary" type="submit" name="textareaButton">Submit</button>
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

	<div class="bg-light">
		<div class="text-center">
			<img src="images/chatterIcon.png" alt="chatter">
			<h1> ... Chatter ... </h1>
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
							<?php
								echo "<h1 class=text-center> $mainUser </h1>"
							?>
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
							<form class="textareaForm form-inline p-3" method="post" id="textareaForm" action="post.php">
								<textarea class="form-control mr-2" type="input" placeholder="Chat..." rows="3" cols="80" name="textarea" id="textarea" required></textarea>
								<button class="btn btn-white" type="submit" id="textareaButton">Submit</input>
							</form>
						</div>
					</div>
					<div class="row bg-light ml-3">
						<div class="col-md-12">
							<h2>New Chats</h2>
							<div class="container" id="content">
								
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<script src="https://code.jquery.com/jquery-3.2.1.min.js">
	</script>
	<script src="js/script.js?newversion"></script>
</body>
<!-- NEEDED FOR MODAL WINDOW SEE REFRENCES FOR TUTORIAL ON MODAL WINDOW I USED -->

<script src="js/bootstrap.min.js"></script>
</html>