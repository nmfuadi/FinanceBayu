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
							
                            <div class="panel-heading"> PROFILE EMPLOYE </div>
                            <div class="panel-wrapper collapse in" aria-expanded="true">
                                <div class="panel-body">
                                    <form action="<?php  echo $action; ?>" class="form-horizontal" method="post" enctype="multipart/form-data" accept-charset="utf-8"> 
									<input class="form-control" type="hidden" name="id" value="<?php  echo $empl['id_kry']; ?>" />
                                        <div class="form-body">
                                            <h3 class="box-title">Detail Profil</h3>
                                            <hr class="m-t-0 m-b-40">	
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                       <label class="control-label col-md-3">NAME<?php echo form_error('emp_name') ?></label>
                                                        <div class="col-md-9">
														 
                                                             <input type="text" class="form-control" name="emp_name" placeholder="NAME" value="<?php echo $empl['emp_name']; ?>" /> </div>
                                                    </div>
                                                </div>
												
												<div class="col-md-12">
                                                    <div class="form-group">
                                                       <label class="control-label col-md-3">PHONE NUMBER<?php echo form_error('emp_phone') ?></label>
                                                        <div class="col-md-9">
														 
                                                             <input type="text" class="form-control" name="emp_phone" placeholder="PHONE NUMBER" value="<?php echo $empl['emp_phone']; ; ?>" /> </div>
                                                    </div>
                                                </div>
												
												<div class="col-md-12">
                                                    <div class="form-group">
                                                       <label class="control-label col-md-3">EMAIL<?php echo form_error('emp_email') ?></label>
                                                        <div class="col-md-9">
														 
                                                             <input type="text" class="form-control" name="emp_email" placeholder="EMAIL" value="<?php echo $empl['emp_email']; ?>" /> </div>
                                                    </div>
                                                </div>
												
												<div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">ADDRESS<?php echo form_error('emp_alamat') ?></label>
													  <div class="col-md-9">	
														<textarea class="form-control" name="emp_alamat" id="editor" placeholder="ADDRESS"><?php echo $empl['emp_alamat']; ?></textarea> 
														</div>
														
                                                        
                                                    </div>
                                                </div>
												
												<div class="col-md-12">
													<div class="form-group">
													   <label class="control-label col-md-3">AVATAR</label>
													    <div class="col-md-9">
														<?php if (!empty($empl['photo'])){ ?>
															<input class="form-control" type="hidden" name="pic_old" value="<?php  echo $empl['photo']; ?>" />
															<img width="200px" src="<?php echo base_url('file/PP/'.$empl['photo'])?>" alt="gallery" class="all studio" />
														<?php }?>
															<input type="button" class="btn btn-warning" value="Pilih File" onclick="document.getElementById('pic').click()"> <br/> <br/>
																<input class="form-control" class="control-label type="text" id="filename"> 
																<input type="file"   name="uploadFile"  id="pic" style="display:none" onchange="document.getElementById('filename').value=this.value">
													</div>
													</div>
													</div>
												
												
                                            </div>
                                            <!--/row-->
                                            
                                            </div>
                                            <!--/row-->                                          
                                            <hr class="m-t-0 m-b-40">
                                            <!--/row-->
											<div class="form-actions">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="row">
                                                        <div class="col-md-offset-3 col-md-9">
                                                             <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
																<button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
																<a href="<?php echo site_url('Report/AdminVp') ?>" class="btn btn-default">Cancel</a>
															<br/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6"> </div>
                                            </div>
                                        </div>
											
                                        </div>
                                        
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
					
					<div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-info">
                            <div class="panel-heading"> CHANGE PASSWORD </div>
                            <div class="panel-wrapper collapse in" aria-expanded="true">
                                <div class="panel-body">
                                    <form action="<?php  echo $action_pwd; ?>" class="form-horizontal" method="post" enctype="multipart/form-data" accept-charset="utf-8" method="post"> 
									<input class="form-control" type="hidden" name="usr_id" value="<?php  echo $empl['user_id']; ?>" />
                                        <div class="form-body">
                                            <h3 class="box-title"></h3>
                                            <hr class="m-t-0 m-b-40">	
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                       <label class="control-label col-md-3">USERNAME</label>
                                                        <div class="col-md-9">
														 
                                                             <input type="text" class="form-control" name="username" placeholder="NAME" value="<?php echo $empl['username']; ?>" / disabled> </div>
                                                    </div>
                                                </div>
												
												<div class="col-md-12">
                                                    <div class="form-group">
                                                       <label class="control-label col-md-3">OLD PASSWORD</label>
                                                        <div class="col-md-9">
														 
                                                             <input type="password" class="form-control" name="old_password" placeholder="OLD PASSWORD" /> </div>
                                                    </div>
                                                </div>
												
												<div class="col-md-12">
                                                    <div class="form-group">
                                                       <label class="control-label col-md-3">NEW PASSWORD</label>
                                                        <div class="col-md-9">
														 
                                                             <input type="password" class="form-control" name="new_password" placeholder="NEW PASSWORD"  /> </div>
                                                    </div>
                                                </div>
												
												<div class="col-md-12">
                                                    <div class="form-group">
                                                       <label class="control-label col-md-3">RE  PASSWORD</label>
                                                        <div class="col-md-9">
														 
                                                             <input type="password" class="form-control" name="re_password" placeholder="RE PASSWORD"  /> </div>
                                                    </div>
                                                </div>
												
												
												
												
                                            </div>
                                            <!--/row-->
                                            
                                            </div>
                                            <!--/row-->                                          
                                            <hr class="m-t-0 m-b-40">
                                            <!--/row-->
											<div class="form-actions">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="row">
                                                        <div class="col-md-offset-3 col-md-9">
                                                             <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
																<button type="submit" class="btn btn-primary"><?php echo $button_pwd ?></button> 
																<a href="<?php echo site_url('Report/AdminVp') ?>" class="btn btn-default">Cancel</a>
															<br/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6"> </div>
                                            </div>
                                        </div>
											
                                        </div>
                                        
                                    </form>
                                </div>
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

	




	
	