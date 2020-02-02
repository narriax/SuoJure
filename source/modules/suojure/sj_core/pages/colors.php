<?php

/*
function dex_to_hex($dex) {
	if ($dex < 0) return '0';
	if ($dex > 15) return 'f';
	$dex = round($dex);
	switch ($dex) {
		case 10: return 'a';
		case 11: return 'b';
		case 12: return 'c';
		case 13: return 'd';
		case 14: return 'e';
		case 15: return 'f';
		default: return $dex.'';
	}
}*/


function sj_core_pages_colors_form ($form, &$form_state) {
	
	drupal_add_css(drupal_get_path('module', 'sj_core').'/pages/colors.css');
	
	 
	$clr_families = sjColorSet::GetColorFamilies();
	$clrs = sjColorSet::GetPresetColors();
	
	$shades = array('pastel', 'pure', 'dark');
	foreach ($clr_families as $cf => $cbase) {
		$clr_families[$cf] = array ('base' => $cbase);
		foreach ($clrs as $c => $cdata) {
			if ($cdata->family == $cf)
				$clr_families[$cf][$cdata->shade] = array($c => $cdata->color);
			if (!in_array($cdata->shade, $shades)) $shades[] = $cdata->shade;
		}
	}
	//dpm($clr_families);

	$t = '';
	foreach ($clr_families as $cf => $cfdata) {	
		$t .= '<tr><td>'.$cf.'</td>';
		foreach ($shades as $sh)
			$t .= '<td style="background: #'.$cfdata[$sh][array_keys($cfdata[$sh])[0]].';">'.array_keys($cfdata[$sh])[0].'</td>';
		$t .= '</tr>';
	}
	$t = '<table>'.$t.'</table>';


	$form['colors'] = array (
		'#type'=> 'fieldset',
		'#title' => t('Colors'),
		//'#prefix' => $t,
	);

	foreach ($clr_families as $f => $fdata) {
		$form['colors']['clrs_'.$f] = array (
			'#type'=> 'fieldset',
			'#title' => t(ucfirst($f).'s'),
			'#prefix' => '<span class="swatch color-family '.$f.'"></span>',
			'#attributes' => array('class' => array('color-family')),
		);
		
		foreach ($shades as $sh) {
			foreach ($cfdata[$sh] as $clrname => $clr) {
				$form['colors']['clrs_'.$f]['clrs__'.$clrname] = array (
					'#type'=> 'fieldset',
					'#title' => t($clrname),
					'#attributes' => array('class' => array('color-pane')),
				);
				$form['colors']['clrs_'.$f]['clrs__'.$clrname]['clrs__'.$clrname.'_name'] = array (
					'#type'=> 'textfield',
					'#value' => $clrname,
				);
				$form['colors']['clrs_'.$f]['clrs__'.$clrname]['clrs__'.$clrname.'_color'] = array (
					'#type'=> 'jquery_colorpicker',
					'#default_value' => $clr,
					'#value' => $clr,
				);
			}
		}
		
		$form['colors']['clrs_'.$f]['clrs_'.$f.'_new'] = array (
			'#type'=> 'fieldset',
			'#title' => t('New Color'),
			'#attributes' => array('class' => array('color-pane')),
		);
		
		$form['colors']['clrs_'.$f]['clrs_'.$f.'_new']['clrs_'.$f.'_new_name'] = array (
			'#type'=> 'textfield',
			//'#title' => '+'.t('New Color Name'),
		);
		$form['colors']['clrs_'.$f]['clrs_'.$f.'_new']['clrs_'.$f.'_new_color'] = array (
			'#type'=> 'jquery_colorpicker',
			'#default_value' => $fdata['base'],
			//'#title' => '+'.t('New Color'),
		);
		$form['colors']['clrs_'.$f]['clrs_'.$f.'_new']['clrs_'.$f.'_new_btn'] = array (
			'#type'=> 'submit',
			'#value' => t('Add'),
		);
		
		$form['colors']['clrs_'.$f]['clrs_'.$f.'_save'] = array (
			'#type' => 'submit',
			'#value' => t('Save'),
		);
	}

	return $form;
}


function sj_core_pages_colors_form_validate ($form, &$form_state) {
	dpm($form_state['values']);
	$changes = array();
	$name_el = '';
	$color_el = '';
	
	$clr_families = sjColorSet::GetColorFamilies();
	foreach ($clr_families as $f => $fbase) {
		if ($form_state['triggering_element']['#id'] == 'edit-clrs-'.$f.'-new-btn') {
			$changes['action'] = 'add';
			$changes['family'] = $f;
			$name_el = 'clrs_'.$f.'_new_name';
			$color_el = 'clrs_'.$f.'_new_color';
			break;
		} else if ($form_state['triggering_element']['#id'] == 'edit-clrs-'.$f.'-save') {
			$changes['action'] = 'edit';
			$changes['family'] = $f;
			break;
		}
	}
	
	if (empty($changes) || empty($color_el) || empty($name_el)) {
		form_set_error('', t('Nothing to save'));
		return false;
	}
	
	$changes['name_el'] = $name_el;
	$changes['color_el'] = $color_el;
	$changes['name'] = $form_state['values'][$name_el];
	$changes['color'] = $form_state['values'][$color_el];
	$errpath = 'colors][clrs_'.$changes['family'].'][clrs_'.$changes['family'].'_new][';
	if (empty($form_state['values'][$name_el])) {
		form_set_error($errpath.$name_el, t('Name cannot be empty'));
	}
	
	dpm($changes);
	
}


function sj_core_pages_colors_form_submit ($form, &$form_state) {
	//dpm($form_state['triggering_element']);

}
