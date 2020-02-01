<?php

function sj_core_pages_colors_form ($form, &$form_state) {
	
	$clr_families = sjColorSet::GetColorFamilies();
	$clrs = sjColorSet::GetPresetColors();
	
	$form['colors'] = array (
		'#type'=> 'fieldset',
		'#title' => t('Colors'),
		'#prefix' => '<table>',
		'#suffix' => '</table>',
	);

	foreach ($clr_families as $f) {
		$form['colors'][$f] = array (
			'#type'=> 'fieldset',
			'#title' => t(ucfirst($f)),
			'#prefix' => '<tr>',
			'#suffix' => '</tr>',
		);
		
		//foreach ($clrs as $cname => $clr) {
		//}
		
		$form['colors'][$f]['_'] = array (
			'#type'=> 'color_field_element_box',
			'#title' => '+'.t('New Color'),
			'#prefix' => '<td>',
			'#suffix' => '</td>',
		);
	}


	
	return $form;
}


function sj_core_pages_colors_form_validate ($form, &$form_state) {
	
}


function sj_core_pages_colors_form_submit ($form, &$form_state) {
	
}
