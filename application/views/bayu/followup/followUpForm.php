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
	<h3 class="w3ls-title2">Input Aktifitas Sales</h3>
		<div class="book-a-ticket">
		
		
							
			
        <form action="<?php echo $action; ?>" method="post">
				
		<div class="ban-top">
		
		<div class="bnr-full">
	   <label class="inputLabel">Email</label>
			<input class="city" type="text" name="cust_email" id="cust_email" placeholder="Cust" Email" value="<?php echo $cust_email; ?>" >
		
	</div>
	
	<div class="bnr-full">
	   <label class="inputLabel">Alamat Custommer</label>
								<input class="city" type="text" name="cust_addres" id="cust_addres" placeholder="Cut Addres" value="<?php echo $cust_addres; ?>"  >
								
	</div>
		
		<div class="bnr-full">
		<div class="section_dest flight">
		   <label class="inputLabel">Mencari Rumah dengan Rentang Harga berapa?</label>
		  <select name="fu_price_range" id="fu_price_range" placeholder="fu_price_range">
				<?php foreach($range_price as $price){
					$selected = $price['id']==$fu_price_range ? "selected":"";
					echo '<option value="'.$price['id'].'"'.$selected.'>'.$price['range'].'</option>';
				} ?>
				
			</select>
		</div>
		</div>
		
		<div class="bnr-full">
		<div class="section_dest flight">
		   <label class="inputLabel">Lokasi yang di inginkan</label>
		  <select name="fu_exptd_location" id="fu_exptd_location" >
		  <?php foreach($project_cust as $prj){
					$selected = $prj['id']==$fu_exptd_location ? "selected":"";
					echo '<option value="'.$prj['id'].'"'.$selected.'>'.$prj['project_name'].'</option>';
				} ?>
				
			</select>
		</div>
		</div>
		
		<div class="bnr-full">
		<div class="section_dest flight">
		   <label class="inputLabel">Perumahan yang paling di minati</label>
		  <select name="fu_srvd_location_id" id="fu_srvd_location_id" value="<?php echo $fu_srvd_location_id; ?>">
		  <?php foreach($surveyed_location as $srv){
					$selected = $srv['id_sv_lock']==$fu_srvd_location_id ? "selected":"";
					echo '<option value="'.$srv['id_sv_lock'].'"'.$selected.'>'.$srv['sc_location'].'</option>';
				} ?>
				
			</select>
		</div>
	</div>
	
	<div class="section_dest flight">
		   <label class="inputLabel">Gaji per Bulan</label>
		  <select name="fu_sallary" id="fu_price_range" placeholder="fu_price_range">
				<option value="1sd5">1Juta s/d 5 Juta</option>
				<option value="5sd10">6 Juta s/d 10 Juta</option>
				<option value="10sd15">10 Juta s/d 15 Juta</option>
				<option value="15sd20">16 juta s/d 20 Juta  </option>
				<option value="20sd25">21 juta s/d 25 Juta  </option>
				<option value="25sd30">26 juta s/d 30 Juta  </option>
				<option value="30plus">Diatas 30 Juta   </option>
				
			</select>
		</div>
		
	<div class="bnr-full">
	   <label class="inputLabel">Catatan</label>
			<input class="city" type="text" name="fu_text" id="fu_text" placeholder="Catatan" value="<?php echo $fu_text; ?>"  required>
			
			<input class="city" type="text" name="cust_id" id="cust_id" placeholder="Catatan" value="<?php echo $cust_id; ?>"readonly  required>
	</div>
	
	<div class="section_dest flight">
		   <label class="inputLabel">Satus Customer</label>
		  <select name="st_cust" id="st_cust" placeholder="st_cust">
				<option value="FOLLOWUP">FOLLOWUP</option>
				<option value="HOT PROSPECT">HOT PROSPECT</option>
				<option value="BOOKING">BOOKING</option>
				<option value="AKAD KREDIT">AKAD KREDIT</option>
				<option value="CANCEL">CANCEL</option>
				
			</select>
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