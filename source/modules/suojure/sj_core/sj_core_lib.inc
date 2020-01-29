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


