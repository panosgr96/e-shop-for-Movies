<?php
class OrdersEntity {
    public $order_id;
    public $movie_id;
    public $movies_names;
    public $movies_price;
    public $movies_quantity;
    public $user_id;
    public $user_name;
    public $total_price;
            
    function __construct($order_id,$movie_id,$movies_names,$movies_price,$movies_quantity,$user_id,
                         $user_name,$total_price) {
        $this->order_id = $order_id;
        $this->movie_id = $movie_id;
        $this->movies_names = $movies_names;
        $this->movies_price = $movies_price;
        $this->movies_quantity = $movies_quantity;
        $this->user_id = $user_id;
        $this->user_name = $user_name;
        $this->total_price =  $total_price;
    }
}
?>