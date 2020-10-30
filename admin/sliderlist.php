<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php
    $filepath = realpath(dirname(__FILE__));
	include $filepath."/../classes/Link.php"; 
	
	$lk = new Link();
	$fm = new Format();
?>
<?php 
    if(isset($_GET['delId'])){
        $delid = $_GET['delId'];
        $deleteSlider = $lk->deleteSlider($delid);
    }
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Slider List</h2>
        <div class="block">  
		<?php 
			if(isset($deleteSlider)){
				echo $deleteSlider;
			}
		?>
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>No.</th>
					<th>Slider Title</th>
					<th>Slider Image</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
			<?php 
				$selectSlider = $lk->selectSliderList();
				if($selectSlider){
					$i=0;
					while($result = $selectSlider->fetch_assoc()){ 
						$i++; ?>
				<tr class="odd gradeX">
					<td><?php echo $i; ?></td>
					<td><?php echo $result['title']; ?></td>
					<td><img src="../admin/<?php echo $result['image']; ?>" height="40px" width="60px"/></td>				
				<td>
					<a href="editSlider.php?editId=<?php echo $result['id']; ?>">Edit</a> || 
					<a onclick="return confirm('Are you sure to Delete!');" href="?delId=<?php echo $result['id'];?>" >Delete</a> 
				</td>
					</tr>	
					<?php }}?>
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
