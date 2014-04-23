<?php
require('../PtvApi.php');
require('../UtcTime.php');

$api = new PtvApi();
$utcTime = new UtcTime();

switch ($_GET['apiCall']) {
	case 'getTimes':
		//get general leaving times for the stop.
		$jsonResult = $api->getTimes($_GET['startID']);
		$timeArray = json_decode($jsonResult,true);
		//echo "<pre>";
		//print_r($timeArray);
		//echo "</pre>";
		foreach ($timeArray['values'] as $train) {
			// Now check if train is stopping at destination
			$jsonResult = $api->getStoppingPattern($_GET['startID'],$train['run']['run_id']);
			$stopArray = json_decode($jsonResult,true);
			//echo "<pre>".print_r($stopArray)."</pre>";
			foreach ($stopArray['values'] as $stop) {
				if ($stop['platform']['stop']['stop_id'] == $_GET['stopID']) {
					if($utcTime->timeInFuture($stop['time_timetable_utc'])) {
						$directionID = $stop['platform']['direction']['direction_id'];
						$lineID = $stop['platform']['direction']['line']['line_id'];
					}
				}
			}
		}
		$jsonResult = $api->getSpecificTimes($lineID,$_GET['startID'],$directionID);
		$timeArray = json_decode($jsonResult,true);
		//echo "<pre>";
		//print_r($timeArray);
		//echo "</pre>";
		foreach($timeArray['values'] as $train) {
			//Now need to find arrival time for each train
			//echo 'stuff'.$train['run']['run_id'];
			$jsonResult = $api->getStoppingPattern($_GET['startID'],$train['run']['run_id']);
			$stopArray = json_decode($jsonResult,true);
			//make sure train stops at destination
			foreach($stopArray['values'] as $trainStation) {
				if ($trainStation['platform']['stop']['stop_id'] == $_GET['stopID']) {
					$trainArray[] = array('departureTime' => $utcTime->convertUTC($train['time_timetable_utc']), 'arrivalTime' => $utcTime->convertUTC($trainStation['time_timetable_utc']));
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
