<?php



echo 'Welcome<br><br>';

// if admin, show tests
global $user;
if (in_array('administrator', $user->roles)) {
	echo '<a href="'.url('test').'">Tests</a>';
	
}





?>