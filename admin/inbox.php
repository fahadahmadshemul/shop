<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php
	$filepath = realpath(dirname(__FILE__));
	include $filepath."/../classes/Cart.php"; 
	
	$ct = new Cart();
	$fm = new Format();
?>
<?php
	if(isset($_GET['delshiftpro'])){
		$delshiftpro = $_GET['delshiftpro'];
		$delpro = $ct->delshiftedpro($delshiftpro);
	}
?>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>Inbox</h2>
<?php 
	if(isset($_GET['shiftid'])){
		$shiftid = $_GET['shiftid'];
		$updateStatus  = $ct->updateStatus($shiftid);
		if($updateStatus){
			echo $updateStatus;
		}
	}
?>
                <div class="block">        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>View Product</th>
							<th>Order Date</th>
							<th>Product</th>
							<th>Quantity</th>
							<th>Price</th>
							<th>Cust. ID</th>
							<th>Address</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
					<?php
						$getOrder = $ct->getAllOrderProduct();
						if($getOrder){
							while($result = $getOrder->fetch_assoc()){ ?>
						<tr class="odd gradeX">
							<td><a href="viewproduct.php?productid=<?php echo $result['id']; ?>">View product</a></td>
							<td><?php echo $fm->formatDate($result['date']); ?></td>
							<td><?php echo $result['productName']; ?></td>
							<td><?php echo $result['quantity']; ?></td>
							<td><?php echo"$ ". $result['price']; ?></td>
							<td><?php echo $result['cmrId']; ?></td>
							<td><a href="customer.php?custId=<?php echo $result['cmrId']; ?>">view Details</a></td>
							<?php 
								if($result['status'] == '0'){ ?>
									<td><a href="?shiftid=<?php echo $result['id']; ?>">Shifted</a></td>
							<?php }elseif($result['status'] == '1'){ ?>
								<td>Pending</td>
							<?php  }else{?>
								<td><a href="?delshiftpro=<?php echo $result['id']; ?>">Remove</a></td>
						<?php 	}  ?>
							
						</tr>
					<?php  } }?>
					</tbody>
				</table>
               </div>
            </div>
        </div>
<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();

        $('.datatable').dataTable();
        setSidebarHeight();
    });
</script>
<?php include 'inc/footer.php';?>
