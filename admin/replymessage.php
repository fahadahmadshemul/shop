<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php 
    $filepath = realpath(dirname(__FILE__));
	include $filepath."/../classes/User.php"; 
	
	$usr = new User();
	$fm = new Format();
?>
<?php
    if(!isset($_GET['replayId']) && $_GET['replyId'] == NULL){
        header("location: contract.php");
    }else{
        $replyId = $_GET['replyId'];
    }
?>
<?php 
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $sentMail = $usr->sentMail($_POST);
    }
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Reply Message</h2>
               <div class="block copyblock"> 
        <?php 
            $viewMessage = $usr->viewMessage($replyId);
            if($viewMessage){
                while($result = $viewMessage->fetch_assoc()){
        ?>

                 <form action="" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <label>To</label>
                            </td>
                            <td>
                            <input type="text" name="toEmail" class="medium" value="<?php echo $result['email']; ?>"/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>From</label>
                            </td>
                            <td>
                                <input type="text" name="formEmail" placeholder="Please Enter your email" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Subject</label>
                            </td>
                            <td>
                                <input type="text" name="subject" placeholder="please enter subject" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Message</label>
                            </td>
                            <td>
                                <textarea style="margin: 0px; width: 278px; height: 61px;" class="medium" type="text" name="message" placeholder="Enter your message"></textarea>
                            </td>
                        </tr>
						<tr> 
                            <td>
                            <input type="submit" name="submit" value="send" />
                            </td>
                        </tr>
                    </table>
                    </form>
                    <?php  } }?>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>