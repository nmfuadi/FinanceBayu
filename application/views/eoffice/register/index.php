
<section id="wrapper" class="login-register">
    <div class="login-box">
        <div class="white-box">
            <form class="form-horizontal form-material" id="loginform" action="<?= base_url() . "/eoffice/Register/add/one" ?>">
                <h3 class="box-title"> X Training | Inixindo</h3>
                <div class="panel panel-default">
                    <div class="panel-body">
                        <ul class="nav nav-pills m-b-30 ">
                            <li class="active"> <a href="#navpills-1" data-toggle="tab" aria-expanded="false">Register</a> </li>
                            <li class=""> <a href="#navpills-2" data-toggle="tab" aria-expanded="false">Feedback</a> </li>
                        </ul>
                        <div class="tab-content br-n pn">
                            <div id="navpills-1" class="tab-pane active">
                                <div class="row">
                                    <div class="col-md-4"> <img src="<?= $path; ?>plugins/images/large/img1.jpg" class="img-responsive thumbnail m-r-15"> </div>
                                    <div class="col-md-8"> Daftarkan diri Anda.Nikmati benefit membership dengan aplikasi Join-X.
                                    </div>
                                </div>
                            </div>
                            <div id="navpills-2" class="tab-pane">
                                <div class="row">
                                    <div class="col-md-8"> Feedback Anda begitu berarti.Berikan saran untuk service lebih memuaskan.
                                    </div>
                                    <div class="col-md-4"> <img src="<?= $path; ?>plugins/images/large/img2.jpg" class="img-responsive thumbnail mr25"> </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group text-center m-t-20">
                    <div class="form-group ">
                        <div class="col-xs-12">
                            <input class="form-control" type="text" required="" placeholder="Email">
                        </div>
                    </div>
                    <div class="form-group ">
                        <div class="col-xs-12">
                            <input class="form-control" type="text" required="" placeholder="PIN Access">
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-xs-12">
                        <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">PROSES</button>
                    </div>
                </div>
            </form>
        </div>
</section>
