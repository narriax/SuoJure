<?php

global $DIR_ROOT;
$DIR_ROOT = getcwd();
while(substr($DIR_ROOT,-1 * strlen('\public_html')) != '\public_html') {
	$DIR_ROOT = substr($DIR_ROOT, 0, strrpos($DIR_ROOT,"\\"));
	if (strlen($DIR_ROOT) < (strlen('\public_html')+1)) 
		die("<div class=error>Unable to find dir root.</div>");
}

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
global $required;
$required = array();
$required['medoo'] = '\libraries\medoo\src\Medoo.php';
$required['openPGP'] = '\libraries\openPGPjs\dist\openpgp.min.js';

function req($libname) {
	global $required;
	return $required[$libname];
}

// =======================================================


// include required libraries
foreach ($required as $r => $rloc) {
	if (!file_exists($DIR_ROOT.$rloc))
		die ("<div class=error>Required library missing: <b>".$r."</b>: [".$rloc."]</div>");
	else if (substr($rloc, -4) == ".php") include_once($DIR_ROOT.$rloc);
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
include_once('lib_utils.inc');
include_once('core/auth/session.inc');





?>
