<?php
if (array_key_exists('action', $_POST)) {
	
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,"http://localhost/suojure/public_html/appaccess/index.php");
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $_POST);
		
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$server_output = curl_exec($ch);
	curl_close ($ch);
	
	echo '<div style="background:#333; color:silver; border: 1px solid gold; padding: 6px;">'.$server_output.'&nbsp;</div>';
}

echo '<hr>';
var_dump($_POST);

?>

<form method=POST>
	<select name="action">
		<option value="user_login">login</option>
	</select><br>

	<label>Username:</label><input name="username" value="narriax"><br>
	<label>Password:</label><input name="password" value="lord"><br>
	
	<input type=submit value="submit test">
</form>