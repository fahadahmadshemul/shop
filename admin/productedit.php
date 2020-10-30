<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include "../classes/Brand.php"; ?>
<?php include "../classes/Category.php"; ?>
<?php include "../classes/Product.php"; ?>

<?php 
    if(!isset($_GET['proid']) && $_GET['proid'] == NULL){
        echo "<script>window.location = 'productlist.php'</script>";
        //header("location: productlist.php");
    }else{
        $proid = $_GET['proid'];
    }

    $pd = new Product();
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
        $productUpdate = $pd->updateProduct($_POST, $_FILES, $proid);
    }
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Add New Product</h2>
        <div class="block">    
        <?php 
            if(isset($productUpdate)){
                echo $productUpdate;
            }
        ?>     
        <?php
            $getProd = $pd->getProById($proid);
            if($getProd){
                while($value = $getProd->fetch_assoc()){
        ?>      
         <form action="" method="post" enctype="multipart/form-data">
            <table class="form">
               
                <tr>
                    <td>
                        <label>Name</label>
                    </td>
                    <td>
                        <input type="text" name="productName" value="<?php echo $value['productName']; ?>" class="medium" />
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Category</label>
                    </td>
                    <td>
                        <select id="select" name="catId">
                            <option>Select Category</option>
                        <?php
                            $cat = new Category();
                            $getAllCat = $cat->getAllCat();
                            if($getAllCat){
                                while($result = $getAllCat->fetch_assoc()){ ?>

                            <option
                            <?php if($value['catId'] == $result['catId']){ ?>
                            selected = 'selected'
                            <?php }?>
                             value="<?php echo $result['catId']; ?>"><?php echo $result['catName']; ?></option>
                                <?php } }?>
                            
                        </select>
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Brand</label>
                    </td>
                    <td>
                        <select id="select" name="brandId">
                            <option>Select Brand</option>
                        <?php
                            $brand = new Brand();
                            $getAllBrand = $brand->getAllBrand();
                            if($getAllBrand){
                                while($result = $getAllBrand->fetch_assoc()){?>
                            <option
                            <?php if($value['brandId'] == $result['brandId']){ ?>
                                selected="selected"
                            <?php } ?>
                             value="<?php echo $result['brandId']; ?>"><?php echo $result['brandName']; ?></option>
                        <?php } } ?>
                        </select>
                    </td>
                </tr>
				
				 <tr>
                    <td style="vertical-align: top; padding-top: 9px;">
                        <label>Description</label>
                    </td>
                    <td>
                        <textarea name="body" class="tinymce"><?php echo $value['body'];?></textarea>
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Price</label>
                    </td>
                    <td>
                        <input type="text" name="price" value="<?php echo $value['price']; ?>" class="medium" />
                    </td>
                </tr>
            
                <tr>
                    <td>
                        <label>Upload Image</label>
                    </td>
                    <td>
                        <img width='200px' height='80px' src="<?php echo $value['image']; ?>" alt="">
                        <br>
                        <input name="image" type="file" />
                    </td>
                </tr>
				
				<tr>
                    <td>
                        <label>Product Type</label>
                    </td>
                    <td>
                        <select id="select" name="type">
                            <option>Select Type</option>
                            <?php
                                if($value['type']=='0'){?>
                                <option selected='selected' value="0">Featured</option>
                                <option value="1">General</option>
                            <?php }else{?>
                                <option value="0">Featured</option>
                                <option selected='selected' value="1">General</option>
                            <?php } ?>
                            
                        </select>
                    </td>
                </tr>

				<tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" Value="Update" />
                    </td>
                </tr>
            </table>
            </form>
        <?php }}?>
        </div>
    </div>
</div>
<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
<!-- Load TinyMCE -->
<?php include 'inc/footer.php';?>


