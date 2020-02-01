<?php


function sj_core_personas_block () {
	if (!user_access('access content')) 
		return '';
	
	global $user;	
	$personas = entity_load('sj_persona', array(), array('username' => $user->name), false);
	dpm($personas);
	
	$content = '';
	foreach ($personas as $p) 
		$content .= $p;
		
	$content .= l('+'.t('Persona'), 'personas');
		
	return $content;
}