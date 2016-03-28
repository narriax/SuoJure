<?php

/**
 * Implements hook_permission().
 *
 * Adds module-defined permissions to the admin menu
 *
 */
function sj_core_permission () {
	return array(
		'sj admin' => array(
			'title' => t('Administer SJ modules'),
			'description' => t('Perform administration tasks for SJ modules.'),
		),
	);
}