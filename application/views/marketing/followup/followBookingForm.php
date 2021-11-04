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
		<h3 class="w3ls-title2">Form Booking Customer</h3>
		<div class="book-a-ticket">					
			
        <form action="<?php echo $action; ?>" method="post">
				
		<div class="ban-top">
		
		
		<div class="section_dest flight">
		   <label class="inputLabel">Jenis Booking</label>
		  <select name="bk_jn" id="bk_jn" placeholder="bk_jn" required>
				<option value="">Pilih</option>
				<option value="RESERVE">RESERVE</option>
				<option value="FULL BOOK">FULL BOOK</option>			
			</select>
		</div>
		
			<div class="bnr-full">
			   <label class="inputLabel">Nominal Booking</label>
					<input class="city" type="text" name="bk_nominal" id="bk_nominal" placeholder="Nominal Booking" value="<?php echo $bk_nominal; ?>" required>
				
			</div>
			
			<div class="bnr-full">
		<div class="section_dest flight">
		   <label class="inputLabel">Lokasi Perumahan</label>
		  <select name="project_id" id="project_id" >
		  <?php foreach($project_cust as $prj){
					$selected = $prj['id']==$project_id ? "selected":"";
					echo '<option value="'.$prj['id'].'"'.$selected.'>'.$prj['project_name'].'</option>';
				} ?>
				
			</select>
		</div>
		</div>
		
		<div class="bnr-full">
			   <label class="inputLabel">Blok Yang di Booking</label>
					<input class="city" type="text" name="project_blok" id="project_blok" placeholder="Blok Yang di Booking" value="<?php echo $project_blok; ?>" >
				
			</div>
	
			<div class="bnr-full">
			   <label class="inputLabel">Keterangan</label>
										<input class="city" type="text" name="bk_ket" id="bk_ket" placeholder="Keterangan" value="<?php echo $bk_ket; ?>"  >
										
										
				<input class="city" type="text" name="cust_id" id="cust_id" placeholder="Catatan" value="<?php echo $cust_id; ?>"readonly  required>
										
			</div>
		
		
		
		</div>
	
	
	
	
	
		
																		 
																		 <div class="search">
									
										<input type="submit" value="Submit">
									</div>
		
		
		</form>	   
	</div>
		</div>
			</div>