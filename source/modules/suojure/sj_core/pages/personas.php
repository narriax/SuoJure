<?php

function sj_core_pages_personas_form($form, &$form_state) {
	
	//$personas = entity_load('sj_persona', array(), array('username' => $user->name), false);
	$clr_types = sjColorSet::GetColorTypes();
	$clr_families = sjColorSet::get_color_families();
	$clrs = sjColorSet::get_colors();
	//dpm($clr_families);
	
	$form_state['current_user'] = new sjUser();
	if (!isset($form_state['current_user'])) {
		$form['nou'] = array ('#markup' => 'no access');
		return $form;
	}
	dpm($form_state['current_user']);
	
	$groups = array('-1' => 'None');
	foreach ($form_state['current_user']->personas as $pgrp => $ps) {
		$groups[$pgrp] = $pgrp;
		
		$form['grp_'.$pgrp] = array (
			'#type' => 'fieldset',
			'#title' => $pgrp,
			'#attributes' => array ('class' => array ('persona-group')),
		);
		
		foreach ($ps as $pname => $pdata) {
			/*
			$form['grp_'.$pgrp]['p_'.$pname] = array (
				'#type' => 'fieldset',
				'#title' => $pname,
				'#attributes' => array ('class' => array ('one-persona')),
			);*/
			
			$form['grp_'.$pgrp]['p_'.$pname] = array (
				'#markup' => $pdata->name,
			);
		}
	}
	
	
	
	
	
	$form['new_title'] = array (
		'#markup' => '<hr><h3>'.t('Add New Persona').'</h3>',
	);
	
	$form['new_id'] = array (
		'#type' => 'hidden',
		'#value' => generate_new_uoid(array('sj_user_persona' => 'id'), 4, 4),
	);
	$form['new_username'] = array (
		'#type' => 'hidden',
		'#value' => $form_state['current_user']->username,
	);	

	$form['new_name'] = array (
		'#title' => t('Name'),
		'#type' => 'textfield',
		'#maxlength' => 16,
	);
	$form['new_group_newname'] = array (
		'#title' => t('New Group'),
		'#type' => 'textfield',
		'#maxlength' => 16,
	);
	$form['new_group_sel'] = array (	
		'#type' => 'select',
		'#options' => $groups,
	);

	/*
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
	}*/
	
	$form['new_btn'] = array(
		'#type' => 'submit',
		'#value' => t('Add New Persona'),
	);

	
	return $form;
}



function sj_core_pages_personas_form_validate($form, &$form_state) {
	//dpm($form_state['values']);
	
	if ($form_state['triggering_element']['#id'] === 'edit-new-btn') {
		//$form_state['current_user']

		if ($form_state['values']['new_group_sel'] == -1 && !empty($form_state['values']['new_group_newname'])) {
			$form_state['values']['new_group_sel'] = trim($form_state['values']['new_group_newname']);
		}
		
		$form_state['values']['new_name'] = trim($form_state['values']['new_name']);
		if (empty($form_state['values']['new_name']))
			form_set_error('new_name', t('Name cannot be empty'));
		else {
			$err = false;
			foreach ($form_state['current_user']->personas as $grp => $grp_members) {
				foreach ($grp_members as $pname => $pdata) {	
					if ($form_state['values']['new_name'] === $pname) {
						form_set_error('', t('Persona already exists').' ('.$grp.')');
						$err = true;
						break;
					}
				}
				if ($err) break;
			}
		}
	}	
}



function sj_core_pages_personas_form_submit($form, &$form_state) {
	
	if ($form_state['triggering_element']['#id'] === 'edit-new-btn') {
		$q = db_insert('sj_user_persona') -> fields(array(
			'id' => $form_state['values']['new_id'],
			'username' => $form_state['current_user']->username,
			'name' => $form_state['values']['new_name'],
			'grp' => $form_state['values']['new_group_sel'],
		))->execute();
		
	}

}


