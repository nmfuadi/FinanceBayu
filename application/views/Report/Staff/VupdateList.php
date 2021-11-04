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
			<div class="col-md-12">
                        <div class="panel panel-info">
                            <div class="panel-heading"> PROGRES TASK FROM: <?php echo $emp_jobs['jobs_tittle']; ?> </div>
                            <div class="panel-wrapper collapse in" aria-expanded="true">
                                <div class="panel-body">
                                    <form class="form-horizontal" role="form">
                                        <div class="form-body">
                                           <hr class="m-t-0 m-b-40">
                                            <div class="row">
                                                
                                                <!--/span-->
                                                
                                                <!--/span-->
                                            </div>
                                            <!--/row-->
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">DEPARTEMENT</label>
                                                        <div class="col-md-9">
                                                            <p class="form-control-static"> <?php echo $emp_jobs['dprt_name']; ?> </p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--/span-->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">TASK DATE</label>
                                                        <div class="col-md-9">
                                                            <p class="form-control-static"> <?php echo $emp_jobs['jobs_start']; ?> TO <?php echo $emp_jobs['jobs_end']; ?> </p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--/span-->
                                            </div>
                                            <!--/row-->
                                            
                                            <!--/row-->
                                           
                                            
                                            
                                            <!--/row-->
                                            
                                        </div>
                                        
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
					</div>
                               <div class="row">
                                 <div class="col-md-12 col-sm-12 col-xs-12">
									<div class="white-box">
				  <h2> TASK UPDATE FROM : <?php echo $emp['emp_name'];?> </h2>      
				  <div class="table-responsive">
						<table class="table table-bordered table-fixed">
					<thead>
					  <tr>
						<th width='3%' style='text-align:center'>No</th>
						<th width='30%' style='text-align:center' >Task Progress</th>
						<th width='20%' style='text-align:center'>Status</th>
						<th width='13%' style='text-align:center'>Progress Date</th>
						<th width='20%' style='text-align:center'>Picture</th>
						<th width='14%' style='text-align:center'>Action</th>
					  </tr>
					</thead>
					<tbody>
					<?php 
					if (!empty($jobsUp)){
						$i=1;
						foreach ($jobsUp as $act){
							
								if(!empty($act['pic'])){
									$extension= substr(strrchr($act['pic'], '.'), 1);
									
							
									if($extension =='jpg' or $extension =='png' or $extension =='jpeg' or $extension =='gif'){
										$pic ='<a href="'.base_url('file/'.$act['pic']).'" data-toggle="lightbox" data-gallery="multiimages" data-title="Image title will be apear here"><img width="200px" src="'.base_url('file/'.$act['pic']).'" alt="gallery" class="all studio" /> </a>';
						}else{
							
							$pic= 
											$picture = '<a href="'.base_url('file/'.$act['pic']).'" class="btn btn-primary"> Download File '.$extension.' </a>';
							
						}
									
															
								}else {
									
									$pic = 'No Image';
								}
								
								
					if($act['job_up_st']=='inprogress'){
				
						$job_up_st = ' <label class="label label-table label-warning">INPROGRESS</label>';
					}elseif($act['job_up_st']=='done'){
						
						$job_up_st = ' <label class="label label-table label-success">DONE</label>';
						
					}else {
						
						$job_up_st = ' <label class="label label-table label-danger">HOLD</label>';
					}
							
							
							
								echo "
								 <tr>
									<td>".$i."</td>
									<td>".$act['jobs_up_descr']."</td>
									<td>".$job_up_st."<br/>
										  	PIC : ".$act['emp_name']."	</td>
									<td>".$act['update_date']."</td>
									<td>".$pic."</td>
									<td style='text-align:center' width='200px'>
										<a href=".site_url('Report/AdminStaff/update/'.$act['up_jobs_id']).">Edit</a> |
										<a class='delete' data-confirm='Are you sure to delete this item?' href=".site_url('Report/AdminStaff/delete/'.$act['up_jobs_id']).">Delete</a>
										
									</td>
									</tr>";
									
							$i++;
						}
						
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
<script>
	var deleteLinks = document.querySelectorAll('.delete');

for (var i = 0; i < deleteLinks.length; i++) {
  deleteLinks[i].addEventListener('click', function(event) {
	  event.preventDefault();

	  var choice = confirm(this.getAttribute('data-confirm'));

	  if (choice) {
	    window.location.href = this.getAttribute('href');
	  }
  });
}
</script>




	
	