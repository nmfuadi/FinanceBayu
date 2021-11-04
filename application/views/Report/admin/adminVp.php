<div id="wrapper">
       
		<!--<div class="preloader">
            <div class="cssload-speeding-wheel"></div>
        </div> -->
      
        
        <!-- ===== Left-Sidebar-End ===== -->
        <!-- ===== Page-Content ===== -->
        <div class="page-wrapper">
		
			
            <div class="container-fluid">
                
				
				
                 
                             <div class="row">
								<?php echo $this->session->userdata('message') <> '' ? '<div class="alert '.$this->session->userdata('status').'">
					
				   '.$this->session->userdata('message').'
				</div>' : ''; ?>
                                 <div class="col-md-12 col-sm-12 col-xs-12">
									<div class="white-box">
					 
				<a href="<?php echo site_url('Report/AdminVp/exelReport') ?>" class="btn btn-primary"> GENERATE REPORT EXCEL</a>
				
				<?php 
					if($tot['total']>0){
				?>
				<a href="<?php echo site_url('Report/AdminVp/ext_to') ?>" class="btn btn-warning waves-effect waves-light" >
				 <span class="badge badge-xs badge-danger"><?php echo $tot['total']; ?></span> TASK WAITING APPROVAL</a>
				
				<?php 
					}else{
				?>
				
				<a href="<?php echo site_url('Report/AdminVp/ext_to') ?>" class="btn btn-info waves-effect waves-light" >
				<span class="badge badge-xs badge-danger"><?php echo $tot['total']; ?></span> TASK FROM OTHER DEPARTEMENT</a>
				<?php 
					}
				?>
				
				
				
				<?php 
					if($tot_from['total']>0){
				?>
				<a href="<?php echo site_url('Report/AdminVp/ext_from') ?>" class="btn btn-success waves-effect waves-light" >
				<span class="badge badge-xs badge-danger"><?php echo $tot_from['total']; ?></span> TASK FOR OTHER DEPARTEMENT</a>
				
				<?php 
					}
				?>
				
				
				
				
				
				
				
					<div class="text-right">
					 <h2><?php echo $judul; ?></h2> 
					</div>			
				   <div class="table-responsive">
						<table class="table table-bordered table-fixed">
					<thead>
					  <tr >
						<th width='3%' style='text-align:center' >No</th>
						<th width='25%' style='text-align:center' >TASK TITLE</th>
						<th  width='30%' style='text-align:center' >TASK DETAIL</th>
						<th  width='15%' style='text-align:center' > DATE RANGE</th>
						<th width='5%' style='text-align:center' >Status</th>
						<th width='22%' style='text-align:center' >Action</th>
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
								
								if($act['archieve_st']=='yes'){
									$action = "
										<a href=".site_url('Report/AdminVp/UpdateTaskList/'.$act['jobs_id']).">View Progress Task</a> ";
									
								}else {
									
									$action = "
										<a href=".site_url('Report/AdminVp/UpdateTaskList/'.$act['jobs_id'])."><div class='label label-table label-info'>View Progress </div></a> <br/><br/>
										<a href=".site_url('Report/AdminVp/update/'.$act['jobs_id'])."><div class='label label-table label-primary'>Edit</div></a> |
										<a onclick=javasciprt: return confirm(\'Are You Sure ?\') href=".site_url('Report/AdminVp/delete/'.$act['jobs_id'])."><div class='label label-table label-danger'>Delete</div></a> <br/><br/>
										<a href=".site_url('Report/AdminStaff/create/'.$act['jobs_id'])."><div class='label label-table label-success'>Create Progress</div></a>
									";
									
								}
								echo "
								 <tr>
									<td>".$n."</td>
									<td> <p style='font-size: 10px;'><b>Task Code : ".$act['jobs_code']."</b></p> ".$act['jobs_tittle']."</td>
									<td>".$act['jobs_desc']."</td>
									<td width='100'>".$act['jobs_start']."<br/> s/d <br/>".$act['jobs_end']."</td>
									<td>".$jobs_stat."</td>
									<td style='text-align:center' width='200px'>
									".$action."
										
										
									</td>
									</tr>";
						$n++;}
						
					}else {
						
						echo "
								
								 <tr>
									<td colspan =3>DATA TIDAK ADA</td>
									
								  </tr>
						
						";
					
					}
					?>
			
						
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





	
	