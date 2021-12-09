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
                        <h3 class="box-title m-b-0">Monitoring Import List</h3>
                        <p class="text-muted m-b-30">Berikut Adalah Data monitoring import by list</p>
                        

                        <div class="table-responsive">

                       

                            <table id="myTable" class="table table-striped">
                                <thead>
                                    <tr>
                                    <th width="2%" class="text-center">No</th>
                                    <th width="20%" class="text-center">Tanggal Import</th>
                                    <th width="10%" class="text-center">Star Date</th>
                                    <th width="10%" class="text-center">Last Date</th>
                                    <th width="10%" class="text-center">Jumlah FIeld</th>
                                    <th width="10%" class="text-center">Bank</th>
                                    <th width="5%" class="text-center">Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (!empty($data)) {
                                        $no = 1;
                                        foreach ($data as $val) {
                                            
                                    ?>
                                            <tr>
                                                <td><?php echo $no++; ?></td>
                                                <td><?php echo $val['posting_date']; ?></td>
                                                <td><?php echo $val['tgl_awal']; ?></td>
                                                <td><?php echo $val['tgl_ahir']; ?></td>
                                                <td><?php echo $val['jumlah']; ?> </td>
                                                <td><?php echo $val['bank_name'] .'-' .$val['branch'].'(' . $val['bank_norek'] . ')'; ?> </td>
                                                
                                                <td>
                                                    <div class="button-box"> 
                                                        <a class="btn btn-success btn-outline" href="<?php echo site_url('Report/Finance/MonitoringDetail/' . $val['posting_date'] ) ?>">Detail <i class="fa fa-eye" aria-hidden="true"></i></a>
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


