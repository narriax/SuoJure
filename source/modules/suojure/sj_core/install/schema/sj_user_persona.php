<?php
function sj_core_schema_user_prsgroup (&$schema) {
  $schema['sj_user_prsgroup'] = array(
	'description' => 'Persona groups',
	'primary key' => array ('id'),
	'indexes' => array ('username', 'name'),
	'fields' => array(
		'id' => array(
		  'type' => 'int',
		  'size' => 4,
		  'not null' => TRUE,
		),
		'username' => array(
		  'type' => 'varchar',
		  'length' => 16,
		  'not null' => TRUE,
		  'default' => '',
		),	
		'name' => array(
		  'type' => 'varchar',
		  'length' => 16,
		  'not null' => TRUE,
		  'default' => '',
		),
		'default_pid' => array(
		  'type' => 'int',
		  'length' => 4,
		  'not null' => TRUE,
		  'default' => -1,
		),
		'weight' => array (
		  'type' => 'int',
		  'size' => 1,
		  'not null' => TRUE,
		  'default' => 99,
		),		
		'date_added' => array(
		  'mysql_type' => 'timestamp',
		  'not null' => TRUE,
		),	
		'date_last_modified' => array(
		  'mysql_type' => 'timestamp',
		  'not null' => TRUE,
		),			
	),
  );
}
?>
