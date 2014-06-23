<?php
require('../PtvApi.php');

$api = new PtvApi();

switch ($_GET['apiCall']) {
	case 'getStops':
		if ($_GET['data'] == '1') {
			$jsonResult = file_get_contents("alamein.json");
		}
		else if ($_GET['data'] == '2') {
			$jsonResult = file_get_contents("belgrave.json");
		}
		else if ($_GET['data'] == '3') {
			$jsonResult = file_get_contents("craigieburn.json");
		}
		else if ($_GET['data'] == '4') {
			$jsonResult = file_get_contents("cranbourne.json");
		}
		else if ($_GET['data'] == '5') {
			$jsonResult = file_get_contents("southMorang.json");
		}
		else if ($_GET['data'] == '6') {
			$jsonResult = file_get_contents("frankston.json");
		}
		else if ($_GET['data'] == '7') {
			$jsonResult = file_get_contents("glenWaverley.json");
		}
		else if ($_GET['data'] == '8') {
			$jsonResult = file_get_contents("hurstbridge.json");
		}
		else if ($_GET['data'] == '9') {
			$jsonResult = file_get_contents("lilydale.json");
		}
		else if ($_GET['data'] == '11') {
			$jsonResult = file_get_contents("pakenham.json");
		}
		else if ($_GET['data'] == '12') {
			$jsonResult = file_get_contents("sandringham.json");
		}
		else if ($_GET['data'] == '14') {
			$jsonResult = file_get_contents("sunbury.json");
		}
		else if ($_GET['data'] == '15') {
			$jsonResult = file_get_contents("upfield.json");
		}
		else if ($_GET['data'] == '16') {
			$jsonResult = file_get_contents("werribee.json");
		}
		else if ($_GET['data'] == '17') {
			$jsonResult = file_get_contents("williamstown.json");
		}
		echo $jsonResult;
		break;
	
	default:
		$result = $api->checkHealth();
		echo $result;
		break;
}
?>