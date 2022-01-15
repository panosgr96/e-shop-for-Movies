<?php
    require ("MoviesModel.php");
    require_once("Authentication.php");
    require_once("WebClient.php");

    class MoviesController{
        var  $error_message;

        function CreateCategoryDropList() {
        $moviesmodel = new MoviesModel();
        $result = "<form action = '' method = 'post' width = '200px'>
                    Please select a Category: 
                    <select name = 'Categories' >
                        <option value = '0' >All</option>
                        " . $this->CreateOptionValues($moviesmodel->GetCategory()) .
                "</select>
                     <input type = 'submit' value = 'Search' />
                </form>";
              
        

        return $result;
    }
    function CreateOptionValues(array $valueArray) {
        $result = "";
        foreach ($valueArray as $value => $categoty) {
            $result = $result . "<option value='$categoty->category_id'>$categoty->name</option>";
        }
        return $result;
    }
    
    function CreateCategoryUIList() {
        $moviesmodel = new MoviesModel();
        $result = "<div class='divcat'>
            <form action = '' method = 'post' width = '200px'>
                    <sidebard id='sidebar'>
                        <ul class='side-ul'>
                         " . $this->CreateLiValues($moviesmodel->GetCategory()) .
                        "</ul>
                    </sidebard>
                  </form>
                </div>";
        return $result;
    }
  
    function CreateLiValues(array $valueArray) {
        $result = "";
        foreach ($valueArray as $value => $category) {
            $result = $result . "<li  ><a href='MoviesCategories.php?category_id=$category->category_id'>$category->name</a></li>";
        }
        return $result;
    }
    
    function ViewMoviesList(){

        $result = "<div class= 'divtable'>"; 
      //  $moviesmodel = new MoviesModel();
      //  $moviesArray = $moviesmodel->GetMovies();
        $webClient = new WebClient("http://localhost/movies/my_webServices/listMovies/");
        $moviesArray = json_decode($webClient->Get_HttpServices(), true);

        foreach ($moviesArray as $key => $movie){
            //print_r ($moviesArray[$key]["year"]);
            $result = $result .
                    "<form method='post' action='Main.php?action=add&id=".$moviesArray[$key]["movie_id"]."'>
                     <table class = 'movieTable'>
                        <tr>
                            <th>
                            <a href='Movie.php?movie_id=".$moviesArray[$key]["movie_id"]."'>
                                ".$this->hotCheck($moviesArray[$key]["movie_id"])."
                            </a>    
                            </th>
                            <td class='movieTableTd'>
                                <div class='moviesMain' valign='middle'><a href='Movie.php?movie_id=".$moviesArray[$key]["movie_id"]."'>".$moviesArray[$key]["name"]."<span>(".$moviesArray[$key]["year"].")</span></a></div>                                                                       
                            </td>
                            <td style='text-align: center; width: 195px;'>  
                                <span class='priceMain'>".$moviesArray[$key]["price"]." €</span>

                                ".$this->outOfStockCheck($moviesArray[$key]["movie_id"])."
                               
                                <div style='float: left;margin-left: 30px;'>
                                    <div id='starMain'><img src='../my_images/star.png'></div>
                                    <span id='avgMain'>".round($moviesArray[$key]["avgrate"],1) ." <span>/8</span></span>
                                </div>
                            </td>
                            
                        </tr>
                                             
                     </table>
                    </form>";
                    
        }        
         $result = $result  . "</div>";
        return $result;
    }
    
    function GetMoviesByCategory($category_id){
        $result = "<div class= 'divtable'>"; 
        $moviesmodel = new MoviesModel();
        $moviesArray = $moviesmodel->GetMoviesByCategory($category_id);
        foreach ($moviesArray as $key => $movie){
             $result = $result .
                    "<form method='post' action='MoviesCategories.php?category_id=".$movie->category_id."&action=add&id=".$movie->movie_id."'>
                    <table class = 'movieTable'>
                        <tr >
                            <th >
                            <a href='Movie.php?movie_id=$movie->movie_id' >
                                ".$this->hotCheck($movie->movie_id)."
                            </a>    
                            </th>
                            <td class='movieTableTd'>
                                <div class='moviesMain' valign='middle'><a href='Movie.php?movie_id=$movie->movie_id'>$movie->name<span>($movie->year)</span></a></div>                                                                       
                            </td>
                            <td style='text-align: center; width: 195px;'>  
                                <span class='priceMain'>$movie->price €</span>

                                ".$this->outOfStockCheck($movie->movie_id)."        
              
                                <div style='float: left;margin-left: 30px;'>
                                    <div id='starMain'><img src='../my_images/star.png'></div>
                                    <span id='avgMain'>".round($movie->avgrate,1) ." <span>/8</span></span>
                                </div>
                            </td>                          
                        </tr>
                                             
                     </table>
                     </form>";
                    
        }        
         $result = $result  . "</div>";
        return $result;
    }
    
    function GetMoviesByMovie($movie_id){
        $moviesmodel = new MoviesModel();
        $moviesArray = $moviesmodel->GetMoviesByMovie($movie_id);
        foreach ($moviesArray as $key => $movie){
            return $movie;
        }
        return null;
    }
    
    function postreveiw($movieid,$userid){
      if(empty($_POST['review']))
        {
            return false;
        }
        $moviesmodel = new MoviesModel();
        if (!$moviesmodel->postreview($movieid, $userid,$_POST['review']))
        {
            $this->HandleError($moviesmodel->error_message);
            return false;
        }
        return true;
        
    }
    
    function postrate($movieid, $userid)
    {
        if(intval($userid) ==0)
        {
            return false;
        }
        
        if(intval($_POST['submittedRate']) == 0 )
        {
            return false;
        }
        if(intval($_POST['total']) == 0 )
        {
            return false;
        }
        $moviesmodel = new MoviesModel();
        if (!$moviesmodel->postrate($movieid, $userid,intval($_POST['total'])))
        {
            $this->HandleError($moviesmodel->error_message);
            return false;
        }
        return true;
    }
    
    
    function HandleError($err)
    {
        $this->error_message .= $err."\r\n";
    }

    function outOfStockCheck($movie_id){
        $moviesmodel = new MoviesModel();
        $moviesArray = $moviesmodel->GetMovies();

        $authentication = new Authentication();

        if(isset($authentication) && $authentication->CheckLogin() && $authentication->AdminValidation() || !(isset($authentication) && $authentication->CheckLogin())){
            return "";
        }else{
           foreach ($moviesArray as $key => $movie){
            if($movie->movie_id == $movie_id){
                if(intval($movie->stock_quantity) == 0){
                    return "<div style='margin: 10px;''><span style='color: coral; font-size: 22px;'>Out of stock</span></div>";
                }else{
                    return "<div style='float: left;'><input type='submit' name='add_to_cart'  class='forwardButton' style='margin-top:5px;' value='Add to Cart' /></div>
                        <div style='float: right;'> <input type='number' name='quantity'  value='1' min='0' style='width: 30px;     padding: 0px;
                                margin: 0px;
                                margin-right: 10px; margin-top: 12px;'/></div>

                        <input type='hidden' name='hidden_name' value='$movie->name' />  
                        <input type='hidden' name='hidden_price' value='$movie->price' />
                        <input type='hidden' name='hidden_hot' value='$movie->hot' />
                        <input type='hidden' name='hidden_stock' value='$movie->stock_quantity'/> ";
                }
            }        
           } 
        }
        
    }

    function outOfStockCheckMoviePage($movie_id){
        $moviesmodel = new MoviesModel();
        $moviesArray = $moviesmodel->GetMovies();

        $authentication = new Authentication();

        if(isset($authentication) && $authentication->CheckLogin() && $authentication->AdminValidation() || !(isset($authentication) && $authentication->CheckLogin())){
            return "";
        }else{
            foreach ($moviesArray as $key => $movie){
                if($movie->movie_id == $movie_id){
                    if(intval($movie->stock_quantity) == 0 ){
                        return "<div style='margin: 10px;''><span style='color: coral; font-size: 22px;'>Out of stock</span></div>";
                    }else{
                        return "<input type='submit' name='add_to_cart'  class='forwardButton' style='margin-top:5px;'' value='Add to Cart'/>
                                                <input type='number' name='quantity'  value='1' min='0' style='width: 30px;     padding: 0px;
                                                    margin: 0px;
                                                    margin-right: 10px;'/>
                                                
                                                <input type='hidden' name='hidden_name' value='$movie->name'/>  
                                                <input type='hidden' name='hidden_price' value='$movie->price'/> 
                                                <input type='hidden' name='hidden_hot' value='$movie->hot' />
                                                <input type='hidden' name='hidden_stock' value='$movie->stock_quantity'/>";
                    }
                }        
            }
        }
        
    }

    function hotCheck($movie_id){
        $moviesmodel = new MoviesModel();
        $moviesArray = $moviesmodel->GetMovies();

        $authentication = new Authentication();

       foreach ($moviesArray as $key => $movie){
            if($movie->movie_id == $movie_id){
                if(intval($movie->hot) < 4){
                    return "<img runat = 'server' src = '$movie->cover' onmouseover=\"popupdiv(this,'$movie->cover','$movie->description');\"  />";
                }else{
                    return "<div class='box'>
                                <img runat = 'server' src = '$movie->cover' onmouseover=\"popupdiv(this,'$movie->cover','$movie->description');\"  />
                                <div class='ribbon'><span>hot</span></div>
                            </div>";
                }
            }        
        } 
    }

    function hotCheckMoviePage($movie_id){
        $moviesmodel = new MoviesModel();
        $moviesArray = $moviesmodel->GetMovies();

        $authentication = new Authentication();

       foreach ($moviesArray as $key => $movie){
            if($movie->movie_id == $movie_id){
                if(intval($movie->hot) < 4){
                    return "<img runat = 'server' src = '$movie->cover'/>
                                <iframe src='$movie->trailer' allowfullscreen='allowfullscreen' mozallowfullscreen='mozallowfullscreen' msallowfullscreen='msallowfullscreen' oallowfullscreen='oallowfullscreen' webkitallowfullscreen='webkitallowfullscreen'></iframe> ";
                }else{
                    return "<div class='box'>
                                <img runat = 'server' src = '$movie->cover'/>
                                <iframe src='$movie->trailer' allowfullscreen='allowfullscreen' mozallowfullscreen='mozallowfullscreen' msallowfullscreen='msallowfullscreen' oallowfullscreen='oallowfullscreen' webkitallowfullscreen='webkitallowfullscreen'></iframe> 
                                <div class='ribbon'><span>hot</span></div>
                            </div>";
                }
            }        
        } 
    }
}
  
?>


