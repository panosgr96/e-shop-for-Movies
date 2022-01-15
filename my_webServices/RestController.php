<?php
require_once("RestHandler.php");
		
$view = "";
if(isset($_GET["view"]))
	$view = $_GET["view"];
/*
controls the RESTful services
URL mapping
*/
switch($view){

	case "getOrders":
		// to handle REST Url /mobile/list/
		$RestHandler = new RestHandler();
		$RestHandler->getOrders();
		break;
		
	case "getMovies":
		// to handle REST Url /mobile/list/
		$RestHandler = new RestHandler();
		$RestHandler->getMovies();
		break;

	/*case "single":
		// to handle REST Url /mobile/show/<id>/
		$mobileRestHandler = new MobileRestHandler();
		$mobileRestHandler->getMobile($_GET["id"]);
		break;
	*/
	case "" :
		//404 - not found;
		break;
}
?>
