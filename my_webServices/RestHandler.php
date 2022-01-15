<?php
require_once("SimpleRest.php");
		
class RestHandler extends SimpleRest {

	function getOrders() {	
		require_once("../my_files/OrdersModel.php");
		$OrdersModel = new OrdersModel();
		$rawData = $OrdersModel->GetOrders();

		if(empty($rawData)) {
			$statusCode = 404;
			$rawData = array('error' => 'No mobiles found!');		
		} else {
			$statusCode = 200;
		}

		$requestContentType = $_SERVER['HTTP_ACCEPT'];
		$this ->setHttpHeaders($requestContentType, $statusCode);

		$response = json_encode($rawData);
		echo $response;
	}

	function getMovies() {	
		require_once("../my_files/MoviesModel.php");
		$MoviesModel = new MoviesModel();
		$rawData = $MoviesModel->GetMovies();

		if(empty($rawData)) {
			$statusCode = 404;
			$rawData = array('error' => 'No mobiles found!');		
		} else {
			$statusCode = 200;
		}

		$requestContentType = $_SERVER['HTTP_ACCEPT'];
		$this ->setHttpHeaders($requestContentType, $statusCode);

		$response = json_encode($rawData);
		echo $response;
	}

	function GetMoviesByCategory() {	
		require_once("../my_files/MoviesModel.php");
		$MoviesModel = new MoviesModel();
		$rawData = $MoviesModel->GetMovies();

		if(empty($rawData)) {
			$statusCode = 404;
			$rawData = array('error' => 'No mobiles found!');		
		} else {
			$statusCode = 200;
		}

		$requestContentType = $_SERVER['HTTP_ACCEPT'];
		$this ->setHttpHeaders($requestContentType, $statusCode);

		$response = json_encode($rawData);
		echo $response;
	}

	public function getMobile($id){
		
		$mobile = array($id => ($this->mobiles[$id]) ? $this->mobiles[$id] : $this->mobiles[1]);
		return $mobile;
	}	

}
?>