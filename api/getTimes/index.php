<?php
require('../PtvApi.php');
require('../UtcTime.php');
require('../Stops.php');

$api = new PtvApi();
$utcTime = new UtcTime();
$stops = new Stops();

switch ($_GET['apiCall']) {
	case 'getTimes':
		$directionID = $stops->getDirection($_GET['lineID'],$_GET['startID'],$_GET['stopID']);
		$jsonResult = $api->getSpecificTimes($_GET['lineID'],$_GET['startID'],$directionID,5);
		$timeArray = json_decode($jsonResult,true);
		//echo "DIR ID".$directionID.'<br>';
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
					$trainArray[] = array('departureTime' => $utcTime->convertUTC($train['time_timetable_utc']), 'arrivalTime' => $utcTime->convertUTC($trainStation['time_timetable_utc']),'runID' => $train['run']['run_id']);
					$timeCount++;
				}
			}
		}
		//If we have not found the required number of trains try getting more from API
		if($timeCount < 5) {
			$timeCount = 0;
			$trainArray = array();
			$jsonResult = $api->getSpecificTimes($_GET['lineID'],$_GET['startID'],$directionID,10);
			$timeArray = json_decode($jsonResult,true);

			foreach($timeArray['values'] as $train) {
				//Now need to find arrival time for each train
				//echo 'stuff'.$train['run']['run_id'];
				$jsonResult = $api->getStoppingPattern($_GET['startID'],$train['run']['run_id']);
				$stopArray = json_decode($jsonResult,true);
				foreach($stopArray['values'] as $trainStation) {
					if ($trainStation['platform']['stop']['stop_id'] == $_GET['stopID']) {
						if($timeCount < 5) {
							$trainArray[] = array('departureTime' => $utcTime->convertUTC($train['time_timetable_utc']), 'arrivalTime' => $utcTime->convertUTC($trainStation['time_timetable_utc']),'runID' => $train['run']['run_id']);
							$timeCount++;
						}
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
