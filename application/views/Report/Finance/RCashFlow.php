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
                                <h3 class="box-title m-b-0">Report Cashflow <?php echo $q ?></h3>
                                <p class="text-muted m-b-30">Report Cashflot Tahun <?php echo $q ?></p>
                            </div>
                            <div class="col-md-2 text-center">
                                <div style="margin-top: 8px" id="message">
                                </div>
                            </div>

                            <div class="col-md-5 text-right">
                                <form action="<?php echo site_url('Report/Finance/ReportCashflow'); ?>" class="form-inline" method="get">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                                        <span class="input-group-btn">
                                            <?php
                                            if ($q <> '') {
                                            ?>
                                                <a href="<?php echo site_url('Report/Finance/viewAllPostingJournal'); ?>" class="btn btn-default">Reset</a>
                                            <?php
                                            }
                                            ?>
                                            <button class="btn btn-primary" type="submit">Submit Tahun</button>
                                        </span>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table color-table primary-table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center">KETERANGAN</th>
                                        <th class="text-center">January</th>
                                        <th class="text-center">February</th>
                                        <th class="text-center">March</th>
                                        <th class="text-center">April</th>
                                        <th class="text-center">May</th>
                                        <th class="text-center">June</th>
                                        <th class="text-center">July</th>
                                        <th class="text-center">August</th>
                                        <th class="text-center">September</th>
                                        <th class="text-center">October</th>
                                        <th class="text-center">November</th>
                                        <th class="text-center">December</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-center" colspan="13"> <b>PENERIMAAN</b></td>
                                    </tr>
                                    <?php
                                    if (!empty($data_cr)) {
                                        $jan_cr = 0;
                                        $feb_cr = 0;
                                        $mar_cr = 0;
                                        $apr_cr = 0;
                                        $mei_cr = 0;
                                        $jun_cr = 0;
                                        $jul_cr = 0;
                                        $agt_cr = 0;
                                        $sep_cr = 0;
                                        $okt_cr = 0;
                                        $nov_cr = 0;
                                        $des_cr = 0;

                                        foreach ($data_cr as $val) {
                                    ?>
                                            <tr>
                                                <td  class="text-left"> <?php echo $val['account_name'] ?></td>
                                                <td  class="text-right"> <?php echo number_format($val['January'], 2, ",", ".") ?></td>
                                                <td  class="text-right"> <?php echo number_format($val['February'], 2, ",", ".") ?></td>
                                                <td  class="text-right"> <?php echo number_format($val['March'], 2, ",", ".") ?></td>
                                                <td  class="text-right"> <?php echo number_format($val['April'], 2, ",", ".") ?></td>
                                                <td  class="text-right"> <?php echo number_format($val['May'], 2, ",", ".") ?></td>
                                                <td  class="text-right"> <?php echo number_format($val['June'], 2, ",", ".") ?></td>
                                                <td  class="text-right"> <?php echo number_format($val['July'], 2, ",", ".") ?></td>
                                                <td  class="text-right"> <?php echo number_format($val['August'], 2, ",", ".") ?></td>
                                                <td  class="text-right"> <?php echo number_format($val['September'], 2, ",", ".") ?></td>
                                                <td  class="text-right"> <?php echo number_format($val['October'], 2, ",", ".") ?></td>
                                                <td  class="text-right"> <?php echo number_format($val['November'], 2, ",", ".") ?></td>
                                                <td  class="text-right"> <?php echo number_format($val['December'], 2, ",", ".") ?></td>

                                            </tr>
                                            <?php
                                            $jan_cr = $val['January'] + $jan_cr;
                                            $feb_cr = $val['February'] + $feb_cr;
                                            $mar_cr = $val['March'] + $mar_cr;
                                            $apr_cr = $val['April'] + $apr_cr;
                                            $mei_cr = $val['May'] + $mei_cr;
                                            $jun_cr = $val['June'] + $jun_cr;
                                            $jul_cr = $val['July'] + $jul_cr;
                                            $agt_cr = $val['August'] + $agt_cr;
                                            $sep_cr = $val['September'] + $sep_cr;
                                            $okt_cr = $val['October'] + $okt_cr;
                                            $nov_cr = $val['November'] + $nov_cr;
                                            $des_cr = $val['December'] + $des_cr;

                                            ?>

                                        <?php
                                        }
                                        ?>

                                        <tr>
                                            <td class="text-center"><b>TOTAL PENERIMAAN</b></td>
                                            <td  class="text-right"><b><?php echo number_format($jan_cr, 2, ",", "."); ?> </b></td>
                                            <td  class="text-right"><b><?php echo number_format($feb_cr, 2, ",", "."); ?> </b></td>
                                            <td  class="text-right"><b><?php echo number_format($mar_cr, 2, ",", "."); ?> </b></td>
                                            <td  class="text-right"><b><?php echo number_format($apr_cr, 2, ",", "."); ?> </b></td>
                                            <td  class="text-right"><b><?php echo number_format($mei_cr, 2, ",", "."); ?> </b></td>
                                            <td  class="text-right"><b><?php echo number_format($jun_cr, 2, ",", "."); ?> </b></td>
                                            <td  class="text-right"><b><?php echo number_format($jul_cr, 2, ",", "."); ?> </b></td>
                                            <td  class="text-right"><b><?php echo number_format($agt_cr, 2, ",", "."); ?> </b></td>
                                            <td  class="text-right"><b><?php echo number_format($sep_cr, 2, ",", "."); ?> </b></td>
                                            <td  class="text-right"><b><?php echo number_format($okt_cr, 2, ",", "."); ?> </b></td>
                                            <td  class="text-right"><b><?php echo number_format($nov_cr, 2, ",", "."); ?> </b></td>
                                            <td  class="text-right"><b><?php echo number_format($des_cr, 2, ",", "."); ?> </b></td>
                                        </tr>

                                    <?php
                                    }
                                    ?>


                                    <tr>
                                        <td colspan="13" class="text-center"> <b>PENGELUARAN</b></td>
                                    </tr>
                                    <?php
                                    if (!empty($data_db)) {
                                        $jan_db = 0;
                                        $feb_db = 0;
                                        $mar_db = 0;
                                        $apr_db = 0;
                                        $mei_db = 0;
                                        $jun_db = 0;
                                        $jul_db = 0;
                                        $agt_db = 0;
                                        $sep_db = 0;
                                        $okt_db = 0;
                                        $nov_db = 0;
                                        $des_db = 0;

                                        foreach ($data_db as $val_db) {


                                    ?>


                                            <tr>
                                                <td class="text-left"> <?php echo $val_db['account_name'] ?></td>
                                                <td class="text-right"> <?php echo number_format($val_db['January'], 2, ",", ".") ?></td>
                                                <td class="text-right"> <?php echo number_format($val_db['February'], 2, ",", ".") ?></td>
                                                <td class="text-right"> <?php echo number_format($val_db['March'], 2, ",", ".") ?></td>
                                                <td class="text-right"> <?php echo number_format($val_db['April'], 2, ",", ".") ?></td>
                                                <td class="text-right"> <?php echo number_format($val_db['May'], 2, ",", ".") ?></td>
                                                <td class="text-right"> <?php echo number_format($val_db['June'], 2, ",", ".") ?></td>
                                                <td class="text-right"> <?php echo number_format($val_db['July'], 2, ",", ".") ?></td>
                                                <td class="text-right"> <?php echo number_format($val_db['August'], 2, ",", ".") ?></td>
                                                <td class="text-right"> <?php echo number_format($val_db['September'], 2, ",", ".") ?></td>
                                                <td class="text-right"> <?php echo number_format($val_db['October'], 2, ",", ".") ?></td>
                                                <td class="text-right"> <?php echo number_format($val_db['November'], 2, ",", ".") ?></td>
                                                <td class="text-right"> <?php echo number_format($val_db['December'], 2, ",", ".") ?></td>

                                            </tr>
                                            <?php
                                            $jan_db = $val_db['January'] + $jan_db;
                                            $feb_db = $val_db['February'] + $feb_db;
                                            $mar_db = $val_db['March'] + $mar_db;
                                            $apr_db = $val_db['April'] + $apr_db;
                                            $mei_db = $val_db['May'] + $mei_db;
                                            $jun_db = $val_db['June'] + $jun_db;
                                            $jul_db = $val_db['July'] + $jul_db;
                                            $agt_db = $val_db['August'] + $agt_db;
                                            $sep_db = $val_db['September'] + $sep_db;
                                            $okt_db = $val_db['October'] + $okt_db;
                                            $nov_db = $val_db['November'] + $nov_db;
                                            $des_db = $val_db['December'] + $des_db;



                                            ?>

                                        <?php
                                        }
                                        ?>

                                        <tr>
                                            <td class="text-center"><b>TOTAL PENGELUARAN</b></td>
                                            <td class="text-right"><b><?php echo number_format($jan_db, 2, ",", "."); ?> </b></td>
                                            <td class="text-right"><b><?php echo number_format($feb_db, 2, ",", "."); ?> </b></td>
                                            <td class="text-right"><b><?php echo number_format($mar_db, 2, ",", "."); ?> </b></td>
                                            <td class="text-right"><b><?php echo number_format($apr_db, 2, ",", "."); ?> </b></td>
                                            <td class="text-right"><b><?php echo number_format($mei_db, 2, ",", "."); ?> </b></td>
                                            <td class="text-right"><b><?php echo number_format($jun_db, 2, ",", "."); ?> </b></td>
                                            <td class="text-right"><b><?php echo number_format($jul_db, 2, ",", "."); ?> </b></td>
                                            <td class="text-right"><b><?php echo number_format($agt_db, 2, ",", "."); ?> </b></td>
                                            <td class="text-right"><b><?php echo number_format($sep_db, 2, ",", "."); ?> </b></td>
                                            <td class="text-right"><b><?php echo number_format($okt_db, 2, ",", "."); ?> </b></td>
                                            <td class="text-right"><b><?php echo number_format($nov_db, 2, ",", "."); ?> </b></td>
                                            <td class="text-right"><b><?php echo number_format($des_db, 2, ",", "."); ?> </b></td>
                                        </tr>

                                    <?php
                                    }

                                    if(!empty($data_db) and !empty($data_cr)){

                                   
                                    ?>

                                    
                                    <tr>
                                            <td class="text-center"><b> SALDO PENERIMAAN - PENGELUARAN</b></td>
                                            <td class="text-right"><b><?php echo number_format($jan_cr-$jan_db, 2, ",", "."); ?> </b></td>
                                            <td class="text-right"><b><?php echo number_format($feb_cr-$feb_db, 2, ",", "."); ?> </b></td>
                                            <td class="text-right"><b><?php echo number_format($mar_cr-$mar_db, 2, ",", "."); ?> </b></td>
                                            <td class="text-right"><b><?php echo number_format($apr_cr-$apr_db, 2, ",", "."); ?> </b></td>
                                            <td class="text-right"><b><?php echo number_format($mei_cr-$mei_db, 2, ",", "."); ?> </b></td>
                                            <td class="text-right"><b><?php echo number_format($jun_cr-$jun_db, 2, ",", "."); ?> </b></td>
                                            <td class="text-right"><b><?php echo number_format($jul_cr-$jul_db, 2, ",", "."); ?> </b></td>
                                            <td class="text-right"><b><?php echo number_format($agt_cr-$agt_db, 2, ",", "."); ?> </b></td>
                                            <td class="text-right"><b><?php echo number_format($sep_cr-$sep_db, 2, ",", "."); ?> </b></td>
                                            <td class="text-right"><b><?php echo number_format($okt_cr-$okt_db, 2, ",", "."); ?> </b></td>
                                            <td class="text-right"><b><?php echo number_format($nov_cr-$nov_db, 2, ",", "."); ?> </b></td>
                                            <td class="text-right"><b><?php echo number_format($des_cr-$des_db, 2, ",", "."); ?> </b></td>

                                    </tr>
                                    <?php  } ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-md-6">

                                <button class="btn btn-success" data-toggle="modal" data-target="#myModalHorizontal">
                                    Export Excel
                                </button>
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