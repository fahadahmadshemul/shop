<?php
    $filepath = realpath(dirname(__FILE__));
    include_once $filepath."/../lib/Database.php";
    include_once $filepath."/../helpers/Format.php";
?>
<?php 
    class Cart{
        public $db;
        public $fm;

        public function __construct(){
            $this->db = new Database();
            $this->fm = new Format();
        }
        public function addToCart($quantity, $proId){
            $quantity = trim(htmlspecialchars(stripslashes($quantity)));

            $quantity  = mysqli_real_escape_string($this->db->link, $quantity);
            $productId = mysqli_real_escape_string($this->db->link, $proId);
            $sId       = session_id();

            $slquery  = "SELECT * FROM tbl_product WHERE productId='$productId'";
            $result = $this->db->select($slquery)->fetch_assoc();

            $productName = $result['productName'];
            $price       = $result['price'];
            $image       = $result['image'];

            $chquery = "SELECT * FROM tbl_cart WHERE productId='$productId' AND sId='$sId'";
            $getPro = $this->db->select($chquery);
            if($getPro){
                $msg = "<span style='color:red;display:block;font-size:18px'>Product Already Added.!</span>";
                return $msg;
            }else{
                $query = "INSERT INTO tbl_cart (sId, productId, productName, price, quantity, image)VALUES('$sId', '$productId', '$productName', '$price', '$quantity', '$image')";
                $insert_row = $this->db->insert($query);
                if($insert_row){
                    header("location: cart.php");
                }else{
                    header("location: 404.php");
                }
            }
        }
        public function getCartPrduct(){
            $sId = session_id();
            $query = "SELECT * FROM tbl_cart WHERE sId='$sId'";
            $result = $this->db->select($query);
            return $result;
        }
        public function updateCart($cartId, $quantity){
            $cartId = trim(htmlspecialchars(stripslashes($cartId)));
            $quantity = trim(htmlspecialchars(stripslashes($quantity)));

            $cartId  = mysqli_real_escape_string($this->db->link, $cartId);
            $quantity  = mysqli_real_escape_string($this->db->link, $quantity);
            $query = "UPDATE tbl_cart 
                    SET
                    quantity='$quantity'
                    WHERE cartId='$cartId'";
            $result = $this->db->update($query);
        }
        public function delProductFromCart($delId){
            $query = "DELETE FROM `tbl_cart` WHERE cartId='$delId'";
            $delpro = $this->db->delete($query);
            if($delpro){
                header("location:cart.php");
            }else{
                $msg = "<span class='error'>Data not Deleted</span>";
                return $msg;
            }
        }
        public function checkCartTable(){
            $sId = session_id();
            $query = "SELECT * FROM tbl_cart WHERE sId='$sId'";
            $result = $this->db->select($query);
            return $result;
        }
        public function delCustomerCart(){
            $sId = session_id();
            $query = "DELETE FROM tbl_cart WHERE sId='$sId'";
            $result = $this->db->delete($query);
        }
        public function orderProduct($cmrid){
            $sId = session_id();
            $query = "SELECT * FROM tbl_cart WHERE sId='$sId'";
            $getPro = $this->db->select($query);
            if($getPro){
                while($result = $getPro->fetch_assoc()){
                    $productId   = $result['productId'];
                    $productName = $result['productName'];
                    $quantity    = $result['quantity'];
                    $price       = $result['price'] * $quantity;
                    $image       = $result['image'];

                    $query = "INSERT tbl_order (cmrId, productId, productName, quantity, price, image) VALUES('$cmrid', '$productId', '$productName', '$quantity', '$price', '$image')";
                    $inserted_row = $this->db->insert($query); 
                }
            }
        }
        public function payableAmount($cmrid){
            $query = "SELECT * FROM tbl_order WHERE cmrId='$cmrid' AND date=now()";
            $result = $this->db->select($query);
            return $result;
        }
        public function getOrderPrduct($cmrid){
            $query = "SELECT * FROM tbl_order WHERE cmrId='$cmrid' ORDER BY date DESC";
            $result = $this->db->select($query);
            return $result;
        }
        public function checkOrder($cmrId){
            $query = "SELECT *  FROM tbl_order WHERE cmrId='$cmrId'";
            $result = $this->db->select($query);
            return $result;
        }
        public function getAllOrderProduct(){
            $query = "SELECT * FROM tbl_order ORDER BY date DESC";
            $result = $this->db->select($query);
            return $result;
        }
        public function updateStatus($shiftid){
            $query ="UPDATE tbl_order
                SET
                
                status = '1'
                WHERE id='$shiftid'";
            $updated_row = $this->db->update($query);
            if($updated_row){
                echo "<span style='color:green;font-size:18px'>Product updated successfully</span>";
            }else{
                echo "<span style='color:red;font-size:18px'>Product not updated</span>";
            }
        }
        public function confirmProduct($confirmId){
            $query ="UPDATE tbl_order
                SET
                status = '2'
                WHERE id='$confirmId'";
            $updated_row = $this->db->update($query);
        }
        public function delshiftedpro($delshiftpro){
            $query  = "DELETE FROM tbl_order WHERE id='$delshiftpro'";
            $delpro = $this->db->delete($query);
            if($delpro){
                echo "<span style='color:green;font-size:18px'>Product Deleted successfully</span>";
            }else{
                echo "<span style='color:red;font-size:18px'>Product not Deleted!.</span>";
            }
        }
        public function deleteConfirm($delId){
            $query  = "DELETE FROM tbl_order WHERE id='$delId'";
            $delpro = $this->db->delete($query);
            if($delpro){
                echo "<span style='color:green;font-size:18px'>Product Deleted successfully</span>";
            }else{
                echo "<span style='color:red;font-size:18px'>Product not Deleted!.</span>";
            }
        }
    }
?>