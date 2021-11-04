<div id="wrapper">
       
        <div class="page-wrapper">
			
            <div class="container-fluid">
			
			<div class="row">
					<?php echo $this->session->userdata('message') <> '' ? '<div class="alert '.$this->session->userdata('status').'">
					
				   '.$this->session->userdata('message').'
				</div>' : ''; ?>
									
                    <div class="col-md-12">
                        <div class="panel panel-info">
                            <div class="panel-heading"> PENCATATAN TAGIHAN MASUK</div>
                            <div class="panel-wrapper collapse in" aria-expanded="true">
                                <div class="panel-body">
                                    <form action="<?php  echo $action; ?>" class="form-horizontal" method="post" enctype="multipart/form-data" accept-charset="utf-8"> 
									  <input class="form-control" type="hidden" name="id" value="<?php echo $id; ?>" />
                                            <h3 class="box-title">Input Data Invoice</h3>
                                            <hr class="m-t-0 m-b-40">
                                            <div class="row">
                                                
                                                <!--/span-->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">Tanggal Diterima Invoice <?php echo form_error('invoice_date_receipt') ?></label>
													  <div class="col-md-9">	
														<input class="form-control" type="datetime-local" name="invoice_date_receipt" value="<?php echo strftime('%Y-%m-%dT%H:%M:%S', strtotime($invoice_date_receipt)); ?>" /> 
														</div>
						                           </div>
                                                </div>
												
												<div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">Tanggal Invoice</label>
                                                        <div class="col-md-9">
                                                            <input class="form-control" type="date" name="invoice_date" value="<?php echo $invoice_date; ?>" /> </div> </div>
                                                    </div>
													
													<div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">Jatuh tempo Invoice</label>
                                                        <div class="col-md-9">
                                                            <input class="form-control" type="date" name="duedate" value="<?php echo $duedate; ?>" /> </div> </div>
                                                    </div>

													<div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">Nomor Invoice</label>
                                                        <div class="col-md-9">
                                                            <input class="form-control" type="text" name="invoice_no" value="<?php echo $invoice_no; ?>" /> </div> </div>
                                                    </div>
													
													<div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">Deskripsi</label>
                                                        <div class="col-md-9">
                                                            <input class="form-control" type="text" name="description" value="<?php echo $description; ?>" /> </div> </div>
                                                    </div>
												
                                                <!--/span-->
                                            
                                            <!--/row-->
                                            
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">Nama Vendor <?php echo form_error('vendor_id') ?></label>
                                                        <div class="col-md-9">
                                                            <select  name="vendor_id" class="form-control">
															<?php foreach($vendor as $vend){ ?>
                                                                <option value="<?php echo $vend['id'] ?>" <?php echo $vendor_id == $vend['id'] ? 'Selected' : ''; ?> ><?php echo $vend['vendor_name'] ?></option>
															<?php } ?>  
                                                            </select> </div>
                                                    </div>
                                                </div>
												<div class="col-md-6">
                                                    <div class="form-group">
                                                       <label class="control-label col-md-3">Departement <?php echo form_error('departement_id') ?></label>
                                                        <div class="col-md-9">
                                                            <select  name="departement_id" class="form-control">
                                                                <?php foreach($jr_departement as $departement){ ?>
                                                                <option value="<?php echo $departement['id'] ?>"<?php echo $departement_id == $departement['id'] ? 'Selected' : ''; ?>><?php echo $departement['dprt_name'] ?></option>
															<?php } ?>
                                                                
                                                            </select> 
													 </div>
                                                    </div>
                                                </div>
												
												<div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">Karyawan <?php echo form_error('employe_id') ?></label>
                                                        <div class="col-md-9">
                                                            <select  name="employe_id" class="form-control">
                                                                <option value="">Nama Karyawan</option>
																<?php foreach($jr_employe as $employe){ ?>
                                                                <option value="<?php echo $employe['id'] ?>" <?php echo $employe_id == $employe['id'] ? 'Selected' : ''; ?>><?php echo $employe['emp_name'] ?></option>
															<?php } ?>
                                                                
                                                            </select> </div>
                                                    </div>
                                                </div>
												
												<div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">Project<?php echo form_error('project_id') ?></label>
                                                        <div class="col-md-9">
                                                            <select  name="project_id" class="form-control">
                                                                <option value="">Nama Project</option>
																
																<?php foreach($st_project as $project){ ?>
                                                                <option value="<?php echo $project['id'] ?>" <?php echo $project_id == $project['id'] ? 'Selected' : ''; ?>><?php echo $project['project_name'] ?></option>
															<?php } ?>
                                                                
                                                            </select> </div>
                                                    </div>
                                                </div>
                                                <!--/span-->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">Total Invoice</label>
                                                        <div class="col-md-9">
                                                            <input class="form-control" type="number" name="amount" value="<?php echo $amount; ?>" /> </div> </div>
                                                    </div>
													
								

												<div class="col-md-6">
													<div class="form-group">
													   <label class="control-label col-md-3">Scan Invoice</label>
													    <div class="col-md-9">
														<?php if (!empty($pic)){ ?>
															<img width="200px" src="<?php echo base_url('file/'.$pic)?>" alt="gallery" class="all studio" />
														<?php }?>
															<input type="button" class="btn btn-warning" value="Pilih File" onclick="document.getElementById('pic').click()"> <br/> <br/>
																<input class="form-control" class="control-label type="text" id="filename"> 
																<input type="file"   name="uploadFile"  id="pic" style="display:none" onchange="document.getElementById('filename').value=this.value">
													</div>
													</div>
													</div>
													
												<hr class="m-t-0 m-b-40">
                                            <!--/row-->
											<div class="form-actions">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="row">
                                                        <div class="col-md-offset-3 col-md-9">
                                                             <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
																<a href="<?php echo site_url('Report/AdminStaff') ?>" class="btn btn-default">Cancel</a>
															<br/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6"> </div>
                                            </div>
                                        </div>
												
													
                                                </div>
												
												
                                                <!--/span-->
                                            </div>
                                            <!--/row-->                                          
                                            
											
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



	
	