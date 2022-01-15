<?php
require ("CategoryEntity.php");
require ("MoviesEntity.php");

class MoviesModel{
    var $error_message;

    function  GetCategory(){
        require 'Db_Credentials.php';
        $query = "SELECT category_id, name FROM category";
        $result = mysqli_query($Connection,$query) or die(mysqli_error($Connection));
        $CategoryArray = array();
        while ($row =  mysqli_fetch_array($result)) {
            $category_id = $row[0];
            $name = $row[1];
            $Category  = new CategoryEntity( $category_id,$name); 
            array_push($CategoryArray, $Category);
        }
        mysqli_close($Connection);
        return $CategoryArray;       
    }
    
    function  GetMovies(){
        $userid = 0;
        $query = "SELECT movie.movie_id,
                    movie.name,
                    movie.description,
                    movie.cover,
                    movie.category_id,
                    category.name as categoryName,
                    movie.director,
                    movie.year,
                    movie.duration,
                    movie.stars,
                    movie.trailer,
                    movie.storyline,
                    movie.price,
                    movie.stock_quantity,
                    movie.hot,
                    COALESCE(viewrate.counts,0) as counts ,
                    COALESCE(viewrate.AVGrates,0) as AVGrates, 
               (select count(movie_id) from rate where rate.movie_id = movie.movie_id and rate.user_id = ". $userid . " ) as isUsrRate, 
               (select count(movie_id) from review where review.movie_id = movie.movie_id and review.user_id = ". $userid . " ) as isUsrreview 
                FROM movie 
                    INNER JOIN category on category.category_id = movie.category_id
                    LEFT JOIN viewrate on viewrate.movie_id = movie.movie_id ";
        
        require 'Db_Credentials.php';
        $result = mysqli_query($Connection,$query) or die(mysqli_error($Connection));
        $moviesArray = array();
        while ($row =  mysqli_fetch_array($result)) {
            $movie_id = $row[0];
            $name = $row[1];
            $description = $row[2];
            $cover = $row[3];
            $category_id = $row[4];
            $categoryName = $row[5];
            $director = $row[6];
            $year = $row[7];
            $duration = $row[8];
            $stars = $row[9];
            $trailer = $row[10];
            $storyline = $row[11];
            $price = $row[12];
            $stock_quantity = $row[13];
            $hot = $row[14];
            $countrate = $row[15];
            $avgrate = $row[16];           
            $UsrRate =0;
            $isUsrreview =0;
            $ReviewArray = array();
            $movie = new MoviesEntity($movie_id,$name,$description,$cover,$category_id,$categoryName,
                         $director,$year,$duration,$stars,$trailer,$storyline,$price, $stock_quantity, $hot,$countrate,$avgrate,$UsrRate,$isUsrreview,
                        $ReviewArray);
            array_push($moviesArray, $movie);
        }
        mysqli_close($Connection);
        return $moviesArray;        
    }
    
     function  GetMoviesByCategory($category_id){
        $query = "SELECT movie.movie_id,
                    movie.name,
                    movie.description,
                    movie.cover,
                    movie.category_id,
                    category.name as categoryName,
                    movie.director,
                    movie.year,
                    movie.duration,
                    movie.stars,
                    movie.trailer,
                    movie.storyline,
                    movie.price,
                    movie.stock_quantity,
                    movie.hot,
                    COALESCE(viewrate.counts,0) as counts ,
                    COALESCE(viewrate.AVGrates,0) as AVGrates
                    FROM movie 
                    INNER JOIN category on category.category_id = movie.category_id
                    LEFT JOIN viewrate on viewrate.movie_id = movie.movie_id ".
                    "WHERE movie.category_id = $category_id";
        
        require 'Db_Credentials.php';
        $result = mysqli_query($Connection,$query) or die(mysqli_error($Connection));
        $moviesArray = array();
        while ($row =  mysqli_fetch_array($result)) {
            $movie_id = $row[0];
            $name = $row[1];
            $description = $row[2];
            $cover = $row[3];
            $category_id = $row[4];
            $categoryName = $row[5];
            $director = $row[6];
            $year = $row[7];
            $duration = $row[8];
            $stars = $row[9];
            $trailer = $row[10];
            $storyline = $row[11];
            $price = $row[12];
            $stock_quantity = $row[13];
            $hot = $row[14];
            $countrate = $row[15];
            $avgrate = $row[16];          
            $UsrRate = 0;   
            $isUsrreview = 0;   
            $ReviewArray = array();
            $movie = new MoviesEntity($movie_id,$name,$description,$cover,$category_id,$categoryName,
                         $director,$year,$duration,$stars,$trailer,$storyline,$price, $stock_quantity, $hot,$countrate,$avgrate,$UsrRate,$isUsrreview,
                        $ReviewArray);

            array_push($moviesArray, $movie);
        }
        mysqli_close($Connection);
        return $moviesArray;       
    }
    
    function  GetMoviesByMovie($movie_id){
        $query = "SELECT movie.movie_id,
                    movie.name,
                    movie.description,
                    movie.cover,
                    movie.category_id,
                    category.name as categoryName,
                    movie.director,
                    movie.year,
                    movie.duration,
                    movie.stars,
                    movie.trailer,
                    movie.storyline,
                    movie.price,
                    movie.stock_quantity,
                    movie.hot,
                    COALESCE(viewrate.counts,0) as counts ,
                    COALESCE(viewrate.AVGrates,0) as AVGrates, 
               (select `rate` from rate where rate.movie_id = movie.movie_id and rate.user_id = ".  $this->GetUserId() . " ) as isUsrRate, 
               (select count(movie_id) from review where review.movie_id = movie.movie_id and review.user_id = ". $this->GetUserId() . " ) as isUsrreview 
                    FROM movie 
                    INNER JOIN category on category.category_id = movie.category_id
                    LEFT JOIN viewrate on viewrate.movie_id = movie.movie_id ".
                    "WHERE movie.movie_id = $movie_id";
        
        $Query_review = " SELECT review.review_id,
                    review.movie_id, review.user_id, 
                    review.review ,user.username
                    FROM review
                    INNER JOIN user on user.user_id = review.user_id";
        
        require 'Db_Credentials.php';
        
        $result = mysqli_query($Connection,$query) or die(mysqli_error($Connection));
        $moviesArray = array();
        while ($row =  mysqli_fetch_array($result)) {
            $movie_id = $row[0];
            $name = $row[1];
            $description = $row[2];
            $cover = $row[3];
            $category_id = $row[4];
            $categoryName = $row[5];
            $director = $row[6];
            $year = $row[7];
            $duration = $row[8];
            $stars = $row[9];
            $trailer = $row[10];
            $storyline = $row[11];
            $price = $row[12];
            $stock_quantity = $row[13];
            $hot = $row[14];
            $countrate = $row[15];
            $avgrate = $row[16]; 
            $UsrRate =$row[17];
            $isUsrreview =$row[18];
            $ReviewArray = array();
            $movie = new MoviesEntity($movie_id,$name,$description,$cover,$category_id,$categoryName,
                         $director,$year,$duration,$stars,$trailer,$storyline,$price, $stock_quantity, $hot,$countrate,$avgrate,$UsrRate,$isUsrreview,
                        $ReviewArray);
            
            
            $review_result = mysqli_query($Connection,$Query_review . " where review.movie_id = $movie_id ") or die(mysqli_error($Connection));
            while ($reviewrow =  mysqli_fetch_array($review_result)) {
                $review_id = $reviewrow['review_id'];
                $movie_id = $reviewrow['movie_id'];
                $user_id = $reviewrow['user_id'];
                $review = $reviewrow['review'];
                $username = $reviewrow['username'];
                $review = new ReviewEntity($review_id,$movie_id,$user_id,$review,$username);
                array_push($movie->ReviewArray, $review);        
            }
            array_push($moviesArray, $movie);
        }
        mysqli_close($Connection);
        return $moviesArray;       
    }
    
    function  postreview($movieid, $userid,$review){
        require 'Db_Credentials.php';
        $query = "INSERT INTO review(movie_id, user_id,review) 
                VALUES ( $movieid,$userid,'$review')";
        if (!mysqli_query($Connection,$query))
        {
            $this->HandleDBError("Error inserting data to the table \n query:$query");
            return false;
        }  
        return true;
    }
    
    function  postrate($movieid, $userid,$rate){
        require 'Db_Credentials.php';
        $query = "INSERT INTO rate(movie_id, user_id,rate) 
                VALUES ( $movieid,$userid,$rate)";
        if (!mysqli_query($Connection,$query))
        {
            $this->HandleDBError("Error inserting data to the table \n query:$query");
            return false;
        }  
        return true;
    }
            
    function GetUserId()
    {
         if(!isset($_SESSION)){ session_start(); }
         if(empty($_SESSION['user_id']))
         {
            return 0;
         }
         return $_SESSION['user_id'];
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
