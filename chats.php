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
		require "user_info.php";

		//gets the name from the URL
		$name = $_GET['Name'];
		// find the id of the name, and the profile
		$sql = "SELECT id, profile FROM Users WHERE name = '$name'";
		$result = $pdo->query($sql);
		$row = $result->fetch();
		// stores the id an profile to be used later
		$id = $row['id'];
		$bio = $row['profile'];
	?>
	<nav class="navbar navbar-expand-sm bg-info navbar-light">
		<div class="navbar-header">
			<a class="navbar-brand" href="index.php">Chatter</a>
		</div>
		<ul class="navbar-nav">
			<li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
			<li class="nav-item"><a class="nav-link" href="chats.php?Name=<?php   echo $mainUser; ?>">MyChats</a></li>
		</ul>
		<form class="form-inline my-2 ml-auto" action="search.php" method="post" name="searchBar">
			<input class="form-control mr-sm-2" type="search" placeholder="Search..." method="post" name="searchText">
		</form>	
		<button type="button" class="btn btn-white" data-toggle="modal" data-target="#myModal">Chat</button>
		<button class="btn btn-danger ml-2" onclick="location.href= 'logout.php'">Log out</button>
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
		<div class="conatiner p-5">
			<div class="row">
				<div class="col-md-2">
					<img src="images/owl..png" alt="chatter" width="112" height="115">	
				</div>	
				<div class="col-md-10">
					<h1 id= "titleName" class="text-left"><?php echo $name;?></h1>
				</div>	
			</div>
		</div>
	</div>

	<section>
		<div class="container-fluid m-2">
			<div class="row mr-2">
				<div class="col-md-4">
					<div class="row bg-light">
						<?php
						// profile displayed
							echo "<p class=p-5>$bio</p>";
						?>
					</div>
					<div class="row bg-light p-3">
						<div class="col-md-8">
							<?php
								echo '<h4><a href="chats.php?Name='.$mainUser.'">Chats</a></h4>';
								echo '<h4><a href="follow.php?Page=Followers& Name='.$mainUser.'">Followers</a></h4>';
								echo '<h4><a href="follow.php?Page=Following& Name='.$mainUser.'">Following</a></h4>'; 

								//to check if user i following current user page
								$sql = "SELECT * FROM Following WHERE User = ? AND FollowingUser = ?";

								$resultCheck = $pdo->prepare($sql);
								$resultCheck->execute(array($userID,$id));

								//if rows gets selected and the user is not on his/her own page
								if($resultCheck->rowCount() == 0 && $userID != $id){
									//display the follow button
									//calls db_updatefollwoing to update follow table if user selects follow
									echo "<form method='post' id='followForm' action='db_updateFollowing.php?Name=$_GET[Name]'>
											<button class='btn btn-info mt-2' name='followButton'>Follow</button>
											</form>";
								}

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
							<form class="form-inline p-3" method= "post" id="textareaForm">
								<textarea class="form-control mr-2" type="input" placeholder="Chat..." rows="3" cols="80" name="textarea"></textarea>
								<button class="btn btn-white" type="submit" name="textareaButton">Submit</button>
							</form>
						</div>
					
					</div>
					<div class="row bg-light ml-3">
						<div class="col-md-12">
							<h2 class = "pb-2"><?php echo $name;?> Chats</h2>
						<?php
							// retrieves the posts for a specified user id
							$sql = "SELECT Posts.date, Posts.post FROM Posts WHERE UserID = $id ORDER BY date DESC";
							//no prepare statement needed, because it is nto using user input
							$result = $pdo->query($sql);

							// loop through rows and retrieves the data for dat eand posts then prints
							while($row = $result->fetch()){
								$date = $row['date'];
								$post = $row['post'];
								echo "<h5 class='p-3'>$date</h5>
										<p class='p-3'>$post</p>";
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