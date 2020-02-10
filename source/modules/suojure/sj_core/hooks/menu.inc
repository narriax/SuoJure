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
	$items['admin/config/suojure/colors'] = array(
		'title' => 'Colors',
		'type' => MENU_NORMAL_ITEM,
		'file' => 'pages/colors.php',	 // don't forget to add the file and path
		'file path' => drupal_get_path('module', 'sj_core'),
		
		'description' => 'Configure Suo Jure color system',
		'page callback' => 'drupal_get_form',
		'page arguments' => array('sj_core_pages_colors_form'),
		'access arguments' => array('access administration pages'),
	);
	$items['admin/config/suojure/colors/table'] = array(
		'title' => 'Color Table',
		'type' => MENU_DEFAULT_LOCAL_TASK,
		'file' => 'pages/colors.php',	 // don't forget to add the file and path
		'file path' => drupal_get_path('module', 'sj_core'),
		
		'description' => 'Configure Suo Jure colors',
		'page callback' => 'drupal_get_form',
		'page arguments' => array('sj_core_pages_colors_form'),
		'access arguments' => array('access administration pages'),
		'weight' => -1,
	);	
	$items['admin/config/suojure/colors/colortypes'] = array(
		'title' => 'Color Types',
		'type' => MENU_LOCAL_TASK,
		'file' => 'pages/color_types.php',	 // don't forget to add the file and path
		'file path' => drupal_get_path('module', 'sj_core'),
		
		'description' => 'Configure Suo Jure color types',
		'page callback' => 'drupal_get_form',
		'page arguments' => array('sj_core_pages_colortypes_form'),
		'access arguments' => array('access administration pages'),
	);	
	$items['admin/config/suojure/colors/sets'] = array(
		'title' => 'Color Sets',
		'type' => MENU_LOCAL_TASK,
		'file' => 'pages/color_sets.php',	 // don't forget to add the file and path
		'file path' => drupal_get_path('module', 'sj_core'),
		
		'description' => 'Configure Suo Jure color sets',
		'page callback' => 'drupal_get_form',
		'page arguments' => array('sj_core_pages_colorsets_form'),
		'access callback' => '',
		'access arguments' => array('access administration pages'),
		'weight' => 10,
	);	
	
	
	
	$items['user/personas'] = array (
		'title' => 'Personas',
		'type' => MENU_LOCAL_TASK,
		'file' => 'pages/personas.php',	 // don't forget to add the file and path
		'file path' => drupal_get_path('module', 'sj_core'),
		
		'page callback' => 'drupal_get_form',
		'page arguments' => array ('sj_core_pages_personas_form'),
		'access callback' => 'user_is_logged_in',
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
