<?php
  require_once("Authentication.php");
  require("Dashboard_Functionality.php");
  $authentication = new Authentication();
  $Dashboard_Functionality = new Dashboard_Functionality();


  if (!( isset($authentication) && $authentication->CheckLogin() && $authentication->AdminValidation())){
    echo("Page is forbidden.");
    die();
  }

  if(isset($_POST['submitInsertion'])){
    $Dashboard_Functionality->submitInsertion();     
  }

  if(isset($_POST['submitUpdate'])){
    $Dashboard_Functionality->UpdateMovieStock($_POST['stock_quantity']);       
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
            <a href="Main.php"><img src="../my_images/home.png" width="70%" height="70%"/></a>
        </div>

        <!--Main Body-->
        <section class="fonts">

            
            
                            
                <table width="70%" height="730px" bgcolor="#ff2d2d" align="center" class="mainTable">
                    <tr>
                        <td align="center"><font size="6" class="textShad"><b>Administrator Dashboard</b></font><br /></td>
                    </tr>
                    <tr>
                        <td>
                            <!--1-->
                            <table align="center" width="100%" height="100%" bgcolor="#e8e8e8" id="regTable">
                            <tr>
                              <td colspan="2" align="center">
                                <table>
                                  <tr>
                              <td align="center">
                                <!-- top tiles -->
                                 <div class="DashboardLine">                                     
                                    <h2 class="topHeaderDashboard"> Total Users</h2>
                                    <span class="DashoboardSpan">
                                      <?php
                                            echo $Dashboard_Functionality ->getUsersCount();
                                      ?>                                             
                                    </span>
                                  </div>
                              </td> 
                              <td align="center">
                                <!-- top tiles -->
                                 <div class="DashboardLine">                                     
                                    <h2 class="topHeaderDashboard"> Total Males</h2>
                                    <span class="DashoboardSpan">
                                      <?php
                                            echo $Dashboard_Functionality ->getMalesCount();
                                      ?>                                             
                                    </span>
                                  </div>
                              </td> 
                              <td align="center">
                                <!-- top tiles -->
                                 <div class="DashboardLine">                                     
                                    <h2 class="topHeaderDashboard"> Total Females</h2>
                                    <span class="DashoboardSpan">
                                      <?php
                                            echo $Dashboard_Functionality ->getFemalesCount();
                                      ?>                                             
                                    </span>
                                  </div>
                              </td> 
                              <td align="center">
                                <!-- top tiles -->
                                 <div class="DashboardLine">                                     
                                    <h2 class="topHeaderDashboard"> Total Rates</h2>
                                    <span class="DashoboardSpan">
                                      <?php
                                            echo $Dashboard_Functionality ->getRatesCount();
                                      ?>                                             
                                    </span>
                                  </div>
                              </td>        
                              <td align="center">
                                <!-- top tiles -->                                 
                                <h2 class="topHeaderDashboard"> Total Reviews</h2>
                                <span class="DashoboardSpan">
                                  <?php
                                        echo $Dashboard_Functionality ->getReviewsCount();
                                  ?>                                             
                                </span>
                              </td>
                            </tr>
                                </table>
                              </td>
                            </tr>
                                
                                  <tr>
                                    


                                    <td style="padding: 30px; vertical-align: top;">
                                      <button class="accordion">
                                        <h2 class="headerDashboard">
                                          <div class='bootstrap-iso' style='display: unset;'>
                                            <span style='background: #d32626;' class='badge badge-pill badge-danger tableCount'>
                                              <?php
                                                echo "#", $Dashboard_Functionality ->getOrdersCount();
                                              ?>
                                            </span>
                                          </div>Orders Board
                                        </h2>
                                      </button>
                                      <div class="panel">
                                        <?php
                                          echo $Dashboard_Functionality ->DashboardOrdersBoardController();
                                        ?>
                                      </div>
                                    </td>   

                                    <!--Insertion Form-->
                                <td style="padding: 30px; vertical-align: top;">
                                  <button class="accordion">
                                  <h2 class="headerDashboard">Insert Product</h2>
                                  </button>
                                  <div class="panel">
                                    <form id='Insertion' method='post'>
                                      <input type='hidden' name='submitInsertion' id='submitInsertion' value='1'/> 
                                      <table>
                                        <tr>
                                          <td align="center">
                                              <input class="textInputDashboard" type="text" id="nameField" name="name" maxlength="80" required placeholder="Name">
                                          </td>
                                      
                                          <td align="center">
                                              <input type="text" id="descriptionField" name="description" maxlength="255" required placeholder="Description">
                                          </td>   
                                                  
                                      </tr>
                                      <tr>
                                        <td align="center">
                                              <input type="number" id="category_idField" name="category_id" maxlength="11" required placeholder="Category_ID">
                                          </td>
                                          <td align="center">
                                              <input type="text" id="directorField" name="director" maxlength="20" required placeholder="Director">
                                          </td>
                                      
                                          
                                      </tr>
                                      <tr>    
                                          <td align="center">
                                              <input type="text" id="starsField" name="stars" maxlength="10" required placeholder="Stars">
                                          </td>
                                      
                                          <td align="center">
                                              <input type="text" id="trailerField" name="trailer" required placeholder="Trailer(../embed/id)">
                                          </td>                                                                                                        
                                      </tr>                                  
                                      <tr>
                                        <td align="left">
                                            <input type="number" id="stockField" name="stock_quantity" required placeholder="Stock_quantity">
                                        </td> 
                                        <td align="left">
                                              <input type="text" id="storylineField" name="storyline" max="5000" required placeholder="Storyline">
                                        </td>   
                                      </tr>
                                      <tr>
                                        <td align="left">
                                              <input type="number" id="durationField" name="duration" required placeholder="Duration">
                                          </td> 
                                          <td align="left">
                                              <input type="number"  name="year" required placeholder="Year">
                                          </td>
                                      </tr>
                                      <tr>                                  
                                        <td align="center">
                                            <input type="number" id="priceField" name="price" required placeholder="Price">
                                        </td>
                                        <td align="center">
                                            <label for="file-upload" class="custom-file-upload">
                                                <i class="fa fa-cloud-upload"></i> Choose a cover<br><i style="color: lightblue">must be in .../my_images/</i>
                                            </label>
                                            <input id="file-upload" type="file" id="coverField" name="cover" required image/* />
                                          </td>                                       
                                      </tr>

                                      <tr align="right" >
                                          <!--Register Button-->
                                          <td colspan="3" style="text-align: center;">
                                              <button class="forwardButton" style="vertical-align: middle;"><span>Insert</span></button>
                                          </td>
                                      </tr>
                                      </table>
                                    </form>
                                  </div>       
                                </td>                            
                                  </tr>
                                <tr>
                              

                                <tr>
                               

                              <td  style="padding: 30px; vertical-align: top;">
                                      <button class="accordion">
                                        <h2 class="headerDashboard">
                                          <div class='bootstrap-iso' style='display: unset;'>
                                            <span style='background: #d32626;' class='badge badge-pill badge-danger tableCount'>
                                              <?php
                                                echo "#", $Dashboard_Functionality ->getProductsCount();
                                              ?>
                                            </span>
                                          </div>Products Board
                                        </h2>
                                      </button>
                                      <div class="panel">
                                        <?php
                                          echo $Dashboard_Functionality ->DashboardProductsBoardController();
                                        ?>
                                      </div>
                                    </td> 

                                     <!--Update Form-->
                              <td style="padding: 30px; vertical-align: top;">                             
                                <button class="accordion">
                                  <h2 class="headerDashboard">Update Product's Stock</h2>
                                </button>
                                <div class="panel">
                                  <form id='Update' method='post'>
                                    <input type='hidden' name='submitUpdate' id='submitUpdate' value='1'/> 
                                    <table>
                                      <tr>
                                        <td align="center">
                                            <input type="number" id="moive_idField" name="movie_id" required placeholder="Movie_id">
                                        
                                            <input type="number"  name="stock_quantity" required placeholder="Stock_quantity">
                                        </td>
                                        <td>
                                          <button class="forwardButton" style="vertical-align: middle; margin-right: 69px;"><span>Update</span></button>
                                        </td>
                                      </tr>
                                    </table>
                                  </form>
                                </div>                          
                              </td>                  
                            </table>
                        </td>
                    </tr>
                </table>
            
        </section>
      </div>
        
        <!--Footer-->
        <footer>
            <?php include 'Footer.php'; ?>
        </footer>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.9.1.min.js"><\/script>')</script>
    <script src="js/main.js"></script> 

    <script>
    var acc = document.getElementsByClassName("accordion");
    var i;

    for (i = 0; i < acc.length; i++) {
      acc[i].addEventListener("click", function() {
        this.classList.toggle("active");
        var panel = this.nextElementSibling;
        if (panel.style.maxHeight){
          panel.style.maxHeight = null;
        } else {
          panel.style.maxHeight = panel.scrollHeight + "px";
        } 
      });
    }
    </script>
    </div>
</body>
</html>