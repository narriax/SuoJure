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

$todayD = $today->format('d')-0;
$d = -1;
for ($w=0; $w < 7; $w++) {
	echo '<div class="floatrow calendar week"> ';
	for ($i=0; $i < count($daysOfWeek); $i++) {	

		if ($d < 0 && $daysOfWeek[$i] == $firstday_month->format('D'))
			$d = 0;
		if ($d > -1) $d++;
		
		$cls = '';
		if ($d < 0) {
			$day = date_create_from_format('d m Y', '01'.$today->format(' m Y'));
			$day = date("Y-m-d", strtotime($day->format('Y-m-d').' -'.($monthDayIndex - $i).' day'));
			$day = date_create_from_format('Y-m-d', $day);
			$cls .= ' lastmonth';
		} else {
			$day = date_create_from_format('d m Y', $d.$today->format(' m Y'));
		}
		
		echo '<div class="floatcard daycard">';
		echo '<div class=date><b>'.$day->format('d').'</b></div>';
		echo '<h4 style="margin-top: 0;">'.$daysOfWeek[$i].'</h4>';
		echo '</div>';
	}
	echo '</div>';
	if ($day->format('d') < 8 && $w >= round($todayD / 7)) 
		break;
}

?>

</body>
</html>