<?php
	$q = db_insert('sj_clrtype') -> fields(array ('name', 'weight'));
	$q -> values (array ('name' => 'primary', 'weight' => 1));
	$q -> values (array ('name' => 'secondary', 'weight' => 2));
	$q -> values (array ('name' => 'aux', 'weight' => 3));
	$q->execute();
?>
