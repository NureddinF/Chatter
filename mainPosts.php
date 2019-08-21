<?php
	//php script that gets the posts from the database
		session_start();
		require "login.php";
		require "user_info.php"


?>

<?php 
								// gets all the posts an displays
								//query to get the posts from both the current users and the users they are following
									$sql = "SELECT Users.name, Following.User, Following.FollowingUser, Posts.post, Posts.date FROM Following, Users, Posts WHERE Following.User = $userID AND Users.userID = Following.FollowingUser AND Posts.UserID = Following.FollowingUser OR Posts.UserID = $userID AND Users.userID = $userID ORDER BY date desc";
									// query does not take in input from users so no prepare statement needed
									$result = $pdo->query($sql);
									// loop to go through the result rows
									while($row = $result->fetch()){
										// stores the name,date,and post
										$name = $row['name'];
										$posts = $row['post'];
										$date = $row['date'];

										//sent to xmlhttprequest then displayed

										echo "<div class='row p-3'>
											<div class='col-md-2'>
											<img src='images/userHead.png' alt='userHead'>
											</div>
											<div class='col-md-8'>
											<h5 id='username'><a href='chats.php?Name=$name'>$name</a></h5>
											<p>$posts</p>
											<h6>$date</h6>
											</div>
											</div>";

										
									}
?>
