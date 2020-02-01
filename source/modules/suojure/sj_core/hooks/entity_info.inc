<?php

/**
 * Implements hook_entity_info().
 */
function sj_core_entity_info() {
	
  return array(
    'sj_persona' => array(
      'label' => t('SJ User Persona'),
      'base table' => 'sj_user_persona',
      'entity keys' => array(
        'id' => 'id',
      ),
    ),
	

  );
}