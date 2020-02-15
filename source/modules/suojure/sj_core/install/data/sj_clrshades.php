<?php
	$q = db_insert('sj_clrshades') -> fields(array ('name', 'math', 'weight'));
	$q -> values (array ('name' => 'offwhite', 'math' => 'n+(max-n)*0.85', 'weight' => 10));
	$q -> values (array ('name' => 'pastel', 'math' => 'n+(max-n)*0.6', 'weight' => 20));
	$q -> values (array ('name' => 'pure', 'math' => '', 'weight' => 30));
	$q -> values (array ('name' => 'gem', 'math' => 'n/2', 'weight' => 40));
	$q -> values (array ('name' => 'dark', 'math' => 'n/4', 'weight' => 50));
	$q -> values (array ('name' => 'deep', 'math' => 'n/8', 'weight' => 60));
	
	$q -> values (array ('name' => 'suede', 'math' => 'n/15+max/10', 'weight' => 70));
	$q -> values (array ('name' => 'drab', 'math' => 'n/15+max/4', 'weight' => 80));
	$q -> values (array ('name' => 'soft', 'math' => 'n/15+max/2', 'weight' => 90));
	$q -> values (array ('name' => 'light', 'math' => 'n/15+max/1.5', 'weight' => 100));
	$q->execute();	
?>
