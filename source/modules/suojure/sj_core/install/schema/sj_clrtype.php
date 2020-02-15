<?php
function sj_core_schema_clrtype (&$schema) {
  $schema['sj_clrtype'] = array(
	'description' => 'Color types',
	'primary key' => array ('name'),
	'fields' => array(
		'name' => array(
		  'type' => 'varchar',
		  'size' => 16,
		  'not null' => TRUE,
		),
		'description' => array (
		  'type' => 'text',
		  'not null' => FALSE,
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
