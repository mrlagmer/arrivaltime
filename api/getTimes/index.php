<?php
require('../PtvApi.php');
require('../UtcTime.php');

$api = new PtvApi();
$utcTime = new UtcTime();

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
					if($utcTime->timeInFuture($stop['time_timetable_utc'])) {
						$trainArray[] = array('departureTime' => $utcTime->convertUTC($train['time_timetable_utc']), 'arrivalTime' => $utcTime->convertUTC($stop['time_timetable_utc']));
						//echo $utcTime->convertUTC($train['time_timetable_utc']).' - '.$utcTime->convertUTC($stop['time_timetable_utc']).'<br>';
					}
				}
			}
		}
		$jsonOut = json_encode($trainArray);
		echo $jsonOut;
		break;

	default:
		$result = $api->checkHealth();
		echo $result;
		break;
}
?>
