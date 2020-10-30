<?php 
    $filepath = realpath(dirname(__FILE__));
    include_once $filepath."/../lib/Database.php";
    include_once $filepath."/../helpers/Format.php";
?>
<?php 
    class User{
        public $db;
        public $fm;

        public function __construct(){
            $this->db = new Database();
            $this->fm = new Format();
        }
        public function contract($data){
            $name    = trim(htmlspecialchars(stripslashes($data['name'])));
            $email   = trim(htmlspecialchars(stripslashes($data['email'])));
            $mobile  = trim(htmlspecialchars(stripslashes($data['mobile'])));
            $subject = trim(htmlspecialchars(stripslashes($data['subject'])));

            $name = mysqli_real_escape_string($this->db->link, $name);
            $email = mysqli_real_escape_string($this->db->link, $email);
            $mobile = mysqli_real_escape_string($this->db->link, $mobile);
            $subject = mysqli_real_escape_string($this->db->link, $subject);

            if(empty($name) || empty($email) ||  empty($mobile) || empty($subject)){
                $msg = "<span style='color:red;font-size:18px'>Feild Must Not be Empty..!</span>";
                return $msg;
            }else{
                $query = "INSERT INTO tbl_contract (name, email, mobile, subject) VALUES ('$name', '$email', '$mobile', '$subject')";
                $inserte_row = $this->db->insert($query);
                if($inserte_row){
                    $msg = "<span style='color:green;font-size:18px'>Message sent successfully..!</span>";
                    return $msg;
                }else{
                    $msg = "<span style='color:red;font-size:18px'>Message Not sent..!please call to admin</span>";
                    return $msg;
                }
            }
        }
        public function getContractMsg(){
            $query = "SELECT * FROM tbl_contract WHERE status='0'";
            $result = $this->db->select($query);
            return $result;
        }
        public function viewMessage($msgid){
            $query = "SELECT * FROM tbl_contract WHERE id='$msgid'";
            $result = $this->db->select($query);
            return $result;
        }
        public function getContractseenMsg(){
            $query = "SELECT * FROM tbl_contract WHERE status='1'";
            $result = $this->db->select($query);
            return $result;
        }
        public function movetoSeenBox($seenId){
            $query = "UPDATE tbl_contract SET
                        status='1'
                    WHERE id='$seenId'";
            $result = $this->db->update($query);
            if($result){
                $msg = "<span style='color:green;font-size:18px'>Message Sent to seen box..!</span>";
                return $msg;
            }else{
                $msg = "<span style='color:red;font-size:18px'>something went wrong..!</span>";
                return $msg;
            }
        }
        public function sentMail($data){
            $to = trim(htmlspecialchars(stripslashes($_POST['toEmail'])));
            $form = trim(htmlspecialchars(stripslashes($_POST['formEmail'])));
            $subject = trim(htmlspecialchars(stripslashes($_POST['subject'])));
            $message = trim(htmlspecialchars(stripslashes($_POST['message'])));

            $sendmail = mail($to, $subject, $message, $form);
            if($sendmail){
                echo "<span style='color:red;font-size:18px'>Send Mail Successfully..!!</span>";
            }else{
                echo "<span style='color:red;font-size:18px'>Something went wrong..!!</span>";
            }
        }
        public function deleteMessage($delMsgId){
            $query = "DELETE FROM tbl_contract WHERE id='$delMsgId'";
            $result = $this->db->delete($query);
            if($result){
                $msg = "<span style='color:green;font-size:18px'>Message Deleted successfully..!!</span>";
                return $msg;
            }else{
                $msg = "<span style='color:red;font-size:18px'>Message Not Deleted..!!</span>";
                return $msg;
            }
        }
    }
?>