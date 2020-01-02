<?php

function sj_core_pages_dbcheck () {
	$content = '';
	
	// process submitted form
	foreach ($_POST as $el => $fix) {
		if ($fix !== 'on' && $fix !== 'checked' && $fix !== 1 && $fix !== true) continue;
		$el = explode ('--', $el);
		$tbl = $el[0];
		$action = $el[1];
		if ($action == 'add') {
			// todo
			dvm ('TODO: add tables... '.$tbl);
		}
	}
	
	// display form
	global $sj_db_tables;
	$content .= '<form method=POST><table width=90%><tr><th>Table</th><th>Table name</th><th>Status</th><th>Fix?</th></tr>';
	foreach ($sj_db_tables as $tbl => $tbl_name) {
		if (!db_table_exists($tbl_name)) {
			$status = '<font color=maroon><b>missing</b></font>';
			$fix = '<input type=checkbox name="'.$tbl.'--add" checked></input>';
		} else {
			$status = '<font color=green><b>OK</b></font>';
			$fix = '';
		}
		$content .= '<tr><td><b>'.$tbl.'</b></td><td><i>'.$tbl_name.'</i></td><td>'.$status.'</td><td>'.$fix.'</td></tr>';
	}
	$content .= '</table><input type=submit value="Fix selected" /></form>';
		
	return $content;
}