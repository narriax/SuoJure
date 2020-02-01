<?php

/**
 * Implements hook_menu().
 *
 * Adds urls to the site
 *
 */
function sj_core_menu () {
	
	$items['admin/config/suojure'] = array(
		'title' => 'Suo Jure',
		'description' => 'Suo Jure settings and config',
		'position' => 'right',
		'weight' => -100, 
		'page callback' => 'system_admin_menu_block_page',
		'access arguments' => array('access administration pages'),
		'file' => 'system.admin.inc',
	);
	$items['admin/config/suojure/color'] = array(
		'title' => 'Colors',
		'type' => MENU_NORMAL_ITEM,
		'file' => 'pages/colors.php',	 // don't forget to add the file and path
		'file path' => drupal_get_path('module', 'sj_core'),
		
		'description' => 'Configure Suo Jure color system',
		'page callback' => 'drupal_get_form',
		'page arguments' => array('sj_core_pages_colors_form'),
		'access arguments' => array('access administration pages'),
	);
	
	$items['personas'] = array (
		'title' => 'Personas',
		'type' => MENU_NORMAL_ITEM,
		'file' => 'pages/personas.php',	 // don't forget to add the file and path
		'file path' => drupal_get_path('module', 'sj_core'),
		
		'page callback' => 'drupal_get_form',
		'page arguments' => array ('sj_core_pages_personas_form'),
		'access callback' => 'user_access',
		'access arguments' => array ('access content'),
	);	
	 
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
