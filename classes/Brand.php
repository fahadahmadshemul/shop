<?php
    include_once "../lib/Database.php";
    include_once "../helpers/Format.php";
?>

<?php
    class Brand{
        
        private $db;
        private $fm;

        public function __construct(){
            $this->db = new Database();
            $this->fm = new Format();
        }
        public function brandInsert($brandName){
            $brandName = trim(htmlspecialchars(stripslashes($brandName)));
            $brandName = mysqli_real_escape_string($this->db->link, $brandName);

            if(empty($brandName)){
                $msg = "<span class='error'>Feild must not be Empty.!</span>";
                return $msg;
            }
            else{
                $query = "INSERT INTO tbl_brand (brandName) VALUES ('$brandName')";
                $insertBrand = $this->db->insert($query);
                if($insertBrand){
                    $msg = "<span class='success'>Brand Inserted Successfully.!</span>";
                    return $msg;
                }else{
                    $msg = "<span class='success'>Brand Inserted Successfully.!</span>";
                    return $msg;
                }
            }
        }
        public function getAllBrand(){
            $query = "SELECT * FROM tbl_brand ORDER BY brandId DESC";
            $result = $this->db->select($query);
            if($result){
                return $result;
            }
        }
        public function getBrandById($brandid){
            $query = "SELECT * FROM tbl_brand WHERE brandId='$brandid'";
            $result = $this->db->select($query);
            if($result){
                return $result;
            }
        }
        public function brandUpdate($brandName, $brandid){
            $brandName = trim(htmlspecialchars(stripslashes($brandName)));
            $brandName = mysqli_real_escape_string($this->db->link, $brandName);

            if(empty($brandName)){
                $msg = "<span class='error'>Feild Must Not be Empty.!</span>";
                return $msg;
            }else{
                $query = "UPDATE tbl_brand
                        SET 
                        brandName='$brandName'
                        WHERE brandId='$brandid'";
                $result = $this->db->update($query);
                if($result){
                    $msg = "<span class='success'>Brand Updated Successfully.!</span>";
                    return $msg;
                }else{
                    $msg = "<span class='error'>Brand Not Updated.!</span>";
                    return $msg;
                }
            }
        }
        public function delBrandById($delbrand){
            $query = "DELETE FROM tbl_brand WHERE brandId='$delbrand'";
            $result = $this->db->delete($query);
            if($result){
                $msg = "<span class='success'>Brand Deleted Successfully..!</span>";
                return $msg;
            }else{
                $msg = "<span class='error'>Brand Not Deleted..!</span>";
                return $msg;
            }
        }
    }