<?php





function theme_page_header ($page_title) {
	global $SITE_NAME, $DIR_ROOT, $WEB_ROOT, $CSS_CACHING;
	
	if ($page_title !== '') $page_title = ' - '.$page_title;
	$page_title = $SITE_NAME.$page_title;
	
	$webpath = realpath(dirname(__FILE__));
	$webpath = str_replace($DIR_ROOT, $WEB_ROOT, $webpath);
	
	echo '<html>'.PHP_EOL;
	echo '<head>'.PHP_EOL;
	
		echo '<title>'.$page_title.'</title>'.PHP_EOL;
	
		echo '<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Exo&display=swap">'.PHP_EOL;
		echo '<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Vollkorn&display=swap">'.PHP_EOL;
		echo '<link rel="stylesheet" href="'.$webpath.'\layout.css'.
			($CSS_CACHING ? '' : '?v='.time()).'">'.PHP_EOL;
		echo '<link rel="stylesheet" href="'.$webpath.'\fonts.css'.
			($CSS_CACHING ? '' : '?v='.time()).'">'.PHP_EOL;
		echo '<link rel="stylesheet" href="'.$webpath.'\colors.css'.
			($CSS_CACHING ? '' : '?v='.time()).'">'.PHP_EOL;
	
	echo '</head>'.PHP_EOL;
	echo '<body>'.PHP_EOL;
	
	echo '<header>';
	echo '<a href="'.$WEB_ROOT.'"><h3>'.$page_title.'</h3></a>'.PHP_EOL;
	echo '</header>';
	
}

