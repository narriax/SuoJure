<?php


function sj_core_personas_block () {
	if (!user_access('access content')) 
		return '';
	
	$usr = new sjUser();
	if (!isset($usr)) 
		return l(t('Log in'), 'login');

	$content = '';
	$content .= '<span class="menu-link">'.l($usr->username, 'user').'</span>';
	$content .= '<span class="menu-link">'.l(t('Logout'), 'user/logout').'</span>';

	foreach ($usr->personas as $pgrp => $ps) {
		$content .= '<span class="menu-group"><labe>'.$pgrp.'</label></span>';
		foreach ($ps as $pname => $pdata) 
			$content .= '<span class="menu-link">'.$pname.'</span>';
	}
		
	
	$content .= '<span class="menu-link">'.l('manage', 'personas').'</span>';
		
	return $content;
}