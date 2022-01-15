<?php
  require_once("Authentication.php");
  require("Cart_Functionality.php");
  $authentication = new Authentication();
  $Cart_Functionality = new Cart_Functionality();

  if (!( isset($authentication) && $authentication->CheckLogin())){
    $Cart_Functionality->EmptyCart();
  }

  if(isset($_POST["add_to_cart"])){
    $Cart_Functionality->AddToCart();  
  }  
  
//unset($_SESSION["shopping_cart"]);

//echo '<pre style="color: white; font-size: 20px;">';
//var_dump($_SESSION);
//echo '</pre>';
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
    <div>
      <div class="flex max-grid">
        <!--Header--><!--Navigator-->
        <header >
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
            <a href="Main.php"><img src="../my_images/home.png" width="70%" height="70%"/></a>
        </div>

        <!--Main Body-->
        <section class="fonts">
            <table width="830px" align="center" class="mainTable">
                <tr >
                    <td><div class="content_area">
                            <table>
                               <tr>    
                                   <th class="line">
                                       <?php
                                           require 'MoviesController.php';
                                           $moviesController = new MoviesController();
                                           echo $moviesController->CreateCategoryUIList();
                                           ?>  
                                   </th>
                                   <td>
                                       <?php
                                           echo $moviesController->ViewMoviesList();
                                       ?>  
                                   </td>
                               </tr>
                            </table>
                        </div>
                    </td>
                </tr>
            </table>          
        </section> 
      </div>
        
      <!--Pop-up-->
      <div id="popupdiv" class="popupdiv">
          <table>
              <tr>
                  <td>
                      <img id="popupimg" src="">
                  </td>
                  <td>
                      <div id="popupdescr"></div>                   
                  </td>                
              </tr>
          </table>             
      </div>
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