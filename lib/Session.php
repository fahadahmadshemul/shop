<?php
    class Session{
        public static function init(){
            session_start();
        }
        public static function set($key, $val){
            $_SESSION[$key] = $val;
        }
        public static function get($key){
            if(isset($_SESSION[$key])){
                return $_SESSION[$key];
            }else{
                return false;
            }
        }
        public static function checkSession(){
            self::init();
            if(self::get('adminlogin')==false){
                self::destroy();
            }
        }
        public static function checkLogin(){
            self::init();
            if(self::get('adminlogin')==true){
                header("location: dashboard.php");
            }
        }
        public static function destroy(){
            session_destroy();
            header("location: login.php");
        }
    }
    
?>
