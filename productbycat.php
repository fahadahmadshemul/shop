<?php include "inc/header.php";?>
<?php
     if(!isset($_GET['catId']) && $_GET['catId'] == ''){
         header("location: 404.php");
     }else{
		$catId = $_GET['catId'];
	}
?>

 <div class="main">
    <div class="content">
    	<div class="content_top">
    		<div class="heading">
			<?php
				$getcatName = $cat->getCategory($catId);
					if($getcatName){
						while($result = $getcatName->fetch_assoc()){

			?>
    		<h3>Latest from <?php echo $result['catName']; ?></h3>
						<?php }} ?>
    		</div>
    		<div class="clear"></div>
    	</div>
	      <div class="section group">
		  <?php
			 $productByCat = $pd->productByCat($catId);
			 if($productByCat){
				while($result = $productByCat->fetch_assoc()){
		  ?>
				<div class="grid_1_of_4 images_1_of_4">
					<a href="details.php?proId=<?php echo $result['productId']; ?>"><img style='height:200px' src="admin/<?php echo $result['image']; ?>" alt="" /></a>
					 <h2><?php echo $result['productName']; ?></h2>
					 <p><?php echo $fm->textShorten($result['productName'], 100); ?></p>
					 <p><span class="price">$<?php echo $result['price']; ?></span></p>
				     <div class="button"><span><a href="details.php?proId=<?php echo $result['productId']; ?>" class="details">Details</a></span></div>
				</div>
				<?php } }else{
					header("location: 404.php");
				} ?>
			</div>
    </div>
 </div>
 <?php include "inc/footer.php";?>