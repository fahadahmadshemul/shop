<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php
    $filepath = realpath(dirname(__FILE__));
	include $filepath."/../classes/Link.php"; 
	
	$lk = new Link();
	$fm = new Format();
?>
<?php 
    if(!isset($_GET['editId']) || $_GET['editId'] == NULL){
        header("location: sliderlist.php");
    }else{
        $sliderid = $_GET['editId'];
    }
?>
<?php 
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $updateSlider = $lk->UpdateSlider($_POST, $_FILES, $sliderid);
    }
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Add New Brand</h2>
                <?php 
                    if(isset($updateSlider)){
                        echo $updateSlider;
                    }
                ?>
               <div class="block copyblock"> 
            <?php 
                $selectSlider = $lk->selectSliderById($sliderid);
                if($selectSlider){
                    while($result = $selectSlider->fetch_assoc()){ ?>

               <form action="" method="post" enctype="multipart/form-data">
                <table class="form">
                    <tr>
                        <td></td>
                        <td>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Title</label>
                        </td>
                        <td>
                            <input type="text" name="title" value="<?php echo $result['title']; ?>" class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <img width="100px" height="80px" src="<?php echo $result['image'] ?>" alt="">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Upload Image</label>
                        </td>
                        <td>
                            <input type="file" name="image" />
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input type="submit" name="submit" Value="Save" />
                        </td>
                    </tr>
                </table>
                </form>
                    <?php }}  ?>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>