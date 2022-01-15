<?PHP
require_once("WebClient.php");
require_once("Enumerations.php");

//$webClient = new WebClient("http://localhost/movies/my_webServices/listOrders/");
$webClient = new WebClient("http://localhost/movies/my_webServices/listMovies/");
try{

	echo($webClient->Get_HttpServices());



}catch(exception $e){
	echo($e->getMessage());
}

?>