
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
	<h3 class="w3ls-title2">DETAIL KONSUMEN</h3>
		<div class="book-a-ticket">
			<div class="payment-options">
					
					<div class="tabs-box">
					<ul class="tabs-menu booking-menu">
						<li><a href="#tab1">Detail</a></li>
						<li><a href="#tab2">FU Customer</a></li>
					<?php if($data['cust_stat']=='BOOKING' or 'PEMBERKASAN') {  ?>
						<li><a href="#tab3">Full Book</a></li>
						<li><a href="#tab4">Dokument</a></li>
					<?php } ?>
					</ul>
					<div class="clearfix"> </div>
					<div class="tab-grids event-tab-grids">
						<div id="tab1" class="tab-grid">
						<h3>DETAIL CUSTOMER</h3><br/>
						 <div class="table-responsive">
							<table class="table"> 
							<tbody>
								<tr>
								  <th>Nama Customer</th>
									<td><?php echo $data['cust_name'];  ?></td>
								</tr>
								<tr>
								  <th>Telepon</th>
									<td><?php echo $data['cust_phone'];  ?></td>
								</tr>
								
								<tr>
								  <th>Alamat Customer</th>
									<td><?php echo $data['cust_addres'];  ?></td>
								</tr>
								<tr>
								  <th>Status</th>
									<td><?php echo $data['cust_stat'];  ?></td>
									
								</tr>
								<tr>
								  <th>Nama Marketing</th>
									<td><?php echo $data['name_mark'];  ?></td>
								</tr>
								<tr>
								  <td>---------------------------------</td>
									<td>-------------------------------</td>
								</tr>
								<?php 
								if(!empty($data['bk_code'])){
								
								
								?>
								<tr>
								  <th>Booking Code</th>
									<td><?php echo $data['bk_code'];  ?></td>
								</tr>
								<tr>
								  <th>Project</th>
									<td><?php echo $data['project_name'];  ?></td>
								</tr>
								
								<tr>
								  <th>Blok</th>
									<td><?php echo $data['project_blok'];  ?></td>
								</tr>
								
								<tr>
								  <th>Jenis Booking</th>
									<td><?php echo $data['bk_jn'];  ?></td>
								</tr>
								
								<tr>
								  <th>Nominal Booking</th>
									<?php $nominal = ($data['bk_nominal_full']+$data['bk_nominal_rsv']); ?>
									<td>Rp. <?php echo number_format($nominal,2,",",".");  ?></td>
								</tr>
								
								<tr>
								  <th>Booking Upadate</th>
									<td><?php echo $data['bk_st'];  ?></td>
								</tr>
								
								<tr>
								  <th>BI Checking Status</th>
									<td><?php echo $data['bk_bi_stat'];  ?></td>
								</tr>
								
								<tr>
								  <th>Tanggal Booking</th>
									<td><?php echo $data['cr_dt'];  ?></td>
								</tr>
								
							</tbody>	
						</table>
					</div>						
								
				<div class="table-responsive">
					<table class="table "> 
						<h3>BI CHECKING STATUS</h3><br/>
								<tr>
								  <th>BANK</th>
								  <th>STATUS</th>
								</tr>
							<tbody>
							 <?php 
							  if(empty($bicek)){
									 echo "<tr><td colspan='2'>Data Bi Cheking Belum ada</td></tr>";
								 }else{
							 foreach($bicek as $cek){
								
								echo "<tr>";
								echo "<td>".$cek['bank']."</td>";
								echo "<td>".$cek['bi_st']."</td>";
								echo "</tr>";
								 
								 
							 }
								 }
				
				?>
				
				</tbody>
						</table>
						</div>
								
								
								
								
								
							</tbody>
						</table>
						<?php } ?>
						<h3>History Followup Konsumen</h3><br/>
						 <div class="table-responsive">
							<table class="table table-bordered agileinfo"> 
								<tr>
								  <th>Konsumen Status</th>
								  <th>Keterangan</th>
								  <th>Tanggal Followup</th>
								</tr>
							<tbody>
							 <?php 
							  if(empty($detail_fu)){
									 echo "<tr><td colspan='2'>Data Tidak ada</td></tr>";
								 }else{
							 foreach($detail_fu as $fu){
								
								echo "<tr>";
								echo "<td>".$fu['fu_cust_st']."</td>";
								echo "<td>".$fu['fu_detail']."</td>";
								echo "<td>".$fu['cr_dt']."</td>";
								echo "</tr>";
								 
								 
							 }
								 }
				
				?>
				
				</tbody>
						</table>
						</div>
						
						
						
						
						
						</div>
						<div id="tab2" class="tab-grid" style="display: none;">
							<h3>UPDATE FOLLOWUP CUSTOMER</h3><br/>
							<form action="<?php echo site_url('marketing/FollowUp/Activity_reportL_proccess'); ?>" method="post">
							<input class="city" type="hidden" name="cust_id" id="cust_id" placeholder="Catatan" value="<?php echo $data['cusid']; ?>"readonly  required>
									
							
				
								<div class="ban-top">												
																
									<div class="section_dest flight">
										<?php echo form_error('st_cust'); ?>
										   <label class="inputLabel">Satus Customer</label>
										  <select name="st_cust" id="st_cust" placeholder="st_cust">
												<option value="FOLLOWUP" <?php if($data['cust_stat']=='FOLLOWUP'){echo'selected';}?>>FOLLOWUP</option>
												<option value="HOT PROSPECT"<?php if($data['cust_stat']=='HOT PROSPECT'){echo'selected';}?>>HOT PROSPECT</option>
												<option value="BOOKING" <?php if($data['cust_stat']=='BOOKING'){echo'selected';}?>>BOOKING</option>
												<option value="PEMBERKASAN"  <?php if($data['cust_stat']=='PEMBERKASAN'){echo'selected';}?> >PEMBERKASAN</option>
												<option value="AKAD KREDIT"  <?php if($data['cust_stat']=='AKAD KREDIT'){echo'selected';}?> >AKAD KREDIT</option>
												<option value="CANCEL">CANCEL</option>
												
											</select>
											
											
										</div>
										
										<div class="bnr-full">
											<?php echo form_error('fu_detail'); ?>
										   <label class="inputLabel">Keterangan</label>
												
												
												<textarea  name="fu_detail" placeholder="" required=""></textarea>
										</div>
									
									
									</div>
						
						
						
						
						
							
																							 
																							 <div class="search">
														
															<input type="submit" value="Submit">
														</div>
							
							
							</form>	  
							
						</div>
						<div id="tab3" class="tab-grid" style="display: none;">
							<h4>Update Full Booking</h4>
							
						<form action="<?php echo site_url('marketing/FollowUp/booking_update_proccess'); ?>" method="post">
						<input class="city" type="hidden" name="BookingId" id="BookingId" placeholder="Catatan" value="<?php echo $BookingId; ?>"readonly  required>
						<input class="city" type="hidden" name="cust_id" id="cust_id" placeholder="Catatan" value="<?php echo $data['cusid']; ?>"readonly  required>
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
									<input class="city" type="text" name="bk_nominal" id="bk_nominal" placeholder="Nominal Booking" value="<?php echo $dat['bk_nominal']; ?>" required>
								
							</div>
							 
																							 <div class="search">
														
															<input type="submit" value="Submit">
														</div>
							</form>
						</div>
						<div id="tab4" class="tab-grid" style="display: none;">
							<h3>DOKUMENT KELENGKAPAN</h3> <br/>
							<?php 
							echo '<a href="'.site_url('marketing/followup/booking_doc/'.$data['cusid']).'"><h1><span class="label label-danger">Upload Dokument</span></h3></a>';
							?>
							
							
							
							 <div class="table-responsive">
								<table class="table table-bordered agileinfo"> 
								<tr>
								  <th>Nama Dokument</th>
								  <th>jenis Dokument</th>
								  <th>Download FIle</th>
								  <th>Tgl Upload</th>
								</tr>
							<tbody>
							 <?php 
							  if(empty($dok)){
									 echo "<tr><td colspan='2'>Data Tidak ada</td></tr>";
								 }else{
							 foreach($dok as $dokument){
								
								echo "<tr>";
								echo "<td>".$dokument['doc_name']."</td>";
								echo "<td>".substr($dokument['doc_file'],-3)."</td>";
								echo '<td> <a href="'.base_url('file/'.$dokument['doc_file']).'"><h5><span class="label label-info">Download</span></h5></a></td>';
								echo "<td>".$dokument['cr_dt']."</td>";
								echo "</tr>";
								 
								 
							 }
								 }
				
				?>
				
				</tbody>
				</table>
				</div>
							
						</div>
							</div>			
					<div class="clearfix"> </div>
				</div>
	<!--start-carrer-->
	<!----- Comman-js-files ----->
		<script>
			$(document).ready(function() {
				$("#tab2").hide();
				$("#tab3").hide();
				$("#tab4").hide();
				$(".tabs-menu a").click(function(event){
					event.preventDefault();
					var tab=$(this).attr("href");
					$(".tab-grid").not(tab).css("display","none");
					$(tab).fadeIn("slow");
				});
			});
		</script>

				</div>
		
		
		</div>
	
	
	
	
	
		
																		 
																
		
	
	</div>
		</div>
			</div>