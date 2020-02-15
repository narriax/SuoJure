<?php
function sj_core_schema_clrshades (&$schema) {
  $schema['sj_clrshades'] = array(
	'description' => 'Color Shades',
	'primary key' => array ('name'),
	'fields' => array(
		'name' => array(
		  'type' => 'varchar',
		  'size' => 16,
		  'not null' => TRUE,
		),
		'math' => array(
		  'type' => 'varchar',
		  'size' => 32,
		  'not null' => TRUE,
		),		
		'weight' => array(
		  'type' => 'int',
		  'size' => 2,
		  'not null' => TRUE,
		),
	),
  );
}
?>
  