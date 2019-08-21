<?php
	//the name of the main user
	function myName(){
		//Gets name from profile.txt file 
		$my_file = "myProfile.txt";
		$fh=fopen($my_file,'r') or die("Cannot open file ".$my_file);
		$name = fgets($fh);
		//returns name
		return $name;
	}

	function formatName($name){
		//formats the name so there is no newline statement following it, makes it easier for if statement to work
		$stripped= str_replace("\n",'',$name);
		return $stripped;
		
	}
	//reads the chats for both the main user or the users they follow/follow them
	function readMyChats(){
			
		$file ="";
		//checks if the name is the name of main user, and sets the text file accordingly
		if(formatName(myName()) == $_GET['Name']){
			$file = file("myChats.txt");
		} 
		else{
			$file = file("userChats/".$_GET['Name']." Chats.txt");
		}
		//reverses file
		$file = array_reverse($file);
		//loop and print accordingly
		for($i = 0; $i < count($file); $i++){
			$date = $file[$i+1];
			echo "<h5 class='p-3'>$date</h5>
				<p class='p-3'>$file[$i]</p>";
			$i = $i+1;
		}
	}
	//reads the chats only for main user
	function readChats(){
		
		//gets file
		$file = file("file.txt");	
		//reverses file and reads from reverse
		$file = array_reverse($file);
		for($i = 0; $i < count($file); $i++){
			//saves date
			$date = $file[$i+1];
			//saves name
			$name = $file[$i+2];
			//prints the contents
			echo "<div class='row p-3'>
				<div class='col-md-2'>
				<img src='images/userHead.png' alt='userHead'>
				</div>
				<div class='col-md-8'>
				<h5 id='username'><a href='chats.php?Name=$name'>$name</a></h5>
				<p>$file[$i]</p>
				<h6>$date</h6>
				</div>
				</div>";
			$i = $i+2;
		}
	}
	//for main user only, writes in their new chats page any posts they submit
	function writeChats(){
		//checks if the button is presses
		if(isset($_POST['textareaButton'])){
			//gets file
			$my_file = "file.txt";
			$date=date("F jS, Y - g:ia",time());
			$fh = fopen($my_file,'a') or die('Cannot open file '.$my_file);

			$data = "\n" .$_POST['textarea'];
			//empty data field check
			if($data != "\n"){
				//if file already populated, creates a new line
				if(filesize($my_file)){
					$newline ="\n";
					fwrite($fh,$newline);
				}
				//writes to file
				fwrite($fh,myName());
				fwrite($fh,$date);
				fwrite($fh,$data);
				fclose($fh);
			}	
		}
	}

	//reads the chats for the mychats page, for both current user and users they follow/follow them
	function writeMyChats(){
		//checks if button pressed
		if(isset($_POST['MyChatstextareaButton'])){
			//checks is the name is the main user
			if(formatName(myName()) == $_GET['Name']){
				$my_file ="myChats.txt";
			} 
			else{
				$my_file = "userChats/".$_GET['Name']." Chats.txt";
			}
			//records date
			$date=date("F jS, Y - g:ia",time());
			$fh = fopen($my_file,'a') or die('Cannot open file '.$my_file);

			$data = "\n" .$_POST['textarea'];
			//adds new line if file already has content in it
			if(filesize($my_file)){
				$newline ="\n";
				fwrite($fh,$newline);
			}
			//writes to file
			fwrite($fh,$name);
			fwrite($fh,$date);
			fwrite($fh,$data);
			fclose($fh);
		}
	}
//gets other users bio
	function getUserBio(){

		$bio="";
		$name = $_GET['Name'];
		//gets text file by name of user
		$my_file = "usersProfiles/".$name.".txt";
		$fh = fopen("$my_file",'r') or die("Cannot open file ".$my_file);
		$name = fgets($fh);
		//stores bio from text file
		$bio = fgets($fh);
		//returns bio
		return $bio;
	}
	//gets the main users bio
	function getMyBio(){
		//get the my profile.txt file
		$my_file = "myProfile.txt";
		//opesn file
		$fh = fopen("$my_file",'r') or die("Cannot open file ".$my_file);
		//stores name
		$name = fgets($fh);
		//stores bio
		$bio = fgets($fh);

		return $bio;	
	}
//returns the followers from a text file
	function getFollowers(){

		$my_file = "followers.txt";
		//opens text file
		$fh = fopen("$my_file",'r') or die("Cannot open file ".$my_file);
		//loops through file
		while(!feof($fh)){
			//gets name from file
			$fname = fgets($fh);
			//prints name with its link
			echo "<h3 class='p-3'> <img src='images/userHead.png' alt='userHead'><a href='chats.php?Name=$fname'>$fname</h3>";

		}
	}
//same oas above but for users following
	function getFollowing(){
		
		$my_file = "Following.txt";
		$fh = fopen("$my_file",'r') or die("Cannot open file ".$my_file);
		while(!feof($fh)){
			$fname = fgets($fh);
			echo "<h3 class='p-3'> <img src='images/userHead.png' alt='userHead'><a href='chats.php?Name=$fname'>$fname</h3>";
		}
	}
?>