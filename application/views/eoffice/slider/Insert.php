<div id="wrapper">
         <?php echo $SIDEBAR; ?>
<div class="page-wrapper">
            <div class="container-fluid">
		
		<!--<div class="preloader">
            <div class="cssload-speeding-wheel"></div>
        </div> -->
      
        <div class="row">
                    <div class="col-sm-12">
                        <div class="white-box">
                            <h3 class="box-title m-b-0">Add Slider And Image Web</h3>
                            <h3 class="box-title m-b-0"></h3>
                            <p class="text-muted m-b-30 font-13"> Manajemen Slider Web </p>
							<?php echo $this->session->flashdata('message');?>
							<form class="form-horizontal" id="loginform"  method="POST" enctype="multipart/form-data" action="<?php echo base_url(); ?>eoffice/Slider/add_proccess">
                                 <div class="form-group">
                                    <label class="col-md-12">Title SLide</label>
                                    <div class="col-md-12">
                                        <input name ="title" type="text" class="form-control" placeholder="Title SLide"> </div>
                                </div>
								
								<div class="form-group">
                                    <label class="col-md-12">Description SLide</label>
                                    <div class="col-md-12">
                                        <input type="text" name="desction" class="form-control" placeholder="Description SLide"> </div>
                                </div>
								
								
								<div class="form-group">
                                    <label class="col-sm-12">Category Slide</label>
                                    <div class="col-sm-12">
                                        <select class="form-control" name="cat_id">
										
										<?php 
											foreach($category as $cat){
												
												echo '<option value="'.$cat['id_cat'].'">'.$cat['name'].'</option>';
											}
										
										?>
          
                                        </select>
                                    </div>
                                </div>
								
                                
                                                                
                                <div class="form-group">
                                    <label class="col-sm-12">Image Slide</label>
                                    <div class="col-sm-12">
                                        <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                                            <div class="form-control" data-trigger="fileinput"> <i class="glyphicon glyphicon-file fileinput-exists"></i> <span class="fileinput-filename"></span></div> <span class="input-group-addon btn btn-default btn-file"> <span class="fileinput-new">Select file</span> <span class="fileinput-exists">Change</span>
                                            <input type="file" name="uploadFile" > </span> <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a> </div>
                                    </div>
                                </div>
                                
								 <button type="action" class="btn waves-effect waves-light btn-info">Action</button>
								
                            </form>
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