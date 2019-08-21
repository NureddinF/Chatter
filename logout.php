<?php

	session_start();
	//deletes the sesssion
	session_destroy();
	// redirects to main landing page
	header("Location: chatter.php");

?>