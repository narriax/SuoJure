<?php


function sj_core_pages_colors_form ($form, &$form_state) {

	sj_core_load_css('colors', 'form');
	 
	$clr_families = sjColorSet::get_color_families();
	$clr_shades = sjColorSet::get_color_shades(true);
	$clrs = sjColorSet::get_colors();
	
	foreach ($clr_families as $cf => $cbase) {
		$clr_families[$cf] = array ('base' => $cbase);
		foreach ($clrs as $c => $cdata) {
			if ($cdata->family == $cf)
				$clr_families[$cf][$cdata->shade] = array($c => $cdata->color);
			if (!array_key_exists($cdata->shade, $clr_shades)) $clr_shades[$cdata->shade] = '';
		}
	}

	$form['#attributes'] = array ('class' => array ('suojure-form form-colors'));

	// 	========================  shades form
	{
		
		$form['shades'] = array (
			'#type'=> 'fieldset',
			'#title' => t('Shades'),
			'#collapsible' => true,
			'#collapsed' => true,
		);
		$form['shades']['swatch'] = array (
			'#markup' => '<div class="expandable-content"><span class="swatch">&nbsp;</span> &nbsp; ',
		);	
		
		foreach ($clr_shades as $sh => $sh_data) {
			$shmath =  $sh_data->math.'';
			$clr1 = sjColorSet::alter_color('00bbff', $sh_data->math);
			$clr2 = sjColorSet::alter_color('ffbb00', $sh_data->math);
			
			$form['shades']['shade_'.$sh] = array (
				'#type'=> 'fieldset',
				'#title' => '<font color=#'.sjColorSet::label_color($clr1).'>'.t(ucfirst($sh)).'</font>',
				'#attributes' => array(
					'class' => array('color-pane'), 
					'style' => 'background: linear-gradient(#'.$clr1.',#'.$clr2.');'),
			);	
			$form['shades']['shade_'.$sh]['shade_'.$sh.'_math'] = array (
				'#type'=> 'textfield',
				'#maxlength' => 32,
				'#default_value' => $sh_data->math,
			);
			$form['shades']['shade_'.$sh]['shade_'.$sh.'_weight'] = array (
				'#type'=> 'textfield',
				'#default_value' => $sh_data->weight,
			);		
		}

		$form['shades']['__shade_controls_start'] = array (
			'#markup'=> '<div class="controls-group shades">&nbsp;<div style="text-align: left;">&nbsp; ',
		);
		
		$form['shades']['shade_save_btn'] = array (
			'#type'=> 'submit',
			'#value' => t('Save Shade Changes'),

		);	
		
		$form['shades']['_new_shade_name'] = array (
			'#title' => t('New Shade'),
			'#type'=> 'textfield',
			'#maxlength' => 16,
			'#prefix' => '</div><div style="text-align: right;">',
		);
		$form['shades']['_new_shade_btn'] = array (
			'#type'=> 'button',
			'#value' => t('Add Shade'),
			'#suffix' => '</div>',
		);
		

		$form['shades']['__shade_controls_end'] = array (
			'#markup'=> '&nbsp;</div></div>',
		);
	
	}
	
	
	// 	========================  colors form
	{
		
		$form['colors'] = array (
			'#type'=> 'fieldset',
			'#title' => t('Colors'),
			//'#prefix' => $t,
		);

		foreach ($clr_families as $f => $cfdata) {
			$form['colors']['clrs_'.$f] = array (
				'#type'=> 'fieldset',
				'#maxlength' => 16,
				'#title' => t(ucfirst($f).'s'),
				'#attributes' => array('class' => array('color-family')),
			);

			$form['colors']['clrs_'.$f]['swatch'] = array (
				'#markup' => '<span class="swatch" style="background: #'.$cfdata['base'].';"></span>',
			);
			
			$form['colors']['clrs_'.$f]['clrs_'.$f.'_save'] = array (
				'#type' => 'button',
				'#attributes' => array('class' => array('color-save-btn')),
				'#value' => t('Save '.$f.'s'),
			);
			
			foreach ($clr_shades as $sh => $sh_data) {				
				$shmath = $sh_data->math;
				if (!array_key_exists($sh, $cfdata)) {
					$cfdata[$sh] = array('' => '');
				}
				foreach ($cfdata[$sh] as $clrname => $clr) {
					if (empty($clr))
						$clr = sjColorSet::alter_color($cfdata['base'], $shmath);
								
					$clid = 'clrs_'.$f.'_'.$sh;
								
					$form['colors']['clrs_'.$f][$clid] = array (
						'#type'=> 'fieldset',
						'#title' => '<font color="'.sjColorSet::label_color($clr).'">'.t($clrname).'</font>',
						'#attributes' => array(
							'class' => array('color-pane'), 
							'style' => 'background: #'.$clr.';',
							'title' => '#'.$clr),
					);
					if ($f == 'white') {
						$form['colors']['clrs_'.$f][$clid]['#weight'] = (256-(sjColorSet::hex_to_dex($clr[0])*16+sjColorSet::hex_to_dex($clr[1])));
					}
					
					$form['colors']['clrs_'.$f][$clid][$clid.'_shade'] = array (
						'#markup'=> '<div class="shade-label">'.$sh.'</div>',
					);

					$form['colors']['clrs_'.$f][$clid][$clid.'_name'] = array (
						'#type'=> 'textfield',
						'#default_value' => $clrname,
					);
				}
			}
		}
	}

	return $form;
}


function sj_core_pages_colors_form_validate ($form, &$form_state) {
	drupal_add_css(drupal_get_path('module', 'sj_core').'/pages/colors.css');

	//dpm($form_state['triggering_element']);
	if ($form_state['triggering_element']['#id'] == 'edit-new-shade-btn') {
		sj_core_pages_colors_form_newshade_validate ($form, $form_state);
	} if ($form_state['triggering_element']['#id'] == 'edit-shade-save-btn') {
		sj_core_pages_colors_form_saveshades_validate ($form, $form_state);
	} else {

		//dpm($form_state['values']);
		$changes = array(	'update' => array(), 'insert' => array(), 'delete' => array()	);
		$name_el = '';
		$color_el = '';
	
		$clr_families = sjColorSet::get_color_families();
		foreach ($clr_families as $f => $fbase) {
			if ($form_state['triggering_element']['#id'] == 'edit-clrs-'.$f.'-new-btn') {
				$changes['family'] = $f;
				$name_el = 'clrs_'.$f.'_new_name';
				$color_el = 'clrs_'.$f.'_new_color';
				
				if (empty($changes) || empty($color_el) || empty($name_el)) {
					form_set_error('', t('Nothing to save'));
					return false;
				}
		
				$changes['name_el'] = $name_el;
				$changes['color_el'] = $color_el;
				$errpath = 'colors][clrs_'.$changes['family'].'][clrs_'.$changes['family'].'_new][';
				if (empty($form_state['values'][$name_el])) {
					form_set_error($errpath.$name_el, t('Name cannot be empty'));
				} else {
					$changes['insert'][''] = $form_state['values'][$name_el];
					//$changes['color'] = $form_state['values'][$color_el];
					//
				}			
				break;
			} else if ($form_state['triggering_element']['#id'] == 'edit-clrs-'.$f.'-save') {
				$changes['family'] = $f;
				
				$allclrs = sjColorSet::get_colors();
				$clrs = sjColorSet::get_colors($f);
				$clr_shades = sjColorSet::get_color_shades(true);
				//dpm($clrs);
			
				foreach ($clr_shades as $sh => $shdata) {
					$old = '';
					if (array_key_exists($f, $shdata->colors)) 
						$old = array_keys($shdata->colors[$f])[0];
						
					$new = strtolower($form_state['values']['clrs_'.$f.'_'.$sh.'_name']);
					
					if (empty($old) && !empty($new)) {
						$changes['insert'][$sh] = $new;
					} else if (!empty($old) && empty($new)) {
						$changes['delete'][$sh] = $f;
						unset($allclrs[$old]);
					} else if ($old != $new) {
						$changes['update'][$sh] = $new;
					}
				}
				
				if (empty($changes['insert']) && empty($changes['update']) && empty($changes['delete'])) {
					form_set_error('', t('Nothing to save'));
				} else {
					foreach ($changes['update'] as $sh => $name) {
						if (array_key_exists($name, $allclrs)) {
							form_set_error('', t('Name already exists: ').$name);
							unset($changes['update'][$sh]);
						}
					}
					foreach ($changes['insert'] as $sh => $name) {
						if (array_key_exists($name, $allclrs)) {
							form_set_error('', t('Name already exists: ').$name);
							unset($changes['insert'][$sh]);
						}
					}
				}
				
				break;
			}
		}
			
		$form_state['changes'] = $changes;
		sj_core_pages_colors_form_submit($form, $form_state);
	}
}

function sj_core_pages_colors_form_submit ($form, &$form_state) {
	if (!array_key_exists('changes', $form_state) || empty($form_state['changes'])) return;
	
	foreach ($form_state['changes']['delete'] as $shade => $family) {
		$q = db_delete('sj_clr')
			->condition('family', $form_state['changes']['family'])
			->condition('shade', $shade);
		$q->execute();
	}
	
	foreach ($form_state['changes']['update'] as $shade => $name) {
		$q = db_update('sj_clr')
			->fields(array('name' => $name))
			->condition('family', $form_state['changes']['family'])
			->condition('shade', $shade);
		$q->execute();
	}
	
	foreach ($form_state['changes']['insert'] as $shade => $name) {
		//dvm($shade.'->'.$name);
		$q = db_insert('sj_clr')
			->fields(array(
				'name' => $name,
				'shade' => $shade,
				'family' => $form_state['changes']['family'],
				'color' => '',
			));
		$q->execute();			
	}	
}



function sj_core_pages_colors_form_newshade_validate ($form, &$form_state) {

	//dpm($form_state['triggering_element']);
	if ($form_state['triggering_element']['#id'] != 'edit-new-shade-btn') {
		form_set_error('shades][_new_shade][_new_shade_btn', t('Wrong action'));
	}
	
	$newName = trim(strtolower($form_state['values']['_new_shade_name']));
	$clr_shades = sjColorSet::get_color_shades();
	$form_state['values']['_new_shade_weight'] = 999;
	$form_state['values']['_new_shade_math'] = '';
		
	if (empty($newName)) {
		form_set_error('shades][_new_shade][_new_shade_name', t('Name cannot be empty'));
	} else if (array_key_exists($newName, $clr_shades)) {
			form_set_error('shades][_new_shade][_new_shade_name', t('Name already exists'));
	} else {
		sj_core_pages_colors_form_newshade_submit($form, $form_state);
	}
}

function sj_core_pages_colors_form_newshade_submit ($form, &$form_state) {
	if ($form_state['triggering_element']['#id'] == 'edit-new-shade-btn') {
		$newName = $form_state['values']['_new_shade_name'];
		$newWeight = $form_state['values']['_new_shade_weight'];
		$newMath = $form_state['values']['_new_shade_math'];
		
		$q = db_insert('sj_clrshades')->fields(array('name', 'math', 'weight'))->values(array($newName, $newMath, $newWeight));
		$q->execute();
	}
}



function sj_core_pages_colors_form_saveshades_validate ($form, &$form_state) {
	$clr_shades = sjColorSet::get_color_shades(true);
	foreach ($clr_shades as $sh => $sh_data) {		
		$newval = $form_state['values']['shade_'.$sh.'_math'];
		$newweight = $form_state['values']['shade_'.$sh.'_weight'];
		
		if ($newval != $sh_data->math || $newweight != $sh_data->weight) {
			$q = db_update('sj_clrshades')
				-> fields (array(
					'math' => $newval,
					'weight' => $newweight,
				))
				-> condition ('name', $sh);
			$q -> execute();
		}
	}
}


