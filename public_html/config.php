<?php

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
$required['medoo'] = '\_libraries\medoo\src\Medoo.php';



// =======================================================
// TODO: move this to install script?

// include required libraries
foreach ($required as $r => $rloc) {
	if (!file_exists(getcwd().$rloc))
		die ("<div class=error>Required library missing: <b>".$r."</b>: [".$rloc."]</div>");
	else 
		include_once(getcwd().$rloc);
}

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

?>
