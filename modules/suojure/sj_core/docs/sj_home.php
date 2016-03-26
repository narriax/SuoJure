<?php

// This file contains basic php code to include the Suo Jure home page
// Intended to be copy-pasted into a basic drupal page with PHP filter on and then set to front page  of the site


if (module_exists('sj_core')) {
	$home = drupal_get_path('module', 'sj_core').'/sj_home.inc';
	include_once($home);
} else {
	echo 'Suo Jure core is not enabled';	
}

?>