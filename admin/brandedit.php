<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include "../classes/Brand.php"; ?>
<?php
    $brand = new Brand();
    if(!isset($_GET['brandid']) && $_GET['brandid'] == NULL){
        header("location: brandlist.php");
    }else{
        $brandid = $_GET['brandid'];
    }
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Edit Category</h2>
               <div class="block copyblock"> 
        <?php
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $brandName = $_POST['brandName'];
                $updateBrand = $brand->brandUpdate($brandName, $brandid);
            }

            if(isset($updateBrand)){
                echo $updateBrand;
            }
        ?>
        <?php 
            $getbrand = $brand->getBrandById($brandid);
            if($getbrand){
                while($result = $getbrand->fetch_assoc()){
        ?>

                 <form action="" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" name="brandName"  value="<?php echo $result['brandName']; ?>" class="medium" />
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Save" />
                            </td>
                        </tr>
                    </table>
                    </form>
                    <?php  } }?>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>