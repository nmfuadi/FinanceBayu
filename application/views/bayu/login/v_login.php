
<div class="phone-box wrap push" id="home">
			<div class="menu-notify">
			 	  
				
				<div class="clearfix"></div>
			</div> 
<!-- banner -->
   
		
	<!-- //banner -->
	<!--bus --> 
            <div class="w3agile contact">
			              <div class="book-a-ticket">
							<div class=" bann-info">
								<div class="booking-info">
							   <h3><a href="main.html">REPOWER SALES TRACKING<span></a></h3>
								
							</div>
							<?php echo $this->session->flashdata('message');?>
							<div class="login-form">
								<form method="POST" enctype="multipart/form-data" action="<?php echo base_url(); ?>marketing/MarketingLogin/LoginProccess">
									<p>User Name </p>
									 <input class="form-control" type="text" required="" name="username" placeholder="Username">
									<p>User Password</p>
									<input class="form-control" type="password" name="password" required="" placeholder="Password">	 
									<div class="wthree-text"> 
										<ul> 
											<li>
												<input type="checkbox" id="brand" value="">
												<label for="brand"><span></span> Remember me ?</label>  
											</li>
											<li> <a href="#">Forgot password?</a> </li>
										</ul>
										<div class="clear"> </div>
									</div> 
									<input type="submit" value="Sign In">		
								</form>
								<p>Don’t have an account ?<a href="#small-dialog1" class="sign-in popup-top-anim"> Sign Up</a></p>
							</div> 
							</div>
					</div> 
			</div>
	<!-- //contact-->
    <!--/footer-->
    
	<!--/footer-->
	</div>