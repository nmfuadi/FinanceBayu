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
                            <div class="col-md-7">
                                <h3 class="box-title m-b-0"> Account :<?php echo $akun['account_name'].' ('.$akun['code'].')' ?> </h3>
                                <p class="text-muted m-b-30">Date Range : <? echo $data['start_date'] .'S/d'.$data['end_date']; ?> </p>
                            </div>
                            <div class="col-md-4 text-center">
                                <div style="margin-top: 8px" id="message">
                                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                                </div>
                            </div>
                            
                            <div class="col-md-3 text-right">
                                <form action="<?php echo site_url('Report/Finance/viewAllJournal'); ?>" class="form-inline" method="get">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                                        <span class="input-group-btn">
                                            <?php
                                            if ($q <> '') {
                                            ?>
                                                <a href="<?php echo site_url('Report/Finance/viewAllJournal'); ?>" class="btn btn-default">Reset</a>
                                            <?php
                                            }
                                            ?>
                                            <button class="btn btn-primary" type="submit">Search</button>
                                        </span>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table color-table primary-table table-bordered">
                                <thead>
                                    <tr>
                                        <th width="3%">NO</th>
                                        <th width="5%">Tanggal</th>
                                        <th width="20%">Keterangan</th>
                                        <th width="15%">Amount (Curency IDR)</th>
                                        <th width="15%">Amount Origin </th>
                                        <th width="3%">Jenis</th>
                                        <th width="15%">Account</th>
                                        <th width="10%">Bank</th>
                                        <th width="19%">Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (!empty($bayu_data)) {
                                        $ss = $start + 1;
                                        foreach ($bayu_data as $val) {
                                            $ret_d = date_create($val->trx_date);

                                    ?>

                                            <tr>
                                                <td><?php echo $ss++; ?></td>
                                                <td><?php echo date_format($ret_d, "d/m/y"); ?></td>
                                                <td><?php echo $val->remark; ?></td>
                                                <td class="text-right"><?php echo 'IDR ' . number_format($val->amount, 2); ?></td>
                                                <td class="text-right"><?php echo $val->currancy . ' ' . number_format($val->original_amount, 2); ?></td>
                                                <td><?php echo $val->type_mutation; ?></td>
                                                <td><?php echo $val->account_name; ?> (<?php echo $val->code; ?>) </td>
                                                <td><?php echo $val->bank_name . '-' . $val->branch;  ?> (<?php echo $val->bank_norek ?>) </td>
                                                <td>
                                                    <a class="btn btn-danger btn-outline btn-xs" onclick="return confirm('Are you sure you want to delete this item?');" href="<?php echo site_url('Report/Finance/DeletePorcess/' . $val->mut_id . '/' . $val->posting_date . '/viewAllJournal/' . $start) ?>">DELETE <i class="fa fa-trash" aria-hidden="true"></i></a>
                                                    <a class="btn btn-success btn-outline btn-xs" href="<?php echo site_url('Report/Finance/editMutasi/' . $val->mut_id . '/' . $val->posting_date . '/viewAllJournal/' . $start . '/' . $q) ?>">Edit <i class="fa fa-pencil" aria-hidden="true"></i></a>
                                                </td>
                                            </tr>
                                    <?php
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <a href="#" class="btn btn-primary">Total Record : <?php echo $total_rows ?></a>
                                <a href="#" class="btn btn-success" data-toggle="modal" data-target="#largeModal">Export Excell</a>
                            </div>
                            <div class="col-md-6 text-right">
                                <?php echo $pagination ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="modal fade" id="largeModal" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Eksport Journal Ke Excel</h4>
                    </div>
                    <div class="modal-body">
                        
                                    
                    <form action="<?php echo $action; ?>" class="form-horizontal" method="POST" enctype="multipart/form-data" accept-charset="utf-8"> 
                      
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


                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label col-md-3">Jenis </label>
                                    <div class="col-md-9">
                                        <select id="type" name="type" class="form-control">
                                            <option value="" selected disabled>Pilih Jenis Transaksi</option>
                                            <option value="">Semua Jenis</option>
                                            <option value="CR">Credit</option>
                                            <option value="DB">Debit</option>
                                            

                                        </select>
                                        
                                    </div>

                                </div>
                            </div>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Export Excel</button>
                    </div>

                                        </form>
                </div>
            </div>
        </div>



        <!-- ===== Page-Container-End ===== -->
        <footer class="footer t-a-c">
            © 2017 Cubic Admin
        </footer>
    </div>
    <!-- ===== Page-Content-End ===== -->
</div>