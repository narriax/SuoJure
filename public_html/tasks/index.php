<?php

include_once("../config.inc"); 

global $db;
$tasks = $db->select('tasks', []);
	
date_default_timezone_set("America/New_York");
$today = new DateTime();
echo $today->format('D, d M Y - h:m:s').'<br>';

$daysOfWeek = array('Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun');
$weekdayIndex = -1;
for ($i=0; $i < count($daysOfWeek); $i++) {
	if ($daysOfWeek[$i] == $today->format('D')) {
		$weekdayIndex = $i;
		break;
	}
}
$firstday_week = $today->format('d') - $weekdayIndex;
$firstday_month = date_create_from_format('d m Y', $today->format('1 m Y'));
$monthDayIndex = -1;
for ($i=0; $i < count($daysOfWeek); $i++) {
	if ($daysOfWeek[$i] == $firstday_month->format('D')) {
		$monthDayIndex = $i;
		break;
	}
}


$d = -1;
for ($w=0; $w < 6; $w++) {
	for ($i=0; $i < count($daysOfWeek); $i++) {	
		if ($daysOfWeek[$i] == $firstday_month->format('D'))
			$d = 0;
		if ($d > -1) $d++;
		
		$day = date_create_from_format('d m Y', $d.$today->format(' m Y'));
		if ($d < 0) 
			$day -= strtotime('-1 day');			// STOPPED HERE
		
		echo '<div class="floatcard daycard">';
		echo '<div style="float: right;">'.$day->format('d').'</div>';
		echo '<h4>'.$daysOfWeek[$i].'</h4>';
		echo '</div>';
	}
}

?>

</body>
</html>