<div id="wrapper">
       
        <div class="page-wrapper">
			
            <div class="container-fluid">
			<div class="row">
					<?php echo $this->session->userdata('message') <> '' ? '<div class="alert '.$this->session->userdata('status').'">
					
				   '.$this->session->userdata('message').'
				</div>' : ''; ?>
                    <div class="col-md-12">
                        <div class="panel panel-info">
                            <div class="panel-heading"> DATA PENERIMAAN INVOICE</div>
                            <div class="panel-wrapper collapse in" aria-expanded="true">
                                <div class="panel-body">
                                    <form class="form-horizontal" role="form">
                                        <div class="form-body">
                                            <h3 class="box-title">INFORMASI INVOICE</h3>
                                            <hr class="m-t-0 m-b-40">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">No Invoice</label>
                                                        <div class="col-md-9">
                                                            <p class="form-control-static"> <?php echo $invoice_no; ?></p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--/span-->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">Tanggal Invoice</label>
                                                        <div class="col-md-9">
                                                            <p class="form-control-static"> <?php echo $invoice_date	; ?> </p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--/span-->
                                            </div>
                                            <!--/row-->
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">Deskripsi</label>
                                                        <div class="col-md-9">
                                                            <p class="form-control-static"> <?php echo $description; ?> </p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--/span-->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">Jatuh Tempo</label>
                                                        <div class="col-md-9">
                                                            <p class="form-control-static"> <?php echo $duedate; ?> </p>
                                                        </div>
                                                    </div>
                                                </div>
												
												<div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">Jumlah Invoice</label>
                                                        <div class="col-md-9">
                                                            <p class="form-control-static"> <?php echo number_format($amount); ?> </p>
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
											<input class="form-control" type="hidden" name="amount" value="<?php echo $amount; ?>" />
                                            <h3 class="box-title">Input Data Pajak</h3>
                                            <hr class="m-t-0 m-b-40">
                                            <div class="row">
                                         									
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">DPP <?php echo form_error('invoice_date_receipt') ?></label>
													  <div class="col-md-9">	
														<input class="form-control" type="number" name="tax_dpp" value="<?php echo $tax_dpp; ?>" /> 
														</div>
														
                                                        </div>
                                                </div>
												
												<div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">PPN</label>
                                                        <div class="col-md-9">
                                                            <input class="form-control" type="number" name="tax_ppn" value="<?php echo $tax_ppn; ?>" /> </div> </div>
                                                    </div>
													
																					
													<div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">PPH 4(2)</label>
                                                        <div class="col-md-9">
                                                            <input class="form-control" type="number" name="tax_pph4_2" value="<?php echo $tax_pph4_2;?>" /> </div> </div>
                                                    </div>

													<div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">PPH 21/26</label>
                                                        <div class="col-md-9">
                                                            <input class="form-control" type="number" name="tax_pph_2126" value="<?php echo $tax_pph_2126;?>" /> </div> </div>
                                                    </div>
													
													<div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">PPH 22</label>
                                                        <div class="col-md-9">
                                                            <input class="form-control" type="number" name="tax_pph_22" value="<?php echo $tax_pph_22;?>" /> </div> </div>
                                                    </div>
													
													<div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">PPH 23/26</label>
                                                        <div class="col-md-9">
                                                            <input class="form-control" type="number" name="tax_pph_2326" value="<?php echo $tax_pph_2326;?>" /> </div> </div>
                                                    </div>
													
													<div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">PPH 15</label>
                                                        <div class="col-md-9">
                                                            <input class="form-control" type="number" name="tax_pph_15" value="<?php echo $tax_pph_15;?>" /> </div> </div>
                                                    </div>
													
													<div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">Down Payment</label>
                                                        <div class="col-md-9">
                                                            <input class="form-control" type="number" name="down_payment" value="<?php echo $down_payment;?>" /> </div> </div>
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
												
                                                <!--/span-->
                                            </div>
                                            <!--/row-->
                                        												
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



	
	