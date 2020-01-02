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
include_once('core/auth/session.inc');




// Function to get the client ip address
function get_client_ip_env() {
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
        $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';
 
    return $ipaddress;
}

?>
