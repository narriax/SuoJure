<?php
function sj_core_schema_clr (&$schema) {
  $schema['sj_clr'] = array(
	'description' => 'Named colors',
	'primary key' => array ('name'),
	'fields' => array(
		'name' => array(
		  'type' => 'varchar',
		  'size' => 16,
		  'not null' => TRUE,
		),	
		'color' => array(
		  'type' => 'varchar',
		  'size' => 6,
		  'not null' => TRUE,
		),
		'family' => array (
		  'type' => 'varchar',
		  'size' => 16,
		  'not null' => TRUE,
		),
		'shade' => array (
		  'type' => 'varchar',
		  'size' => 16,
		  'not null' => TRUE,
		),	
	),
  );
}
?>
