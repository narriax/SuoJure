<?php

function sj_core_pages_test () {
	$content = '';
	
	$tests = array (
		array (
			'module' => 'sj_core',
			'class' => 'sjUser',
			'fn' => 'test_load_access',
		)
	);
	
	// print TOC
	$content .= '<b>Tests</b><ul>';
	foreach ($tests as $tix => $tdata) {
		$link = $tdata['class'].':: '.$tdata['fn'];
		$content .= '<li>'.l($link, 'test', array('query' => array('test' => $tix))).'</li>';
	}
	$content .= '</ul><hr>';
		
		
	// load selected test
	if (isset($_GET['test']) && isset($tests[$_GET['test']])) {
		$test = $tests[$_GET['test']];
		module_load_include('class', $test['module'], 'api/'.$test['class']);
		eval ('$obj = new '.$test['class'].'();');
		eval ('$res = $obj->'.$test['fn'].'();');
	}	
		
	return $content;
}