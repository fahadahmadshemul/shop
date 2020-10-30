<?php include "inc/header.php";?>
<?php 
	$login = Session::get('cusLogin');
	if($login == true){
		header("location: order.php");
	}
?>
<?php
	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])){
		$customerLogin = $cmr->customerLogin($_POST);
	}
?>
 <div class="main">
    <div class="content">
    	 <div class="login_panel">
        	<h3>Existing Customers</h3>
        	<p>Sign in with the form below.</p>
			<?php 
				if(isset($customerLogin)){
					echo $customerLogin;
				}
			?>
        	<form action="" method="post" id="member">
                	<input name="email" type="text" placeholder="Enter Your Email">
                    <input name="password" type="password" placeholder="Enter Your Password">
					<div class="buttons"><div><button name="login" class="grey">Sign In</button></div>
                 </form>
                    </div>
                    </div>

<?php 
	if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['register'])){
		$customerRegi = $cmr->customerRegistration($_POST);
	}
?>
    	<div class="register_account">
    		<h3>Register New Account</h3>
			<?php
				if(isset($customerRegi)){
					echo $customerRegi;
				}
			?>
    		<form action="" method="post">
		   			 <table>
		   				<tbody>
						<tr>
						<td>
							<div>
							<input type="text" name="name" placeholder="Name" />
							</div>
							
							<div>
							   <input type="text" name="city" placeholder="City" />
							</div>
							
							<div>
								<input type="text" name="zip" placeholder="Zip-Code"/>
							</div>
							<div>
								<input type="text" name="email" placeholder="Email">
							</div>
		    			 </td>
		    			<td>
						<div>
							<input type="text" name="address" placeholder="Address">
						</div>
		    		<div>
						<input type="text" name="country" placeholder="Country">
				 	</div>		        
	
		           <div>
		          <input type="text" name="phone" placeholder="Phone No">
		          </div>
				  
				  <div>
					<input type="text" name="password" placeholder="Password">
				</div>
		    	</td>
		    </tr> 
		    </tbody></table> 
		   <div class="search"><div><button name="register" class="grey">Create Account</button></div></div>
		    <div class="clear"></div>
		    </form>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
 <?php include "inc/footer.php";?>