<?php
require ("OrdersEntity.php");

class OrdersModel{
    var $error_message;
    
    function  GetOrders(){
        $userid = 0;
        $query = "SELECT */*order.order_id,
                        order.movie_id,
                        order.movies_names,
                        order.movies_price,
                        order.movies_quantity,
                        order.user_id,
                        order.user_name,
                        order.total_price*/
                    FROM movies_db.order";
        
        require 'Db_Credentials.php';
        $result = mysqli_query($Connection,$query) or die(mysqli_error($Connection));
        $ordersArray = array();
        while ($row =  mysqli_fetch_array($result)) {
            $order_id = $row[0];
            $movie_id = $row[1];
            $movies_names = $row[2];
            $movies_price = $row[3];
            $movies_quantity = $row[4];
            $user_id = $row[5];
            $user_name = $row[6];
            $total_price = $row[7];

            $order = new OrdersEntity($order_id,$movie_id,$movies_names,$movies_price,$movies_quantity,$user_id,
                         $user_name,$total_price);
            array_push($ordersArray, $order);
        }
        mysqli_close($Connection);
        return $ordersArray;        
    }

    function HandleError($err)
    {
        $this->error_message = $err."\r\n";
    }
    function HandleDBError($err)
    {
        $this->HandleError("mysqlerror:".mysqli_error($Connection)."\r\n ".$err );
    }
}
?>
