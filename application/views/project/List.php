<div id="wrapper">
         <?php echo $SIDEBAR; ?>
<div class="page-wrapper">
            <div class="container-fluid">
		
		<!--<div class="preloader">
            <div class="cssload-speeding-wheel"></div>
        </div> -->
      
				<div class="row">
		            <div class="col-lg-12">
						<div class="col-md-6 ">
							<h3 class="box-title m-b-0">Data List Project Property</h3>
							<p class="text-muted m-b-20">List Porject Porperty PT Repower Asia Indonesia</p>
					   </div>
						<div class="col-md-6">
							<div class="btn-group right-side-toggle">
								<br/>
							<div class="btn-group btn-group-justified m-b-20"> 
								<a class="btn btn-default btn-outline waves-effect waves-light" role="button">Left</a>
								<a class="btn btn-default btn-outline waves-effect waves-light" role="button">Middle</a> 
								<a class="btn btn-default btn-outline waves-effect waves-light" role="button">Right</a>
							</div>
								
							</div>
						</div>
						<div class="white-box">  
                            <table class="tablesaw table-bordered table-hover table" data-tablesaw-mode="swipe" data-tablesaw-sortable data-tablesaw-sortable-switch data-tablesaw-minimap data-tablesaw-mode-switch>
                                <thead>
                                    <tr>
										<th scope="col" >No</th>
                                        <th scope="col" >Project Name</th>
                                        <th scope="col" >Location</th>
                                        <th scope="col" >Number of units</th>
                                        <th scope="col" >
                                            <abbr title="Action Button">Action</abbr>
                                        </th>
                                       
                                    </tr>
                                </thead>
                                <tbody>
								<?php 
									if(!empty($project)){
									foreach($project as  $index => $data){
										
										echo '<tr> 
												 <td class="title"><a href="javascript:void(0)">'.$idx.'</a></td>	
												 <td>'.$data['project_name'].'</td>
												 <td>'.$data['project_locat'].'</td>
												<td>'.$data['project_unit'].'</td>
												<td>
													<div class="btn-group m-b-20">
														<button type="button" class="btn btn-default btn-outline waves-effect">Edit</button>
														<button type="button" class="btn btn-default btn-outline waves-effect">Delete</button>
														<button type="button" class="btn btn-default btn-outline waves-effect">Input Units</button>
													</div>
												</td>
											</tr>';										
										
										
										$idx++;
									}
									
									
									
								}
								else{ // Jika data tidak ada
									echo "<tr><td colspan='5'>Data tidak ada</td></tr>";
									}
								
								
								
								?>
                                    
                                   
                                </tbody>
                            </table>
							
							<div class="pagination">
								<ul>
								<?php 
									echo $this->pagination->create_links();
								?>
								</ul>
								</div>
							
                        </div>
                    </div>
                </div>
			
            <!-- ===== Page-Container-End ===== -->
		</div>
            <footer class="footer t-a-c">
                © 2017 Cubic Admin
            </footer>
        </div>
        <!-- ===== Page-Content-End ===== -->
    </div>