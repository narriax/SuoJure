<?php

function sj_core_personas_block () {
	if (!user_access('access content')) 
		return '';
	
	sj_core_load_css('block_personas', 'block');
	//drupal_add_css(drupal_get_path('module', 'sj_core').'/blocks/block_personas.css');
	
	$usr = new sjUser();
	if (!isset($usr)) 
		return l(t('Log in'), 'login');

	// ======================

	$curp = sjvar('persona', '');
	$defp = $usr->get_default_persona();
	
	if (array_key_exists('clearache', $_GET)) {
		sjvar_set('persona', $defp);
		$curp = $defp;
	} else if (array_key_exists('persona', $_GET) && $_GET['persona'] != $curp) {
		sjvar_set('persona', $_GET['persona']);
		$curp = $_GET['persona'];
		header("Refresh:0");
	} else {
		if (empty($curp)) {
			$defp = $usr->get_default_persona();
			if (!empty($defp)) {
				sjvar_set('persona', $defp);
				$curp = $defp;
				header("Refresh:0");
			}
		}
	}
	
	$currents = array(
		'personas' => array ('name' => '', 'url' => '?persona='.$curp),
	);

	// ======================

	$links = array (
		'profile' => array (
			'' => array (
				'user' => array (
					'#text' => $usr->username,
					'#tooltip' => t('profile'),
				),
				'user/logout' => array(
					'#text' => t('logout'), 
					'#icon' => 'logout.png',
				),
			),
		),
		'personas' => array (),
	);
	
		
	foreach ($usr->personas as $pgrp => $ps) {
		if (empty($ps->members)) continue;
		
		$pkeys = array();
		foreach ($ps->members as $pid => $pdata) 
			if ($ps->default_pid == $pid) $pkeys[$pid] = '__crown';
			else $pkeys[$pid] = 'w'.str_pad($pdata->weight.'',3,'0',STR_PAD_LEFT);
		asort($pkeys);
		
		$links['personas'][$ps->name] = array();
		foreach ($pkeys as $pid => $w) {
			$pdata = $ps->members[$pid];
			if ($pid == $curp) $currents['personas']['name'] = $pdata->name;
			if (!$pdata->active) continue;
			$links['personas'][$ps->name]['?persona='.$pid] = array ('#text' => $pdata->name);
		}
		if (empty($links['personas'][$ps->name])) unset($links['personas'][$ps->name]);
	}
	
	if (count($links['personas']) > 0) {
		if (!array_key_exists('', $links['personas'])) $links['personas'][''] = array();
		$links['personas']['']['user/'.$usr->get_uid().'/personas'] = array(
			'#text' => t('manage'), 
			'#icon' => 'cog.png', 
			'#tooltip' => t('manage personas'));
	}

	// ======================
	global $GLOBALS;
	$imgpath = $GLOBALS['base_url'].'/'.drupal_get_path('theme', 'suojure').'/images/';

	$content = '';
	foreach ($links as $menuname => $menucontent) {
		$content .= '<div id="menu-'.$menuname.'" class="menu-line">'.PHP_EOL;
					
		if (array_key_exists($menuname, $currents))
			$content .= '<div class="current-item"><label>'.$currents[$menuname]['name'].'</label></div>'.PHP_EOL;
		
		foreach ($menucontent as $grpname => $grpcontent) {
			if (!empty($grpname)) {
				$content .= '<div id="menu-grp-'.$grpname.'" class="menu-group">'.
					'<label class="menu-group-name">'.$grpname.'</label>'.PHP_EOL;
				$content .= '<ul id="menu-grp-'.$grpname.'-container" class="menu-group-container">';
			}
		
			foreach ($grpcontent as $linkurl => $link) {
				$linktext = '';
				$linkicon = '';
				$linktooltip = '';
				if (array_key_exists('#text', $link)) $linktext = $link['#text'];
				if (array_key_exists('#icon', $link)) $linkicon = '<img src="'.$imgpath.$link['#icon'].'">';
				if (array_key_exists('#tooltip', $link)) $linktooltip = $link['#tooltip'];
				else $linktooltip = $linktext;
				if ($linkurl[0] !== '?') $linkurl = $GLOBALS['base_url'].'/'.$linkurl;

				$cls = '';
				if (!empty($linkicon)) $cls .= ' has-icon';
				if (array_key_exists($menuname, $currents) && $currents[$menuname]['url'] == $linkurl)
					$cls .= ' selected';
				
				
				$content .= '<li class="link-holder '.$cls.'">&nbsp;<a href="'.$linkurl.'" class="menu-link '.$cls.'" title="'.$linktooltip.'">'.
					$linkicon.
					'<label class="menu-link-name">'.$linktext.'</label></a></li>';
			}
			if (!empty($grpname)) $content .= '</ul></div><!-- end of menu-grp-'.$grpname.' -->'.PHP_EOL;
		}
		$content .= '</div><!-- end of menu-'.$menuname.' -->'.PHP_EOL;
	}
		
	return $content;
}