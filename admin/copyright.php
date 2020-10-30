<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php 
    $filepath = realpath(dirname(__FILE__));
	include $filepath."/../classes/Link.php"; 
	
	$lk = new Link();
	$fm = new Format();
?>
<?php 
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $updateCopyRight = $lk->updateCopyRight($_POST);
    }
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Update Copyright Text</h2>
        <div class="block copyblock"> 
    <?php 
        $select_copyright = $lk->selectCopyright();
        if($select_copyright){
            while($result = $select_copyright->fetch_assoc()){ ?>

         <form action="" method="post">
            <table class="form">	
                <tr>
                    <td>
                <?php
                    if(isset($updateCopyRight)){
                        echo $updateCopyRight;
                    } 
                ?>
                    </td>
                </tr>				
                <tr>
                    <td>
                        <input type="text" value="<?php echo $result['copyright']; ?>" name="copyright" class="large" />
                    </td>
                </tr>
				
				 <tr> 
                    <td>
                        <input type="submit" name="submit" Value="Update" />
                    </td>
                </tr>
            </table>
            </form>
                <?php }} ?>
        </div>
    </div>
</div>
<?php include 'inc/footer.php';?>