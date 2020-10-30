<?php
    $filepath = realpath(dirname(__FILE__));
    include_once $filepath."/../lib/Database.php";
    include_once $filepath."/../helpers/Format.php";
?>
<?php 
    class Customer{
        public $db;
        public $fm;

        public function __construct(){
            $this->db = new Database();
            $this->fm = new Format();
        }
        public function customerRegistration($data){
            $name     = trim(htmlspecialchars(stripslashes($data['name'])));
            $address  = trim(htmlspecialchars(stripslashes($data['address'])));
            $city     = trim(htmlspecialchars(stripslashes($data['city'])));
            $country  = trim(htmlspecialchars(stripslashes($data['country'])));
            $zip      = trim(htmlspecialchars(stripslashes($data['zip'])));
            $phone    = trim(htmlspecialchars(stripslashes($data['phone'])));
            $email    = trim(htmlspecialchars(stripslashes($data['email'])));
            $password = trim(htmlspecialchars(stripslashes(md5($data['password']))));

            $name      = mysqli_real_escape_string($this->db->link, $name);
            $address   = mysqli_real_escape_string($this->db->link, $address);
            $city      = mysqli_real_escape_string($this->db->link, $city);
            $country   = mysqli_real_escape_string($this->db->link, $country);
            $zip       = mysqli_real_escape_string($this->db->link, $zip);
            $phone     = mysqli_real_escape_string($this->db->link, $phone);
            $email     = mysqli_real_escape_string($this->db->link, $email);
            $password  = mysqli_real_escape_string($this->db->link, $password);

            if(empty($name) || empty($address) || empty($city) || empty($country) || empty($zip) || empty($phone) || empty($email) || empty($password) ){
                $msg = "<span style='color:red;display:block;font-size:18px'>Feild must not be Empty.!</span>";
                return $msg;
            }else{
                $mailquery = "SELECT * FROM tbl_customer WHERE email='$email'";
                $chkmail = $this->db->select($mailquery);
                if($chkmail == true){
                    $msg = "<span style='color:red;display:block;font-size:18px'>Email Address Already Exist.!</span>";
                    return $msg;
                }else{
                    $query = "INSERT INTO tbl_customer (name, address, city, country, zip, phone, email, password) VALUES('$name', '$address', '$city', '$country', '$zip', '$phone', '$email', '$password')";
                    $insert_row = $this->db->insert($query);
                    if($insert_row){
                        $msg = "<span style='color:green;display:block;font-size:18px'>Customer Registration Successfully.!</span>";
                        return $msg;
                    }
                }
            }
            
        }
        public function customerLogin($data){
            $email    = trim(htmlspecialchars(stripslashes($data['email'])));
            $password = trim(htmlspecialchars(stripslashes(md5($data['password']))));

            $email     = mysqli_real_escape_string($this->db->link, $email);
            $password  = mysqli_real_escape_string($this->db->link, $password);
            if(empty($email) || empty($password)){
                $msg = "<span style='color:red;display:block;font-size:14px'>Feild must not be empty.!</span>";
                return $msg;
            }else{
                $query  = "SELECT * FROM tbl_customer WHERE email='$email' AND password='$password'";
                $result = $this->db->select($query);
                if($result != false){
                    $value = $result->fetch_assoc();
                    Session::set('cusLogin', true);
                    Session::set('cmrId', $value['id']);
                    Session::set('cmrName', $value['name']);
                    header("location: cart.php");
                }else{
                    $msg = "<span style='color:red;display:block;font-size:18px'>Email or Password Not Match.!</span>";
                    return $msg;
                }
            }
        }
        public function getCustomerData($id){
            $query = "SELECT * FROM tbl_customer WHERE id='$id'";
            $result = $this->db->select($query);
            return $result;
        }
        public function customerUpdate($data, $cmrId){
            $name     = trim(htmlspecialchars(stripslashes($data['name'])));
            $address  = trim(htmlspecialchars(stripslashes($data['address'])));
            $city     = trim(htmlspecialchars(stripslashes($data['city'])));
            $country  = trim(htmlspecialchars(stripslashes($data['country'])));
            $zip      = trim(htmlspecialchars(stripslashes($data['zip'])));
            $phone    = trim(htmlspecialchars(stripslashes($data['phone'])));
            $email    = trim(htmlspecialchars(stripslashes($data['email'])));

            $name      = mysqli_real_escape_string($this->db->link, $name);
            $address   = mysqli_real_escape_string($this->db->link, $address);
            $city      = mysqli_real_escape_string($this->db->link, $city);
            $country   = mysqli_real_escape_string($this->db->link, $country);
            $zip       = mysqli_real_escape_string($this->db->link, $zip);
            $phone     = mysqli_real_escape_string($this->db->link, $phone);
            $email     = mysqli_real_escape_string($this->db->link, $email);
            if(empty($name) || empty($address) || empty($city) || empty($country) || empty($zip) || empty($phone) || empty($email)){
                $msg = "<span style='color:red;display:block;font-size:18px'>Feild Must not be empty.!</span>";
                return $msg;
            }else{
                $query = "UPDATE tbl_customer 
                    SET
                    name='$name',
                    address='$address',
                    city='$city',
                    country='$country',
                    zip='$zip',
                    phone='$phone',
                    email='$email'
                    WHERE id='$cmrId'";
                $update_row = $this->db->update($query);
                if($update_row){
                    $msg = "<span style='color:green;display:block;font-size:18px'>Customer Data Update Successfully.!</span>";
                    return $msg;
                }else{
                    $msg = "<span style='color:red;display:block;font-size:18px'>Customer Data Not Update.!</span>";
                    return $msg;
                }
            }
        }
        public function getCustomerDetails($custId){
            $query = "SELECT * FROM tbl_customer WHERE id='$custId'";
            $result = $this->db->select($query);
            return $result;
        }
    }
?>