<?php
    include "../lib/Session.php";
    Session::checkLogin();
    include_once "../lib/Database.php";
    include_once "../helpers/Format.php";
?>
<?php

    class Adminlogin{
        private $db;
        private $fm;
        public function __construct(){
            $this->db = new Database();
            $this->fm = new Format();
        }
        public function adminLogin($adminuser,$adminPass){
            $adminuser = trim(htmlspecialchars(stripslashes($adminuser)));
            $adminPass = trim(htmlspecialchars(stripslashes($adminPass)));

            if(empty($adminuser) || empty($adminPass)){
                $loginmsg = "Username or password must not be empty";
                return $loginmsg;
            }else{
                $query = "SELECT * FROM tbl_admin WHERE adminUser='$adminuser' AND adminPass='$adminPass'";
                $result = $this->db->select($query);
                if($result != false){
                    $value = $result->fetch_assoc();
                    Session::set("adminlogin", true);
                    Session::set("adminId", $value['adminId']);
                    Session::set("adminUser", $value['adminUser']);
                    Session::set("adminName", $value['adminName']);
                    header('location: dashboard.php');
                }else{
                    $loginmsg = "Username or password Not Match !.";
                    return $loginmsg;
                }
            }
        }

    }

?>
