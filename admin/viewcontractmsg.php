<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php 
    $filepath = realpath(dirname(__FILE__));
	include $filepath."/../classes/User.php"; 
	
	$usr = new User();
	$fm = new Format();
?>
<?php
    if(!isset($_GET['msgid']) && $_GET['msgid'] == NULL){
        header("location: contract.php");
    }else{
        $msgid = $_GET['msgid'];
    }
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>View Customer Details</h2>
               <div class="block copyblock"> 
        <?php 
            $viewMessage = $usr->viewMessage($msgid);
            if($viewMessage){
                while($result = $viewMessage->fetch_assoc()){
        ?>

                 <form action="" method="post">
                    <table class="form">					
                        <tr>
                            <td>Name</td>
                            <td>
                                <input type="text" class="medium" value="<?php echo $result['name']; ?>"/>
                            </td>
                        </tr>
                        <tr>
                            <td>Email Address</td>
                            <td>
                            <input type="text" class="medium" value="<?php echo $result['email']; ?>"/>
                            </td>
                        </tr>
                        <tr>
                            <td>Mobile </td>
                            <td>
                            <input type="text" class="medium" value="<?php echo $result['mobile']; ?>"/>
                            </td>
                        </tr>
                        <tr>
                            <td>Message</td>
                            <td>
                                <textarea name="" id="" cols="33" rows="5"><?php echo $result['subject']; ?></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>Date</td>
                            <td>
                            <input type="text" class="medium" value="<?php echo $fm->formatDate($result['date']); ?>"/>
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <a style="background: #e8e8e8; padding: 6px 20px;border-radius: 3px;" href="contract.php">OK</a>
                            </td>
                        </tr>
                    </table>
                    </form>
                    <?php  } }?>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>