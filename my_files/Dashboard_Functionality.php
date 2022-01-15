<?php
require ("MoviesModel.php");
require ("OrdersModel.php");


class Dashboard_Functionality{


    function submitInsertion(){
        $name = trim($_POST['name']);
        $description = trim($_POST['description']);    
        $cover = '../my_images/' . trim($_POST['cover']);
        $category_id = trim($_POST['category_id']); 
        $director = trim($_POST['director']);    
        $year = trim($_POST['year']);
        $duration = trim($_POST['duration']);
        $stars = trim($_POST['stars']); 
        $trailer = trim($_POST['trailer']);    
        $storyline = trim($_POST['storyline']);
        $price = trim($_POST['price']);
        $stock_quantity = trim($_POST['stock_quantity']);

        $insertQuery = "INSERT INTO movies_db.movie (name, description, cover, category_id, director,
                       year, duration, stars, trailer, storyline, price, stock_quantity, hot)
                        VALUES ('$name', '$description',  '$cover', '$category_id','$director',
                      '$year','$duration', '$stars', '$trailer', '$storyline', '$price', '$stock_quantity', '0')";

        require 'Db_Credentials.php';

        mysqli_query($Connection,$insertQuery) or die(mysqli_error($Connection));

        mysqli_close($Connection);
    }

    function UpdateMovieStock() {
        $movie_id = trim($_POST['movie_id']);
        $stock_quantity = trim($_POST['stock_quantity']); 

        $selectQuery = "SELECT stock_quantity FROM movies_db.movie 
                        WHERE movie_id = '$movie_id'";


        require 'Db_Credentials.php';

        $old_stock_OBJ_MYSQLI = mysqli_query($Connection,$selectQuery) or die(mysqli_error($Connection));
        $row = mysqli_fetch_array($old_stock_OBJ_MYSQLI);
        $old_stock = $row[0];


        $updateQuery = "UPDATE movies_db.movie 
                        SET stock_quantity ='$old_stock' + '$stock_quantity'
                        WHERE movie_id = '$movie_id'";

        mysqli_query($Connection,$updateQuery) or die(mysqli_error($Connection));

        mysqli_close($Connection);
    }    

    function DashboardProductsBoardController(){
      $result = "
                    <table class='showTable' style='padding: 10px; margin-bottom: 20px;'>  
                          <tr>  
                               <th width='10%'>Movie_ID</th>  
                               <th width='40%'>Name</th>  
                               <th width='20%'>Year</th>  
                               <th width='50%'>Price</th>  
                               <th width='20%'>Stock</th>  
                          </tr>"; 
      $moviesmodel = new MoviesModel();
      $moviesArray = $moviesmodel->GetMovies();
      foreach ($moviesArray as $key => $movie){


          $result = $result .
                  "  <tr>
                          <td>
                          $movie->movie_id  
                          </td >
                          <td>
                              <a href='Movie.php?movie_id=$movie->movie_id' class='aDashboard'>$movie->name</a>                                                                     
                          </td>
                          <td>
                              $movie->year                                                                       
                          </td>
                          <td>
                              $movie->price €                                                                       
                          </td>
                          <td>
                              $movie->stock_quantity                                                                      
                          </td>
                        
                          
                      </tr>
                  ";
                  
      }        
       $result = $result  . "</table>";
      return $result;
    }

    function DashboardOrdersBoardController(){
      $result = "
                    <table class='showTable' style='padding: 10px; margin-bottom: 20px;'>  
                          <tr>  
                               <th width='5%'>Order_ID</th>
                               <th width='5%'>Movies_ID</th>  
                               <th width='50%'>Names</th>  
                               <th width='10%'>Price</th>  
                               <th width='10%'>Quantity</th>  
                               <th width='5%'>User_ID</th>  
                               <th width='10%'>User_Name</th>  
                               <th width='5%'>Total_Price</th> 
                          </tr>"; 
      $ordesmodel = new OrdersModel();
      $ordersArray = $ordesmodel->GetOrders();
      foreach ($ordersArray as $key => $order){


          $result = $result .
                  "  <tr>
                          <td>
                          $order->order_id  
                          </td >
                          <td>
                              $order->movie_id                                                                    
                          </td>
                          <td>
                              $order->movies_names                                                                       
                          </td>
                          <td>
                              $order->movies_price                                                                     
                          </td>
                          <td>
                              $order->movies_quantity                                                                      
                          </td>
                          <td>
                              $order->user_id                                                                      
                          </td>
                          <td>
                              $order->user_name                                                                      
                          </td>
                          <td>
                              $order->total_price €                                                                    
                          </td>
                        
                          
                      </tr>
                  ";
                  
      }        
       $result = $result  . "</table>";
      return $result;
    }

    function getProductsCount(){
      require 'Db_Credentials.php';     

      $query = "SELECT COUNT(movie_id)
                FROM movies_db.movie";

      $result = mysqli_query($Connection,$query) or die(mysqli_error($Connection));
      mysqli_close($Connection);
      
      $row = mysqli_fetch_row($result);
      return $row[0];
    }
    
    function getOrdersCount(){
      require 'Db_Credentials.php';     

      $query = "SELECT COUNT(order_id)
                FROM movies_db.order";

      $result = mysqli_query($Connection,$query) or die(mysqli_error($Connection));
      mysqli_close($Connection);

      $row = mysqli_fetch_row($result);
      return $row[0];
    }

    function getUsersCount(){
      require 'Db_Credentials.php';     

      $query = "SELECT COUNT(user_id)
                FROM movies_db.user";

      $result = mysqli_query($Connection,$query) or die(mysqli_error($Connection));
      mysqli_close($Connection);
      
      $row = mysqli_fetch_row($result);
      return $row[0] - 1; //- admin
    }  

    function getMalesCount(){
      require 'Db_Credentials.php';     

      $query = "SELECT COUNT(user_id)
                FROM movies_db.user
                WHERE user.sex = 'Male'";

      $result = mysqli_query($Connection,$query) or die(mysqli_error($Connection));
      mysqli_close($Connection);
      
      $row = mysqli_fetch_row($result);
      return $row[0];
    } 

    function getFemalesCount(){
      require 'Db_Credentials.php';     

      $query = "SELECT COUNT(user_id)
                FROM movies_db.user
                WHERE user.sex = 'Female'";

      $result = mysqli_query($Connection,$query) or die(mysqli_error($Connection));
      mysqli_close($Connection);
      
      $row = mysqli_fetch_row($result);
      return $row[0];
    } 

    function getRatesCount(){
      require 'Db_Credentials.php';     

      $query = "SELECT COUNT(rate_id)
                FROM movies_db.rate";

      $result = mysqli_query($Connection,$query) or die(mysqli_error($Connection));
      mysqli_close($Connection);
      
      $row = mysqli_fetch_row($result);
      return $row[0];
    } 

    function getReviewsCount(){
      require 'Db_Credentials.php';     

      $query = "SELECT COUNT(review_id)
                FROM movies_db.review";

      $result = mysqli_query($Connection,$query) or die(mysqli_error($Connection));
      mysqli_close($Connection);
      
      $row = mysqli_fetch_row($result);
      return $row[0];
    }      

}