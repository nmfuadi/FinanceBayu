<script language="JavaScript" type="text/javascript" src="/js/jquery-1.2.6.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<div id="wrapper">

    <!--<div class="preloader">
            <div class="cssload-speeding-wheel"></div>
        </div> -->


    <!-- ===== Left-Sidebar-End ===== -->
    <!-- ===== Page-Content ===== -->
    <div class="page-wrapper">

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="white-box">

                        <?php echo $this->session->userdata('message') <> '' ? '<div class="alert ' . $this->session->userdata('status') . '">
					
				   ' . $this->session->userdata('message') . '
				</div>' : ''; ?>

                        <div class="row" style="margin-bottom: 10px">
                            <div class="col-md-4">
                                <?php

                                $newstart = date("d/m/y", strtotime($start));
                                $newend = date("d/m/y", strtotime($end));
                                ?>
                                <h3 class="box-title m-b-0"> Account :<?php echo $akun['account_name'] . ' (' . $akun['code'] . ')' ?> </h3>
                                <?php if(!empty($bank['id'])){ ?>
                                <h3 class="box-title m-b-0"> Account Bank :<?php echo $bank['bank_name'] . '-' . $bank['branch'];  ?> (<?php echo $bank['bank_norek'] ?>) </h3>
                                <?php } ?>
                                <p class="text-muted m-b-30">Date Range <?php echo $newstart . ' S/d ' . $newend ?></p>
                            </div>


                        </div>
                        <div class="table-responsive">
                            <table class="table color-table primary-table table-bordered">
                                <thead>
                                    <tr>

                                        <th class="text-center">BANK INFO</th>
                                        <th class="text-center">JUMLAH (IDR)</th>
                                        <?php if (!empty($currancy) and $currancy != 'IDR') { ?>
                                        <th class="text-center">ORIGINAL AMOUNT</th>
                                        <?php } ?>
                                        <th class="text-center">ACTION</th>

                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    if (!empty($data_ac)) {
                                        $jml_cr = 0;
                                        $jml_cr_ori = 0;

                                        foreach ($data_ac as $val) {
                                    ?>
                                            <tr>


                                                <td class="text-left"> <?php echo $val['bank_name'] . '-' . $val['branch'];  ?> (<?php echo $val['bank_norek'] ?>) </td>
                                                <td class="text-right"> <?php echo number_format($val['uang'], 2, ",", ".") ?></td>
                                                <?php if (!empty($currancy) and $currancy != 'IDR') { ?>
                                                    <td class="text-right"> <?php echo number_format($val['uang_ori'], 2, ",", ".") ?></td>

                                                <?php } ?>
                                                <td>

                                                    <a class="btn btn-success btn-outline btn-xs" href="<?php echo site_url('Report/Finance/DetailReportBulanan/?start_date=' . $start . '&end_date=' . $end . '&acount=' . $account. '&bank_id=' . $val['bank_id']) ?>" target="_blank">DETAIL<i class="fa fa-pencil" aria-hidden="true"></i></a>
                                                </td>



                                            </tr>
                                            <?php
                                            $jml_cr = $val['uang'] + $jml_cr;
                                            $jml_cr_ori = $val['uang_ori'] +  $jml_cr_ori;


                                            ?>

                                        <?php
                                        }
                                        ?>

                                        <tr>
                                            <td class="text-center" colspan="1"><b>TOTAL </b></td>
                                            <td class="text-right"><b><?php echo number_format($jml_cr, 2, ",", "."); ?> </b></td>
                                            <?php if (!empty($currancy) and $currancy != 'IDR') { ?>
                                                <td class="text-right"><b><?php echo number_format($jml_cr_ori, 2, ",", "."); ?> </b></td>
                                            <?php } ?>
                                        </tr>

                                    <?php
                                    }
                                    ?>



                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-md-6">


                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Modal -->


        <!-- ===== Page-Container-End ===== -->
        <footer class="footer t-a-c">
            © 2017 Cubic Admin
        </footer>
    </div>
    <!-- ===== Page-Content-End ===== -->
</div>