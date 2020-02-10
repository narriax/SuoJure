<?php

function sj_core_pages_personas_form($form, &$form_state) {
	
	sj_core_load_css('personas', 'form');
	
	$form['blurb'] = array (
		'#markup' => '<div class=blurb>'.
			t('Personas allow multiple "usernames" to be used by the same profile.').'<br>'. 
			t('Authoring content and general access rules will respect this subdivision 
			while still following the parent profile rules as well.').'</div>',
	);
	
	$clr_types = sjColorSet::GetColorTypes();
	$clr_families = sjColorSet::get_color_families();
	$clrs = sjColorSet::get_colors();
	
	$form_state['current_user'] = new sjUser();
	if (!isset($form_state['current_user'])) {
		$form['nou'] = array ('#markup' => 'no access');
		return $form;
	}
	
	$count = 0;
	foreach ($form_state['current_user']->personas as $pgrp => $ps)
		$count += count($ps->members);
	
	if ($count == 0) {
		$form['no_cotnent'] = array (
		'#markup' => '<div class="blurb no-content">'.
			t('No personas have been created for your profile.').'</div>',
		);
	}
	
	
	$weght_options = array();
	for ($i=0; $i < 100; $i++)
		$weght_options[$i] = $i;
	
	
	$form['grps'] = array (
		'#type' => 'fieldset',
		'#attributes' => array ('class' => array ('section-groups', 'flex-table')),
	);
		
	foreach ($form_state['current_user']->personas as $pgrp => $ps) {
		$groups[$pgrp] = $pgrp;
		
		$form['grps']['grp_'.$pgrp] = array (
			'#type' => 'fieldset',
			'#title' => ($pgrp == -1 ? '- ungrouped -' : (empty($ps->name) ? '&nbsp;' : $ps->name)),
			'#attributes' => array ('class' => array ('persona-group', 'flex-col')),
		);
			
		foreach ($ps->members as $pid => $pdata) {
			$form['grps']['grp_'.$pgrp]['p_'.$pid] = array (
				'#type' => 'fieldset',
				'#attributes' => array ('class' => array ('persona-line')),
			);
					
			$form['grps']['grp_'.$pgrp]['p_'.$pid]['p_'.$pid.'_name'] = array (
				'#type' => 'textfield',
				'#default_value' => $pdata->name,
				'#maxlength' => 16,
			);
			
			$form['grps']['grp_'.$pgrp]['p_'.$pid]['p_'.$pid.'_delete'] = array (
				'#markup' => '<div class="form-item form-type-links">'.
					'<a href="">edit</a> &nbsp; '.
					'<a href="">delete</a>'.
				'</div>',
			);	
		}
		
		$form['grps']['grp_'.$pgrp]['_new'] = array (
			'#type' => 'fieldset',
			'#attributes' => array ('class' => array ('persona-line')),
		);

		$form['grps']['grp_'.$pgrp]['_new']['grp_'.$pgrp.'__new'] = array (
			'#title' => '+'.t('New Persona'),
			'#type' => 'textfield',
			'#maxlength' => 16,
		);
	}
	$form['grps__btnsave'] = array(
		'#type' => 'submit',
		'#value' => t('Save Personas'),
		'#prefix' => '<br>',
	);	
	
	
	$form['grplist'] = array (
		'#type' => 'fieldset',
		'#title' => t('Groups'),
		'#collapsible' => true,
//		'#collapsed' => true,
		'#attributes' => array ('class' => array ('persona-group-list')),
	);
	$groups = array('-1' => 'None');
	foreach ($form_state['current_user']->personas as $pgrp => $ps) {
		if ($pgrp == -1) continue;
			
		$form['grplist']['grp_'.$pgrp] = array (
			'#type' => 'fieldset',
			//'#title' => $ps->name,
		);
		$form['grplist']['grp_'.$pgrp]['grp_'.$pgrp.'_name'] = array (
			'#type' => 'textfield',
			'#title' => t('Name'),
			'#default_value' => $ps->name,
			'#attributes' => array ('class' => array ('persona-group-line')),
		);
		$form['grplist']['grp_'.$pgrp]['grp_'.$pgrp.'_weight'] = array (
			'#type' => 'select',
			'#title' => t('Weight'),
			'#options' => $weght_options,
			'#default_value' => $ps->weight,
			'#attributes' => array (
				'class' => array ('persona-group-line'),
			),
		);	
	}	
	
	$form['grplist']['grp__new'] = array (
		'#type' => 'fieldset',
	);
	$form['grplist']['grp__new']['new_group_newname'] = array (
		'#title' => '+'.t('New Group'),
		'#type' => 'textfield',
		'#maxlength' => 16,
	);
	$form['grplist']['save_groups'] = array(
		'#type' => 'submit',
		'#value' => t('Save Groups'),
	);	
	
	
	
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
	dpm($form_state['values']);
	//dpm($form_state['triggering_element']['#id']);
	
	if ($form_state['triggering_element']['#id'] === 'edit-save-groups') {
		foreach ($form_state['current_user']->personas as $pgrp => $grp_data) {
			//if ($form_state['values']['grp_'.$pgrp.'_name'] != $grp_data -> name)
		}
		
	} else if ($form_state['triggering_element']['#id'] === 'edit-new-btn') {
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
	if ($form_state['triggering_element']['#id'] === 'edit-save-groups') {
		foreach ($form_state['current_user']->personas as $pgrp => $grp_data) {
			
			if ($pgrp == -1) continue;
				
			$newname = trim($form_state['values']['grp_'.$pgrp.'_name']);
			$newweight = $form_state['values']['grp_'.$pgrp.'_weight'];
			if (empty($newname)) {
				$q = db_delete('sj_user_prsgroup')
				   ->condition(db_and()
						->condition('id', $pgrp)
						->condition('username', $form_state['current_user']->username)
					)
				   ->execute();
				$q = db_update('sj_user_persona')
					->fields(array('grp' => 0))
					->condition(db_and()
						->condition('grp', $pgrp)
						->condition('username', $form_state['current_user']->username)
					)->execute();
			} else {
				if ($newname != $grp_data->name || $newweight != $grp_data->weight) {
					$q = db_update('sj_user_prsgroup')
					   ->fields(array('name' => $newname, 'weight' => $newweight, 'date_last_modified' => timestamp_sql()))
					   ->condition(db_and()
							->condition('id', $pgrp)
							->condition('username', $form_state['current_user']->username)
						)->execute();
				}
			}
		}
		
		$newname = trim($form_state['values']['new_group_newname']);
		if (!empty($newname)) {
			$q = db_insert('sj_user_prsgroup')
			   ->fields(array('id', 'name', 'username'))
			   ->values(array(0 => array(
					'id' => generate_new_uoid(array('sj_user_prsgroup' => 'id', 'sj_user_persona'=>'id'), 4,4),
					'name' => $newname,
					'username' => $form_state['current_user']->username,
				)));
				dvm($q.'');
				$q->execute();
		}

	} else if ($form_state['triggering_element']['#id'] === 'edit-new-btn') {
		$q = db_insert('sj_user_persona') -> fields(array(
			'id' => $form_state['values']['new_id'],
			'username' => $form_state['current_user']->username,
			'name' => $form_state['values']['new_name'],
			'grp' => $form_state['values']['new_group_sel'],
		))->execute();
		
	}

}


