<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php 
    $filepath = realpath(dirname(__FILE__));
    include $filepath."/../classes/Product.php"; 
?>
<?php
    $pd = new Product();
    if(!isset($_GET['custId']) && $_GET['productid'] == NULL){
        header("location: inbox.php");
    }else{
        $productid = $_GET['productid'];
    }
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>View Product</h2>
               <div class="block copyblock"> 
        <?php 
            $getDetails = $pd->getProductImage($productid);
            if($getDetails){
                while($result = $getDetails->fetch_assoc()){
        ?>

                 <form action="" method="post">
                    <table class="form">	
                        <tr>
                            <td></td>
                            <td><?php echo $result['productName']; ?></td>
                        </tr>				
                        <tr>
                            <td></td>
                            <td>
                                <img src="<?php echo $result['image']; ?>" alt="">
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <a style="background: #e8e8e8; padding: 6px 20px;border-radius: 3px;" href="inbox.php">OK</a>
                            </td>
                        </tr>
                    </table>
                    </form>
                    <?php  } }?>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>