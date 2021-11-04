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
	<h3 class="w3ls-title2">Absensi Sales</h3>
		<div class="book-a-ticket">
		
		<a href="productcateory://<productid>/<customerid>">Get Details</a> 
							
		<p>Cek lokasi anda! >> <button onclick="getLocation()">Cek</button></p>	
        <form action="<?php echo $action; ?>" method="post">
				
		<div class="ban-top">
		<div class="bnr-full">
		<div class="section_dest flight">
		   <label class="inputLabel">Absen</label>
		  <select name="abs_activity" id="abs_activity" placeholder="abs_activity" value="<?php echo $abs_activity; ?>">
				<?php foreach($st_abs_jns as $jns){
					$selected = $jns['id_jns_absn']==$abs_activity ? "selected":"";
					echo '<option value="'.$jns['id_jns_absn'].'"'.$selected.'>'.$jns['jns_name'].'</option>';
				} ?>
				
			</select>
		</div>
		</div>
				
	<div class="bnr-full">
	   <label class="inputLabel">Lokasi</label>
			<input class="city" type="text" name="location" id="location" placeholder="Catatan" value="<?php echo $location; ?>"  required>
	</div>
	
	
	
	<div class="bnr-full">
	   <label class="inputLabel">Latitude</label>
			<input class="city" type="text" name="latitude" id="latitude" placeholder="Catatan" value="<?php echo $latitude; ?>" readonly required>
	</div>
	
	<div class="bnr-full">
	   <label class="inputLabel">Longitude</label>
			<input class="city" type="text" name="longitude" id="longitude" placeholder="Catatan" value="<?php echo $longitude; ?>" readonly required>
	</div>
		
		</div>
	
	
	
	
	
		
																		 
																		 <div class="search">
									
										<input type="submit" value="Submit">
									</div>
		
		
		</form>	   
	</div>
		</div>
			</div>
			
			
			<script>
var view = document.getElementById("tampilkan");
function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
    } else {
        view.innerHTML = "Yah browsernya ngga support Geolocation bro!";
    }
}
 function showPosition(position) {
	document.getElementById("latitude").value = position.coords.latitude;
	document.getElementById("longitude").value = position.coords.longitude;
	
    
 }
</script>