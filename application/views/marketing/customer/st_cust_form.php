<div class="phone-box wrap push" id="home">
			<div class="menu-notify">
				<div class="profile-left">
					<a href="#menu" class="menu-link"><i class="fa fa-list-ul"></i></a>
				</div>
				<div class="Profile-mid">
					<h5 class="pro-link"><a href=#">Repower Sales Tracker</a></h5>
				</div>
				
				<div class="clearfix"></div>
			</div> 
<!-- banner -->
   <div class="details-grid bus">
				<div class="details-shade ">
						<div class="details-right">
							<img width='150px' src="<?= $path; ?>images/logo.png" alt=" ">
							<h3><?php echo $ms['name_mark'];?></h3>
								
							
						</div>
						

				
				</div>
			</div>
	 <div class="w3agile contact">
	<h3 class="w3ls-title2">Input Data Calon Customer </h3>
		<div class="book-a-ticket">
		
		<?php echo $this->session->flashdata('message');?>
							
			
        <form action="<?php echo $action; ?>" method="post">
				
		<div class="bnr-full">
	  <label class="inputLabel">Source</label>
		  <select name="source" id="source" placeholder="Source" value="<?php echo $source; ?>">
		  <?php foreach($source_cus as $src){
					$ssl=$src['src']==$source ? "selected":"";
					echo '<option value="'.$src['id_sc'].'"'.$ssl.'>'.$src['name_sc'].'</option>';
		  } ?>
				
			</select>
		
	</div>
	
	<div class="bnr-full">
			<label class="inputLabel">Customer Name</label>
			<input class="city" type="text" name="cust_name" id="cust_name" placeholder="Cust Name" value="<?php echo $cust_name; ?>" required="">
		</div>
		
	<div class="bnr-full">
			<label class="inputLabel">Phone</label>
			<input class="city" type="text" name="cust_phone" id="cust_phone" placeholder="Cust Phone" value="<?php echo $cust_phone; ?>"  required="">
		</div>

	
		
																		 
																		 <div class="search">
									
										<input type="submit" value="Submit">
									</div>
		
		
		</form>	   
	</div>
		</div>
			</div>