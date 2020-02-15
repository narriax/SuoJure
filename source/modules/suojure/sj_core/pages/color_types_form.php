<?php


function sj_core_pages_colortypes_form ($form, &$form_state) {
	
	sj_core_load_css('color_types', 'form');
	
	sjvar_set('colors', array());
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
	
	$availabe_weights = array ();
	for ($i=1; $i < 100; $i++) {
		$availabe_weights[$i] = $i;
	}	
	
	$taken_weights = array();
	foreach ($clr_types as $type => $data) {
		$taken_weights[] = $data->weight;
		$form['_cur']['type_'.$type.'_weight'] = array (
			'#type' => 'select',
			'#title' => t(ucfirst($type)),
			'#options' => $availabe_weights,
			'#default_value' => $data->weight,
			'#prefix' => '<div class=one-type-line>',
		);		
		$form['_cur']['type_'.$type.'_desc'] = array (
			'#type' => 'textfield',
		//	'#title' => t(ucfirst($type)),
			'#default_value' => $data->description,
			'#suffix' => '</div>',
		);
	}

	$form['_cur']['_save_btn'] = array (
		'#type' => 'submit',
		'#value' => t('Save Changes'),
		'#attributes' => array ('disabled' => 'disabled'),
		'#suffix' => '<font color=red>#TODO: change names and weight</font>',
	);
	
	// ============== new 

	foreach ($taken_weights as $i) {
		unset($availabe_weights[$i]);
	}
	$default_weight = (ceil(max($taken_weights) + 1)/10) * 10;
	
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
		//'#attributes' => array ('disabled' => 'disabled'),
		//'#suffix' => '<font color=red>#TODO: add new color types</font>',
	);	
	
	return $form;
}

function sj_core_pages_colortypes_form_validate ($form, &$form_state) {
	if ($form_state['triggering_element']['#id'] == 'edit-new-btn') {
		$clr_types = sjColorSet::get_color_types(true);
		$form_state['values']['_new_name'] = trim($form_state['values']['_new_name']);
		$form_state['values']['_new_desc'] = trim($form_state['values']['_new_desc']);
		if (empty($form_state['values']['_new_name'])) 
			form_set_error('_new_name', t('Name cannot be empty.'));
		else if (in_array($form_state['values']['_new_name'],$clr_types)) {
			form_set_error('_new_name', t('Name already exists.'));
		}
		if (empty($form_state['values']['_new_desc']))
			$form_state['values']['_new_desc'] = null;
	}
}

function sj_core_pages_colortypes_form_submit ($form, &$form_state) {
	if ($form_state['triggering_element']['#id'] == 'edit-new-btn') {
		$q = db_insert('sj_clrtype')
		   -> fields(array('name', 'description', 'weight'))
		   -> values(array(0 => array(
			'name' => strtolower($form_state['values']['_new_name']),
			'description' => $form_state['values']['_new_desc'],
			'weight' => $form_state['values']['_new_weight'],
		)))->execute();
	}
}
