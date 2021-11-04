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
		
<!-- experts -->

<div class="w3agile single-bus">
	
           <div class="w3agile bus-midd">
		   <div class="banner_search">
		<form action="<?php echo site_url('marketing/customer/index'); ?>" method="get">
								<div class="input-group">
									<input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
									<span class="input-group-btn">
										<?php 
											if ($q <> '')
											{
												?>
												<a href="<?php echo site_url('marketing/customer'); ?>" class="btn btn-default">Reset</a>
												<?php
											}
										?>
									  <button class="btn btn-primary" type="submit">Search</button>
									</span>
								</div>
							</form>
						</div> 
		   <?php echo anchor(site_url('marketing/customer/create'),'Create', 'class="btn btn-primary"'); ?>
		   <?php echo anchor(site_url('marketing/customer/excel'), 'Excel', 'class="btn btn-primary"'); ?> <br/> <br/>
		   <?php echo anchor(site_url('marketing/customer/index/PROSPECT'),'HOT PROSPECT', 'class="btn btn-danger"'); ?>
		   <?php echo anchor(site_url('marketing/customer/index/BOOKING'),'BOOKING', 'class="btn btn-danger"'); ?>
		   <?php echo anchor(site_url('marketing/customer/'),'ALL DATA', 'class="btn btn-danger"'); ?>
		   <br/><br/>
		   
		   <?php echo $this->session->flashdata('message');?>
	  	     <div class="table-responsive">
		   <table class="table table-bordered agileinfo"> 
	 <thead>
 			       <tr> 
					   <th>No</th>  
					   <th>Customer Name</th> 
					    <th>Phone</th> 
					     <th>Source</th>
					   <th>Status FU</th>
					   <th>Action</th>
				   </tr> 
			  </thead>
		   <tbody>
		    			 
			 <?php
            foreach ($customer_data as $customer)
            {
                ?>
                <tr>
			<td width="80px"><?php echo ++$start ?></td>
			<td><?php echo $customer->cust_name ?></td>
			<td><?php echo $customer->cust_phone ?></td>
			<td><?php echo $customer->name_sc ?></td>
			<td><?php echo $customer->cust_stat ?></td>
			<td style="text-align:center" width="200px">
				<?php
			if($customer->fu_st=='NW'){
				echo anchor(site_url('marketing/followup/activity/'.$customer->id.'/wa/followup'),'WhatsAPP'); 
				echo ' | '; 
				echo anchor(site_url('marketing/followup/activity/'.$customer->id.'/tlp/followup'),'Telepone'); 
				echo ' | '; 
				
				
			}elseif($customer->fu_st=='FU'){
				echo anchor(site_url('marketing/followup/Activity_report/'.$customer->id),'FOLLOWUP');
				
			}else{
				echo anchor(site_url('marketing/followup/DetailCustomer/'.$customer->id),'FU CUSTOMER');
			}
			
			
				//echo anchor(site_url('marketing/customer/delete/'.$customer->id),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
				?>
			</td>
		</tr>
                <?php
            }
            ?>
			 
			 
			  
			 
			 </tbody> 
		</table>	
		</div>
		<a href="#" class="btn btn-primary">Total Record : <?php echo $total_rows ?></a>
		<div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
	</div>
</div>
<!-- //experts -->
    <!--/footer-->
    
		
	<!--/footer-->
	</div>
