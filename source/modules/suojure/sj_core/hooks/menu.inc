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
		'file' => 'pages/colors_form.php',	 // don't forget to add the file and path
		'file path' => drupal_get_path('module', 'sj_core'),
		
		'description' => 'Configure Suo Jure color system',
		'page callback' => 'drupal_get_form',
		'page arguments' => array('sj_core_pages_colors_form'),
		'access arguments' => array('access administration pages'),
	);
	$items['admin/config/suojure/colors/table'] = array(
		'title' => 'Color Table',
		'type' => MENU_DEFAULT_LOCAL_TASK,
		'file' => 'pages/colors_form.php',	 // don't forget to add the file and path
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
		'file' => 'pages/color_types_form.php',	 // don't forget to add the file and path
		'file path' => drupal_get_path('module', 'sj_core'),
		
		'description' => 'Configure Suo Jure color types',
		'page callback' => 'drupal_get_form',
		'page arguments' => array('sj_core_pages_colortypes_form'),
		'access arguments' => array('access administration pages'),
	);	
	$items['admin/config/suojure/colors/colorsets'] = array(
		'title' => 'Color Sets',
		'type' => MENU_LOCAL_TASK,
		'file' => 'pages/color_sets_form.php',	 // don't forget to add the file and path
		'file path' => drupal_get_path('module', 'sj_core'),
		
		'description' => 'Configure Suo Jure color sets',
		'page callback' => 'drupal_get_form',
		'page arguments' => array('sj_core_pages_colorsets_form'),
		'access arguments' => array('access administration pages'),
		'weight' => 10,
	);	
	
	
	
	$items['user/%user/personas'] = array (
		'title' => 'Personas List',
		'type' => MENU_LOCAL_TASK,
		'file' => 'pages/personas_form.php',	 // don't forget to add the file and path
		'file path' => drupal_get_path('module', 'sj_core'),
		
		'page callback' => 'drupal_get_form',
		'page arguments' => array ('sj_core_pages_personas_form'),
		'access callback' => 'user_is_logged_in',
		'weight' => 5,
	);	
	$items['user/%user/persona'] = array (
		'title' => 'Persona',
		'type' => MENU_LOCAL_TASK,
		'file' => 'pages/persona_edit_form.php',	 // don't forget to add the file and path
		'file path' => drupal_get_path('module', 'sj_core'),
		
		'page callback' => 'drupal_get_form',
		'page arguments' => array ('sj_core_pages_persona_edit_form'),
		'access callback' => 'user_is_logged_in',
		'weight' => 6,
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

function sj_core_menu_alter(&$callbacks) {
	/*
  //  DEBUGGING OUTPUT.
  foreach ($callbacks as $path => $options) {
    $access = $options['access callback'] ? $options['access callback'] : 'user_access';
    $page = $options['page callback'] ? $options['page callback'] : 'no page callback';
    echo $path . " | ". $page . " | " . $access . " | " . implode(', ', $options['access arguments']) . '<br />';
  }
  */
}


//===============================================
function sj_core_pages ($page) {
	module_load_include ('php', 'sj_core', 'pages/'.$page);
	$fn = 'sj_core_pages_'.$page;
	return $fn();
}

function sj_core_load_css ($page, $type = 'page', $module = 'sj_core') {
	$paths = array (
		'CSS_MODULE' => drupal_get_path('module', $module).'/pages/',
		'CSS_THEME' => drupal_get_path('theme', 'suojure').'/css/components/',
	);
	$filenames = array ('common.css', $page.'.css', $type.'s.css', $page.'_'.$type.'.css');

	foreach ($paths as $pathtype => $path) {
		foreach ($filenames as $file) {
			if (file_exists($path.$file)) {
				drupal_add_css($path.$file, array('type'=>'file', 'group' => $pathtype));
			}
		}
	}
}
