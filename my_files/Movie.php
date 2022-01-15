<?PHP
require_once("Authentication.php");
require("Cart_Functionality.php");
$authentication = new Authentication();
$userid =$authentication->GetUserId();
$Cart_Functionality = new Cart_Functionality();
require 'MoviesController.php';

$moviesController = new MoviesController();
if(isset($_POST['submitted']))
{
   if ($moviesController->postreveiw($_GET['movie_id'] ,$userid))
   {
       unset($_POST['submitted']);
       $authentication->RedirectToURL("Movie.php?movie_id=".$_GET['movie_id']);
       exit;
   }
   else {
       echo $moviesController->error_message;
   }
}

if(isset($_POST['submittedRate']))
{
   if ($moviesController->postrate($_GET['movie_id'] ,$userid))
   {
       unset($_POST['submittedRate']);
       $authentication->RedirectToURL("Movie.php?movie_id=".$_GET['movie_id']);
       exit;
   }
   else {
       echo $moviesController->error_message;
   }
}
$movie =  $moviesController->GetMoviesByMovie($_GET['movie_id']);

if(isset($_POST["add_to_cart"])){  
  $Cart_Functionality->AddToCart();
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
    <div class="flex">
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
    <div>
        <!--Movies Logo-->
        <div class="bigLogo">
            <a href="Main.php"><img src="../my_images/home.png" width="70%" height="70%" /></a>
        </div>

        <!--Main Body-->
        <section class="fonts">
            <div class="max-grid">
                <table width="720px" align="center" class="mainTable">
                    <tr>
                        <td>
                           <div class="content_area">
                            <table class = "mview">
                                <tr class="header  bgcolor">
                                    <td>                               
                                        <h1><?PHP echo $movie->name; ?></h1>
                                        <span id="year">(<?PHP echo $movie->year; ?>)</span> 
                                        <span class="ghost">|</span>
                                        <span><img src="../my_images/star.png"></span>
                                        <span id="avg"><?PHP echo round($movie->avgrate,1); ?><span>/8</span></span>
                                        <span class="ghost">|</span>
                                        
                                        <div 
                                        <?PHP
                                         if (intval($userid) == 0){
                                             echo 'class="acidjs-rating-stars acidjs-rating-disabled "' ;
                                         }elseif (isset($authentication) && $authentication->AdminValidation()) {
                                             echo 'class="acidjs-rating-stars acidjs-rating-disabled "' ;
                                         }else {
                                            if (intval($movie->UsrRate) >0 )
                                            {
                                                echo 'class="acidjs-rating-stars acidjs-rating-disabled "' ;
                                            }else {
                                                 echo 'class="acidjs-rating-stars "' ;
                                            }
                                         }
                                            ?> >
                                            
                                        
                                            <form id="formRate" method="post" >
                                                <input type="hidden" name="submittedRate" id="submittedRate" value="0"/>    
                                                <input type="hidden" name="total" id="total" value="0"/>    

                                                <input type="radio" name="group-1" id="group-1-0" onclick="StarRate(this);" 
                                                       <?PHP if(intval($movie->UsrRate) == 8) echo 'checked="checked"' ?> value="8" /><label for="group-1-0"></label><!--
                                                --><input type="radio" name="group-1" id="group-1-1" onclick="StarRate(this);" 
                                                       <?PHP if(intval($movie->UsrRate) == 7) echo 'checked="checked"' ?> value="7" /><label for="group-1-1"></label><!--
                                                --><input type="radio" name="group-1" id="group-1-2" onclick="StarRate(this);"
                                                       <?PHP if(intval($movie->UsrRate) == 6) echo 'checked="checked"' ?> value="6" /><label for="group-1-2"></label><!--
                                                --><input type="radio" name="group-1" id="group-1-3" onclick="StarRate(this);"
                                                       <?PHP if(intval($movie->UsrRate) == 5) echo 'checked="checked"' ?> value="5" /><label for="group-1-3"></label><!--
                                                --><input type="radio" name="group-1" id="group-1-4" onclick="StarRate(this);"
                                                       <?PHP if(intval($movie->UsrRate) == 4) echo 'checked="checked"' ?> value="4" /><label for="group-1-4"></label><!--
                                                --><input type="radio" name="group-1" id="group-1-5" onclick="StarRate(this);"
                                                       <?PHP if(intval($movie->UsrRate) == 3) echo 'checked="checked"' ?> value="3" /><label for="group-1-5"></label><!--
                                                --><input type="radio" name="group-1" id="group-1-6" onclick="StarRate(this);"
                                                       <?PHP if(intval($movie->UsrRate) == 2) echo 'checked="checked"' ?> value="2" /><label for="group-1-6"></label><!--
                                                --><input type="radio" name="group-1" id="group-1-7" onclick="StarRate(this);"
                                                       <?PHP if(intval($movie->UsrRate) == 1) echo 'checked="checked"' ?> value="1" /><label for="group-1-7"></label>
                                            </form>
                                        </div>
                                    </td>  
                                </tr>
                                <tr>
                                    <td class="bgcolor">
                                        <div class="subfield">
                                            <span class="ghost">|</span>
                                            <span class="subtext"><?PHP echo $movie->duration; ?>-min</span> 
                                            <span class="ghost">|</span>
                                            <span class="subtext"><?PHP echo $movie->categoryName; ?></span> 
                                            <span class="ghost">|</span>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="bgcolor">
                                    <td>
                                        <?php
                                          echo $moviesController->hotCheckMoviePage($movie->movie_id);
                                        ?>                                
                                    </td>
                                </tr>     
                            <tr>
                            <td>
                                <table >
                                    <tr>
                                        
                                        <td id="descr" colspan="2"><?PHP echo $movie->description; ?></td>
                                    </tr>

                                    <tr>
                                        <td colspan="2" class="credits">
                                            <div class="credits">
                                            <span>Director: <span><?PHP echo $movie->director; ?></span></span><br />
                                            <span>Stars: <span><?PHP echo $movie->stars; ?></span></span>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td style=" margin-left: 60px;">  
                                            <form method="post" action="Movie.php?movie_id=<?php echo $movie->movie_id; ?>&action=add&id=<?php echo $movie->movie_id; ?>">     
                                                <span class="priceMain" style="margin-left: 30px;"><?PHP echo $movie->price; ?> €</span>
                                                <?php
                                                    echo $moviesController->outOfStockCheckMoviePage($movie->movie_id);
                                                ?>                                           
                                            </form>
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <td class="story">     
                                            <span id="storylineHeader">Storyline</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td id="storyline"><?PHP echo $movie->storyline; ?></td>
                                    </tr>
                                    <tr>
                                    <td colspan='2' >
                                        <table class="reviewsTable">
                                            <span id="reviewsHeader">User Reviews</span>
                                            <?PHP
                                             if (intval($userid) > 0 && intval($movie->isUsrreview)==0 && !(isset($authentication) && $authentication->AdminValidation()))
                                             {
                                                 include 'Review.php'; 
                                             }
                                            ?>
                                            <?PHP
                                            $resReview ="";
                                            foreach ($movie->ReviewArray as $key => $Review){
                                              $resReview = $resReview .
                                               " <tr>
                                                   <td >
                                                      <hr />
                                                      <div class='reviewUser'>$Review->username</div><br />
                                                      <div class='review'>$Review->review</div><br />
                                                    </td>
                                                 </tr>";
                                            }
                                            echo $resReview;
                                            ?>
                                        </table>      
                                    </td>
                                    </tr>
                                 </table>
                            </td>
                            </tr>
                            </table>
                        </div>
                    </td>
                </tr>
            </table>
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