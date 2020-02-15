<?php
	module_load_include ('class', 'sj_core', 'api/sjColorSet');

	$colors = array (
		'red' => 	  array('base' => array(16, 0, 0), 	'dark' => 'maroon', 	'pastel'=>'rose'),
		'orange' =>   array('base' => array(16, 9, 0), 	'dark' => 'brown', 		'pastel'=>'salmon'),
		'yellow' =>   array('base' => array(16,16, 0), 	'dark' => 'bile', 		'pastel'=>'canary'),
		'grass' => 	  array('base' => array(9,16, 0), 	'dark' => 'swamp', 		'pastel'=>'tea'),
		'lime' => 	  array('base' => array( 0,16, 0), 	'dark' => 'green', 		'pastel'=>'eco'),
		'leygreen' => array('base' => array( 0,16,10), 	'dark' => 'forest', 	'pastel'=>'aero'),
		'cyan' => 	  array('base' => array( 0,14,16), 	'dark' => 'teal', 		'pastel'=>'ice'),
		'sky' => 	  array('base' => array( 0,10,16), 	'dark' => 'sea', 		'pastel'=>'babyblue'),
		'blue' => 	  array('base' => array( 0, 4,16), 	'dark' => 'navy', 		'pastel'=>'powder'),
		'violet' =>   array('base' => array( 8, 0,16), 	'dark' => 'universe', 	'pastel'=>'lavender'),
		'magenta' =>  array('base' => array(12, 0,16), 	'dark' => 'purple', 	'pastel'=>'lace'),
		'fuchsia' =>  array('base' => array(16, 0,10),  'dark' => 'wine', 		'pastel'=>'pink'),
		'white' =>    array('base' => array(16,16,16),  'dark' => 'gray'),
	);
	$color_keys = array_keys($colors);
	
	$qf = db_insert('sj_clrfamily') -> fields(array ('name', 'baseclr', 'weight'));
	$qc = db_insert('sj_clr') -> fields(array ('name', 'family', 'shade', 'color'));
	
	for ($c=0; $c < count($color_keys); $c++) {
		$data = $colors[$color_keys[$c]];

		$clr = '';
		$clrl = '';
		$clrd = '';
		foreach ($data['base'] as $code) {
			$n = max($code-1,0);
			$m = max($data['base']);
			
			$clr .= sjColorSet::dex_to_hex($n).sjColorSet::dex_to_hex($n);
			$clrd .= '';//dex_to_hex($n/2).dex_to_hex($n/2);
			$clrl .= '';//dex_to_hex($n + ($m-$n)*0.6).dex_to_hex($n + ($m-$n)*0.6);
		} 

		$qf -> values (array ('name' => $color_keys[$c], 'weight' => ($c+1), 'baseclr' => $clr));
		$qc -> values (array ('name' => $color_keys[$c], 'family' => $color_keys[$c], 'shade' => 'pure', 'color' => $clr));
		$qc -> values (array ('name' => $data['dark'], 'family' => $color_keys[$c], 'shade' => 'dark',  'color' => $clrd));
		$qc -> values (array ('name' => $data['pastel'], 'family' => $color_keys[$c], 'shade' => 'pastel',  'color' => $clrl));
	}
	$qf->execute();
	$qc->execute();	
?>
