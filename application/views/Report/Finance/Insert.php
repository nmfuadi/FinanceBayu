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
                    <?php echo $this->session->userdata('message') <> '' ? '<div class="alert ' . $this->session->userdata('status') . '">
				
				   ' . $this->session->userdata('message') . '
				</div>' : ''; ?>

                </div>
                <div class="col-md-12">
                    <div class="panel panel-info">
                        <div class="panel-heading">IMPORT DATA MUTASI</div>
                        <div class="panel-wrapper collapse in" aria-expanded="true">
                            <div class="panel-body">
                                <form action="<?php echo $action; ?>" class="form-horizontal" method="post" enctype="multipart/form-data" accept-charset="utf-8">

                                    <div class="form-body">
                                        <h3 class="box-title">IMPORT BY FILE EXCELL</h3>
                                        <hr class="m-t-0 m-b-40">
                                        <div class="row">

                                        </div>
                                        <!--/row-->
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Rekenening Bank </label>
                                                    <div class="col-md-9">
                                                        <select name="rekening" class="form-control" required>
                                                            <option value="" disabled selected> Select Bank</option>
                                                            <?php
                                                            if (!empty($bank)) {
                                                                foreach ($bank as $banks) { ?>
                                                                    <option value="<?php echo $banks['id'] ?>"><?php echo $banks['bank_name'] . '-' . $banks['branch'] . ' (' . $banks['bank_norek'] . ') -'.$banks['currency_code']; ?></option>
                                                            <?php }
                                                            } ?>

                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Kurs</label>
                                                    <div class="col-md-9">
                                                    <select name="currancy" class="form-control" required>
                                                    <option value="" disabled selected> Select Currancy</option>
                                                        <?php if (!empty($kurs)) {
                                                            foreach ($kurs as $kurs) {
                                                        ?>
                                                                <option value="<?php echo $kurs['kurs_code'] ?>" ><?php echo $kurs['kurs_code'] ?></option>
                                                        <?php }
                                                        } ?>

                                                    </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <?php if($format=='DANAMON' or $format=='MANDIRI_PERSONAL') {?>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Tahun</label>
                                                    <div class="col-md-9">
                                                    <select name="tahun" class="form-control" required>
                                                    <option value="<?php echo date("Y")-1; ?>" ><?php  echo date("Y")-1; ?></option>
                                                    <option value="<?php echo date("Y"); ?>" selected><?php  echo date("Y"); ?></option>
                                                        <option value="<?php echo date("Y")+1; ?>" ><?php  echo date("Y")+1; ?></option>
                                                       

                                                    </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <?php } ?>


    
                                            <!--/span-->
                                            <!--  <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">PROGRESS DATE</label>
                                                        <div class="col-md-9">
                                                            <input class="form-control" id='datepicker-autoclose'type="text" name="update_date" value="" /> </div> </div>
                                                    </div> -->

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">FILE EXCEL</label>
                                                    <div class="col-md-9">
                                                        <?php if (!empty($pic)) { ?>
                                                        <?php } ?>
                                                        <input type="button" class="btn btn-warning" value="Pilih File" onclick="document.getElementById('pic').click()"> <br /> <br />
                                                        <input class="form-control" class="control-label type=" text" id="filename">
                                                        <input type="file" name="uploadFile" id="pic" style="display:none" onchange="document.getElementById('filename').value=this.value">
                                                    </div>
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
                                                        <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
                                                        <a href="<?php echo site_url('Report/AdminStaff') ?>" class="btn btn-default">Cancel</a>
                                                        <br />
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
        ?? 2017 Cubic Admin
    </footer>
</div>
<!-- ===== Page-Content-End ===== -->
</div>

<script src="https://cdn.ckeditor.com/ckeditor5/18.0.0/classic/ckeditor.js">