<?php include "inc/header.php";?>



 <div class="main">
    <div class="content">
    	<div class="content_top">
    		<div class="heading">
    		<h3>Acer</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
	      <div class="section group">
              <?php  
                if(!isset($_GET['search']) || $_GET['search'] == NULL){
                    header("location: 404.php");
                }else{
                    $search = $_GET['search'];
                    $serchBox = $pd->serchProduct($search);
				 if($serchBox){
					 while($result = $serchBox->fetch_assoc()){?>
				<div style="margin: 1% 0 1% 0%" class="grid_1_of_4 images_1_of_4">
					 <a href="details.php?proId=<?php echo $result['productId']; ?>"><img style='height:200px' src="admin/<?php echo $result['image']; ?>" alt="" /></a>
					 <h2><?php echo $result['productName']; ?></h2>
					 <p><?php echo $fm->textShorten($result['productName'], 100); ?></p>
					 <p><span class="price">$<?php echo $result['price']; ?></span></p>
				     <div class="button"><span><a href="details.php?proId=<?php echo $result['productId']; ?>" class="details">Details</a></span></div>
				</div>
					 <?php } }else{
						 echo "<h2 style='text-align:center'>No result found.!</h2>";
					 } }?>
			</div>
    </div>
 </div>
 <?php include "inc/footer.php";?>