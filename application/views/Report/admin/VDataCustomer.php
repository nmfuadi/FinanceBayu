 <link href="<?= $path; ?>plugins/components/morrisjs/morris.css" rel="stylesheet">
<div id="wrapper">
       
		<!--<div class="preloader">
            <div class="cssload-speeding-wheel"></div>
        </div> -->
      
        
        <!-- ===== Left-Sidebar-End ===== -->
        <!-- ===== Page-Content ===== -->
        <div class="page-wrapper">
		
			
            <div class="container-fluid">
                <div class="row colorbox-group-widget">
				
                    <div class="col-md-3 col-sm-6 info-color-box">
                        <div class="white-box">
                            <div class="media bg-primary">
                                <div class="media-body">
                                    <h3 class="info-count"> <?php echo $all['jumlah']; ?> <span class="pull-right"><i class="mdi mdi-checkbox-marked-circle-outline"></i></span></h3>
                                    <p class="info-text font-12">SEMUA DATA</p>
                                    <p class="info-ot font-15">Target<span class="label label-rounded">198</span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 info-color-box">
                        <div class="white-box">
                            <div class="media bg-success">
                                <div class="media-body">
                                    <h3 class="info-count"><?php echo $pr['jumlah']; ?> <span class="pull-right"><i class="mdi mdi-comment-text-outline"></i></span></h3>
                                    <p class="info-text font-12"><?php  echo $pr['cust_stat']; ?></p>
                                    <p class="info-ot font-15">Target<span class="label label-rounded">154</span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 info-color-box">
                        <div class="white-box">
                            <div class="media bg-danger">
                                <div class="media-body">
                                    <h3 class="info-count"><?php echo $bk['jumlah']; ?>  <span class="pull-right"><i class="mdi mdi-coin"></i></span></h3>
                                    <p class="info-text font-12"><?php echo $bk['cust_stat']; ?></p>
                                    <p class="info-ot font-15">Target<span class="label label-rounded">236</span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 info-color-box">
                        <div class="white-box">
                            <div class="media bg-warning">
                                <div class="media-body">
                                    <h3 class="info-count"><?php echo $ak['jumlah']; ?> <span class="pull-right"><i class="mdi mdi-coin"></i></span></h3>
                                    <p class="info-text font-12"><?php echo $ak['cust_stat']; ?></p>
                                    <p class="info-ot font-15">Target<span class="label label-rounded">782</span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
						
						<div class="row">
                    <div class="col-md-6 col-sm-12 col-xs-12">
                        <div class="white-box">
                            <h3 class="box-title">Data Customer Tahun 2020</h3>
                            <ul class="list-inline text-right">
										<?php 
										
												foreach ($scr as $y){
			
														$cl = dechex(crc32($y['name_sc']));
															$clour = substr($cl, 5, 6);			
															
															
															
														echo '
														
											<li>
												<h5><i class="fa fa-circle  m-r-5" style="color:#'.$clour.'"></i>'.$y['name_sc'].'</h5> 
											</li>
												
												';	
															
													}
																							
											?>
                            </ul>
                            <div id="custSource"></div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12 col-xs-12">
                        <div class="white-box">
                            <h3 class="box-title">Data Customer Berdasarkan Sumber Data</h3>
                            <ul class="list-inline text-right">
                                <li>
                                    <h5><i class="fa fa-circle m-r-5 text-info"></i>Data Customer</h5> </li>
                               
                            </ul>
                            <div id="graph"></div>
                        </div>
                    </div>
                </div>
				
                 
                            <div class="row">
                                  <div class="col-md-6 col-sm-12 col-xs-12">
									<div class="white-box">
										<h3 class="box-title">Data Konversi Customer</h3>
										<ul class="list-inline text-right">
											<?php 
												
												$ky = array ('AKADKREDIT','PEMBERKASAN','BOOKING','HOTPROSPECT','FOLLOWUP','NEW');
											
												 $i= 0;
												for ($i=0;$i<=5;$i++){
													
													$cl = dechex(crc32($ky[$i]));
														$clour = substr($cl, 5, 6);			
														
														
												echo '
														
											<li>
												<h5><i class="fa fa-circle  m-r-5" style="color:#'.$clour.'"></i>'.$ky[$i].'</h5> 
											</li>
												
												';
													
												}
		
												
													
											?>
												
											
								
											
																					
											
											
											
										</ul>
										<div id="morris-area-chart"></div>
									</div>
								</div>
								
										 <div class="col-md-6 col-sm-12 col-xs-12">
											<div class="white-box">
												<h3 class="box-title">Data Konversi Booking Customer</h3>
												
												<div id="donut"></div>
											</div>
										</div>
                            </div>
                  
              
				
				  <div class="row">
                                 <div class="col-md-12 col-sm-12 col-xs-12">
									<div class="white-box">
				  <h2>Aktivitas Sales Hari ini </h2>      
				  <table class="table table-hover">
					<thead>
					  <tr>
						<th>Nama Marketing</th>
						<th>Jenis Aktivitas</th>
						<th>Detail Aktivitas</th>
					  </tr>
					</thead>
					<tbody>
					<?php 
					if (!empty($activity)){
						foreach ($activity as $act){
							
								echo "
								 <tr>
									<td>".$act['name_mark']."</td>
									<td>".$act['actv_jn']."</td>
									<td>".$act['actv_text']."</td>
								  </tr>
								
								";
							
						}
						
					}else {
						
						echo "
								
								 <tr>
									<td colspan =3>Belum Ada Aktivitas Sales Hari ini</td>
									
								  </tr>
						
						";
					}
					?>
					 
						
					</tbody>
				  </table>
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
                ?? 2017 Cubic Admin 
            </footer>
        </div>
        <!-- ===== Page-Content-End ===== -->
    </div>





	
	