<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include "../classes/Brand.php"; ?>
<?php
	 $brand = new Brand(); 
?>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>Category List</h2>
                <div class="block">  
		<?php
			 if(isset($_GET['delbrand'])){
			 	$delbrand = $_GET['delbrand'];
			 	$delId = preg_replace('/[^a-zA-Z0-9]/', '', $_GET['delbrand']);
			 	$delBrand = $brand->delBrandById($delbrand);
			 	if(isset($delBrand)){
			 		echo $delBrand;
			 	}
			 }
			
		?>      
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Brand Name</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
					<?php 
						$getBrand = $brand->getAllBrand();
						if($getBrand){
							$i=0;
							while($result = $getBrand->fetch_assoc()){
								$i++;
								?>
								
						<tr class="odd gradeX">
							<td><?php echo $i; ?></td>
							<td><?php echo $result['brandName']; ?></td>
							<td><a href="branedit.php?brandid=<?php echo $result['brandId']?>">Edit</a> || <a onclick="return confirm('Are you sure to delete?')" href="?delbrand=<?php echo $result['brandId']?>">Delete</a></td>
						</tr>
						<?php } }else{
							echo "<span class='error'>No Brand available.! </span>";
						} ?>
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

