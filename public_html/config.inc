<?php

global $SITE_NAME, $CSS_CACHING;
$SITE_NAME = 'Suo Jure';
$CSS_CACHING = false;

// define main db
$db_info = array(
	'main' => array (
		'hostname' => 'localhost',
		'dbtype' => 'mysql',
		'dbname' => 'suojure',
		'username' => 'root',
		'password' => '',
	),
);


// list required libraries
global $REQUIRED_LIBS;
$REQUIRED_LIBS = array();
$REQUIRED_LIBS['medoo'] = array(
	'\libraries\medoo\src\Medoo.php',
	'..\..\_lib\_tools\medoo\src\Medoo.php' 
);
$REQUIRED_LIBS['openPGP'] = '\libraries\openPGPjs\dist\openpgp.min.js';

function req($libname) {
	global $REQUIRED_LIBS;
	return $REQUIRED_LIBS[$libname];
}

// define themes
global $THEMES;
$THEMES = array(
	'gray' => '\themes\gray'
);



// =======================================================
// find roots

global $DIR_ROOT, $WEB_ROOT;
$DIR_ROOT = getcwd();
while(substr($DIR_ROOT,-1 * strlen('\public_html')) != '\public_html') {
	$DIR_ROOT = substr($DIR_ROOT, 0, strrpos($DIR_ROOT,"\\"));
	if (strlen($DIR_ROOT) < (strlen('\public_html')+1)) 
		die("<div class=error>Unable to find dir root.</div>");
}
$WEB_ROOT = $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].
	substr($_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'], 'public_html/') + strlen('public_html'));

// =======================================================
// load theme

include_once('lib_utils.inc');
include_once(themepath('theme.php'));

// =======================================================
// include required libraries
foreach ($REQUIRED_LIBS as $r => $rloc) {
	
	$reqdir = '';
	if (is_array($rloc)) {
		foreach ($rloc as $oneloc) {
			if (file_exists(rootpath($oneloc))) {
				$reqdir = $oneloc;
				break;
			}
		}
		if ($reqdir === '') 
			$reqdir = implode(']; [', $rloc);
	} else {
		$reqdir = $oneloc;
	}
		
	if (!file_exists(rootpath($reqdir))) {
		die ("<div class=error>Required library missing: <b>".$r."</b>: [".$reqdir."]</div>");
	} else if (substr($reqdir, -4) == ".php") 
		include_once(rootpath($reqdir));
}

// =======================================================
// initialize db
use Medoo\Medoo;
global $db;
$db = new Medoo([
	// required
	'server' => $db_info['main']['hostname'],
	'database_type' => $db_info['main']['dbtype'],
	'database_name' => $db_info['main']['dbname'],
	'username' => $db_info['main']['username'],
	'password' => $db_info['main']['password'],
]);

// =======================================================
// bootstrap sessions

theme_page_header('');

include_once('core/auth/session.inc');
user_access_header();






?>
