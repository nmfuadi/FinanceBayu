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

                                <h3 class="box-title m-b-0">Data Import Mutasi</h3>
                                <p class="text-muted m-b-30">Silahkan Pilih Account untuk memposting hasil import ini</p>

                            </div>
                            <div class="col-md-4 text-center">
                                <div style="margin-top: 8px" id="message">

                                </div>
                            </div>

                            <div class="col-md-3 text-right">
                                <form action="<?php echo site_url('Report/Finance/viewAllPostingJournal'); ?>" class="form-inline" method="get">
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
                                        <th>NO</th>
                                        <th>Tanggal</th>
                                        <th>Keterangan</th>
                                        <th>Jumlah</th>
                                        <th>Jenis</th>
                                        <th>Bank</th>
                                        <th>Pilih Account</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (!empty($bayu_data)) {

                                        foreach ($bayu_data as $val) {
                                            $ret_d = date_create($val->trx_date);

                                    ?>


                                            <tr>
                                                <td><?php echo $start++; ?></td>
                                                <td><?php echo date_format($ret_d, "d/m/y"); ?></td>
                                                <td><?php echo $val->remark; ?></td>
                                                <td><?php echo number_format($val->amount); ?></td>
                                                <td><?php echo $val->type_mutation; ?></td>
                                                <td><?php echo $val->bank_name.'('.$val->bank_norek.')'; ?> </td>
                                                
                                                <td>
                                                    <form action="<?php echo site_url('Report/Finance/postingPorcess/') ?>" class="form-horizontal" method="get">

                                                        <select name="account" id="cars" required>
                                                            <option value="">Pilih Account</option>
                                                            <?php if (!empty($account)) {

                                                                foreach ($account as $acc) { ?>
                                                                    <?php if($val->type_mutation == $acc['trx_type']){?>
                                                                    <option value="<?php echo $acc['code'] ?>"><?php echo $acc['account_name'] ?></option>
                                                                    

                                                            <?php } }
                                                            } ?>
                                                        </select>
                                                </td>
                                                <td>
                                                    <div class="button-box">
                                                        <input type="hidden" name="id" value="<?php echo $val->mut_id; ?>">
                                                        <input type="hidden" name="tglGet" value="<?php echo $val->posting_date ?>">
                                                        <input type="hidden" name="actionType" value="UPDATE">
                                                        <input type="hidden" name="from" value="jurnal">
                                                        <button type="submit" class="btn btn-primary btn-outline btn-xs">POSTING <i class="fa fa-pencil" aria-hidden="true"></i></button>
                                                        </form>
                                                        <a class="btn btn-danger btn-outline btn-xs" onclick="return confirm('Are you sure you want to delete this item?');" href="<?php echo site_url('Report/Finance/postingPorcess/' . $val->mut_id . '/' . $val->posting_date . '/DELETE/jurnal') ?>">DELETE <i class="fa fa-trash" aria-hidden="true"></i></a>
                                                        <a class="btn btn-success btn-outline btn-xs" href="<?php echo site_url('Report/Finance/editMutasi/' . $val->mut_id) ?>">Edit <i class="fa fa-pencil" aria-hidden="true"></i></a>
                                                    </div>


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
                                <?php echo anchor(site_url('bayuform/excel'), 'Excel', 'class="btn btn-primary"'); ?>
                            </div>
                            <div class="col-md-6 text-right">
                                <?php echo $pagination ?>
                            </div>
                        </div>
                    </div>
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