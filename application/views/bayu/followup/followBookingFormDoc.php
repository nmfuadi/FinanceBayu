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
		<h3 class="w3ls-title2">Form Upload Booking Customer</h3>
		<div class="book-a-ticket">					
			
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" accept-charset="utf-8">
				
		<div class="ban-top">
		
		
		<div class="section_dest flight">
		   <label class="inputLabel">JENIS DOKUMENT</label>
		  <select name="doc_name" id="doc_name" required>
				<option value="">Pilih</option>
				<option value="KTP1">KTP 1</option>
				<option value="KTP2">KTP 2</option>
				<option value="KK">KARTU KELUARGA</option>
				<option value="SLIPGAJI">SLIP GAJI</option>
				
			</select>
		</div>
		
			<div class="bnr-full">
			   <label class="inputLabel">Pilih FIle Dari Device Anda</label>
					<input type="button" class="btn btn-warning" value="Pilih File" onclick="document.getElementById('pic').click()">
						<input type="text" id="filename"> 
						<input type="file"   name="uploadFile"  id="pic" style="display:none" onchange="document.getElementById('filename').value=this.value">	
			</div>
			
			
			<input class="city" type="hidden" name="cust_id" id="cust_id" placeholder="Catatan" value="<?php echo $cust_id; ?>"readonly  required>		
		
		</div>
	
	
	
	
	
		
																		 
																		 <div class="search">
									
										<input type="submit" value="Submit">
									</div>
		
		
		</form>	   
	</div>
		</div>
			</div>