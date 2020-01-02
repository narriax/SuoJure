<?php

global $required;
$required = array();
$required['medoo'] = '\_libraries\medoo\src\Medoo.php';



// check requirements
foreach ($required as $r => $rloc) {
	if (!file_exists(getcwd().$rloc))
		die ("<div class=error>Required library missing: <b>".$r."</b>: [".$rloc."]</div>");
}


?>
