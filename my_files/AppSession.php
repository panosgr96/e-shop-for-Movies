<?php
if (!isset($_SESSION)) { session_start();}
require_once("Enumerations.php");
class AppSession {
    const ServerUrl = "http://askdeveloper.ddns.net:8083/"; 
    const ServicesPath = "ZAutomation/api/v1";
    public static function CurentUser() {
        if (!isset($_SESSION['CurentUser']))
        {
            $usr=new stdClass;
            $usr->id='';
            $usr->login='';
            $usr->password='';
            $usr->name='';
            $usr->role= UserRole::ANONYMOUS;
            $usr->rooms=array(0);
            $usr->remoteid ='';
            $usr->TimeZone ='0';
            $_SESSION['CurentUser']=$usr;
        }        
        return $_SESSION['CurentUser'];
    }
    public static function ClearCurentUser() {
        $usr=new stdClass;
        $usr->id='';
        $usr->login='';
        $usr->password='';
        $usr->name='';
        $usr->role='';
        $usr->rooms=array(0);
        $usr->remoteid ='';
        $usr->TimeZone ='0';
        $_SESSION['CurentUser']=$usr;
        return $_SESSION['CurentUser'];
    }

    public static function Set_Userid($Userid){
        $usr=self::CurentUser();
        $usr->id=$Userid;  
        $OnLineZ_wave =0;
        if ($usr != null){$OnLineZ_wave =1;}
        $_SESSION['OnLineZ_wave'] =$OnLineZ_wave; 
    }
    
    public static function IsLogin(){
       if (!isset($_SESSION['IsLogin'])){
           $islogin =0;
           $_SESSION['IsLogin'] =$islogin; 
       }
       return $_SESSION['IsLogin'];
    }
    
    public static function SetRemoteId($remoteid){
        $usr=self::CurentUser();
        $usr->remoteid = $remoteid;
    }
    
    public static function GetRemoteId(){
        $usr=self::CurentUser();
        return $usr->remoteid;
    }

    public static function SetTimeZone($TimeZone){
        $usr=self::CurentUser();
        $usr->TimeZone = $TimeZone;
    }
   
    public static function GetTimeZone(){
        $usr=self::CurentUser();
        return $usr->TimeZone;
    }    

    public static function Logout(){
        session_unset();
        session_destroy(); 
    }

    public static function Set_IsLogin($islogin){
        $_SESSION['IsLogin'] =$islogin; 
    }

    public static function PageRedirect($Page){
        header("Location: $Page");
        exit;
    }
    public static function PageError($Message) {
        $_SESSION['message'] = $Message;
        header("Location: error.php");
        exit;
    }
    
    public static function PageErrorByException(Exception $ex ) {
        $_SESSION['message'] = $ex->getMessage();
        header("Location: error.php");
        exit;
    }

    public static function OnLineZ_wave()
    {
       if (!isset($_SESSION['OnLineZ_wave'])){
           $OnLineZ_wave =0;
           $_SESSION['OnLineZ_wave'] =$OnLineZ_wave; 
       }
      return $_SESSION['OnLineZ_wave'];
    }

    public static function Authorization($Message =null){
        if (self::IsLogin()==0){
            self::PageError("You must log in ".$Message);
        }
    }
    public static function AuthorizationIsAdmin($Message =null){
        if (self::IsLogin()==0){
            self::PageError("You must log in ".$Message);
        }
        $usr=self::CurentUser();
        if (intval($usr->role)!=UserRole::ADMIN){
            self::PageError("Your must log in  privilege is not administrator ".$Message);
        }
    }
}
