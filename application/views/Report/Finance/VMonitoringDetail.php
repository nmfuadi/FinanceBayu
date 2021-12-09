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
                                    <th width="2%" class="text-center">No</th>
                                    <th width="5%" class="text-center">Tanggal Transaksi</th>
                                    <th width="20%" class="text-center">Keterangan</th>
                                    <th width="15%" class="text-center">Jumlah</th>
                                    <th width="3%" class="text-center">Jenis</th>
                                    <th width="10%" class="text-center">Bank</th>
                                    <th width="32%" class="text-center">Status Posting</th>
                                    <th width="20%" class="text-center">Action</th>
 

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (!empty($data)) {
                                        $no = 1;
                                        foreach ($data as $val) {
                                            $ret_d = date_create($val['trx_date']);
                                    ?>
                                            <tr>
                                                <td><?php $no++; ?></td>
                                                <td><?php echo date_format($ret_d, "d/m/y"); ?></td>
                                                <td><?php echo $val['remark']; ?></td>
                                                <td><?php echo number_format($val['amount'],2); ?></td>
                                                <td><?php echo $val['type_mutation']; ?></td>
                                                <td><?php echo $val['bank_name'] .'-'. $val['bank_rek_name'].'-' .$val['branch'].'(' . $val['bank_norek'] . ')'; ?> </td>
                                                <td>
                                                     <?php echo $val['posting_st']; ?></td>
                                                </td>
                                                <td>
                                                    <div class="button-box">
                                                        <input id="id<?php echo $val['id']; ?>" type="hidden" name="id" value="<?php echo $val['id']; ?>">
                                                        <input id="tglGet<?php echo $val['id']; ?>" type="hidden" name="tglGet" value="<?php echo $val['posting_date']; ?>">
                                                        <input id="actionType<?php echo $val['id']; ?>" type="hidden" name="actionType" value="UPDATE">
                                                       

                                                        <a class="btn btn-danger btn-outline btn-xs" onclick="return confirm('Are you sure you want to delete this item?');" href="<?php echo site_url('Report/Finance/DeletePorcess/' . $val['id'] . '/' . $val['posting_date'].'/MonitoringDetail') ?>">DELETE <i class="fa fa-trash" aria-hidden="true"></i></a>
                                                        <a class="btn btn-success btn-outline btn-xs" href="<?php echo site_url('Report/Finance/editMutasi/' . $val['id'] . '/' . $val['posting_date'].'/MonitoringDetail') ?>">Edit <i class="fa fa-pencil" aria-hidden="true"></i></a>

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

                    </div>
                </div>
            </div>




            <!-- Modal -->
            


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
            success: function(response){
               window.location.reload(); 

            }
        });
        return false;
});
});

</script>