<?php


/**
 * Implements hook_block_info().
 */
function sj_core_block_info() {
  $blocks['sj_core_personas'] = array(
    'info' => t('SuoJure: Personas'),
  );
  $blocks['sj_core_reset_cache'] = array(
    'info' => t('SuoJure: Reset Cache'),
  );
  return $blocks;
}

/**
 * Implements hook_block_view().
 */
function sj_core_block_view($delta = '') {
  switch ($delta) {
  case 'sj_core_personas':
    module_load_include ('inc', 'sj_core', 'blocks/block_personas');
    
	$block['subject'] = t('SuoJure: Personas');
    $block['content'] = sj_core_personas_block();
	break;
	
  case 'sj_core_reset_cache':
    $block['subject'] = t('SuoJure: Reset Cache');
	$block['content'] = '<a href="?clearache=1">'.t('Reset cache').'</a>';
	
	if (array_key_exists('clearache', $_GET) && array_key_exists('sj', $_SESSION)) {
		$path = current_path();
		unset($_SESSION['sj']);
		drupal_set_message('Cache has been reset');
		drupal_goto($path);
	}
	
	break;
  }

  return $block;
}

