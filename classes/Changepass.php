<?php
    include_once "../lib/Database.php";
    include_once "../helpers/Format.php";
?>
<?php

    class Changepass{
        private $db;
        private $fm;
        public function __construct(){
            $this->db = new Database();
            $this->fm = new Format();
        }
        public function changeAdminPass($data, $adminId){
            $oldpassword = trim(htmlspecialchars(stripslashes($data['oldpassword'])));
            $newpassword = trim(htmlspecialchars(stripslashes($data['newpassword'])));

            $oldpassword = mysqli_real_escape_string($this->db->link, $oldpassword);
            $newpassword = mysqli_real_escape_string($this->db->link, $newpassword);

            if(empty($oldpassword) || empty($newpassword)){
                $cngpassmsg = "<span style='color:red;font-size:18px'>Feild Must not be empty !.</span>";
                return $cngpassmsg;
            }else{
                $oldpassword = md5($oldpassword);
                $newpassword = md5($newpassword);
                $query = "SELECT adminPass FROM tbl_admin WHERE adminId='$adminId' AND adminPass='$oldpassword'";
                $result = $this->db->select($query);
                if($result != false){
                    $cquery = "UPDATE tbl_admin SET
                                adminPass = '$newpassword'
                                WHERE adminId='$adminId'";
                    $changepass = $this->db->update($cquery);
                    if($changepass){
                        $cngpassmsg = "<span style='color:green;font-size:18px'>Change password successfuly !.</span>";
                        return $cngpassmsg;
                    }
                }else{
                    $cngpassmsg = "<span style='color:red;font-size:18px'>Password Not Match !.</span>";
                    return $cngpassmsg;
                }
            }
        }

    }

?>
