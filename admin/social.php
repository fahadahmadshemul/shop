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
        $insertSocial = $lk->insertSocialLink($_POST);
    }
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Update Social Media</h2>
        <div class="block">      
    <?php 
        $selectSocial = $lk->selectSocialLink();
        if($selectSocial){
            while($result = $selectSocial->fetch_assoc()){ ?>
      
         <form action="" method="post">
            <table class="form">
                <tr>
                    <td></td>
                    <td>
                <?php 
                    if(isset($insertSocial)){
                        echo $insertSocial;
                    }
                ?>
                    </td>
                </tr>					
                <tr>
                    <td>
                        <label>Facebook</label>
                    </td>
                    <td>
                        <input type="text" name="facebook" value="<?php echo $result['facebook']; ?>" class="medium" />
                    </td>
                </tr>
				 <tr>
                    <td>
                        <label>Twitter</label>
                    </td>
                    <td>
                        <input type="text" name="twitter" value="<?php echo $result['twitter']; ?>" class="medium" />
                    </td>
                </tr>
				
				 <tr>
                    <td>
                        <label>LinkedIn</label>
                    </td>
                    <td>
                        <input type="text" name="linkedin" value="<?php echo $result['linkedin']; ?>" class="medium" />
                    </td>
                </tr>
				
				 <tr>
                    <td>
                        <label>Google Plus</label>
                    </td>
                    <td>
                        <input type="text" name="googleplus" value="<?php echo $result['googleplus']; ?>" class="medium" />
                    </td>
                </tr>
				
				 <tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" Value="Update" />
                    </td>
                </tr>
            </table>
            </form>
                <?php } } ?>
        </div>
    </div>
</div>
<?php include 'inc/footer.php';?>