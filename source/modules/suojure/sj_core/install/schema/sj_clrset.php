<?php
function sj_core_schema_clrset (&$schema) {
  $schema['sj_clrset'] = array(
	'description' => 'Color sets',
	'primary key' => array ('id'),
	'fields' => array(
		'id' => array(
		  'type' => 'int',
		  'size' => 16,
		  'not null' => TRUE,
		),
		
	),
  );
}
?>
