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
                                <h3 class="box-title m-b-0">Report Cashflow <?php echo  $newstart.' S/d '. $newend ?></h3>
                                <p class="text-muted m-b-30">Report Cashflow <?php echo $newstart .' S/d '. $newend ?></p>
                            </div>
                            <div class="col-md-4 text-center">
                                <div style="margin-top: 8px" id="message">
                                <a href="#" class="btn btn-success" data-toggle="modal" data-target="#largeModal">Select Report</a>
                                </div>
                            </div>



                            <div class="modal fade" id="largeModal" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Report Bulanan</h4>
                    </div>
                    <div class="modal-body">
                        
                                    
                    <form action="<?php echo $action; ?>" class="form-horizontal" method="GET" enctype="multipart/form-data" accept-charset="utf-8"> 
                      
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label col-md-3">Rekenening Bank </label>
                                    <div class="col-md-9">
                                        <select name="rekening" class="form-control">
                                            <option value="" selected disabled>Pilih Rekening</option>
                                            <option value="">Semua Rekening Bank</option>
                                            <?php
                                            if (!empty($bank)) {
                                                foreach ($bank as $banks) { ?>
                                                    <option value="<?php echo $banks['id'] ?>"><?php echo $banks['bank_name'] . '-' . $banks['branch'] . ' (' . $banks['bank_norek'] . ')-' . $banks['currency_code']; ?></option>
                                            <?php }
                                            } ?>

                                        </select>
                                    </div>
                                </div>
                            </div>


                            <!--/span-->
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label col-md-3">Range Tanggal Transaksi</label>
                                    <div class="col-md-4">
                                        <input class="form-control" type="date" name="start" value="" placeholder="Start" />
                                    </div>
                                    <div class="col-md-1">
                                        <label class="control-label">Sampai</label>
                                    </div>
                                    <div class="col-md-4">
                                        <input class="form-control"  type="date" name="end" value="" placeholder="End" />
                                    </div>
                                </div>
                            </div>


                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label col-md-3">Original Currancy </label>
                                    <div class="col-md-9">
                                        <select id="kurs" name="kurs" class="form-control">
                                            <option value="" selected disabled>Pilih Kurs Matauang</option>
                                            <option value="">All Currancy</option>
                                            <?php
                                            if (!empty($kurs)) {
                                                foreach ($kurs as $kurs) {
                                                 
                                            ?>
                                            <option value="<?php echo $kurs['kurs_code'] ?>"><?php echo $kurs['kurs_code']; ?></option>
                                                        
                                            <?php 
                                                }
                                            } ?>

                                        </select>
                                        
                                    </div>

                                </div>
                            </div>                            
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">View Report</button>
                    </div>

                                        </form>
                </div>
            </div>
        </div>

                           
                        </div>
                        <div class="table-responsive">
                            <table class="table color-table primary-table table-bordered">
                                <thead>
                                    <tr>
                                        
                                        <th class="text-center">KETERANGAN</th>
                                        <th class="text-center">JUMLAH (IDR)</th>
                                        <?php if(!empty($currancy) and $currancy !='IDR') { ?>
                                        <th class="text-center">ORIGINAL AMOUNT (<?php echo $currancy ?>)</th>
                                        <?php } ?>
                                        <th class="text-center">ACTION</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-center" colspan="13"> <b>PENERIMAAN</b></td>
                                    </tr>
                                    <?php
                                    if (!empty($data_cr)) {
                                        $jml_cr = 0;
                                        $jml_cr_ori= 0;
                                       
                                        foreach ($data_cr as $val) {
                                    ?>
                                            <tr>
                                               
                                                
                                                <td  class="text-left"> <?php echo $val['account_name'] ?></td>
                                                <td  class="text-right"> <?php echo number_format($val['uang'], 2, ",", ".") ?></td>
                                                 <?php if(!empty($currancy) and $currancy !='IDR') { ?>
                                                <td  class="text-right"> <?php echo number_format($val['uang_ori'], 2, ",", ".") ?></td>
                                                
                                                <?php } ?>
                                                <td>
                                                    
                                                    <a class="btn btn-success btn-outline btn-xs" href="<?php echo site_url('Report/Finance/DetailReportBulanan/?start_date='.$start.'&end_date='.$end.'&account='.$val['account_code'])?>" target="_blank">DETAIL<i class="fa fa-pencil" aria-hidden="true"></i></a>
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
                                            <td class="text-center" colspan="1"><b>TOTAL PENERIMAAN</b></td>
                                            <td  class="text-right"><b><?php echo number_format($jml_cr, 2, ",", "."); ?> </b></td>
                                            <?php if(!empty($currancy) and $currancy !='IDR') { ?>
                                            <td  class="text-right"><b><?php echo number_format($jml_cr_ori, 2, ",", "."); ?> </b></td>
                                            <?php } ?>
                                        </tr>

                                    <?php
                                    }
                                    ?>


                                    <tr>
                                        <td colspan="13" class="text-center"> <b>PENGELUARAN</b></td>
                                    </tr>
                                    <?php
                                    if (!empty($data_db)) {
                                        $jml_db = 0;
                                        $jml_db_ori = 0;
                                       

                                        foreach ($data_db as $val_db) {


                                    ?>


                                            <tr>
                                            
                                                <td  class="text-left"> <?php echo $val_db['account_name'] ?></td>
                                                <td  class="text-right"> <?php echo number_format($val_db['uang'], 2, ",", ".") ?></td>
                                            <?php if(!empty($currancy) and $currancy !='IDR') { ?>
                                                <td  class="text-right"> <?php echo number_format($val_db['uang_ori'], 2, ",", ".") ?></td>
                                                

                                                <?php } ?>
                                                <td>
                                                    
                                                    <a class="btn btn-success btn-outline btn-xs" href="<?php echo site_url('Report/Finance/DetailReportBulanan/?start_date='.$start.'&end_date='.$end.'&account='.$val_db['account_code'])?>" target="_blank">DETAIL<i class="fa fa-pencil" aria-hidden="true" target="_blank"></i></a>
                                                </td>

                                            </tr>
                                            <?php
                                            $jml_db = $val_db['uang'] + $jml_db;
                                            $jml_db_ori = $val_db['uang_ori'] + $jml_db_ori;
                                            



                                            ?>

                                        <?php
                                        }
                                        ?>

                                        <tr>
                                            <td class="text-center" colspan="1"><b>TOTAL PENGELUARAN</b></td>
                                            <td class="text-right"><b><?php echo number_format($jml_db, 2, ",", "."); ?> </b></td>
                                            <?php if(!empty($currancy) and $currancy !='IDR') { ?>
                                            <td class="text-right"><b><?php echo number_format($jml_db_ori, 2, ",", "."); ?> </b></td>
                                            <?php } ?>
                                            
                                        </tr>

                                    <?php
                                    }

                                    if(!empty($data_db) and !empty($data_cr)){

                                   
                                    ?>

                                    
                                    <tr>
                                            <td class="text-center" colspan="1"><b> SALDO PENERIMAAN - PENGELUARAN</b></td>
                                            <td class="text-right"><b><?php echo number_format($jml_cr-$jml_db, 2, ",", "."); ?> </b></td>
                                            <?php if(!empty($currancy) and $currancy !='IDR') { ?>
                                            <td class="text-right"><b><?php echo number_format($jml_cr_ori-$jml_db_ori, 2, ",", "."); ?> </b></td>
                                            <?php } ?>

                                    </tr>
                                    <?php  } ?>
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