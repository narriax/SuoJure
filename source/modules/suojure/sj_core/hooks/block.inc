<?php


/**
 * Implements hook_block_info().
 */
function sj_core_block_info() {
  $blocks['sj_core_personas'] = array(
    // The name that will appear in the block list.
    'info' => t('SuoJure: Personas'),
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
  }

  return $block;
}

