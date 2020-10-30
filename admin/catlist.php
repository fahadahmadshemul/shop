<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include "../classes/Category.php"; ?>
<?php
	 $cat = new Category(); 
?>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>Category List</h2>
                <div class="block">  
		<?php
			if(isset($_GET['delid'])){
				$delId = $_GET['delid'];
				$delId = preg_replace('/[^a-zA-Z0-9]/', '', $_GET['delid']);
				$delCat = $cat->delCatById($delId);
				if(isset($delCat)){
					echo $delCat;
				}
			}
			
		?>      
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Category Name</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
					<?php 
						$geCat = $cat->getAllCat();
						if($geCat){
							$i=0;
							while($result = $geCat->fetch_assoc()){
								$i++;
								?>
								
						<tr class="odd gradeX">
							<td><?php echo $i; ?></td>
							<td><?php echo $result['catName']; ?></td>
							<td><a href="catedit.php?catid=<?php echo $result['catId']?>">Edit</a> || <a onclick="return confirm('Are you sure to delete?')" href="?delid=<?php echo $result['catId']?>">Delete</a></td>
						</tr>
						<?php } }else{
							echo "<span class='error'>Category Not Inserted</span>";
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

