<?php

class Authentication{
    
    var $SessionVar;
    var $ValidUser;
    var $error_message;
      
    function Authentication(){
       $this->SessionVar ="ValidUser";
       $this->ValidUser = 0;
       $this->error_message="";
    }
               
    function SignIn(){
        if(empty($_POST['username']))
        {
            $this->HandleError("UserName is empty!");
            return false;
        }
        if(empty($_POST['password'])){
            $this->HandleError("Password is empty!");
            return false;
        }
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);    
        if(!isset($_SESSION)){ session_start(); }
        if(!$this->CheckLoginInDB($username,$password))
        {
            return false;
        }
        $_SESSION[$this->SessionVar] = $this->ValidUser;
        return true;
    }
    
    function  Registration(){
        if(!isset($_POST['submitted']))
        {
           return false;
        }       
        if(empty($_POST['Username']))
        {
            $this->HandleError("UserName is empty!");
            return false;
        }
        if(empty($_POST['Password']))
        {
            $this->HandleError("Password is empty!");
            return false;
        }
        if(empty($_POST['Name']))
        {
            $this->HandleError("name is empty!");
            return false;
        }
        if(empty($_POST['Surname']))
        {
            $this->HandleError("surname is empty!");
            return false;
        }

        if(empty($_POST['Sex']))
        {
            $this->HandleError("sex is empty!");
            return false;
        }
        
         if(empty($_POST['Email']))
        {
            $this->HandleError("email is empty!");
            return false;
        }
        if(empty($_POST['Age']))
        {
            $this->HandleError("age is empty!");
            return false;
        }
        if(empty($_POST['Proffesion']))
        {
            $this->HandleError("proffesion is empty!");
            return false;
        }
        $username = trim($_POST['Username']);
        $password = trim($_POST['Password']);    
        $name = trim($_POST['Name']);
        $surname = trim($_POST['Surname']); 
        $sex = trim($_POST['Sex']);
        $email = trim($_POST['Email']);    
        $age = trim($_POST['Age']);
        $proffesion = trim($_POST['Proffesion']);    
        require 'Db_Credentials.php';
        $insert_query = "INSERT INTO user(username,password,name,surname,sex,email,age,proffesion) 
            VALUES ( '".$username ."','".$password."','".$name."',
                '".$surname."','".$sex."','".$email."',".$age.",'".$proffesion."')";
        if (!mysqli_query($Connection,$insert_query))
        {
            $this->HandleDBError("Error inserting data to the table\nquery:$insert_query");
            return false;
        }        
        mysqli_close($Connection);
        if(!isset($_SESSION)){ session_start(); }
        if(!$this->CheckLoginInDB($username,$password))
        {
            return false;
        }
        $_SESSION[$this->SessionVar] = $this->ValidUser;
        return true;
    }
    function LogOut(){
        session_start();
        $_SESSION[$this->SessionVar]=NULL;
        unset($_SESSION[$this->SessionVar]);
        $_SESSION['user_id'] = NULL;
        unset($_SESSION['user_id']);
        $_SESSION['username'] =null;
        unset($_SESSION['username'] );
        
    }
    function CheckLoginInDB($username,$password){
        require 'Db_Credentials.php';
        $query = "SELECT user_id, username, password, type FROM user where username='$username' and password='$password'";
        $result = mysqli_query($Connection,$query) or die(mysqli_error());
        if(!$result || mysqli_num_rows($result) <= 0)
        {
            $this->HandleError("Error logging in. The username or password does not match");
            return false;
        }
        $row = mysqli_fetch_assoc($result);
        $_SESSION['username']  = $row['username'];
        $_SESSION['user_id'] = $row['user_id'];
        $this->ValidUser =  $row['user_id'];
        $_SESSION['type'] = $row['type'];
        mysqli_close($Connection);
        return true;
    }
    
    function HandleError($err){
        $this->error_message .= $err."\r\n";
    }
    
    function HandleDBError($err){
        $this->HandleError($err."\r\n mysqlerror:".mysqli_error());
    }
    function RedirectToURL($url){
        header("Location: $url");
        exit;
    }
    
    function CheckLogin(){
         if(!isset($_SESSION)){ session_start(); }
         if(empty($_SESSION[$this->SessionVar]))
         {
            return false;
         }
         return true;
    }
    
    function GetUserId(){
         if(!isset($_SESSION)){ session_start(); }
         if(empty($_SESSION['user_id']))
         {
            return 0;
         }
         return $_SESSION['user_id'];
    }

    function GetUsername(){
         if(!isset($_SESSION)){ session_start(); }
         if(empty($_SESSION['username']))
         {
            return "";
         }
         return $_SESSION['username'];
    }
    
    function AdminValidation(){
        if(!isset($_SESSION)){ session_start(); }
        if($_SESSION['type'] !== '1')
         {
            return false;
         }
         return true;
    }
    
}