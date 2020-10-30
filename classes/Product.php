<?php 
    $filepath = realpath(dirname(__FILE__));
    include_once $filepath."/../lib/Database.php";
    include_once $filepath."/../helpers/Format.php";
?>
<?php 
    class Product{
        public $db;
        public $fm;

        public function __construct(){
            $this->db = new Database();
            $this->fm = new Format();
        }
        public function insertProduct($data, $file){
            $productName = trim(htmlspecialchars(stripslashes($data['productName'])));
            $catId       = trim(htmlspecialchars(stripslashes($data['catId'])));
            $brandId     = trim(htmlspecialchars(stripslashes($data['brandId'])));
            $body        = trim(htmlspecialchars(stripslashes($data['body'])));
            $price       = trim(htmlspecialchars(stripslashes($data['price'])));
            $type        = trim(htmlspecialchars(stripslashes($data['type'])));

            $productName = mysqli_real_escape_string($this->db->link, $productName);
            $catId       = mysqli_real_escape_string($this->db->link, $catId);
            $brandId     = mysqli_real_escape_string($this->db->link, $brandId);
            $body        = mysqli_real_escape_string($this->db->link, $body);
            $price       = mysqli_real_escape_string($this->db->link, $price);
            $type        = mysqli_real_escape_string($this->db->link, $type);

            $permited = array('jpg', 'jpeg', 'png', 'gif');
			$file_name = $file['image']['name'];
			$file_size = $file['image']['size'];
			$file_tmp = $file['image']['tmp_name'];
			
			$div = explode(".", $file_name);
			$file_ext = strtolower(end($div));
			$unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
            $uploaded_image = "upload/".$unique_image;

            if($productName == "" || $catId == "" || $brandId == "" || $body == "" || $price == "" || $file_name == "" || $type == "" ){
                $msg = "<span class='error'>Feild Must not be Empty.!</span>";
            }elseif($file_size > 2097152){
                echo "<span style='color:red'>Image size should be 2MB.</span>";
            }elseif(in_array($file_ext, $permited) === false){
                echo "<span style='color:red'>You can upload only.".implode(',', $permited)."</span>";
            }else{
                move_uploaded_file($file_tmp, $uploaded_image);
                $query = "INSERT INTO tbl_product (productName, catId, brandId, body, price, image, type) VALUES('$productName', '$catId',  '$brandId',  '$body',  '$price',  '$uploaded_image', '$type')";
                $insert_row = $this->db->insert($query);
                if($insert_row){
                    $msg = "<span class='success'>Data Inserted Successfully..!</span>";
                    return $msg;
                }else{
                    $msg = "<span class='success'>Data Not Inserted..!</span>";
                    return $msg;
                }
            }

        }

        public function getAllProduct(){
            
            /*$query = "SELECT p.*, c.catName, b.brandName
            FROM tbl_product as p, tbl_category as c, tbl_brand as b
            WHERE p.catId = c.catId AND p.brandId = b.brandId
            ORDER BY p.productId DESC";*/

            $query = "SELECT tbl_product.*, tbl_category.catName, tbl_brand.brandName FROM  tbl_product
            INNER JOIN tbl_category
            ON tbl_product.catId = tbl_category.catId
            INNER JOIN tbl_brand
            ON tbl_product.brandId = tbl_brand.brandId
            ORDER BY tbl_product.productId DESC";
            $result = $this->db->select($query);
            return $result;
        }
        public function getProById($proid){
            $query = "SELECT * FROM tbl_product WHERE productId='$proid'";
            $result = $this->db->select($query);
            return $result;
        }
        public function updateProduct($data, $file, $proid){
            $productName = trim(htmlspecialchars(stripslashes($data['productName'])));
            $catId       = trim(htmlspecialchars(stripslashes($data['catId'])));
            $brandId     = trim(htmlspecialchars(stripslashes($data['brandId'])));
            $body        = trim(htmlspecialchars(stripslashes($data['body'])));
            $price       = trim(htmlspecialchars(stripslashes($data['price'])));
            $type        = trim(htmlspecialchars(stripslashes($data['type'])));

            $productName = mysqli_real_escape_string($this->db->link, $productName);
            $catId       = mysqli_real_escape_string($this->db->link, $catId);
            $brandId     = mysqli_real_escape_string($this->db->link, $brandId);
            $body        = mysqli_real_escape_string($this->db->link, $body);
            $price       = mysqli_real_escape_string($this->db->link, $price);
            $type        = mysqli_real_escape_string($this->db->link, $type);

            $permited = array('jpg', 'jpeg', 'png', 'gif');
			$file_name = $file['image']['name'];
			$file_size = $file['image']['size'];
			$file_tmp = $file['image']['tmp_name'];
			
			$div = explode(".", $file_name);
			$file_ext = strtolower(end($div));
			$unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
            $uploaded_image = "upload/".$unique_image;

            if($productName == "" || $catId == "" || $body == "" || $price == "" || $type == ""){
                echo "<span style='color:red;font-size:18px;'>Feild must not be empty !.</span>";
            }else{
             if(!empty($file_name)){
    
                if($file_size > 2097152){
                    echo "<span style='color:red'>Image size should be 2MB.</span>";
                }elseif(in_array($file_ext, $permited) === false){
                    echo "<span style='color:red'>You can upload only.".implode(',', $permited)."</span>";
                }else{
                    move_uploaded_file($file_tmp, $uploaded_image);
                    $query ="UPDATE tbl_product
                            SET
                            productName    = '$productName',
                            catId  = '$catId',
                            body   = '$body',
                            body  = '$body',
                            price = '$price',
                            image   = '$uploaded_image',
                            type = '$type'
                    WHERE productId='$proid'";
                    $updated_row = $this->db->update($query);
                    if($updated_row){
                        echo "<span style='color:green;font-size:18px'>Product updated successfully</span>";
                    }else{
                        echo "<span style='color:red;font-size:18px'>Product not updated</span>";
                    }
                }
            }else{
                $query ="UPDATE tbl_product
                        SET
                        productName    = '$productName',
                        catId  = '$catId',
                        body   = '$body',
                        body  = '$body',
                        price = '$price',
                        type = '$type'
                        WHERE productId='$proid'";
                    $updated_row = $this->db->update($query);
                    if($updated_row){
                        echo "<span style='color:green;font-size:18px'>Product Shifted successfully</span>";
                    }else{
                        echo "<span style='color:red;font-size:18px'>Product not Shifted</span>";
                    }
                }
            }
        }
        public function deleteProduct($delpro){
            $query = "SELECT * FROM tbl_product WHERE productId='$delpro'";
            $getData = $this->db->select($query);
            if($getData){
                while($delImg = $getData->fetch_assoc()){
                    $dellink = $delImg['image'];
                    unlink($dellink);
                }
            }
            $delquery = "DELETE FROM tbl_product WHERE productId='$delpro'";
            $delData = $this->db->delete($delquery);
            if($delquery){
                $msg = "<span class='success'>Product Deleted Successfully..!</span>";
                return $msg;
            }else{
                $msg = "<span class='error'>Product Not Deleted..!</span>";
                return $msg;
            }
        }
        public function getFeatureProduct(){
            $query = "SELECT * FROM tbl_product WHERE type='0' ORDER BY productId DESC LIMIT 4";
            $result = $this->db->select($query);
            return $result;
        }
        public function getNewProduct(){
            $query = "SELECT * FROM tbl_product ORDER BY productId DESC LIMIT 4";
            $result = $this->db->select($query);
            return $result;
        }
        public function getSingleProduct($proId){
            $query = "SELECT p.*, c.catName, b.brandName FROM tbl_product as p, tbl_category as c, tbl_brand as b WHERE p.catId = c.catId AND p.brandId = b.brandId AND p.productId='$proId'";
            /*$query = "SELECT p.*, c.catName, b.brandName
            FROM tbl_product as p, tbl_category as c, tbl_brand as b
            WHERE p.catId = c.catId AND p.brandId = b.brandId
            ORDER BY p.productId DESC";*/
            $result = $this->db->select($query);
            return $result;
        }
        public function latestFromIphone(){
            $query = "SELECT * FROM tbl_product WHERE brandId='3' ORDER BY productId DESC LIMIT 1";
            $result = $this->db->select($query);
            return $result;
        }
        public function latestFromSamsung(){
            $query = "SELECT * FROM tbl_product WHERE brandId='2' ORDER BY productId DESC LIMIT 1";
            $result = $this->db->select($query);
            return $result;
        }
        public function latestFromAcer(){
            $query = "SELECT * FROM tbl_product WHERE brandId='1' ORDER BY productId DESC LIMIT 1";
            $result = $this->db->select($query);
            return $result;
        }
        public function latestFromCanon(){
            $query = "SELECT * FROM tbl_product WHERE brandId='4' ORDER BY productId DESC LIMIT 1";
            $result = $this->db->select($query);
            return $result;
        }
        public function productByCat($catId){
            $catId = mysqli_real_escape_string($this->db->link, $catId);
            $query = "SELECT * FROM tbl_product WHERE catId='$catId'";
            $result = $this->db->select($query);
            return $result;
        }
        public function getProductImage($productid){
            $query = "SELECT productName, image FROM tbl_product WHERE productId='$productid'";
            $result = $this->db->select($query);
            return $result;
        }
        public function getAcerBrand(){
            $query = "SELECT * FROM tbl_product WHERE brandId='1'";
            $result = $this->db->select($query);
            return $result;
        }
        public function getSamsungBrand(){
            $query = "SELECT * FROM tbl_product WHERE brandId='2'";
            $result = $this->db->select($query);
            return $result;
        }
        public function getCanonBrand(){
            $query = "SELECT * FROM tbl_product WHERE brandId='4'";
            $result = $this->db->select($query);
            return $result;
        }
        public function serchProduct($search){
            $query = "SELECT * FROM tbl_product WHERE productName LIKE '%$search%' OR body LIKE '%$search%'";
            $result = $this->db->select($query);
            return $result;
        }
    }
?>







