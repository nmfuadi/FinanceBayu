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
                                        <th class="text-center">NO</th>
                                        <th class="text-center">Cecklist</th>
                                        <th class="text-center">Tanggal</th>
                                        <th class="text-center">Keterangan</th>
                                        <th class="text-center">Jumlah</th>
                                        <th class="text-center">Jenis</th>
                                        <th class="text-center">Bank</th>
                                        <th class="text-center">Pilih Account</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (!empty($bayu_data)) {
                                        $st = $start+1;
                                        foreach ($bayu_data as $val) {
                                            $ret_d = date_create($val->trx_date);

                                    ?>


                                            <tr>
                                                <td><?php echo $st++; ?></td>
                                                <td><input type="checkbox" name="myCheckboxes[]" id="myCheckboxes" value="<?php echo $val->mut_id; ?>" /></td>
                                                <td><?php echo date_format($ret_d, "d/m/y"); ?></td>
                                                <td><?php echo $val->remark; ?></td>
                                                <td><?php echo $val->currancy.' '.number_format($val->amount); ?></td>
                                                <td><?php echo $val->type_mutation; ?></td>
                                                <td><?php echo $val->bank_name . '(' . $val->bank_norek . ')'; ?> </td>

                                                <td>
                                                    <select name="account" id="account<?php echo $val->mut_id; ?>" required>
                                                        <option value="">Pilih Account</option>
                                                        <?php if (!empty($account)) {

                                                            foreach ($account as $acc) { ?>
                                                                <?php if ($val->type_mutation == $acc['trx_type']) { ?>
                                                                    <option value="<?php echo $acc['code'] ?>"><?php echo $acc['account_name'] ?></option>
                                                        <?php }
                                                            }
                                                        } ?>
                                                    </select>
                                                </td>
                                                <td>
                                                    <div class="button-box">
                                                        <input id="id<?php echo $val->mut_id; ?>" type="hidden" name="id" value="<?php echo $val->mut_id; ?>">
                                                        <input id="tglGet<?php echo $val->mut_id; ?>" type="hidden" name="tglGet" value="<?php echo $val->posting_date ?>">
                                                        <input id="actionType<?php echo $val->mut_id; ?>" type="hidden" name="actionType" value="jurnal">
                                                        <button id="submit<?php echo $val->mut_id; ?>" type="submit" class="btn btn-primary btn-outline btn-xs">POSTING <i class="fa fa-pencil" aria-hidden="true"></i></button>

                                                        <a class="btn btn-danger btn-outline btn-xs" onclick="return confirm('Are you sure you want to delete this item?');" href="<?php echo site_url('Report/Finance/postingPorcess/' . $val->mut_id . '/' . $val->posting_date . '/DELETE/jurnal') ?>">DELETE <i class="fa fa-trash" aria-hidden="true"></i></a>
                                                        <a class="btn btn-success btn-outline btn-xs" href="<?php echo site_url('Report/Finance/editMutasi/' . $val->mut_id) ?>">Edit <i class="fa fa-pencil" aria-hidden="true"></i></a>
                                                    </div>


                                                </td>

                                            </tr>

                                            <script>
                                                $(document).ready(function() {
                                                    $('#submit<?php echo $val->mut_id; ?>').click(function() {
                                                        var id = $("#id<?php echo $val->mut_id; ?>").val();
                                                        var tglGet = $("#tglGet<?php echo $val->mut_id; ?>").val();
                                                        var actionType = $("#actionType<?php echo $val->mut_id; ?>").val();
                                                        var account = $("#account<?php echo $val->mut_id; ?>").val();

                                                        // Returns successful data submission message when the entered information is stored in database.
                                                        var dataString = 'id=' + id + '&tglGet=' + tglGet + '&actionType=' + actionType + '&account=' + account;
                                                        if (id == '' || tglGet == '' || actionType == '' || account == '') {
                                                            alert("Harap Pilih Account Mutasi");
                                                        } else {
                                                            // AJAX Code To Submit Form.
                                                            $.ajax({
                                                                type: "GET",
                                                                url: "<?php echo site_url('Report/Finance/postingPorcess/') ?>",
                                                                data: dataString,
                                                                cache: false,
                                                                success: function(result) {
                                                                    window.location.reload();
                                                                }
                                                            });
                                                        }
                                                        return false;
                                                    });
                                                });
                                            </script>

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
                            
                                <button class="btn btn-success" data-toggle="modal" data-target="#myModalHorizontal">
                                    Lanjutkan Pilihan
                                </button>
                            </div>
                            <div class="col-md-6 text-right">
                                <?php echo $pagination ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Modal -->
        <div class="modal fade" id="myModalHorizontal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Close</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel">
                            Pilih Account
                        </h4>
                    </div>

                    <!-- Modal Body -->
                    <div class="modal-body">

                        <form class="form-horizontal" role="form">
                            <div class="form-group">
                                <label class="col-sm-4 control-label" for="inputEmail3">Pilih Account</label>
                                <div class="col-sm-8">
                                    <select name="account" id="accountAll" required>
                                        <option value="" disabled selected> Select Account</option>
                                        <optgroup label="CREDIT ACCOUNT">
                                            <?php if (!empty($account)) {
                                                foreach ($account as $acc) { ?>
                                                    <?php if ($acc['trx_type'] == 'CR') { ?>
                                                        <option value="<?php echo $acc['code'] ?>"><?php echo $acc['account_name'] ?></option>
                                            <?php  }
                                                }
                                            } ?>
                                        </optgroup>
                                        <optgroup label="DEBIT ACCOUNT">
                                            <?php if (!empty($account)) {
                                                foreach ($account as $acc) { ?>
                                                    <?php if ($acc['trx_type'] == 'DB') { ?>

                                                        <option value="<?php echo $acc['code'] ?>"><?php echo $acc['account_name'] ?></option>

                                            <?php  }
                                                }
                                            } ?>

                                        </optgroup>

                                    </select>
                                </div>
                            </div>
                        </form>

                    </div>

                    <!-- Modal Footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">
                            Close
                        </button>
                        <button id="submit" type="submit" class="btn btn-primary">POSTING <i class="fa fa-pencil" aria-hidden="true"></i></button>
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





<script>
    $(document).ready(function() {
        $('#submit').click(function() {
            var accountAll = $("#accountAll").val();
            var myCheckboxes = new Array();
            $("input:checked").each(function() {
                myCheckboxes.push($(this).val());
            });
            if (myCheckboxes == '' || accountAll == '') {
                alert("Harap Pilih Account Mutasi atau anda belum ceklis data Mutasi");
            } else {
                $.ajax({
                    type: "POST",
                    url: "<?php echo site_url('Report/Finance/postingPorcessAll/') ?>",
                    data: 'accountAll=' + accountAll + '&myCheckboxes=' + myCheckboxes,
                    cache: false,
                    success: function(data) {
                        window.location.reload();
                    }
                });
                return false;
            }
        });
    });
</script>