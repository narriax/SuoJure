<?php
function sj_core_schema_user_persona (&$schema) {
  $schema['sj_user_persona'] = array(
	'description' => 'Personas (sub-users)',
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
		'grp' => array(
		  'type' => 'varchar',
		  'length' => 16,
		  'not null' => TRUE,
		  'default' => '',
		),
		'signature' => array(
		  'type' => 'varchar',
		  'length' => 255,
		  'not null' => TRUE,
		  'default' => '',
		),		
		'clrsetid' => array (
		  'type' => 'int',
		  'size' => 16,
		  'not null' => FALSE,
		  'default' => NULL,
		),
		'active' => array (
		  'type' => 'int',
		  'size' => 1,
		  'not null' => TRUE,
		  'default' => 1,
		),
		'weight' => array (
		  'type' => 'int',
		  'size' => 3,
		  'not null' => TRUE,
		  'default' => 999,
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
