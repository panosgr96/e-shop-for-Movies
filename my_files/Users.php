<?php

require_once("AppSession.php");
require_once("db.php");
require_once("Z_Wave_WebApi.php");

if (!isset($_SESSION)) {session_start();}
class Users {

//    public static $ROLE = array("ADMIN"=>"1", "USER"=>"2", "LOCAL"=>"3","ANONYMOUS"=>"4");
    public $id;
    public $login;
    public $name;
    public $email;
    public $password;
    public $role;
    public $lang;
    public $rooms;
    public $color;
    public $dashboard;
    public $interval;
    public $hide_all_device_events;
    public $hide_system_events;
    public $hide_single_device_events;

    public function Users($Id, $Login, $Name, $Password, $Email, $Role, $Rooms, $Lang) {
        $this->id = $Id;
        $this->login = $Login;
        $this->name = $Name;
        $this->password = $Password;
        $this->email = $Email;
        $this->role = $Role;
        $this->lang = $Lang;
        $this->rooms = $Rooms;
        $this->color = "#dddddd";
        $this->dashboard = array();
        $this->interval = 2000;
        $this->hide_all_device_events = false;
        $this->hide_system_events = false;
        $this->hide_single_device_events = array();
    }

    public static function RemoveProfile($ProfileId){
        try {
            $sqlQuery ="Select * FROM users WHERE id = ".intval($ProfileId);
            $SdlResponce = SelectQuery($sqlQuery);
            if ($SdlResponce->num_rows == 0) {
                throw new Exception("the User not found!");
            }
            $response =Z_Wave_WebApi::Del_ProfilesById($ProfileId);
            
            $sqlQuery ="DELETE FROM z_wave.users WHERE id = ".intval($ProfileId);
            ExcecuteQuery($sqlQuery);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
    
    public static function Login($Login, $Password) {
        try {
            $role = UserRole::ADMIN;
            $usr = AppSession::ClearCurentUser();
            $result = SelectQuery("SELECT * FROM users WHERE login ='$Login'");
            if ($result->num_rows == 0) {
                throw new Exception("the User not found  try again!");
            }
            while ($row = mysqli_fetch_array($result)) {
                $usr->id='';
                $usr->login=$row['login'];
                $usr->password=$row['password'];
                $usr->name=$row['name'];
                $usr->role=$row['role'];
                $usr->rooms=array(0);
            }
            if ($Login === $usr->login && $Password === $usr->password) {
                AppSession::Set_IsLogin(1);
                AppSession::Set_Userid(Z_Wave_WebApi::Post_Login($Login, $Password));
            } else {
                throw new Exception("You have entered wrong password, try again!");
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
    
    public static function Register_user($Login, $Name, $Password, $Email, $Role, $Rooms, $Lang) {
        try {
            if (AppSession::OnLineZ_wave() == 0 )
            {
                throw new Exception("to z-wave is not connect !!");
            }
            $result = SelectQuery("SELECT * FROM users WHERE login ='$Login'");
            if ($result->num_rows != 0) {
                throw new Exception("the UserName is found !");
            }
            $Id=null;
            $users =  json_encode(new Users($Id, $Login, $Name, $Password, $Email, $Role, $Rooms, $Lang));
            $profile = json_decode($users,true);
            if (intval($profile['role'])==UserRole::ADMIN){
               $profile['room'] = array(0); 
            }
          //  unset($profile['password']);
          //  unset($profile['id']);
            Z_Wave_WebApi::Post_Profiles($profile);
            $profile= array();
            $response = Z_Wave_WebApi::Get_Profiles();
            foreach ($response as $value) {
                $retprof= Z_Wave_WebApi::Get_ProfilesById($value['id'])['data'];
                if($retprof['login']==$Login){
                    $profile = $retprof;
                    break;
                }
            }
            $InsertSql="INSERT INTO users(id,login,password,name,email,role,rooms,lang)"
                    ."  VALUES (".intval($profile['id']).",'".$profile['login']."','".$Password."','"
                    .$profile['name']."','".$profile['email']."',".intval($profile['role'])." ,'"
                    .implode(",",$profile['rooms'])."','".$profile['lang']."')";
            ExcecuteQuery($InsertSql);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
    //implode(",",array) array to string
    // explode (",",string) string to array
    
        public static function TableUsers() {
        $listloc = array();
        try {
            $sqlQuery = "SELECT * FROM `users`";
            $SqlResponce = SelectQuery($sqlQuery);
            if ($SqlResponce->num_rows > 0) {
                while ($row = mysqli_fetch_array($SqlResponce)) {
                    array_push($listloc, new Users(intval($row["id"]), $row['login'], $row['name'], $row['password'], $row['email'], $row['role'], $row['rooms'], $row['lang']));
                }
            }


            $result = "<div id = \"user-table\" >";
            if (count($listloc) == 0) {
                $result = $result . " <tr>
                           <td> </td>         
                           <td> </td>         
                           <td> </td>    
                           <td> </td>
                           <td> </td>
                         </tr>";
            } else {
                foreach ($listloc as $key => $Users) {
                    $result = $result . " <div class=\"user-row\">      
                           <div style=\" display: table-cell;\">$Users->name($Users->id)</div>         
                           <div style=\" display: table-cell; text-align: right;\">
                                <div class=\"btn-group\">
                                <li style=\"float: left;\"><button type=\"submit\" formaction=\"edituser.php\" title=\"Update\" class=\"fa fa-cog\" name=\"Update\" value=\"$Users->id\" style=\"font-family: FontAwesome; \"></button></li>    
                                <li style=\"float: left;\"><button type=\"submit\" title=\"Remove\" class=\"fa fa-trash\" name=\"remove\" value=\"$Users->id\" style=\"font-family: FontAwesome; \"></button></li>
                                </div>
                            </div>
                    </div>";
                }
            }
            $result = $result . "</div>";
            return $result;
        } catch (Exception $exc) {
            throw new Exception($exc->getMessage());
        }
    }
    
    public static function Edit_user($id) {
        try {
            if (AppSession::OnLineZ_wave() == 0 )
            {
                throw new Exception("to z-wave is not connect !!");
            }
            $result = SelectQuery("SELECT * FROM users WHERE id ='$id'");
            if ($result->num_rows != 0) {
                throw new Exception("the UserName is found !");
            }
            $Id=null;
            $users =  json_encode(new Users($Id, $Login, $Name, $Password, $Email, $Role, $Rooms, $Lang));
            $profile = json_decode($users,true);
            if (intval($profile['role'])==UserRole::ADMIN){
               $profile['room'] = array(0); 
            }
          //  unset($profile['password']);
          //  unset($profile['id']);
            Z_Wave_WebApi::Post_Profiles($profile);
            $profile= array();
            $response = Z_Wave_WebApi::Get_Profiles();
            foreach ($response as $value) {
                $retprof= Z_Wave_WebApi::Get_ProfilesById($value['id'])['data'];
                if($retprof['login']==$Login){
                    $profile = $retprof;
                    break;
                }
            }
            $InsertSql="INSERT INTO users(id,login,password,name,email,role,rooms,lang)"
                    ."  VALUES (".intval($profile['id']).",'".$profile['login']."','".$Password."','"
                    .$profile['name']."','".$profile['email']."',".intval($profile['role'])." ,'"
                    .implode(",",$profile['rooms'])."','".$profile['lang']."')";
            ExcecuteQuery($InsertSql);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}