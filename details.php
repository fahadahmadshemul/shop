<?php include "inc/header.php";?>
<?php
     if(!isset($_GET['proId']) && $_GET['proId'] == ''){
         header("location: 404.php");
     }else{
		 $proId = $_GET['proId'];
	}

	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		$quantity = $_POST['quantity'];
		$addCart = $ct->addToCart($quantity, $proId);
	}
?>

 <div class="main">
    <div class="content">
    	<div class="section group">
	<?php
		$getPd = $pd->getSingleProduct($proId);
		if($getPd){
			while($result = $getPd->fetch_assoc()){
	?>
				<div class="cont-desc span_1_of_2">				
					<div class="grid images_3_of_2">
						<img style="width:200px;height:150px" src="admin/<?php echo $result['image']; ?>" alt="" />
					</div>
				<div class="desc span_3_of_2">
					<h2><?php echo $result['productName']; ?> </h2>				
					<div class="price">
						<p>Price: <span>$<?php echo $result['price']; ?></span></p>
						<p>Category: <span> <?php echo $result['catName']; ?></span></p>
						<p>Brand:<span> <?php echo $result['brandName']; ?></span></p>
					</div>
		<div class="add-cart">
			<form action="" method="post">
				<input type="number" class="buyfield" name="quantity" value="1"/>
				<?php
				$login = Session::get('cusLogin');
				if($login == false){?>
					<a  class="buysubmit" href="login.php">Login</a>
			 	<?php }else{?>
					<input type="submit" class="buysubmit" name="submit" value="Buy Now"/>
				<?php  } ?>
				
			</form>				
		</div>
		<?php 
			if(isset($addCart)){
				echo $addCart;
			}
		?>
			</div>
			<div class="product-desc">
			<h2>Product Details</h2>
			<p><?php echo $result['body']; ?></p>
	    </div>
	<?php } } ?>		
	</div>
				<div class="rightsidebar span_3_of_1">
					<h2>CATEGORIES</h2>
				<?php
					$selctByCat = $cat->selectByCategory();
					if($selctByCat){
						while($result = $selctByCat->fetch_assoc()){

				?>
					<ul>

				      <li><a href="productbycat.php?catId=<?php echo $result['catId']; ?>"><?php echo $result['catName']; ?></a></li>
				      
    				</ul>
						<?php } }?>
 				</div>
 		</div>
 	</div>
	 </div>
<?php include "inc/footer.php";?>