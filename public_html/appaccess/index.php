<?php

if (array_key_exists('action', $_POST)) {
	include('../config.inc');
	
	switch ($_POST['action']) {
		case 'user_login':
			echo app_login('testapp', 'testdevice', $_POST['username'], $_POST['password']);
			break;
		case 'user_logout':
			echo app_logout('testapp', $_POST['sessionid']);
			break;
		default:
			echo 'error: unknown request';
			break;
	}
}



function app_login($app, $device, $username, $password) {	
	// app is not currently used
	
	$code = auth_code($username, $password);
	$sessid = '';
	if ($code == 0) {
		$sessid = session_open($_POST["username"], $device);
	}
	return $code.':'.$sessid;
}


function app_logout ($app, $sessionid) {
	// app is not currently used
	
	if (!empty($sessionid)) session_close($sessionid);
}




?>


