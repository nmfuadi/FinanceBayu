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
                            <div class="panel-heading"> WEEKLY TASK </div>
                            <div class="panel-wrapper collapse in" aria-expanded="true">
                                <div class="panel-body">
                                    <form action="<?php  echo $action; ?>" class="form-horizontal" method="post"> 
                                        <div class="form-body">
                                            <h3 class="box-title">Input weekly task</h3>
                                            <hr class="m-t-0 m-b-40">
											
											
											<div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">TASK EXTERNAL DEPARTEMENT <?php echo form_error('jobs_stat') ?></label>
                                                        <div class="col-md-9">
                                                            <select  id="type" name="ext_st" class="form-control" >
                                                                <option value="no"<?php if($ext_st=='no'){echo 'selected';} ?>>NO</option>
                                                                <option value="yes" <?php if($ext_st=='yes'){echo 'selected';} ?>>YES</option>
														        </select> </div>
                                                    </div>
                                                </div>
                                                <!--/span-->
                                                <div class="col-md-12" id="emp">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">DEPARTEMENT EXT</label>
                                                        <div class="col-md-9">
															<select  name="ext_kry_id" class="form-control"  >
                                                                <option value="">SELECT DEPARTEMENT</option>
														<?php 
															if(!empty($vp)){
																foreach($vp as $v){
																	if($v['id_em']==$ext_kry_id){$select="selected";}else{$select='';}
																	
																	echo '<option value="'.$v['id_em'].'"'.$select.'>'.$v['dprt_name'].'</option>';
																}
															}
															?>
                                                            </select>
															</div> </div>
                                                    </div>
															
                                                </div>
											
											 
											
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                       <label class="control-label col-md-3">TASK TITLE<?php echo form_error('jobs_tittle') ?></label>
                                                        <div class="col-md-9">
														 
                                                             <input type="text" class="form-control" name="jobs_tittle" placeholder="TASK TITLE" value="<?php echo $jobs_tittle; ?>" /> </div>
                                                    </div>
                                                </div>
                                                <!--/span-->
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">TASK DESCIPTION <?php echo form_error('jobs_desc') ?></label>
													  <div class="col-md-9">	
														<textarea class="form-control" name="jobs_desc" id="editor" placeholder="TASK DESCIPTION"><?php echo $jobs_desc; ?></textarea> 
														</div>
														
                                                        
                                                    </div>
                                                </div>
												
												
                                                <!--/span-->
                                            </div>
                                            <!--/row-->
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">TASK STATUS <?php echo form_error('jobs_stat') ?></label>
                                                        <div class="col-md-9">
                                                            <select  name="jobs_stat" class="form-control">
                                                                <option value="inprogress"<?php if($jobs_stat=='inprogress'){echo 'selected';} ?>>INPROGRESS</option>
                                                                <option value="done" <?php if($jobs_stat=='done'){echo 'selected';} ?>>DONE</option>
																 <option value="hold"  <?php if($jobs_stat=='hold'){echo 'selected';} ?>>HOLD</option>
                                                            </select> </div>
                                                    </div>
                                                </div>
                                                <!--/span-->
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">TASK RANGE TARGET</label>
                                                        <div class="col-md-9">
														<?php 
															if(!empty($jobs_start)){
															$jobs_date = $jobs_start.' to '.$jobs_end; 
															}else{
																$jobs_date='';
															}
															?>
                                                            <input class="form-control input-daterange-datepicker" type="text" name="jobs_date" value="<?php echo $jobs_date;?>" /> </div> </div>
                                                    </div>
													
													
													<div class="col-md-12" <?php if($button=='Update'){echo '';}else{ echo 'hidden=hidden';}  ?> >
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">ARCHIEVE STATUS <?php echo form_error('archieve_st') ?></label>
                                                        <div class="col-md-9">
                                                            <select  name="archieve_st" class="form-control" >
                                                                <option value="no"<?php if($archieve_st=='no'){echo 'selected';} ?>>NO</option>
                                                                <option value="yes" <?php if($archieve_st=='yes'){echo 'selected';} ?>>YES</option>
														        </select> </div>
                                                    </div>
                                                </div>
													
                                                </div>
                                                <!--/span-->
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
<script src="https://cdn.ckeditor.com/ckeditor5/18.0.0/classic/ckeditor.js">
	




	
	