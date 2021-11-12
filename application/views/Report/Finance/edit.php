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
                        <div class="panel-heading">Insert Data Jurnal</div>
                        <div class="panel-wrapper collapse in" aria-expanded="true">
                            <div class="panel-body">
                                <form action="<?php echo $action; ?>" class="form-horizontal" method="post" enctype="multipart/form-data" accept-charset="utf-8">
                                    <input class="form-control" type="hidden" name="id" value="<?php echo $data['id'] ?>" />
                                    <input class="form-control" type="hidden" name="tglform" value="<?php echo $data['tgl'] ?>" />
                                    <div class="form-body">
                                        <h3 class="box-title">Insert Data Jurnal</h3>
                                        <hr class="m-t-0 m-b-40">
                                        <div class="row">

                                        </div>
                                        <!--/row-->
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Rekenening Bank </label>
                                                    <div class="col-md-9">
                                                        <select name="rekening" class="form-control">
                                                            <?php
                                                            if (!empty($bank)) {
                                                                foreach ($bank as $banks) { ?>
                                                                    <option value="<?php echo $banks['id'] ?>" <?php echo $banks['id'] == $data['bank_id'] ? 'selected' : '' ?>><?php echo $banks['bank_name'].'-'.$banks['branch'].' (' . $banks['bank_norek'] . ')'; ?></option>
                                                            <?php }
                                                            } ?>

                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Pilih Account </label>
                                                    <div class="col-md-9">
                                                        <select name="account" class="form-control">
                                                            <option value="" disabled selected>Pilih Account <?php echo  $data['type_mutation'] == 'CR' ? 'Credit' : 'Debit' ?></option>
                                                            <?php if (!empty($account)) {

                                                                foreach ($account as $acc) { ?>
                                                                    <option value="<?php echo $acc['code'] ?>" <?php echo $acc['code'] == $data['account_code'] ? 'selected' : '' ?>><?php echo $acc['account_name'] ?></option>

                                                            <?php  }
                                                            } ?>

                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Tipe Mutasi </label>
                                                    <div class="col-md-9">
                                                        <select name="type_trx" class="form-control">
                                                            <option value="CR" <?php echo  $data['type_mutation'] == 'CR' ? 'selected' : '' ?>>Credit</option>
                                                            <option value="DB" <?php echo  $data['type_mutation'] == 'DB' ? 'selected' : '' ?>>Debit</option>


                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--/span-->
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Tanggal Transaksi</label>
                                                    <div class="col-md-9">
                                                        <input class="form-control" id='datepicker' type="text" name="trx_date" value="<?php echo $data['trx_date'] ?>" />
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Currancy </label>
                                                    <div class="col-md-9">
                                                        <select name="currancy" class="form-control">
                                                        <?php if (!empty($kurs)) {
                                                                foreach ($kurs as $kurs) {
                                                            ?>
                                                                    <option value="<?php echo $kurs['kurs_code'] ?>" <?php echo  $kurs['kurs_code'] == $data['currancy'] ? 'selected' : '' ?>><?php echo $kurs['kurs_code'] ?></option>
                                                            <?php }
                                                            } ?>
                                                            

                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Jumlah Transaksi</label>
                                                    <div class="col-md-9">
                                                        <input class="form-control" type="number" name="amount" value="<?php echo $data['amount'] ?>" />
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Keterangan</label>
                                                    <div class="col-md-9">
                                                        <input class="form-control" type="text" name="remark" value="<?php echo $data['remark'] ?>" />
                                                    </div>
                                                </div>
                                            </div>

                                            <!--	<div class="col-md-12">
													<div class="form-group">
													   <label class="control-label col-md-3">FILE EXCEL</label>
													    <div class="col-md-9">
														
															<input type="button" class="btn btn-warning" value="Pilih File" onclick="document.getElementById('pic').click()"> <br/> <br/>
																<input class="form-control" class="control-label type="text" id="filename"> 
																<input type="file"   name="uploadFile"  id="pic" style="display:none" onchange="document.getElementById('filename').value=this.value">
													</div>
													</div>
													</div>
                                                        -->




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

        <!-- ===== Right-Sidebar-End ===== -->
    </div>
    <!-- ===== Page-Container-End ===== -->
    <footer class="footer t-a-c">
        © 2017 Cubic Admin
    </footer>
</div>
<!-- ===== Page-Content-End ===== -->
</div>

<script src="https://cdn.ckeditor.com/ckeditor5/18.0.0/classic/ckeditor.js">