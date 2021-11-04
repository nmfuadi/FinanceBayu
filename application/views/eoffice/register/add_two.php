<div id="wrapper">
    <!-- ===== Top-Navigation ===== -->
    <nav class="">
        <div class="navbar-header">
            <a class="navbar-toggle font-20 hidden-sm hidden-md hidden-lg " href="javascript:void(0)" data-toggle="collapse" data-target=".navbar-collapse">
                <i class="fa fa-bars"></i>
            </a>
            <div class="">
                <a class="logo" href="index.html">
                    <b>
                        <img src="<?= $path; ?>plugins/images/InixJogja-White.png" alt="home" height="50px" />
                    </b>
<!--                            <span>
                        <img src="<?= $path; ?>plugins/images/logo-text.png" alt="homepage" class="dark-logo" />
                    </span>-->

<!--<span style="color: white">X TRAINING | Pendaftaran</span>-->
                </a>
            </div>                    
        </div>
    </nav>
    <!-- ===== Top-Navigation-End ===== -->
    <!-- ===== Left-Sidebar ===== -->

    <!-- ===== Left-Sidebar-End ===== -->
    <!-- Page Content -->
    <div class="">
        <div class="container-fluid">
            <!-- .row -->

            <!-- .row -->
            <div class="row">
                <div class="col-md-12">
                    <div class="white-box">
                        <h3 class="box-title">X Training | Pendaftaran</h3>
                        <div class="row thin-steps">
                            <div class="col-md-4 column-step">
                                <div class="step-number">1</div>
                                <div class="step-title">PILIH</div>
                                <div class="step-info">Instansi Anda bekerja</div>
                            </div>
                            <div class="col-md-4 column-step active">
                                <div class="step-number">2</div>
                                <div class="step-title">LENGKAPI</div>
                                <div class="step-info">Data diri Anda</div>
                            </div>
                            <div class="col-md-4 column-step">
                                <div class="step-number">3</div>
                                <div class="step-title">UPLOAD</div>
                                <div class="step-info">Foto profil Anda</div>
                            </div>
                        </div>

                        <br/>

                        <div class="panel panel-info">
                            <!--                                    <div class="panel-heading"> With Horizontal two column</div>-->
                            <div class="panel-wrapper collapse in" aria-expanded="true">
                                <div class="panel-body">
                                    <form action="#" class="form-horizontal">
                                        <div class="form-body">
                                            <h3 class="box-title">Person Info</h3>
                                            <hr class="m-t-0 m-b-40">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">Nama Lengkap</label>
                                                        <div class="col-md-9">
                                                            <input type="text" class="form-control" placeholder=""> <span class="help-block" style="color: green"> <i>Pastikan benar, dipakai juga di sertifikat.</i> </span> </div>
                                                    </div>
                                                </div>
                                                <!--/span-->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">Email Pribadi</label>
                                                        <div class="col-md-9">
                                                            <input type="text" class="form-control" placeholder=""> <span class="help-block"></span> </div>
                                                    </div>
                                                </div>
                                                <!--/span-->
                                            </div>
                                            <!--/row-->
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">Jenis Kelamin</label>
                                                        <div class="col-md-9">
                                                            <select class="form-control">
                                                                <option value="">Laki-laki</option>
                                                                <option value="">Perempuan</option>
                                                            </select> <span class="help-block"></span> </div>
                                                    </div>
                                                </div>
                                                <!--/span-->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">Tempat,<br/> Tanggal Lahir</label>
                                                        <div class="col-md-6">
                                                            <input type="text" class="form-control" placeholder="Yogyakarta"> 
                                                        </div>
                                                        <div class="col-md-3">
                                                            <input type="text" class="form-control" placeholder="31/12/<?= date("Y"); ?>"> 
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--/span-->
                                            </div>
                                            <!--/row-->
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">Agama</label>
                                                        <div class="col-md-9">
                                                            <select class="form-control" data-placeholder="" tabindex="1">
                                                                <option value="Category 1">Islam</option>
                                                                <option value="Category 2">Katholik</option>
                                                                <option value="Category 3">Kristen</option>
                                                                <option value="Category 4">Hindhu</option>
                                                                <option value="Category 4">Budha</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--/span-->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">Membership</label>
                                                        <div class="col-md-9">
                                                            <div class="radio-list">
                                                                <label class="radio-inline">
                                                                    <input type="radio" name="optionsRadios2" value="option1"> Free </label>
                                                                <label class="radio-inline">
                                                                    <input type="radio" name="optionsRadios2" value="option2" checked=""> Professional </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--/span-->
                                            </div>
                                            <h3 class="box-title">Address</h3>
                                            <hr class="m-t-0 m-b-40">
                                            <!--/row-->
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">Address 1</label>
                                                        <div class="col-md-9">
                                                            <input type="text" class="form-control"> </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">Address 2</label>
                                                        <div class="col-md-9">
                                                            <input type="text" class="form-control"> </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">City</label>
                                                        <div class="col-md-9">
                                                            <input type="text" class="form-control"> </div>
                                                    </div>
                                                </div>
                                                <!--/span-->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">State</label>
                                                        <div class="col-md-9">
                                                            <input type="text" class="form-control"> </div>
                                                    </div>
                                                </div>
                                                <!--/span-->
                                            </div>
                                            <!--/row-->
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">Post Code</label>
                                                        <div class="col-md-9">
                                                            <input type="text" class="form-control"> </div>
                                                    </div>
                                                </div>
                                                <!--/span-->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">Country</label>
                                                        <div class="col-md-9">
                                                            <select class="form-control">
                                                                <option>Country 1</option>
                                                                <option>Country 2</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--/span-->
                                            </div>
                                            <!--/row-->
                                        </div>
                                        <div class="form-actions">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="row">
                                                        <div class="col-md-offset-3 col-md-9">
                                                            <button type="submit" class="btn btn-success">Submit</button>
                                                            <button type="button" class="btn btn-default">Cancel</button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6"> </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-5"></div>
                        <div class="col-md-2">
                            <div class="btn-group btn-group-justified m-b-20">
                                <div class="btn-group btn-group-justified m-b-20"> 
                                    <a href="<?= base_url() . "/eoffice/Register/add/one" ?>" class="btn btn-warning waves-effect waves-light" role="button"><i class="fa fa-arrow-left"></i></span>&nbsp;&nbsp;Prev</a> 
                                    <a href="<?= base_url() . "/eoffice/Register/add/three" ?>" class="btn btn-info waves-effect waves-light" role="button">Next&nbsp;&nbsp;<i class="fa fa-arrow-right"></i></span></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5"></div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <!-- ===== Right-Sidebar ===== -->
            </div>
            <!-- ===== Right-Sidebar-End ===== -->
        </div>
        <!-- /.container-fluid -->
        <footer class="footer t-a-c">
            © 2018 InixindoJogja.Co.Id
        </footer>
    </div>
    <!-- /#page-wrapper -->
</div>
