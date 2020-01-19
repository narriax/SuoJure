<?php



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



 
function random_string($length = 16) {
	$input = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $input_length = strlen($input);
    $random_string = '';
    for($i = 0; $i < $length; $i++) {
        $random_character = $input[mt_rand(0, $input_length - 1)];
        $random_string .= $random_character;
    }
 
    return $random_string;
}


function generate_new_uoid () {
	global $db;

	$allExisting = array();
	$tables = $db->select("uobj_types", ["tablename"]);
	foreach ($tables as $t => $tdata) {
		$onelist = $db->select($tdata["tablename"], ["uoid"]);
		foreach ($onelist as $l => $ld) {
			$allExisting[] = $ld["uoid"];
		}
	}	
	$tryme = 0;
	while ($tryme == 0 || in_array($tryme, $allExisting))
		$tryme = rand();
	return $tryme;
}



function rootpath ($dir) {
	global $DIR_ROOT;
	
	$root = $DIR_ROOT;
	while (substr($dir, 0, 3) === '..\\') {
		$root = substr($root, 0, strrpos($root, "\\"));
		$dir = substr($dir, 3);
	}
	if (substr($dir, 0, 1) !== '\\') $dir = '\\'.$dir;
	return $root.$dir;	
}


?>
