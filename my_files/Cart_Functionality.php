<?php

class Cart_Functionality{

      
    function AddToCart(){
       if(isset($_SESSION["shopping_cart"]))  
      {  
           $item_array_id = array_column($_SESSION["shopping_cart"], "item_id");  
           if(!in_array($_GET["id"], $item_array_id))  
           {  
                $count = count($_SESSION["shopping_cart"]);  
                $item_array = array(  
                     'item_id'               =>     $_GET["id"],  
                     'item_name'               =>     $_POST["hidden_name"],  
                     'item_price'          =>     $_POST["hidden_price"],  
                     'item_quantity'          =>     $_POST["quantity"],
                     'item_hot'            =>     $_POST["hidden_hot"],
                     'item_stock'             =>     $_POST["hidden_stock"]   
                );  
                $_SESSION["shopping_cart"][$count] = $item_array;  
           }  
           else  
           {  
                echo '<script>alert("Item Already Added")</script>';  
                echo '<script>window.location="Main.php"</script>';  
           }  
      }  
      else  
      {  
           $item_array = array(  
                'item_id'               =>     $_GET["id"],  
                'item_name'               =>     $_POST["hidden_name"],  
                'item_price'          =>     $_POST["hidden_price"],  
                'item_quantity'          =>     $_POST["quantity"],
                'item_hot'            =>     $_POST["hidden_hot"],
                'item_stock'             =>     $_POST["hidden_stock"] 
           );  
           $_SESSION["shopping_cart"][0] = $item_array;  
      }
    }

    function SubmitOrder(){
        if(count($_SESSION["shopping_cart"]) > 0){
          $movies_ids_array = array();
          $movies_names_array = array(); 
          $movies_prices_array = array();
          $movies_quantities_array = array(); 
          $total_price = 0;

          foreach($_SESSION["shopping_cart"] as $keys => $values) { 

            $newHot = $_SESSION["shopping_cart"][$keys]["item_hot"] + $_SESSION["shopping_cart"][$keys]["item_quantity"];
            $oldStock = $_SESSION["shopping_cart"][$keys]["item_stock"];
            $newStock = $oldStock - $_SESSION["shopping_cart"][$keys]["item_quantity"];

            $movie_id = $_SESSION["shopping_cart"][$keys]["item_id"];
            $movie_name = $_SESSION["shopping_cart"][$keys]["item_name"];

            $updateQuery = "UPDATE movies_db.movie 
                          SET stock_quantity ='$newStock', hot = '$newHot'
                          WHERE movie_id = '$movie_id'";

            if($newStock > 0){                        
              require 'Db_Credentials.php';

              mysqli_query($Connection,$updateQuery) or die(mysqli_error($Connection));

              mysqli_close($Connection);

              array_push($movies_ids_array,$_SESSION["shopping_cart"][$keys]["item_id"]); 
              array_push($movies_names_array,$_SESSION["shopping_cart"][$keys]["item_name"]); 
              array_push($movies_prices_array,$_SESSION["shopping_cart"][$keys]["item_price"]); 
              array_push($movies_quantities_array,$_SESSION["shopping_cart"][$keys]["item_quantity"]);   

              $total_price = $total_price + ($values["item_quantity"] * $values["item_price"]);    
            }else{
              exit('Not enough stock for '.$movie_name.'.</br> Available stock is '.$oldStock.'.</br></br> Please enter a valid quantity.');
            }   
          }

          $movies_ids = implode(", ",$movies_ids_array);
          $movies_names = implode(", ",$movies_names_array); 
          $movies_price = implode(", ",$movies_prices_array);
          $movies_quantity = implode(", ",$movies_quantities_array); 


          $user_id = $_SESSION["user_id"];
          $user_name = $_SESSION["username"];

          $insertQuery = "INSERT INTO movies_db.order (movies_ids, movies_names, movies_price, movies_quantity, user_id,
                         user_name, total_price)
                          VALUES ('$movies_ids', '$movies_names', '$movies_price', '$movies_quantity',
                          '$user_id','$user_name','$total_price')";

          require 'Db_Credentials.php';

          mysqli_query($Connection,$insertQuery) or die(mysqli_error($Connection));

          mysqli_close($Connection);

          
          foreach($_SESSION["shopping_cart"] as $keys => $values) {  
            unset($_SESSION["shopping_cart"][$keys]);     
          }
        echo "<script>
        alert('Thank you!  Your order was placed.');
        window.location.href='Main.php';
        </script>";
      }else{
        echo "<script>
        alert('Nothing to Order');
        window.location.href='Main.php';
        </script>";
      }

    }

    function RemoveFromCart(){
        foreach($_SESSION["shopping_cart"] as $keys => $values)  
           {  
                if($values["item_id"] == $_GET["id"])  
                {  
                     unset($_SESSION["shopping_cart"][$keys]);   
                     echo '<script>window.location="Checkout.php"</script>';  
                }  
           } 
    }

    function EmptyCart() {
      if (isset($_SESSION["shopping_cart"])){
        foreach($_SESSION["shopping_cart"] as $keys => $values) {  
            unset($_SESSION["shopping_cart"][$keys]);     
        }
      }
    }    
                 
    function Notification(){
      if (isset($_SESSION["shopping_cart"])){
        return count($_SESSION["shopping_cart"]);
      }else{
        return 0;
      }
    }
}