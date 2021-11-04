<div id="wrapper">
       
		<!--<div class="preloader">
            <div class="cssload-speeding-wheel"></div>
        </div> -->
      
        
        <!-- ===== Left-Sidebar-End ===== -->
        <!-- ===== Page-Content ===== -->
        <div class="page-wrapper">
		
			
            <div class="container-fluid">
                          <div class="row">
                               <div class="col-md-12 col-sm-12 col-xs-12">
									<div class="white-box">
									
				<a href="<?php echo site_url('Report/AdminVp/ext_to') ?>" class="btn btn-warning waves-effect waves-light" >
				<span class="btn-label"><?php echo $tot['total']; ?></span>TASK WAITING APPROVAL</a>
				<div class="text-right">
					 <h2><?php echo $judul; ?></h2> 
					</div>
				 
					
				   <div class="table-responsive">
						<table class="table table-bordered table-fixed">
					<thead>
					  <tr>
						<th width='3%' style='text-align:center'>No</th>
						<th width='30%' style='text-align:center'>TASK TITLE</th>
						<th  width='40%' style='text-align:center'>TASK DETAIL</th>
						<th  width='15%' style='text-align:center'>DATE RANGE</th>
						<th width='22%' style='text-align:center'>Action</th>
					  </tr>
					</thead>
					<tbody>
					<?php 
					$n= 1;
					if (!empty($jobs)){
						foreach ($jobs as $act){
							
							if($act['jobs_stat']=='inprogress'){
				
						$jobs_stat = '<div class="label label-table label-warning">INPROGRESS</div>';
					}elseif($act['jobs_stat']=='done'){
						
						$jobs_stat = '<div class="label label-table label-success">DONE</div>';
						
					}else {	
						
						$jobs_stat = '<div class="label label-table label-danger">HOLD</div>';
					}			
							
							
							if($act['ext_st']=='yes'){
								
								if($ext=='from'){
									$ttl = "Request to: <div class='label label-table label-success'>".$act['dprt_to']."</div>";
									$action =  ' <label class="btn btn-warning waves-effect waves-light" >
													<span class="btn-label"><i class="fa fa-clock-o"></i></span>WAITING APPROVAL</label>';
									if(empty($act['ext_app'])){
										
										$action = ' <label class="btn btn-warning waves-effect waves-light" >
													<span class="btn-label"><i class="fa fa-clock-o"></i></span>WAITING APPROVAL</label>';
										$aksi = '';
									}elseif ($act['ext_app']=='yes'){
										
										$action = ' <label class="btn btn-success waves-effect waves-light" >
													<span class="btn-label"><i class="fa fa-check"></i></span>APPROVED</label>';
										$aksi = "<a href=".site_url('Report/AdminVp/UpdateTaskList/'.$act['jobs_id'])."><div class='label label-table label-info'>View Progress </div></a>";
									}else{
										
										$action =  ' <label class="btn btn-danger waves-effect waves-light" >
													<span class="btn-label"><i class="fa fa-frown-o"></i></span>DISCARD</label>';
										$aksi = '';
									}

									
								}else{
									$ttl = "Request From: <div class='label label-table label-success'>".$act['dprt_from']."</div>";
									
									if(empty($act['ext_app'])){
										$action = ' <label class="btn btn-warning waves-effect waves-light" >
													<span class="btn-label"><i class="fa fa-clock-o"></i></span>WAITING APPROVAL</label>';
										$aksi = " 
										<a href=".site_url('Report/AdminVp/UpdateTaskExt/yes/'.$act['jobs_id']).">APPROVE</a>
										<a href=".site_url('Report/AdminVp/UpdateTaskExt/no/'.$act['jobs_id']).">DISCARD</a> ";
										
																					
										
									}elseif ($act['ext_app']=='yes'){
										
										$action = ' <label class="btn btn-success waves-effect waves-light" >
													<span class="btn-label"><i class="fa fa-check"></i></span>APPROVED</label>';
										$aksi = "<a href=".site_url('Report/AdminVp/UpdateTaskList/'.$act['jobs_id'])."><div class='label label-table label-info'>View Progress </div></a>";
									}else{
										
										$action = ' <label class="btn btn-danger waves-effect waves-light" >
													<span class="btn-label"><i class="fa fa-frown-o"></i></span>DISCARD</label>';
										$aksi = '';
									}
									
								}
								
					
								
								
								
							}else{
								
							
							}
								
								
								echo "
								 <tr>
									<td>".$n."</td>
									<td> <b> Code:".$act['jobs_code']."</b> <br/> ".$act['jobs_tittle']." <br/>".$ttl."<br/><br/>".$action."</td>
									<td>".$act['jobs_desc']."</td>
									<td width='100'>".$act['jobs_start']."<br/> s/d <br/>".$act['jobs_end']."</td>
									<td style='text-align:center' width='200px'>
									".$aksi."
										
										
									</td>
									</tr>";
						$n++;
						
						}
						
					}else {
						
						echo "
								
								 <tr>
									<td colspan =5>DATA TIDAK ADA</td>
									
								  </tr>
						
						";
					
					}
					?>
			
						<div class="tooltip top tooltip-success" role="tooltip">
														<div class="tooltip-arrow"></div>
														<div class="tooltip-inner"> WAITING APROVAL </div>
													</div>
					</tbody>
				  </table>
				</div>
				</div>
				</div>
				</div>
                  
              
				
				  
				
                
                
                
                
                <!-- ===== Right-Sidebar ===== -->
                <div class="right-sidebar">
                    <div class="slimscrollright">
                        <div class="rpanel-title"> Service Panel <span><i class="icon-close right-side-toggler"></i></span> </div>
                        <div class="r-panel-body">
                            <ul class="hidden-xs">
                                <li><b>Layout Options</b></li>
                                <li>
                                    <div class="checkbox checkbox-danger">
                                        <input id="headcheck" type="checkbox" class="fxhdr">
                                        <label for="headcheck"> Fix Header </label>
                                    </div>
                                </li>
                                <li>
                                    <div class="checkbox checkbox-warning">
                                        <input id="sidecheck" type="checkbox" class="fxsdr">
                                        <label for="sidecheck"> Fix Sidebar </label>
                                    </div>
                                </li>
                            </ul>
                            <ul id="themecolors" class="m-t-20">
                                <li><b>With Light sidebar</b></li>
                                <li><a href="javascript:void(0)" data-theme="default" class="default-theme working">1</a></li>
                                <li><a href="javascript:void(0)" data-theme="green" class="green-theme">2</a></li>
                                <li><a href="javascript:void(0)" data-theme="yellow" class="yellow-theme">3</a></li>
                                <li><a href="javascript:void(0)" data-theme="red" class="red-theme">4</a></li>
                                <li><a href="javascript:void(0)" data-theme="purple" class="purple-theme">5</a></li>
                                <li><a href="javascript:void(0)" data-theme="black" class="black-theme">6</a></li>
                                <li class="db"><b>With Dark sidebar</b></li>
                                <li><a href="javascript:void(0)" data-theme="default-dark" class="default-dark-theme">7</a></li>
                                <li><a href="javascript:void(0)" data-theme="green-dark" class="green-dark-theme">8</a></li>
                                <li><a href="javascript:void(0)" data-theme="yellow-dark" class="yellow-dark-theme">9</a></li>
                                <li><a href="javascript:void(0)" data-theme="red-dark" class="red-dark-theme">10</a></li>
                                <li><a href="javascript:void(0)" data-theme="purple-dark" class="purple-dark-theme">11</a></li>
                                <li><a href="javascript:void(0)" data-theme="black-dark" class="black-dark-theme">12</a></li>
                            </ul>
                            <ul class="m-t-20 chatonline">
                                <li><b>Chat option</b></li>
                                <li>
                                    <a href="javascript:void(0)"><img src="../plugins/images/users/1.jpg" alt="user-img" class="img-circle"> <span>Varun Dhavan <small class="text-success">online</small></span></a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"><img src="../plugins/images/users/2.jpg" alt="user-img" class="img-circle"> <span>Genelia Deshmukh <small class="text-warning">Away</small></span></a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"><img src="../plugins/images/users/3.jpg" alt="user-img" class="img-circle"> <span>Ritesh Deshmukh <small class="text-danger">Busy</small></span></a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"><img src="../plugins/images/users/4.jpg" alt="user-img" class="img-circle"> <span>Arijit Sinh <small class="text-muted">Offline</small></span></a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"><img src="../plugins/images/users/5.jpg" alt="user-img" class="img-circle"> <span>Govinda Star <small class="text-success">online</small></span></a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"><img src="../plugins/images/users/6.jpg" alt="user-img" class="img-circle"> <span>John Abraham<small class="text-success">online</small></span></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- ===== Right-Sidebar-End ===== -->
            </div>
            <!-- ===== Page-Container-End ===== -->
            <footer class="footer t-a-c">
                © 2017 Cubic Admin 
            </footer>
        </div>
        <!-- ===== Page-Content-End ===== -->
    </div>





	
	