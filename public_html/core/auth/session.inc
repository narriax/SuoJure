<?php

// TODO: bootrap this through a framework, zend probably?

global $sess;
session_start();
if (isset($_SESSION) && array_key_exists('suojure', $_SESSION)) {
	// valid session?
	$sess = $_SESSION['suojure'];
	// TODO: session expiration check?
	
	//var_dump($sess['user']);
	echo "Welcome, ".$sess['user']['username'];
	echo ' -- <a href="core/auth/logout.php">Logout</a>';
	
} else {	
	// no valid session, go to login
	include ('login.inc');
}


?>
