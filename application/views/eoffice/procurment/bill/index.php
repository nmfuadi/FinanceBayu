
<div id="wrapper">
       
		<!--<div class="preloader">
            <div class="cssload-speeding-wheel"></div>
        </div> -->
      
        
        <!-- ===== Left-Sidebar-End ===== -->
        <!-- ===== Page-Content ===== -->
        <div class="page-wrapper">
		
			
            <div class="container-fluid">
				
				 <div class="row">
				<?php echo $this->session->userdata('message') <> '' ? '<div class="alert '.$this->session->userdata('status').'">
					
				   '.$this->session->userdata('message').'
				</div>' : ''; ?>
				<div class="col-sm-12">
                        <div class="white-box">
                            <h3 class="box-title m-b-0">List Data Penerimaan Invoice</h3>
                            <p class="text-muted m-b-30">Export data to Copy, CSV, Excel, PDF & Print</p>
                            <div class="table-responsive">
                                <table id="example23" class="display nowrap table-bordered" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th style='text-align:center'>No</th>
											<th style='text-align:center'>Tanggal Terima Invoice</th>
											<th style='text-align:center'>Tanggal Invoice</th>
											<th style='text-align:center'>Invoice No</th>
											<th style='text-align:center'>Karyawan</th>
											<th style='text-align:center'>Divisi</th>
											<th style='text-align:center'>Projek</th>
											<th style='text-align:center'>Vendor</th>
											<th style='text-align:center'>Jumlah Tagihan</th>
											<th style='text-align:center'>Status</th>
											<th style='text-align:center'>Jatuh Tempo</th>
											<th style='text-align:center'>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                           <th style='text-align:center'>No</th>
											<th style='text-align:center'>Tanggal Terima Invoice</th>
											<th style='text-align:center'>Tanggal Invoice</th>
											<th style='text-align:center'>Invoice No</th>
											<th style='text-align:center'>Karyawan</th>
											<th style='text-align:center'>Divisi</th>
											<th style='text-align:center'>Projek</th>
											<th style='text-align:center'>Vendor</th>
											<th style='text-align:center'>Jumlah Tagihan</th>
											<th style='text-align:center'>Status</th>
											<th style='text-align:center'>Jatuh Tempo</th>
											<th style='text-align:center'>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
											<?php 
										if (!empty($bill)){
											$i=1;
											foreach ($bill as $act){	
													echo "
													 <tr>
														<td>".$i."</td>
														<td>".$act['invoice_date_receipt']."</td>
														<td>".$act['invoice_date']."</td>
														<td>".$act['invoice_no']."</td>
														<td>".$act['emp_name']."</td>
														<td>".$act['dprt_name']."</td>
														<td>".$act['project_name']."</td>
														<td>".$act['vendor_name']."</td>
														<td>".number_format($act['amount'])."</td>
														<td>".$act['paid_st']."</td>
														<td>".$act['duedate']."</td>
														<td class='text-nowrap'>
															  <a href='".site_url('eoffice/procurment/Bill/InsertTax/'.$act['id_bill'])."' data-toggle='tooltip' data-original-title='Add Pajak'> <i class='fa fa-camera text-inverse m-r-10'></i> </a>
															   <a href='".site_url('eoffice/procurment/Bill/Edit/'.$act['id_bill'])."' data-toggle='tooltip' data-original-title='Create Progress'> <i class='fa fa-plus-circle text-danger'></i> </a>
															</td
														
														</tr>";
														
												$i++;
										}
										}
										?>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
              
		
               
                
                
                
                <!-- ===== Right-Sidebar ===== -->
                <div class="right-sidebar">
                    <div class="slimscrollright">
                        <div class="rpanel-title"> Service Panel <span><i class="icon-close right-side-toggler"></i></span> </div>
                        <div class="r-panel-body">
                            <ul class="hidden-xs">
                                <li><b>Layout Options</b></li>
                                <li>
                                    <div class="checkbox checkbox-danger">
                                        <input id="headcheck" type="checkbox" class="fxhdr">
                                        <label for="headcheck"> Fix Header </label>
                                    </div>
                                </li>
                                <li>
                                    <div class="checkbox checkbox-warning">
                                        <input id="sidecheck" type="checkbox" class="fxsdr">
                                        <label for="sidecheck"> Fix Sidebar </label>
                                    </div>
                                </li>
                            </ul>
                            <ul id="themecolors" class="m-t-20">
                                <li><b>With Light sidebar</b></li>
                                <li><a href="javascript:void(0)" data-theme="default" class="default-theme working">1</a></li>
                                <li><a href="javascript:void(0)" data-theme="green" class="green-theme">2</a></li>
                                <li><a href="javascript:void(0)" data-theme="yellow" class="yellow-theme">3</a></li>
                                <li><a href="javascript:void(0)" data-theme="red" class="red-theme">4</a></li>
                                <li><a href="javascript:void(0)" data-theme="purple" class="purple-theme">5</a></li>
                                <li><a href="javascript:void(0)" data-theme="black" class="black-theme">6</a></li>
                                <li class="db"><b>With Dark sidebar</b></li>
                                <li><a href="javascript:void(0)" data-theme="default-dark" class="default-dark-theme">7</a></li>
                                <li><a href="javascript:void(0)" data-theme="green-dark" class="green-dark-theme">8</a></li>
                                <li><a href="javascript:void(0)" data-theme="yellow-dark" class="yellow-dark-theme">9</a></li>
                                <li><a href="javascript:void(0)" data-theme="red-dark" class="red-dark-theme">10</a></li>
                                <li><a href="javascript:void(0)" data-theme="purple-dark" class="purple-dark-theme">11</a></li>
                                <li><a href="javascript:void(0)" data-theme="black-dark" class="black-dark-theme">12</a></li>
                            </ul>
                            <ul class="m-t-20 chatonline">
                                <li><b>Chat option</b></li>
                                <li>
                                    <a href="javascript:void(0)"><img src="../plugins/images/users/1.jpg" alt="user-img" class="img-circle"> <span>Varun Dhavan <small class="text-success">online</small></span></a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"><img src="../plugins/images/users/2.jpg" alt="user-img" class="img-circle"> <span>Genelia Deshmukh <small class="text-warning">Away</small></span></a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"><img src="../plugins/images/users/3.jpg" alt="user-img" class="img-circle"> <span>Ritesh Deshmukh <small class="text-danger">Busy</small></span></a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"><img src="../plugins/images/users/4.jpg" alt="user-img" class="img-circle"> <span>Arijit Sinh <small class="text-muted">Offline</small></span></a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"><img src="../plugins/images/users/5.jpg" alt="user-img" class="img-circle"> <span>Govinda Star <small class="text-success">online</small></span></a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"><img src="../plugins/images/users/6.jpg" alt="user-img" class="img-circle"> <span>John Abraham<small class="text-success">online</small></span></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
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
$(document).ready(function () {
$('#dtHorizontalExample').DataTable({
"scrollX": true
});
$('.dataTables_length').addClass('bs-select');
});

</script>




	
	