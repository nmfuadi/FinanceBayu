<div id="wrapper">
       
		<!--<div class="preloader">
            <div class="cssload-speeding-wheel"></div>
        </div> -->
      
        
        <!-- ===== Left-Sidebar-End ===== -->
        <!-- ===== Page-Content ===== -->
        <div class="page-wrapper">
		
			
            <div class="container-fluid">
			
			<div class="row">
					
					<div class="row">
					<?php echo $this->session->userdata('message') <> '' ? '<div class="alert '.$this->session->userdata('status').'">
					
				   '.$this->session->userdata('message').'
				</div>' : ''; ?>
                    
                </div>					
                    <div class="col-md-12">
                        <div class="panel panel-info">
                            <div class="panel-heading">PILIH FORMAT EXCELL</div>
                            <div class="panel-wrapper collapse in" aria-expanded="true">
                                <div class="panel-body">
                               
                                    <form action="<?php echo $action; ?>" class="form-horizontal" method="get" enctype="multipart/form-data" accept-charset="utf-8"> 
																		 
                                        <div class="form-body">
                                            <h3 class="box-title">PILIH FORMAT EXCELL</h3>
                                            <hr class="m-t-0 m-b-40">
                                            <div class="row">
                                                
                                         </div>
                                            <!--/row-->
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">PILIH FORMAT EXCEL </label>
                                                        <div class="col-md-9">
                                                            <select  name="format" class="form-control">
                                                            <option value="BCA">BANK BCA</option>
                                                            <option value="BCA">BANK BCA USD</option>
                                                            <option value="BNI">BANK BNI</option>
                                                            <option value="MANDIRI">BANK MANDIRI</option>
                                                            <option value="BRI">BANK BRI</option>
                                                            <option value="PERMATA">BANK PERMATA</option>
                                                            <option value="OCBC">BANK OCBC</option>
                                                            <option value="UOB">BANK UOB</option>
                                                            <option value="DBS">BANK DBS</option>
                                                            <option value="CIMB">CIMB</option>
                                                            <option value="VICTORIA">VICTORIA</option>
                                                            <option value="DANAMON">DANAMON</option>
                                                            <option value="CASH">CASH</option>
                                                            <option value="MAYBANK">MAYBANK</option>

                                                                
                                                            </select> </div>
                                                    </div>
                                                </div>
                                                <!--/span-->
                                               <!--  <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">PROGRESS DATE</label>
                                                        <div class="col-md-9">
                                                            <input class="form-control" id='datepicker-autoclose'type="text" name="update_date" value="" /> </div> </div>
                                                    </div> -->
					
												
													
												
												
													
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
                                        
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
	
                <!-- ===== Right-Sidebar ===== -->
               
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



	
	