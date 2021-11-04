
<div id="wrapper">
    <!-- ===== Top-Navigation ===== -->
    <nav class="">
        <div class="navbar-header">
            <!--                    <a class="navbar-toggle font-20 hidden-sm hidden-md hidden-lg " href="javascript:void(0)" data-toggle="collapse" data-target=".navbar-collapse">
                                    <i class="fa fa-bars"></i>
                                </a>-->
            <a class="logo" href="index.html">
                <b>
                    <img src="<?= $path; ?>plugins/images/InixJogja-White.png" alt="home" height="50px"/>
                </b>
<!--                            <span>
                    <img src="<?= $path; ?>plugins/images/logo-text.png" alt="homepage" class="dark-logo" />
                </span>-->

<!--<span style="color: white">X TRAINING | Pendaftaran</span>-->
            </a>
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
                            <div class="col-md-4 column-step active">
                                <div class="step-number">1</div>
                                <div class="step-title">PILIH</div>
                                <div class="step-info">Instansi Anda bekerja</div>
                            </div>
                            <div class="col-md-4 column-step">
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
                        <div class="form-group">
                            <div class="input-group">
                                <ul class="icheck-list">
                                    <li>
                                        <input type="radio" class="check" id="square-radio-1" name="square-radio" data-radio="iradio_square-red">
                                        <label for="square-radio-1">Diskominfo Magelang</label>
                                    </li>
                                    <li>
                                        <input type="radio" class="check" id="square-radio-2" name="square-radio" checked data-radio="iradio_square-red">
                                        <label for="square-radio-2">PT Sari Husada Tbk</label>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-md-5"></div>
                        <div class="col-md-2">
                            <div class="btn-group btn-group-justified m-b-20">
                                <div class="btn-group btn-group-justified m-b-20"> 
                                    <!--<a href="<?= base_url() . "/eoffice/Register/add/one" ?>" class="btn btn-warning waves-effect waves-light" role="button"><i class="fa fa-arrow-left"></i></span>&nbsp;&nbsp;Prev</a>--> 
                                    <a href="<?= base_url() . "/eoffice/Register/add/two" ?>" class="btn btn-info waves-effect waves-light" role="button">Next&nbsp;&nbsp;<i class="fa fa-arrow-right"></i></span></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5"></div>
                        <div class="clearfix"></div>
                    </div>
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

