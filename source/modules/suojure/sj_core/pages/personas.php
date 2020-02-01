<?php

function sj_core_pages_personas_form($form, &$form_state) {
		
	global $user;
	$personas = entity_load('sj_persona', array(), array('username' => $user->name), false);
	$clr_types = sjColorSet::GetColorTypes();
	$clr_families = sjColorSet::GetColorFamilies();
	$clrs = sjColorSet::GetPresetColors();
	dpm($clr_families);
	

	
	$groups = array('-' => 'None');
	
	$form['new_title'] = array (
		'#markup' => '<hr><h3>'.t('Add New Persona').'</h3>',
	);
	
	$form['new_id'] = array (
		'#type' => 'hidden',
		'#value' => generate_new_uoid(array('sj_user_persona' => 'id'), 4, 4),
	);
	$form['new_username'] = array (
		'#type' => 'hidden',
		'#value' => $user->name,
	);	

	$form['new_name'] = array (
		'#title' => t('Name'),
		'#type' => 'textfield',
		'#maxlength' => 16,
	);

	$form['new_group'] = array (
		'#title' => t('Group'),
		'#type' => 'fieldset',
	);
	$form['new_group']['grp'] = array (	
		'#type' => 'select',
		'#options' => $groups,
		'#maxlength' => 16,
	);
	$form['new_group']['grpnew'] = array (
		'#title' => t('New Group'),
		'#type' => 'textfield',
		'#maxlength' => 16,
	);

	$form['new_color'] = array (
		'#title' => t('Colors'),
		'#type' => 'fieldset',
	);
	foreach ($clr_types as $ct) {
		$form['new_color']['clr_'.$ct] = array (	
			'#title' => t(ucfirst($ct)),
			'#type' => 'select',
			'#options' => $groups,
			'#maxlength' => 16,
		);
	}
	
	$form['submit'] = array(
		'#type' => 'submit',
		'#value' => t('Submit'),
	);

	
	return $form;
}



function sj_core_pages_personas_form_validate($form, &$form_state) {
	dpm($form_state['values']);

}



function sj_core_pages_personas_form_submit($form, &$form_state) {
	$grp = $form_state['values']['grp'];
	if ($form_state['values']['grp'] == -1 && $form_state['values']['grpnew']) {
	}
}


