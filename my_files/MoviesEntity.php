<?php
class MoviesEntity {
    public $movie_id;
    public $name;
    public $description;
    public $cover;
    public $category_id;
    public $categoryName;
    public $director;
    public $year;
    public $duration;
    public $stars;
    public $trailer;
    public $storyline;
    public $price;
    public $stock_quantity;
    public $hot;
    public $countrate;
    public $avgrate;
    public $UsrRate;
    public $isUsrreview;
    public $ReviewArray;
            
    function __construct($movie_id,$name,$description,$cover,$category_id,$categoryName,
                         $director,$year,$duration,$stars,$trailer,$storyline,$price,$stock_quantity,$hot,$countrate,$avgrate,$UsrRate,$isUsrreview,
                         $ReviewArray) {
        $this->movie_id = $movie_id;
        $this->name = $name;
        $this->description = $description;
        $this->cover = $cover;
        $this->category_id = $category_id;
        $this->categoryName = $categoryName;
        $this->director = $director;
        $this->year =  $year;
        $this->duration =$duration;
        $this->stars =$stars;
        $this->trailer =$trailer;
        $this->storyline =$storyline;
        $this->price = $price;
        $this->stock_quantity = $stock_quantity;
        $this->hot = $hot;
        $this->countrate =$countrate;
        $this->avgrate =$avgrate;
        $this->UsrRate= $UsrRate;
        $this->isUsrreview=$isUsrreview;
        $this->ReviewArray = $ReviewArray;
    }
}

class ReviewEntity{
    public $review_id;
    public $movie_id;
    public $user_id;
    public $review;
    public $username;
    function __construct($review_id,$movie_id,$user_id,$review,$username) {
        $this->review_id = $review_id;
        $this->movie_id = $movie_id;
        $this->user_id = $user_id;
        $this->review = $review;
        $this->username = $username;
    }
}
?>