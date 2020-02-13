<?php

function sj_core_pages_personas_form($form, &$form_state) {
	
	sj_core_load_css('personas', 'form');
	
	if (array_key_exists('action', $_GET)) {
		switch($_GET['action']) {
			case 'move':
				$q = db_update('sj_user_persona')->fields(array('grp' => $_GET['grp']))->condition('id', $_GET['pid'])->execute();
				break;
			case 'activate':
				$q = db_update('sj_user_persona')->fields(array('active' => $_GET['active']))->condition('id', $_GET['pid'])->execute();
				break;
			case 'crown':
				$q = db_update('sj_user_prsgroup')->fields(array('default_pid' => $_GET['pid']))->condition('id', $_GET['grp'])->execute();
				break;
		}
	}
	
	
	
	
	
	
	
	
	$form['blurb'] = array (
		'#markup' => '<div class=blurb>'.
			t('Personas allow multiple "usernames" to be used by the same profile as well as attaching extra information to the user.').'<br>'. 
			t('Authoring content and general access rules will respect this subdivision 
			while still following the parent profile rules as well.').'</div>',
	);
	
	$clr_types = sjColorSet::get_color_types();
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
		
	
	$imgpath = $GLOBALS['base_url'].'/'.drupal_get_path('theme', 'suojure').'/images/';
	$groups = array_keys($form_state['current_user']->personas);
	
	$maxcount = 0;
	for ($g=0; $g < count($groups); $g++)
		$maxcount = max ($maxcount, count($form_state['current_user']->personas[$groups[$g]]->members));
	
	for ($g=0; $g < count($groups); $g++) { // $form_state['current_user']->personas as $pgrp => $ps) {	
		$grp_data = $form_state['current_user']->personas[$groups[$g]];
		
		$form['grps']['grp_'.$groups[$g]] = array (
			'#type' => 'fieldset',
			'#title' => ($groups[$g] == -1 ? '- ungrouped -' : (empty($grp_data->name) ? '&nbsp;' : $grp_data->name)),
			'#attributes' => array ('class' => array ('persona-group', 'flex-col')),
		);
		
		$pkeys = array();
		foreach ($grp_data->members as $pid => $pdata) 
			if ($grp_data->default_pid == $pid) $pkeys[$pid] = '__crown';
			else $pkeys[$pid] = 'w'.str_pad($pdata->weight.'',3,'0',STR_PAD_LEFT);
		asort($pkeys);
		
		foreach ($pkeys as $pid => $w) {		
			$pdata = $grp_data->members[$pid];
			
			$items = array (
				'crown' => array (
					'text' => ($grp_data->default_pid == $pid ?'&#9733;':'&nbsp;'),
					'icon' => '',
					'class' => 'persona-crown',
					'tooltip' => t('make group\'s primary'),
					'url' => '?action=crown&pid='.($grp_data->default_pid == $pid ? -1 : $pid).'&grp='.$groups[$g],
				),
				'active' => array (
					'text' => ($pdata->active?'&#x2714;':'&nbsp;'),
					'icon' => '',
					'class' => 'persona-active',
					'tooltip' => t('toggle active status'),
					'url' => '?action=activate&pid='.$pid.'&active='.($pdata->active?0:1),
				),
				'name' => array (
					'text' => $pdata->name,
					'icon' => '',
					'class' => 'persona-name form-item',
					'tooltip' => $pdata->signature,
					'url' => 'persona?persona='.$pid,
				),			
			);
			if ($g > 0) $items['left'] = array (
					'text' => t('move left'),
					'icon' => 'arrow_left.png',
					'class' => 'persona-move link-left',
					'tooltip' => t('move left'),
					'url' => '?action=move&pid='.$pid.'&grp='.$groups[$g-1],
			);
			if ($g < count($groups)-1) $items['right'] = array (
					'text' => t('move right'),
					'icon' => 'arrow_right.png',
					'class' => 'persona-move link-right',
					'tooltip' => t('move right'),
					'url' => '?action=move&pid='.$pid.'&grp='.$groups[$g+1],
			);
					
			$line = '';
			foreach ($items as $itemname => $itemvalues) {
				$line .= '<a href="'.$itemvalues['url'].'" class="'.$itemvalues['class'].'" title="'.$itemvalues['tooltip'].'">';
				if (!empty($itemvalues['icon'])) 
					$line .= '<img src="'.$imgpath.$itemvalues['icon'].'">';
				if (!empty($itemvalues['text'])) 
					$line .= '<label>'.$itemvalues['text'].'</label>';
				$line .= '</a>';
			}
			
			$form['grps']['grp_'.$groups[$g]]['p_'.$pid] = array (
				'#markup' => '<div class="persona-line '.($pdata->active ? 'active' : 'inactive').'">'.$line.'</div>'
			);
		}
		for ($i=count($pkeys); $i < $maxcount; $i++)
			$form['grps']['grp_'.$groups[$g]]['p___'.$i] = array ('#markup' => '<div class="persona-line">&nbsp;</div>');
	
		
		$form['grps']['grp_'.$groups[$g]]['_new'] = array (
			'#type' => 'fieldset',
			'#attributes' => array ('class' => array ('persona-line')),
		);

		$form['grps']['grp_'.$groups[$g]]['_new']['grp_'.$groups[$g].'__new'] = array (
			//'#title' => '+'.t('New Persona'),
			'#type' => 'textfield',
			'#maxlength' => 16,
		);
	}
	$form['btnsave'] = array(
		'#type' => 'submit',
		'#value' => t('Save Personas'),
		'#prefix' => '<br>',
		'#default' => true,
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
	
	return $form;
}



function sj_core_pages_personas_form_validate($form, &$form_state) {
	//var_dump($form_state['values']);
	//dpm($form_state['triggering_element']['#id']);
	
	if ($form_state['triggering_element']['#id'] === 'edit-save-groups') {
		foreach ($form_state['current_user']->personas as $pgrp => $grp_data) {
			//if ($form_state['values']['grp_'.$pgrp.'_name'] != $grp_data -> name)
		}
		
	} else {
		//$form_state['current_user']

		$form_state['values']['inserts'] = array();
		if (!empty(trim($form_state['values']['grp_-1__new']))) {
			$form_state['values']['inserts'][-1] = trim($form_state['values']['grp_-1__new']);
		}
		
		foreach ($form_state['current_user']->personas as $grp => $grp_members) {
			if (!empty(trim($form_state['values']['grp_'.$grp.'__new']))) {
				$form_state['values']['inserts'][$grp] = trim($form_state['values']['grp_'.$grp.'__new']);
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

	} else {
		foreach ($form_state['values']['inserts'] as $grp => $newname) {
			$q = db_insert('sj_user_persona') -> fields(array(
				'id' => generate_new_uoid(array('sj_user_prsgroup' => 'id', 'sj_user_persona'=>'id'), 4,4),
				'username' => $form_state['current_user']->username,
				'name' => $newname,
				'grp' =>  $grp,
			))->execute();
		}
	
	}

}


