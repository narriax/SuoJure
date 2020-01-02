
<?php

echo '<script src="core\session\login.js"></script>'.PHP_EOL;
echo '<script src=".\\'.req('openPGP').'"></script>'.PHP_EOL;


//var_dump($_POST);
if (array_key_exists('action', $_POST) && array_key_exists('username', $_POST)) {
	global $db;
	//$secret = '{new user}';
	if ($user = $db->select("users", ["username", "password"], ["username" => $_POST['username']])) {
		//var_dump($user);	
	}	
	
	/*
	$ip = get_client_ip_env();
	if ($_POST['action'] == 'user_request_auth') {
		$cookiesign = '';
		$temp = $_POST['username'].'++'.$secret.'++'.(new DateTime)->getTimestamp();
		$length = strlen($temp);
		for ($i = 0; $i < $length; $i++) {
			$cookiesign .= $temp[$length-$i-1].$temp[$i];
		}
		$db->delete("user_cookiesign", ["username" => $_POST["username"], "ip" => $ip]);
		$db->insert("user_cookiesign", ["username" => $_POST["username"], "ip" => $ip, "cookiesign" => $cookiesign]);
		
		$email_link = explode('?', $_SERVER['REQUEST_URI'])[0].'?authtoken='.$cookiesign;
		echo '<a href="'.$email_link.'">clicky</a>';
		// todo: email this to user
		
		//setcookie ('cookiesign', $cookiesign);
	} else */ 
	if ($_POST['action'] == 'user_login') {
		
		if (!$user || $user[0]["password"] != $_POST["password"]) {
			echo "<div class=error>Login information does not match.</div>";
		} else {
			session_open($_POST["username"], "browser");
			header("Location: .");
		}
		
	}
}
	
	// echo '<div style="display:none;" id="public_ip">'.get_client_ip_env().'</div>';
/*
	echo '<form method=none id="inputForm">';
		echo '<label>Username:</label><input name="username" id="input_username"><br>';
		echo '<label>Password:</label><input name="password" id="input_password" type="password"><br>';
		echo '<input type="submit" value="Login">';
		echo '<input type="submit" value="Login" onclick="TryLogin(); return false;">';
	echo '</form>';

	echo '<form method=POST id="loginForm" style="display:none;">';
		echo '<input name="action" id="send_action" type="hidden">';
		echo '<input name="username" id="send_username" type="hidden">';
		echo '<input name="passwordHash" id="send_passwordHash" type="hidden">';
	echo '</form>';
*/
?>
	
	
<a href="core/auth/newuser.php">Register new user</a>

<form method=POST id="inputForm">
	<input name="action" id="send_action" type="hidden" value="user_login">
	<label>Username:</label><input name="username" id="input_username"><br>
	<label>Password:</label><input name="password" id="input_password" type="password"><br>
	<input type="submit" value="Login">
</form>





	