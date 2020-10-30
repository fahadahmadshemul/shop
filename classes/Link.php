<?php
    $filepath = realpath(dirname(__FILE__));
    include_once $filepath."/../lib/Database.php";
    include_once $filepath."/../helpers/Format.php";
?>
<?php

    class Link{
        private $db;
        private $fm;
        public function __construct(){
            $this->db = new Database();
            $this->fm = new Format();
        }
        public function insertSocialLink($data){
            $facebook   = trim(htmlspecialchars(stripslashes($data['facebook'])));
            $twitter    = trim(htmlspecialchars(stripslashes($data['twitter'])));
            $linkedin   = trim(htmlspecialchars(stripslashes($data['linkedin'])));
            $googleplus = trim(htmlspecialchars(stripslashes($data['googleplus'])));

            $facebook   = mysqli_real_escape_string($this->db->link, $facebook);
            $twitter    = mysqli_real_escape_string($this->db->link, $twitter);
            $linkedin   = mysqli_real_escape_string($this->db->link, $linkedin);
            $googleplus = mysqli_real_escape_string($this->db->link, $googleplus);

            if(empty($facebook) || empty($twitter) || empty($linkedin) || empty($googleplus)){
                $msg = "<span style='color:red;font-size:18px'>Feild Must Not be Empty..!</span>";
                return $msg;
            }else{
                $query = "UPDATE tbl_social SET 
                            facebook = '$facebook',
                            twitter = '$twitter',
                            linkedin = '$linkedin',
                            googleplus = '$googleplus'
                            WHERE id='1'";
                $inserted_row = $this->db->insert($query);
                if($inserted_row){
                    $msg = "<span style='color:green;font-size:18px'>Data Inserted successfully..!</span>";
                    return $msg;
                }else{
                    $msg = "<span style='color:red;font-size:18px'>Data Not Inserted..!</span>";
                    return $msg;
                }
            }
        }
        public function selectSocialLink(){
            $query = "SELECT * FROM tbl_social WHERE id='1'";
            $result = $this->db->select($query);
            return $result;
        }
        public function updateCopyRight($data){
            $copyright = trim(stripslashes(htmlspecialchars($data['copyright'])));
            $copyright = mysqli_real_escape_string($this->db->link, $copyright);

            if(empty($copyright)){
                $msg = "<span style='color:red;font-size:18px'>Feild Must not be empty..!</span>";
                return $msg;
            }else{
                $query = "UPDATE tbl_copyright SET
                         copyright = '$copyright'
                         WHERE id='1'";
                $updated_row = $this->db->update($query);
                if($updated_row){
                    $msg = "<span style='color:green;font-size:18px'>Data Updated Successfully..!</span>";
                    return $msg;
                }else{
                    $msg = "<span style='color:red;font-size:18px'>Data Not Updated..!</span>";
                    return $msg;
                }
            }
        }
        public function selectCopyright(){
            $query = "SELECT * FROM tbl_copyright WHERE id='1'";
            $result = $this->db->select($query);
            return $result;
        }
        public function insertSlider($data, $file){
            $title = trim(htmlspecialchars(stripslashes($data['title'])));

            $title = mysqli_real_escape_string($this->db->link, $title);

            $permited = array('jpg', 'jpeg', 'png', 'gif');
            $file_name = $file['image']['name'];
            $file_size = $file['image']['size'];
            $file_tmp = $file['image']['tmp_name'];
            
            $div = explode(".", $file_name);
            $file_ext = strtolower(end($div));
            $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
            $uploaded_image = "upload/slider/".$unique_image;

            if(empty($title) || empty($file_name)){
                $msg = "<span style='color:red;font-size:18px'>Feild Must not be empty..!</span>";
                return $msg;
            }elseif($file_size > 2097152){
                echo "<span style='color:red'>Image size should be 2MB.</span>";
            }elseif(in_array($file_ext, $permited) === false){
                echo "<span style='color:red'>You can upload only.".implode(',', $permited)."</span>";
            }else{
                move_uploaded_file($file_tmp, $uploaded_image);
            
                $query = "INSERT INTO tbl_slider( `title`, `image`) VALUES ('$title', '$uploaded_image')";
                $inserted_rows = $this->db->insert($query);
    
                if($inserted_rows){
                    $msg =  "<span style='color:green;font-size:18px'>Slider inserrted successfully</span>";
                    return $msg;
                }else{
                    $msg =  "<span style='color:red;font-size:18px'>Slider not Inserted</span>";
                    return $msg;
                }
            }
        }
        public function selectSliderList(){
            $query = "SELECT * FROM tbl_slider ORDER BY id DESC";
            $result = $this->db->select($query);
            return $result;
        }
        public function selectSliderById($id){
            $query = "SELECT * FROM tbl_slider WHERE id='$id'";
            $result = $this->db->select($query);
            return $result;
        }
        public function updateSlider($data, $file, $sliderid){
            $title = mysqli_real_escape_string($this->db->link, $data['title']);

            $permited = array('jpg', 'jpeg', 'png', 'gif');
                $file_name = $file['image']['name'];
                $file_size = $file['image']['size'];
                $file_tmp = $file['image']['tmp_name'];
                
                $div = explode(".", $file_name);
                $file_ext = strtolower(end($div));
                $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
                $uploaded_image = "upload/slider/".$unique_image;
                
            if($title == ""){
                $msg = "<span style='color:red;font-size:18px;'>Feild must not be empty !.</span>";
                return $msg;
            }else{
            if(!empty($file_name)){

                if($file_size > 2097152){
                    $msg = "<span style='color:red'>Image size should be 2MB.</span>";
                    return $msg;
                }elseif(in_array($file_ext, $permited) === false){
                    $msg =  "<span style='color:red'>You can upload only.".implode(',', $permited)."</span>";
                    return $msg;
                }else{
                    move_uploaded_file($file_tmp, $uploaded_image);
                    $query ="UPDATE tbl_slider
                            SET
                            title  = '$title',
                            image  = '$uploaded_image'
                    WHERE id='$sliderid'";
                    $updated_row = $this->db->update($query);
                    if($updated_row){
                        $msg =  "<span style='color:green;font-size:18px'>Slider updated successfully</span>";
                        return $msg;
                    }else{
                        $msg = "<span style='color:red;font-size:18px'>SLider not updated</span>";
                        return $msg;
                    }
                }
            }else{
                $query ="UPDATE tbl_slider
                            SET
                            title  = '$title'
                    WHERE id='$sliderid'";
                    $updated_row = $this->db->update($query);
                    if($updated_row){
                       $msg =  "<span style='color:green;font-size:18px'>Slider updated successfully</span>";
                        return $msg;
                    }else{
                        $msg = "<span style='color:red;font-size:18px'>SLider not updated</span>";
                        return $msg;
                    }
            }
        }
    }
    public function deleteSlider($delid){
        $selectquery = "SELECT * FROM tbl_slider WHERE id='$delid'";
        $select = $this->db->select($selectquery);
        if($select){
            while($sResult = $select->fetch_assoc()){
                $getImg = $sResult['image'];
                unlink($getImg);
            }
        }

        $query = "DELETE FROM tbl_slider WHERE id='$delid'";
        $result = $this->db->delete($query);
        if($result){
            $msg = "<span style='color:green;font-size:18px'>Slider Deleted successfully</span>";
            return $msg;
        }else{
            $msg = "<span style='color:red;font-size:18px'>SLider not Deleted</span>";
            return $msg;
        }
    }
    }