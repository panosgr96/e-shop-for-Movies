<?PHP
require_once("Authentication.php");
require("Cart_Functionality.php");
$Cart_Functionality = new Cart_Functionality();
$authentication = new Authentication();
$Cart_Functionality->EmptyCart();
$authentication->LogOut();
$authentication->RedirectToURL("Main.php");
?>
