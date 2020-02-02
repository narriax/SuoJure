<?php


function sj_core_pages_colortypes_form ($form, &$form_state) {
	$clr_types = sjColorSet::GetColorTypes(true);
	dpm($clr_types);
	
	$taken_weights = array();
	foreach ($clr_types as $type => $data) {
		$taken_weights[] = $data->weight;
		$form['type_'.$type] = array (
			'#type' => 'textfield',
			'#title' => t(ucfirst($type)),
			'#value' => $data->description,
			'#field_prefix' => '<span class=weight>'.$data->weight.'</span>',
		);
	}
	
	$default_weight = 11111;
	$availabe_weights = array ();
	for ($i=1; $i < 100; $i++) {
		if (in_array($i, $taken_weights)) continue;
		$availabe_weights[$i] = $i;
		if ($i < $default_weight)
			$default_weight = $i;
		if ($default_weight%10 != 0 && $i%10 == 0)
			$default_weight = $i;
	}
	
	$form['_new'] = array (
		'#type' => 'fieldset',
		'#title' => '+'.t('Add New'),
	);
	$form['_new']['_new_weight'] = array (
		'#type' => 'select',
		'#options' => $availabe_weights,
		'#title' => t('Weight'),
		'#default_value' => $default_weight,
	);	
	$form['_new']['_new_name'] = array (
		'#type' => 'textfield',
		'#title' => t('Name'),
	);
	$form['_new']['_new_desc'] = array (
		'#type' => 'textfield',
		'#title' => t('Description'),
	);
	
	return $form;
}

function sj_core_pages_colortypes_form_validate ($form, &$form_state) {
	
}

function sj_core_pages_colortypes_form_submit ($form, &$form_state) {
	
}