<?php
require('../PtvApi.php');

$api = new PtvApi();

switch ($_GET['apiCall']) {
	case 'getStops':
		$jsonResult = $api->getStops($_GET['data']);
		echo $jsonResult;
		break;
	
	default:
		$jsonResult = $api->healthcheck;
		echo $jsonResult;
		break;
}
?>