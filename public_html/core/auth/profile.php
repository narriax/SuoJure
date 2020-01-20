<?php

include_once("../../config.inc"); 


if (array_key_exists('newpersona', $_GET)) {
	$newp = trim($_GET['newpersona']);

	if (!empty ($newp) && !in_array($newp, $_SESSION['suojure']['user']['personas'])) {	
		global $db;
		$newid = generate_new_uoid();
		$params = array(
			'uoid' => $newid, 
			'personaname' => $_GET['newpersona'],
			'username' => $_SESSION['suojure']['user']['username'],
		);
		$db->insert('user_personas', $params);
		$_SESSION['suojure']['user']['personas'][$newid] = $_GET['newpersona'];
	}
}
if (array_key_exists('deletepersona', $_GET)) {
	$delp = trim($_GET['deletepersona']);
	if (!empty ($delp) && array_key_exists($delp, $_SESSION['suojure']['user']['personas'])) {	
		global $db;
		$db->delete('user_personas', ['uoid' => $delp]);
		unset($_SESSION['suojure']['user']['personas'][$delp]);
	}
}


foreach ($_SESSION['suojure']['user']['personas'] as $uiod => $personaname) {
	echo '<form><b style="display: inline-block; width: 12em;">'.$personaname.'</b>'.
		'<input type=hidden name=deletepersona value="'.$uiod.'"><input type=submit value=Delete></form>';
}
echo '<form><input name=newpersona  style="width: 12em;"><input type=submit value=Add></form>';

	
?>



</body>
</html>