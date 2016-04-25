<?php

/**
 * Implements hook_menu().
 *
 * Adds urls to the site
 *
 */
function sj_core_menu () {
	$items['test'] = array (
		'type' => MENU_NORMAL_ITEM,
		'title' => 'Test',
		'page callback' => 'sj_core_pages',
		'page arguments' => array ('test'),
		'access callback' => 'user_access',
		'access arguments' => array ('sj admin'),
	);
	$items['dbcheck'] = array (
		'type' => MENU_NORMAL_ITEM,
		'title' => 'DB Check',
		'page callback' => 'sj_core_pages',
		'page arguments' => array ('dbcheck'),
		'access callback' => 'user_access',
		'access arguments' => array ('sj admin'),
	);
	return $items;
}

//===============================================
function sj_core_pages ($page) {
	module_load_include ('php', 'sj_core', 'pages/'.$page);
	$fn = 'sj_core_pages_'.$page;
	return $fn();
}
