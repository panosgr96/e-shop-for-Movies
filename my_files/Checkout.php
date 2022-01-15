<?php
  require_once("Authentication.php");
  require("Cart_Functionality.php");
  $authentication = new Authentication();
  $userid =$authentication->GetUserId();
  $Cart_Functionality = new Cart_Functionality();
  require 'MoviesController.php';

  if (!( isset($authentication) && $authentication->CheckLogin()) || ( isset($authentication) && $authentication->CheckLogin() && $authentication->AdminValidation())){
    echo("Page is forbidden.");
    $Cart_Functionality->EmptyCart();    
    die(); 
  }

  if(isset($_GET["action"])){  
    if($_GET["action"] == "delete"){  
      $Cart_Functionality->RemoveFromCart();
    }  
  }  

if(isset($_POST['checkoutBtn'])){
  $Cart_Functionality->SubmitOrder();
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Movies</title>
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
          <a href="Main.php"><img src="../my_images/home.png" width="70%" height="70%"/></a>
      </div>

      <!--Main Body-->
      <section class="fonts">

          <!--Checkout Form-->
          <div><br /><br />
              <form id="formDelivery" method="post" action="">
                  <table width="30%" height="370px" bgcolor="#ff2d2d" align="center" class="mainTable" style="max-width: 600px;">
                      <tr>
                          <td align="center"><font size="6" class="textShad"><b>Checkout</b></font><br /></td>
                      </tr>
                      <tr>
                          <td>
                              <!--Container Table-->
                              <table align="center" width="100%" height="100%" bgcolor="#e8e8e8" id="regTable" style="padding: 25px;">
                                  <tr>
                              <td colspan='2' >
                                  <div style="clear:both"></div>  
              <br />  
              <h3>Order Details</h3>  
              <div>  
                   <table class="showTable">  
                        <tr>  
                             <th width="40%">Item Name</th>  
                             <th width="10%">Quantity</th>  
                             <th width="20%">Price</th>  
                             <th width="15%">Total</th>  
                             <th width="5%">Action</th>  
                        </tr>  
                        <?php   
                        if(!empty($_SESSION["shopping_cart"]))  
                        {  
                             $total = 0;  
                             foreach($_SESSION["shopping_cart"] as $keys => $values)  
                             {  
                        ?>  
                        <tr>  
                             <td><?php echo $values["item_name"]; ?></td>  
                             <td><?php echo $values["item_quantity"]; ?></td>  
                             <td><?php echo $values["item_price"]; ?> €</td>  
                             <td><?php echo number_format($values["item_quantity"] * $values["item_price"], 2); ?> €</td>  
                             <td><a href="Checkout.php?action=delete&id=<?php echo $values["item_id"]; ?>"><span style="color: #af0000;">Remove</span></a></td>  
                        </tr>  
                        <?php  
                                  $total = $total + ($values["item_quantity"] * $values["item_price"]);  
                             }  
                        ?>  
                        <tr>  
                             <td colspan="3" align="right">Total</td>  
                             <td align="right"><?php echo number_format($total, 2); ?> €</td>  
                             <td></td>  
                        </tr>  
                        <?php  
                        }  
                        ?>  
                   </table>  
              </div>      
                              </td>
                              </tr>
                                  
                                  
                                  <tr>
                                      <!--checkoutBtn Button-->
                                      <td align="center" colspan="3">
                                          <button name="checkoutBtn" id="checkoutBtn" class="forwardButton" style="vertical-align:middle"><span>Proceed</span></button>
                                      </td>
                                  </tr>
                              </table>
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