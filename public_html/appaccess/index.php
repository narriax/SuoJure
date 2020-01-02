<?php

if (array_key_exists('action', $_POST)) {
	include('../config.inc');
	
	switch ($_POST['action']) {
		case 'user_login':
			echo app_login('testapp', $_POST['username'], $_POST['password']);
			break;
		case 'user_logout':
			echo app_logout('testapp', $_POST['username'], $_POST['sessionid']);
			break;		
		default:
			echo 'error: unknown request';
			break;
	}
}



function app_login($app, $username, $password) {


	$code = auth_code($username, $password);
	
	$sessid = '';
	if ($code == 0) {
		$sessid = session_open($_POST["username"], $app);		// using app as device, thoughts?
	}
	
	return $code.':'.$sessid;
}


function app_logout ($app, $username, $password) {
	
}




?>


