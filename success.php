<?php include "inc/header.php";?>
<?php 
	$login = Session::get('cusLogin');
	if($login == false){
		header("location: login.php");
	}
?>
<style>
    .payment{width: 500px;min-height:200px;text-align:center;border:1px solid #ddd;margin:0 auto; padding:50px}
    .payment h2{border-bottom:1px solid #ddd; margin-bottom:20px;padding-bottom:10px}
    .payment p{line-height:25px;font-size:18px;text-align:left}
</style>
 <div class="main">
    <div class="content">
    	<div class="section group">
            <div class="payment">
                <h2>Success</h2>
            <?php
                $cmrid = Session::get('cmrId');
                $amount = $ct->payableAmount($cmrid);
                if($amount){
                    $sum = 0;
                    while($result = $amount->fetch_assoc()){
                        $price = $result['price'];
                        $sum = $sum+$price;
                    }
                }
            ?>
                <p>Total Payable Amount(Including vat ) : $
                    <?php
                        $vat = $sum*0.1;
                        $total = $sum+$vat;
                        echo $total;
                    ?>
                </p>
                <p>Thanks for Purchase.Receive your order successfully.We will contract you as soon as possible with delivery details.Here is your order details..... <a href="orderdetails.php">Visit Here</a></p>
            </div>
 		</div>
 	</div>
</div>
<?php include "inc/footer.php";?>