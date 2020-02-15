<?php
function sj_core_schema_clrset_clrs (&$schema) {
  $schema['sj_clrset_clrs'] = array(
	'description' => 'Color set values',
	'indexes' => array ('clrsetid'),
	'fields' => array(
		'clrsetid' => array(
		  'type' => 'int',
		  'size' => 16,
		  'not null' => TRUE,
		),
		'clrtype' => array(
		  'type' => 'varchar',
		  'size' => 16,
		  'not null' => TRUE,
		),
		'clr' => array(
		  'type' => 'varchar',
		  'size' => 16,
		  'not null' => TRUE,
		),
	),
  );
}
?>
