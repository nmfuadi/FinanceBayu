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
                <div class="col-sm-12">
                    <div class="white-box">

                        <?php echo $this->session->userdata('message') <> '' ? '<div class="alert ' . $this->session->userdata('status') . '">
					
                    ' . $this->session->userdata('message') . '
                 </div>' : ''; ?>
                        <h3 class="box-title m-b-0">Data Import Mutasi</h3>
                        <p class="text-muted m-b-30">Silahkan Pilih Account untuk memposting hasil import ini</p>
                        <a class="btn btn-danger btn-outline btn-lg" onclick="return confirm('Are you sure you want delete All in Your Import Item?');" href="<?php echo site_url('Report/Finance/DeleteAllData/'.$tgl) ?>">DELETE ALL  <i class="fa fa-trash" aria-hidden="true"></i></a><br/><br/>

                        <div class="table-responsive">

                       

                            <table id="myTable" class="table table-striped">
                                <thead>
                                    <tr>
                                    <th width="2%" class="text-center">Cecklist</th>
                                    <th width="5%" class="text-center">Tanggal</th>
                                    <th width="20%" class="text-center">Keterangan</th>
                                    <th width="15%" class="text-center">Jumlah</th>
                                    <th width="3%" class="text-center">Jenis</th>
                                    <th width="10%" class="text-center">Bank</th>
                                    <th width="32%" class="text-center">Pilih Account</th>
                                    <th width="20%" class="text-center">Action</th>
 

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (!empty($data)) {
                                        foreach ($data as $val) {
                                            $ret_d = date_create($val['trx_date']);
                                    ?>
                                            <tr>
                                                <td><input type="checkbox" name="myCheckboxes[]" id="myCheckboxes" value="<?php echo $val['id']; ?>" /></td>
                                                <td><?php echo date_format($ret_d, "d/m/y"); ?></td>
                                                <td><?php echo $val['remark']; ?></td>
                                                <td><?php echo number_format($val['amount'],2); ?></td>
                                                <td><?php echo $val['type_mutation']; ?></td>
                                                <td><?php echo $val['bank_name'] . '(' . $val['bank_norek'] . ')'; ?> </td>
                                                <td>
                                                    <select name="account" id="account<?php echo $val['id']; ?>" required>
                                                        <option value="">Pilih Account</option>
                                                        <?php if (!empty($account)) {

                                                            foreach ($account as $acc) { ?>

                                                                <?php if ($val['type_mutation'] == $acc['trx_type']) { ?>
                                                                    <option value="<?php echo $acc['code'] ?>"><?php echo $acc['account_name'] ?></option>
                                                        <?php  }
                                                            }
                                                        } ?>
                                                    </select>
                                                </td>
                                                <td>
                                                    <div class="button-box">
                                                        <input id="id<?php echo $val['id']; ?>" type="hidden" name="id" value="<?php echo $val['id']; ?>">
                                                        <input id="tglGet<?php echo $val['id']; ?>" type="hidden" name="tglGet" value="<?php echo $val['posting_date']; ?>">
                                                        <input id="actionType<?php echo $val['id']; ?>" type="hidden" name="actionType" value="UPDATE">
                                                        <button id="submit<?php echo $val['id']; ?>" type="submit" class="btn btn-primary btn-outline btn-xs">POSTING <i class="fa fa-pencil" aria-hidden="true"></i></button>

                                                        <a class="btn btn-danger btn-outline btn-xs" onclick="return confirm('Are you sure you want to delete this item?');" href="<?php echo site_url('Report/Finance/DeletePorcess/' . $val['id'] . '/' . $val['posting_date']) ?>">DELETE <i class="fa fa-trash" aria-hidden="true"></i></a>
                                                        <a class="btn btn-success btn-outline btn-xs" href="<?php echo site_url('Report/Finance/editMutasi/' . $val['id'] . '/' . $val['posting_date']) ?>">Edit <i class="fa fa-pencil" aria-hidden="true"></i></a>

                                                    </div>


                                                </td>

                                            </tr>

                                            <script>
                                                $(document).ready(function() {
                                                    $('#submit<?php echo $val['id']; ?>').click(function() {
                                                        var id = $("#id<?php echo $val['id']; ?>").val();
                                                        var tglGet = $("#tglGet<?php echo $val['id']; ?>").val();
                                                        var actionType = $("#actionType<?php echo $val['id']; ?>").val();
                                                        var account = $("#account<?php echo $val['id']; ?>").val();

                                                        // Returns successful data submission message when the entered information is stored in database.
                                                        var dataString = 'id=' + id + '&tglGet=' + tglGet + '&actionType=' + actionType + '&account=' + account;
                                                        if (id == '' || tglGet == '' || actionType == '' || account == '') {
                                                            alert("Please Fill All Fields");
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

                            <input id="tglGetAll" type="hidden" name="tglGetAll" value="<?php echo $tgl; ?>">
                            <input id="actionTypeAll" type="hidden" name="actionTypeAll" value="UPDATE" />

                            <button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModalHorizontal">
    Lanjutkan Pilihan
</button>

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
                                         <option value="" disabled selected>  Select Account</option>
                                             <optgroup label = "CREDIT ACCOUNT">
                                                <?php if (!empty($account)) {
                                                    foreach ($account as $acc) { ?>
                                                        <?php if ($acc['trx_type'] == 'CR' ) { ?>                                                          
                                                            <option value="<?php echo $acc['code'] ?>"><?php echo $acc['account_name'] ?></option>
                                                <?php  }
                                                    }
                                                } ?>
                                                </optgroup>
                                                <optgroup label = "DEBIT ACCOUNT">
                                                <?php if (!empty($account)) {
                                                    foreach ($account as $acc) { ?>
                                                        <?php if ($acc['trx_type'] == 'DB' ) { ?>
                                                            
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


<script>
 $(document).ready(function() {
    $('#submit').click(function() {
    var tglGet = $("#tglGetAll").val();
    var actionType = $("#actionTypeAll").val();
    var accountAll = $("#accountAll").val();
        var myCheckboxes = new Array();
        $("input:checked").each(function() {
           myCheckboxes.push($(this).val());
        });

        $.ajax({
            type: "POST",
            url: "<?php echo site_url('Report/Finance/postingPorcessAll/') ?>",
            data: 'tglGet='+tglGet+'&actionType='+actionType+'&accountAll='+accountAll+'&myCheckboxes='+myCheckboxes,
            cache: false,
            success: function(data){
                window.location.reload();
            }
        });
        return false;
});
});

</script>