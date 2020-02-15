<?php
function sj_core_schema_clrfamily (&$schema) {
  $schema['sj_clrfamily'] = array(
	'description' => 'Color Families',
	'primary key' => array ('name'),
	'fields' => array(
		'name' => array(
		  'type' => 'varchar',
		  'size' => 16,
		  'not null' => TRUE,
		),
		'baseclr' => array(
		  'type' => 'varchar',
		  'size' => 6,
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
