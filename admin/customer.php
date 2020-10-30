<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php 
    $filepath = realpath(dirname(__FILE__));
    include $filepath."/../classes/Customer.php"; 
?>
<?php
    $cmr = new Customer();
    if(!isset($_GET['custId']) && $_GET['custId'] == NULL){
        header("location: inbox.php");
    }else{
        $custId = $_GET['custId'];
    }
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>View Customer Details</h2>
               <div class="block copyblock"> 
        <?php 
            $getDetails = $cmr->getCustomerDetails($custId);
            if($getDetails){
                while($result = $getDetails->fetch_assoc()){
        ?>

                 <form action="" method="post">
                    <table class="form">					
                        <tr>
                            <td>Name</td>
                            <td>
                                <p class="medium" > <?php echo $result['name']; ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td>Address</td>
                            <td>
                                <p class="medium" > <?php echo $result['address']; ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td>City</td>
                            <td>
                                <p class="medium" > <?php echo $result['city']; ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td>Country</td>
                            <td>
                                <p class="medium" > <?php echo $result['country']; ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td>ZipCode</td>
                            <td>
                                <p class="medium" > <?php echo $result['zip']; ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td>Phone</td>
                            <td>
                                <p class="medium" > <?php echo $result['phone']; ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>
                                <p class="medium" > <?php echo $result['email']; ?></p>
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <a style="background: #e8e8e8; padding: 6px 20px;border-radius: 3px;" href="inbox.php">OK</a>
                            </td>
                        </tr>
                    </table>
                    </form>
                    <?php  } }?>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>