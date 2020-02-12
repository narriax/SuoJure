<?php


function sj_core_pages_colortypes_form ($form, &$form_state) {
	
		drupal_add_css(drupal_get_path('module', 'sj_core').'/pages/colors.css');
	
	$clr_types = sjColorSet::get_color_types(true);
	//dpm($clr_types);

	$form['blurb'] = array (
		'#markup' => '<div class="blurb">'.t('Color types help define coherent color themes by explaining how the color will be used (main, background, border, etc)</div>'),
	);

	$form['_cur'] = array (
		'#type' => 'fieldset',
		'#title' => t('Current color types'),
		'#prefix' => '<div class="half-pane">',
		'#suffix' => '</div><!-- half-pane end -->',
	);
	
	$taken_weights = array();
	foreach ($clr_types as $type => $data) {
		$taken_weights[] = $data->weight;
		$form['_cur']['type_'.$type] = array (
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
	
	$form['_cur']['_save_btn'] = array (
		'#type' => 'submit',
		'#value' => t('Save Changes'),
		'#attributes' => array ('disabled' => 'disabled'),
		'#suffix' => '<font color=red>#TODO: change names and weight</font>',
	);
	
	// ============== new 
	
	$form['_new'] = array (
		'#type' => 'fieldset',
		'#title' => t('Add New Color Type'),
		'#prefix' => '<div class="half-pane">',
		'#suffix' => '</div><!-- half-pane end -->',
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
	$form['_new']['_new_btn'] = array (
		'#type' => 'submit',
		'#value' => t('Add New'),
		'#attributes' => array ('disabled' => 'disabled'),
		'#suffix' => '<font color=red>#TODO: add new color types</font>',
	);	
	
	return $form;
}

function sj_core_pages_colortypes_form_validate ($form, &$form_state) {
	
}

function sj_core_pages_colortypes_form_submit ($form, &$form_state) {
	
}