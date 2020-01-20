<?php

function user_access_header () {
	if (!session_check("")) {
		// no valid session, go to login
		include ('login.inc');
		die();
	} else {	
		global $WEB_ROOT;
		$selid = '';
		
		
		if (array_key_exists('selpersona', $_GET)) {
			$_SESSION['suojure']['user']['selected_persona'] = $_GET['selpersona'];
		}
		
		if (array_key_exists('selected_persona', $_SESSION['suojure']['user'])) {
			$selid = $_SESSION['suojure']['user']['selected_persona'];
		}
		
		echo '<div class=access-header-bar>';
			echo '<div class=line1>';
			echo "Welcome, ".$_SESSION['suojure']['user']['username'];
			echo ' <a id=profilelink href="'.$WEB_ROOT.'/core/auth/profile.php" class=hoverable><label>Profile</label></a>'.
				 ' <a id=logoutlink href="'.$WEB_ROOT.'/core/auth/logout.php" class=hoverable><label>Logout</label></a>';
			
			echo '</div><div class=line2>';
			foreach ($_SESSION['suojure']['user']['personas'] as $uiod => $personaname) {
				if ($selid === $personaname)
					echo '<span class=selection>'.$personaname.'</span>';
				else
					echo '<a href="?selpersona='.$personaname.'">'.$personaname.'</a> ';
			}
			echo '</div>';
		echo '</div>';
	}
}




function session_open ($username, $device) {
	global $db;
	$user = $db->select("users", ["username"], ["username" => $username]);
	if (!$user) return "";
	
	$sessid = random_string(32);
	while ($exists = $db->select("user_sessions", ["id", "username"], ["id"=>$sessid])) {
		$sessid = random_string(32);	
	}
	if (empty($device)) $device = "browser";
	$db->delete("user_sessions", ["username" => $username, "device" => $device]);
	$db->insert("user_sessions", ["id" => $sessid, "username" => $username, "device" => $device]);
	
	$date = (new DateTime())->format('Y-m-d H:i:s');
	$db->update("users", ["date_visited" => $date], ["username" => 	$user[0]["username"]]);
			
	if ($device == "browser") {
		if (session_status() == PHP_SESSION_NONE)
			session_start();
		else 
			session_unset();	
		$_SESSION['suojure'] = array ('sessionid' => $sessid, 'user' => $user[0]);
	}
	session_load_personas();

	return $sessid;
}


function session_load_personas() {
	global $db;
	$personas = $db->select('user_personas', ['uoid', 'personaname'], ['username' => $_SESSION['suojure']['user']["username"]]);
	$_SESSION['suojure']['user']['personas'] = array();
	foreach ($personas as $pdata) {
		var_dump($pdata);
		$_SESSION['suojure']['user']['personas'][$pdata['uoid']] = $pdata['personaname'];
	}
}


function session_check($device, $sessionid = "") {
	if (empty($device)) $device = "browser";
	
	if (empty($sessionid) && $device == "browser") {
		if (session_status() == PHP_SESSION_NONE)
			session_start();
		if (!isset($_SESSION) || !array_key_exists('suojure', $_SESSION))
			return false;
		$sessionid = $_SESSION['suojure']['sessionid'];
	}

	global $db;
	$sess = $db->select("user_sessions", ["username", "device", "started"], ["id" => $sessionid]);
	if (!$sess) return false;
	
	if ($sess[0]['device'] != $device) return false;
	if ($sess[0]['device'] == "browser" && $sess[0]['username'] != $_SESSION['suojure']['user']['username']) return false;
	
	$duration =(new DateTime($sess[0]['started']))->diff(new DateTime());
	$hours = $duration->h;
	$hours = $hours + ($duration->days*24);
	if ($hours > 8) return false;
	
	return true;
}


function session_close($sessionid = "") {
	session_start();
	if (isset($_SESSION) && array_key_exists("suojure", $_SESSION)) {
		if (empty($sessionid)) $sessionid = $_SESSION["suojure"]["sessionid"];	
		if ($sessionid == $_SESSION["suojure"]["sessionid"]) session_unset();
	}
	if (!empty($sessionid)) {
		global $db;
		$db->delete("user_sessions", ["id" => $sessionid]);
	}
}



function auth_code ($username, $password) {
	global $db;
	if (!$user = $db->select("users", ["username", "password"], ["username" => $username])) {
		return -1;
	}
	if (!$user || $user[0]["password"] != $_POST["password"]) {
		return -2;
	} else {
		return 0;
	}
}


?>
