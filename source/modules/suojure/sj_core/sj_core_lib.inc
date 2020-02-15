<?php


// logging
function sjl ($msg, $type="msg", $info=null) {
	global $sj_log;
	switch ($type) {
		case 'msg': 
			$sj_log[] = '...'.$msg; 
			break;
		case 'trace':
			$sj_log[] = '~~~~ ~~~~';
			$sj_log[] = 'TRACE ('.$info.'):: '.$msg;
			break;
		case 'success':
			$sj_log[] = '...SUCCESS:: '.$msg;
			break;
		case 'failure': 
			$sj_log[] = '...FAILURE:: '.$msg;
			break;
		case 'query': 
			$qlog = $info->__toString();
			$qargs = $info->arguments();
			$qarr = explode ("\n", $qlog);
			$sj_log[] = '...QUERY:: '.$msg;
			$sj_log[] = '   ---------------------';
			foreach ($qarr as $line) $sj_log[] = '   | '.$line;
			$sj_log[] = '   ---------------------';
			break;
		case 'array':
			$sj_log[] = '...ARRAY:: '.$msg;
			$sj_log[] = '   ---------------------';
			foreach ($info as $key => $value) $sj_log[] = '   | '.$key.' = '.$value;
			$sj_log[] = '   ---------------------';
			break;
		default:
			$sj_log[] = $msg; 
	}
}
function sjp() {
	global $sj_log;
	$sj_log[] = '===== =====';
	dpm(implode("\n", $sj_log));
	$sj_log = array();
}





function sjvar ($varname, $default = null) {
	if (!array_key_exists('sj', $_SESSION)) return $default;
	if (!array_key_exists($varname, $_SESSION['sj'])) return $default;
	return $_SESSION['sj'][$varname];
}

function sjvar_set ($varname, $newval) {
	if (!array_key_exists('sj', $_SESSION)) 
		$_SESSION['sj'] = array();
	$_SESSION['sj'][$varname] = $newval;
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


function generate_new_uoid ($for_tables = array(), $min_digits = 4, $max_digits = 16) {
    global $db;

	if ($max_digits < $min_digits) $max_digits = $min_digits;
	$min = pow(10, $min_digits-1);
	$max = pow(10, $max_digits)-1;
	$tables = array_keys($for_tables);
    
	$attempts = 0;
	if (count($for_tables) == 0)  {
		$try_me = rand($min, $max);
	} else {
		$try_me = 0;
		while ($try_me == 0) {
			$try_me = rand($min, $max);
			foreach ($for_tables as $table => $col) {
				$query = db_select($table, 't') -> fields('t', array($col)) -> condition('t.'.$col, $try_me)->countQuery();
				if ($query->execute()->fetchField() > 0) {
					$try_me = 0;
					break;
				}
			}
		}	
		$attempts++;
		if ($attempts > 10) {
			return 0;
		}
	}
    return $try_me;
}

function timestamp_sql () {
	return date('Y-m-d H:i:s');
}

