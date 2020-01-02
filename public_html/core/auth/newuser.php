<?php
include_once('../../config.inc');

?>

<hr>
<form method=POST>
	<input name="action" id="new_action" value="user_create" type="hidden" />
	<label>Username:</label><input name="username" id="new_username"><br>
	<label>Email:</label><input name="email" id="new_email" type="email"><br>
	<label>Password:</label><input name="password" id="new_password" type="password"><br>
	<input type=submit value="Create new user"/>
</form>


<?php

if (array_key_exists("action", $_POST) && $_POST["action"] == "user_create") {	
	$username = trim($_POST["username"]);
	$password = trim($_POST["password"]);
	$email = trim($_POST["email"]);
	
	$allgood = true;
	if (strlen($username) < 3) {
		echo '<div class=error>Username too short</div>';
		$allgood = false;
	}
	if (strlen($password) < 3) {
		echo '<div class=error>Password too short</div>';
		$allgood = false;
	}
	if (strlen($email) < 3) {
		echo '<div class=error>Email too short</div>';	
		$allgood = false;
	}
	if (!$allgood) die();
	
	global $db;
	if ($existing = $db->select("users", ["username" => $username])) {
		die ("<div class=error>User already exists</div>");
	}
	
	$db->insert("users", ["username" => $username, "email" => $email, "password" => $password]);
}

?>