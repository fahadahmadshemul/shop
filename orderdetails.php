<?php include "inc/header.php";?>
<?php 
	$login = Session::get('cusLogin');
	if($login == false){
		header("location: login.php");
	}
?>
<?php
   if(isset($_GET['confirmId'])){
      $confirmId = $_GET['confirmId'];
      $confirm = $ct->confirmProduct($confirmId);
   }
?>
<?php 
   if(isset($_GET['delconfirm'])){
      $delId = $_GET['delconfirm'];
      $delconfirm = $ct->deleteConfirm($delId);
   }
?>

<style>
   .tblone tr td{text-align:left;font-size: 14px;}
</style>
 <div class="main">
    <div class="content">
        <div class="section group"> 
           <div class="order">
            <h2>Your Order Details<h2>
            <?php 
               if(isset($delconfirm)){
                  echo $delconfirm;
               }
            ?>
            <table class="tblone">
							<tr>
								<th>No</th>
								<th>Product Name</th>
								<th>Image</th>
                        <th>Quantity</th>
								<th>Price</th>
                        <th>Date</th>
                        <th>Status</th>
								<th>Action</th>
							</tr>
						<?php
                     $cmrid = Session::get('cmrId');
							$getOrder = $ct->getOrderPrduct($cmrid);
							 if($getOrder){
								 $i=0;
							 	while($result = $getOrder->fetch_assoc()){
							 		$i++;
						?>
							<tr>
								<td><?php echo $i; ?></td>
								<td><?php echo $result['productName']; ?></td>
								<td><img src="admin/<?php echo $result['image']; ?>" alt=""/></td>
                        <td> <?php echo $result['quantity']; ?></td>
								<td>$. <?php echo $result['price']; ?></td>
                        <td><?php echo $fm->formatDate($result['date']); ?></td>
                        <td>
                           <?php 
                              if($result['status'] == '0'){
                                 echo "pending";
                              }elseif($result['status'] == '1'){?>
                                 <a  href="?confirmId=<?php echo $result['id']; ?>">Confirm</a>
                             <?php }else{
                                 echo "Confirm";
                              }
                           ?>
                        </td>
                        <?php  if($result['status'] == '2'){ ?>
                              <td><a onclick="return confirm('Are you sure to delete?')" href="?delconfirm=<?php echo $result['id']; ?>">X</a></td>
                           <?php }else{ ?>
                              <td>N/A</td>
                           <?php } ?>
							</tr>
							
								 <?php } } ?>
						</table>
           </div>
        </div>
       <div class="clear"></div>
    </div>
 </div>
 <?php include "inc/footer.php";?>