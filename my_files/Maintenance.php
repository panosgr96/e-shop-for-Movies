<?PHP
require_once("Authentication.php");
require("Cart_Functionality.php");
$authentication = new Authentication();
$Cart_Functionality = new Cart_Functionality();

if(isset($_POST['submitted']))
{
   if($authentication->SignIn())
   {
        $authentication->RedirectToURL("Main.php");
   }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Movies-eShop</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="mystyle.css">
    <script src="myjs.js"></script>
    <link rel="icon" href="../my_images/favicon.ico" type="image/icon">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/bootstrap-iso.css">
</head>
<body>
    <div class="flex max-grid">
        <!--Header--><!--Navigator-->
        <header>
           <?php include 'Menu.php'; ?>
        </header>
        <!--loader-->
        <div id="loader-wrapper">
          <div id="loader"></div>
       
          <div class="loader-section section-left"></div>
          <div class="loader-section section-right"></div>
       
        </div>
        <!--Loader's Header-->
        <div class="entry-header">
          <h1 class="entry-title">Movies-eShop <img class="loaderImg" src="../my_images/home.png"></h1>
        </div>
        <!--Movies Logo-->
        <div class="bigLogo">
            <a href="Main.php"><img src="../my_images/home.png" width="70%" height="70%" /></a>
        </div>
       
        <!--Main Body-->
        <section class="fonts">
            <!--Main Table-->
            <div class="max-grid">
                <form id='login' method='post' accept-charset='UTF-8'>
                    <input type='hidden' name='submitted' id='submitted' value='1'/>
                    <table width="30%" height="370px" bgcolor="#ff2d2d" align="center" class="mainTable">
                        <tr>
                            <td align="center"><font size="6" class="textShad"><b><br>Service is under construction...</b></font><br /></td>
                        </tr>
                        <tr>
                            <td align="center">
                               <img src="../my_images/construction.jpg" width="935px" height="457px" />
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </section>
    </div>
       
    <!--Footer-->
    <footer>
        <?php include 'Footer.php'; ?>
    </footer>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
  <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.9.1.min.js"><\/script>')</script>
  <script src="js/main.js"></script> 
</body>
</html>