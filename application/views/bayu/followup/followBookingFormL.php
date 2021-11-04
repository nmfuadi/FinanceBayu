<?php echo $this->session->flashdata('message');?>
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
  
	 <div class="w3agile contact">
	<h3 class="w3ls-title2">Input Followup Lanjutan Konsumen Booking</h3>
		<div class="book-a-ticket">
			
        <form action="<?php echo $action; ?>" method="post">
		<input class="city" type="hidden" name="cust_id" id="cust_id" placeholder="Catatan" value="<?php echo $cust_id; ?>"readonly  required>
				
		<div class="ban-top">
			
	
			
		
		<div class="section_dest flight">
			<?php echo form_error('bk_st'); ?>
		   <label class="inputLabel">Status Konsumen Setelah Booking</label>
		  <select name="bk_st" id="bk_jn" placeholder="bk_st" required>
				<option value="">Pilih</option>
				<option value="BI CHECKING">BI CHECKING'CANCEL',''</option>
				<option value="PEMBERKASAN">PEMBERKASAN</option>
				<option value="AKAD">AKAD</option>
				<option value="AKAD">CANCEL</option>	
				
			</select>
		</div>
		
		<div class="bnr-full">
		<?php echo form_error('fu_detail'); ?>
	   <label class="inputLabel">Keterangan</label>
			
			<textarea  name="fu_detail" placeholder="" required=""><?php echo $fu_detail; ?></textarea>
	</div>
	
		
	
		</div>
		
		
		</div>
	
	
	
	
	
		
																		 
																		 <div class="search">
									
										<input type="submit" value="Submit">
									</div>
		
		
		</form>	   
	</div>
		</div>
			</div>