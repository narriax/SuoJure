<?php

function sj_core_pages_persona_edit_form ($form, &$form_state) {
	sj_core_load_css('persona_edit', 'form');
	
	// get current user
	$usr = new sjUser();
	if (!isset($usr))
		return $form;
	
	// check user has personas
	if (empty($usr->personas)) {
		$form['no_content'] = array (
			'#markup' => '<div class="blurb no-content">'.t('No personas have been created for your profile.').'</div>',
		);		
		return $form;
	}
	
	// get current persona id
	$pid = sjvar('persona');
	if ($pid <= 0) {
		$form['no_cotnent'] = array (
		'#markup' => '<div class="blurb no-content">'.t('Select a persona to view.').'</div>',
		);		
		return $form;
	}
	
	// get current persona
	$persona = null;
	foreach ($usr->personas as $pgrp => $pgrpdata) {
		foreach ($pgrpdata->members as $p => $pdata) 
			if ($p == $pid) {
				$persona = $pdata;
				break;
			}
	}
	
	// no persona selected
	if (!isset($persona)) {
		$form['no_cotnent'] = array (
			'#markup' => '<div class="blurb no-content">'.t('Select a persona to view.').'</div>',
		);	
		return $form;
	}
	
	// perform link actions
	$editmode = false;
	if (array_key_exists('action', $_GET)) {
		switch ($_GET['action']) {
			case 'delete':
				$q = db_delete('sj_user_persona')->condition('id', $_GET['pid'])->execute();
				break;
			case 'activate':
				$q = db_update('sj_user_persona')->fields(array('active' => $_GET['active']))->condition('id', $_GET['pid'])->execute();
				$persona->active = ($_GET['active'] == 1);
				break;
			case 'edit':
				$editmode = $_GET['edit'];
				break;
			case 'attachcolors':
				// todo: do not insert redundants
				if (!isset($persona->colorset) || $persona->colorset->setid <= 0) {					
					$editmode = false;
					$newid = generate_new_uoid(array('sj_clrset'=>'id'), 4,4);
					$q = db_insert('sj_clrset')->fields(array('id'))->values(array(0 => array('id' => $newid)))->execute();
					$q = db_update('sj_user_persona')->fields(array('clrsetid' => $newid))->condition('id', $_GET['pid'])->execute();
					$persona->colorset = new sjColorSet($newid);
				}
				break;
		}
	}	
	
	//$persona->colorset->colors['primary'] = '551100';
	//$persona->colorset->colors['secondary'] = 'ff0000';
	//var_dump($persona);
	
	
	$form['header_open'] = array ('#markup' => '<div class="header persona-'.($persona->active ? 'active' : 'inactive').'">');
		
	$form['header_links'] = array ('#markup' => 
			'<div class=mark-inactive>'.($persona->active ? '&nbsp;' : '['.t('inactive').']').'</div>'.
			'<div class=header-actions>'.
				'<a href="?action=edit&edit='.($editmode ? 0 : 1).'">'.($editmode ? t('view') : t('edit')).'</a>'.
				'<a href="?action=activate&pid='.$pid.'&active='.($persona->active ? 0 : 1).'">'.($persona->active ? t('deactivate') : t('activate')).'</a>'.
				'<a href="?action=delete&pid='.$pid.'">'.t('delete').'</a>'.
		'</div>',
	);		
		
	
		
	if (!$editmode) {
		$form['title'] = array ('#markup' => '<h3>'.$persona->name.'</h3>');
		$form['signature'] = array ('#markup' => 
			'<div class="view-line signature"><label>Signature</label>: '.
			(empty($persona->signature) ? '<span class=no-content>- none -</span>' : $persona->signature.'</div>'));
		
		
		if (isset($persona->colorset)) {
			$form['color_set'] = array (
				'#type' => 'fieldset',
				'#title' => t('Colors'),
				'#attributes' => array(),
			);
			if (array_key_exists('primary', $persona->colorset->colors))
				$form['color_set']['#attributes']['style'] = 'background: #'.$persona->colorset->colors['primary'];
			
			$allcolrs = sjColorSet::get_colors();
			$clrtypes = sjColorSet::get_color_types();
			foreach ($clrtypes as $tp =>$typedata) {
				$tpp = $typedata->name;
				$clrname = '';
				$clr = 'eeeeee';
				if (array_key_exists($tpp, $persona->colorset->colors)) {
					$clr = $persona->colorset->colors[$tpp];
					foreach ($allcolrs as $clrn => $clrdata) {
						if ($clrdata->color === $clr)
							$clrname = '- '.$clrdata->name.' -';
					}
				}
				$form['color_set'][$tpp] = array (
					'#markup' => '<div class="color-block type-'.$tpp.'" style="background: #'.$clr.';" title="#'.$clr.'">'.
						'<label style="color: #'.sjColorSet::label_color($clr).'">'.$tpp.'<br>'.$clrname.'</label></div>'
				);
			}
		}
		
		
	} else  {
		$form['name'] = array (
			'#type' => 'textfield',
			'#title' => t('Name'),
			'#default_value' => $persona->name,
			'#maxlength' => 16,
		);
	}
	
	$form['header_close'] = array ('#markup' => '</div>');
		
		
	if ($editmode) {
		$form['pid'] = array (
			'#type' => 'hidden',
			'#value' => $persona->id,
		);
		
		$form['weight'] = array (
			'#type' => 'select',
			'#options' => array($persona->weight => $persona->weight),
			'#title' => t('Weight'),
			'#default_value' => $persona->weight,
		);
		for ($i=0; $i < 50; $i++) 
			$form['weight']['#options'][$i*10] = $i*20;
		ksort($form['weight']['#options']);
		
		$form['signature'] = array (
			'#type' => 'textarea',
			'#title' => t('Signature'),
			'#maxlength' => 255,
			'#default_value' => $persona->signature,
		);
		
		if (isset($persona->colorset)) {
			$form['color_set'] = array (
				'#type' => 'fieldset',
				'#title' => t('Colors'),
			);
			
			$form['color_set']['setid'] = array (
				'#type' => 'hidden',
				'#value' => $persona->colorset->setid,
			);
			
			$clrtypes = sjColorSet::get_color_types();
			foreach ($clrtypes as $tp => $typedata) {
				$tpp = $typedata->name;
				$clr = 'eeeeee';
				if (array_key_exists($tpp, $persona->colorset->colors))
					$clr = $persona->colorset->colors[$tpp];
				
				$form['color_set']['clrtype_'.$tpp] = sjColorSet::palette_widget('edit-clrtype-'.$tpp, $tpp, $clr);
				$form['color_set']['clrtype_'.$tpp]['#prefix'] = '<div class="color-block color-block-edit type-'.$tpp.'" style="background: #'.$clr.'; color: #'.sjColorSet::label_color($clr).';">';
				$form['color_set']['clrtype_'.$tpp]['#suffix'] = '</div>';
				$form['color_set']['clrtype_'.$tpp]['#attributes']['dbexists'] = array_key_exists($tpp, $persona->colorset->colors);
			}				
		} else {
			$form['color_set'] = array (
				'#markup' => '<div class="attach attach-colors"><a href="?action=attachcolors&pid='.$pid.'">'.t('Attach colors').'</a></div>',
			);
		}
		
		$form['btn_save'] = array (
			'#type' => 'submit',
			'#value' => t('Save Changes'),
		);
	} 
	

	
	

	return $form;
}


function sj_core_pages_persona_edit_form_validate ($form, &$form_state) {
	$form_state['values']['name'] = trim($form_state['values']['name']);
	if (empty($form_state['values']['name']))
		form_set_error('name', t('Name cannot be empty.'));
}


function sj_core_pages_persona_edit_form_submit ($form, &$form_state) {
	$q = db_update('sj_user_persona')->fields(array(
		'name' => $form_state['values']['name'],
		'signature' => $form_state['values']['signature'],
		'weight' => $form_state['values']['weight'],
		'date_last_modified' => date('Y-m-d H:i:s'),
	))->condition('id', $form_state['values']['pid'])->execute();
	
	$clrtypes = sjColorSet::get_color_types();
	foreach ($clrtypes as $tp =>$typedata) {
		$tpp = $typedata->name;
		$clr = str_replace('#','', trim($form_state['values']['clrtype_'.$tpp]));
		
		$exists = $form['color_set']['clrtype_'.$tpp]['#attributes']['dbexists'];
		if (!$exists)
			$q = db_insert('sj_clrset_clrs') 
		       -> fields (array('clrsetid', 'clrtype', 'clr'))
			   -> values (array(0 => array(
					'clrsetid' => $form_state['values']['setid'],
					'clrtype' => $tpp,
					'clr' => $clr,
				))) -> execute();
		else 
			$q = db_update('sj_clrset_clrs') 
			   -> fields (array('clr' => $clr))
			   -> condition (db_and() 
					-> condition('clrsetid', $form_state['values']['setid'])
					-> condition('clrtype', $tpp)
				) -> execute();
	}
}


