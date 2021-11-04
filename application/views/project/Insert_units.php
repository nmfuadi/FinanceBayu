<div id="wrapper">
         <?php echo $SIDEBAR; ?>
<div class="page-wrapper">
            <div class="container-fluid">
		
		<!--<div class="preloader">
            <div class="cssload-speeding-wheel"></div>
        </div> -->
			
			<div class="row">
						 <div class="col-md-12">
				            <div class="panel panel-info">
                            <div class="panel-heading">Input Unit Proyek </div>
                            <div class="panel-wrapper collapse in" aria-expanded="true">
                                <div class="panel-body">
								<?php echo $this->session->flashdata('message');?>
									
                                    <form class="form-horizontal" id="loginform"  method="POST" enctype="multipart/form-data" action="<?php echo base_url(); ?>project/ProjectUnits/add_proccess">
                                        <div class="form-body">
											<div class="btn-group right-side-toggle">
												
													<a href="#" class="btn btn-default btn-outline waves-effect waves-light" role="button">Left</a>
													<a href="#" class="btn btn-default btn-outline waves-effect waves-light" role="button">Middle</a> 
													<a href="#" class="btn btn-default btn-outline waves-effect waves-light" role="button">Right</a>

											</div>
                                            <h3 class="box-title">Person Info</h3>
                                            <hr>
											
											
											<?php 
												
												if(!empty($project)){
													
													for($i=1;$i<=$project['project_blok'];$i++){
														
														echo '
														<div class="row">
																	<div class="col-md-6">
																	<div class="form-group">
																	<label class="control-label">Blok Name ('.$i.')</label>
																	<input type="text" id="firstName" class="form-control" placeholder="John doe"> </div>
																	</div>
															
																<div class="col-md-6">
																<div class="form-group">
																	<label class="control-label">Units Of Number<br/></label>
																	<input type="text" id="lastName" class="form-control" placeholder="12n">
																</div>
																</div>
														</div>';
														
													}
													
												}
												
											?>
                                            
										  
                                        </div>
                                        <div class="form-actions">
                                            <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
                                            <button type="button" class="btn btn-default">Cancel</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <!-- ===== Page-Container-End ===== -->
		</div>
            <footer class="footer t-a-c">
                © 2017 Cubic Admin
            </footer>
        </div>
        <!-- ===== Page-Content-End ===== -->
    </div>