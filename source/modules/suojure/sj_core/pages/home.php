<?php



echo 'Welcome<br><br>';

// if admin, show tests
global $user;
if (in_array('administrator', $user->roles)) {
	echo '<ul>';
	echo '<li><a href="'.url('dbcheck').'">DB check</a></li>';
	echo '<li><a href="'.url('test').'">Tests</a></li>';
	echo '</ul>';
}

echo '<br>';




?>