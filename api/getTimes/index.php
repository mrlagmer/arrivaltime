<?php
require('../PtvApi.php');

$api = new PtvApi();
$timeNow = new DateTime($stop['time_timetable_utc'],new DateTimeZone('Australia/Melbourne'));

switch ($_GET['apiCall']) {
	case 'getTimes':
		$jsonResult = $api->getTimes($_GET['startID']);
		$timeArray = json_decode($jsonResult,true);
		//echo "<pre>".print_r($timeArray)."</pre>";
		foreach ($timeArray['values'] as $train) {
			// Now check if train is stopping at destination
			$jsonResult = $api->getStoppingPattern($_GET['startID'],$train['run']['run_id']);
			$stopArray = json_decode($jsonResult,true);
			//echo "<pre>".print_r($stopArray)."</pre>";
			foreach ($stopArray['values'] as $stop) {
				if ($stop['platform']['stop']['stop_id'] == $_GET['stopID']) {
					$time = new DateTime($stop['time_timetable_utc'],new DateTimeZone('UTC'));
					$time->setTimezone(new DateTimeZone('Australia/Melbourne'));
					if($timeNow < $time) {
						echo $stop['time_timetable_utc'].' - '.$time->format('d/m/Y G:i:s a').'<br>';
					}
				}
			}
		}

		//echo $jsonResult;
		break;

	default:
		$result = $api->checkHealth();
		echo $result;
		break;
}
?>
