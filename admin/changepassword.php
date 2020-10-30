<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include "../classes/Changepass.php"; ?>
<?php 
    $chgpass = new Changepass();
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $adminId = Session::get("adminId");
        $changepass = $chgpass->changeAdminPass($_POST, $adminId);
    }
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2 >Change Password</h2>
        <div class="block">         
         <form action="" method="post">
            <table class="form">
                <tr>
                    <td></td>
                    <td>
                    <?php 
                        if(isset($changepass)){
                            echo $changepass;
                        }
                    ?> 
                    </td>
                    <td></td>
                </tr>					
                <tr>
                    <td>
                        <label>Old Password</label>
                    </td>
                    <td>
                        <input type="password" placeholder="Enter Old Password..."  name="oldpassword" class="medium" />
                    </td>
                </tr>
				 <tr>
                    <td>
                        <label>New Password</label>
                    </td>
                    <td>
                        <input type="password" placeholder="Enter New Password..." name="newpassword" class="medium" />
                    </td>
                </tr>
				 
				
				 <tr>
                    <td>
                    </td>
                    <td>
                        <input type="submit" name="submit" Value="Update" />
                    </td>
                </tr>
            </table>
            </form>
        </div>
    </div>
</div>
<?php include 'inc/footer.php';?>