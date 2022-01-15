<ul class="nav-ul">
    <?PHP  
    
    if ( isset($authentication) && $authentication->CheckLogin() && !$authentication->AdminValidation()){
       echo "<li class='line' style='float:right'><a href='LogOut.php'><div>(".$authentication->GetUsername().")</div>Log Out</a></li>".
            "<li class='line' style='float:right'><a href='Checkout.php' style='padding: 22.5px'><img src='../my_images/cart.png' style='width: 30px;'/><div class='bootstrap-iso' style='display: inherit;'><span style='background: #d32626;' class='badge badge-pill badge-danger cartNotification'>".$Cart_Functionality->Notification()."</span></div></a></li>";
    }elseif (( isset($authentication) && $authentication->CheckLogin() && $authentication->AdminValidation())) {
        //admin is logged
        echo "<li class='line' style='float:right'><a href='LogOut.php'><div>(".$authentication->GetUsername().")</div>Log Out</a></li>".
            "<li class='line' style='float:right'><a href='Admin_Dashboard.php' style='padding: 31px'><img src='../my_images/dashboard.png' style='width: 30px;'/></a></li>";
    }else {
        echo " <li class='line' style='float:right'><a href='Registration.php'>Sign up now!</a></li>".
             "<li class='line' style='float:right'><a href='SignIn.php'>Sign in</a></li>";   
    }
    ?>
    <li class='line' style="float:right"><a href="Main.php">Movies</a></li>
</ul>