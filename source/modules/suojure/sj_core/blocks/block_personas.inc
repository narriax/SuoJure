<?php

function sj_core_personas_block () {
	if (!user_access('access content')) 
		return '';
	
	drupal_add_css(drupal_get_path('module', 'sj_core').'/blocks/block_personas.css');
	
	$usr = new sjUser();
	if (!isset($usr)) 
		return l(t('Log in'), 'login');

	// ======================

	if (array_key_exists('persona', $_GET)) {
		sjvar_set('persona', $_GET['persona']);
	}
	
	$currents = array(
		'personas' => '?persona='.sjvar('persona', $usr->get_default_persona()),
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
		$links['personas'][$ps->name] = array();
		foreach ($ps->members as $pid => $pdata) {
			$links['personas'][$ps->name]['?persona='.$pid] = array ('#text' => $pdata->name);
		}
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
		foreach ($menucontent as $grpname => $grpcontent) {
			if (!empty($grpname)) {
				$content .= '<div id="menu-grp-'.$grpname.'" class="menu-group">'.
					'<label class="menu-group-name">'.$grpname.'</label>'.PHP_EOL;
				$content .= '<div id="menu-grp-'.$grpname.'-container" class="menu-group-container">';
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

				$cls = 'menu-link';
				if (!empty($linkicon)) $cls .= ' has-icon';
				if (array_key_exists($menuname, $currents) && $currents[$menuname] == $linkurl)
					$cls .= ' selected';
				
				
				$content .= '<a href="'.$linkurl.'" class="'.$cls.' title="'.$linktooltip.'">'.
					$linkicon.
					'<label class="menu-link-name">'.$linktext.'</label></a>';
			}
			if (!empty($grpname)) $content .= '</div></div><!-- end of menu-grp-'.$grpname.' -->'.PHP_EOL;
		}
		$content .= '</div><!-- end of menu-'.$menuname.' -->'.PHP_EOL;
	}
		
	return $content;
}