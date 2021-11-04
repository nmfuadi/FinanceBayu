 <link href="<?= $path; ?>plugins/components/morrisjs/morris.css" rel="stylesheet">
<div id="wrapper">
       
        <!--<div class="preloader">
            <div class="cssload-speeding-wheel"></div>
        </div> -->
      
        
        <!-- ===== Left-Sidebar-End ===== -->
        <!-- ===== Page-Content ===== -->
        <div class="page-wrapper">
        
            
            <div class="container-fluid">
                
                
                
                 
                            
               <div class="row">
                    <div class="col-sm-12">
                        <div class="white-box">
                      
                         <!-- Create code here -->


                            <h2 style="margin-top:0px">INPUT AKTIVITAS SALES (<?php echo $setKpi->kpi_name; ?>)</h2>
                                <form action="<?php echo $action; ?>" method="post">
                                <div class="form-group">
                                    <label for="varchar">Pilih Sales<?php echo form_error('kry_id') ?></label>
                                    <select class="form-control" name="kry_id">
                                        <?php foreach ($sales as $key) {

                                            echo '<option value="'.$key->id.'">'.$key->name_mark.'</option>';
                                            # code...
                                        } ?>
                                        
                                        
                                    </select >
                                   
                                </div>
                                <div class="form-group">
                                    <label for="double">Value <?php echo form_error('kpiDate') ?></label>
                                    <input type="date" class="form-control" name="kpiDate" id="kpi_value" placeholder="Tanggal" value="2020-06-23" />
                                </div>
                                <div class="form-group">
                                    <label for="int">Pencapaian <?php echo form_error('value') ?></label>
                                    <input type="number" class="form-control" name="value" id="kpi_weight" placeholder="Pencapaian Harian" value="<?php echo $value; ?>" />
                                </div>

                                 <div class="form-group">
                                    <label for="int">Keterangan <?php echo form_error('otherText1') ?></label>
                                    <input type="text" class="form-control" name="otherText1" id="kpi_weight" placeholder="Keterangan" value="<?php echo $value; ?>" />
                                </div>
                                
                                <input type="hidden" name="sett_id" value="<?php echo $setKpi->id; ?>" /> 
                                <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
                                <a href="<?php echo site_url('eoffice/settkpi') ?>" class="btn btn-default">Cancel</a>
                            </form>



                         <!-- end Code this page -->  

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





