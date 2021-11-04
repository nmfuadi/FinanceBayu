 <link href="<?= $path; ?>plugins/components/morrisjs/morris.css" rel="stylesheet">
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
                         <form action="<?php echo $actionSearch; ?>" method="post">

                                    <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label class="control-label">Start Date</label>
                                                        <input type="date" id="start" name="start" class="form-control" placeholder="John doe"> 
                                                    </div>
                                                </div>
                                                <!--/span-->
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label class="control-label">Finish Date</label>
                                                        <input type="date" id="finish" name="finish" class="form-control" placeholder="12n">
                                                    </div>
                                                </div>
                                                <!--/span-->
                                                <div class="col-md-3">
                                                 <div class="form-group">
                                                     <label class="control-label">`</label>
                                                    <input type="submit" class="form-control btn btn-success" value="Search">
                                                </div>
                                                </div>
                                                
                                            </div>
                                        
                                    </form>
                        <div class="white-box">
                      
                         <!-- Create code here -->
                           

                            <h3 class="box-title m-b-0">Progres Pencapaian Sales</h3>
                              <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Tugas</th>
                                            <th>Progress</th>
                                            <th>Periode</th>
                                            <th class="text-nowrap">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if(!empty($penc)){
                                            foreach ($penc as $settkpi)
                                            {
                                                if($settkpi['kpi']<40){

                                                    $cls = 'progress-bar-danger';
                                                }else if($settkpi['kpi']>40 and $settkpi['kpi']<50){
                                                     $cls = 'progress-bar-warning';

                                                }else if($settkpi['kpi']>=50 and $settkpi['kpi']<80){

                                                            $cls = 'progress-bar-primary';

                                                }else{

                                                    $cls = 'progress-bar-success';
                                                }



                                                ?>
                                        <tr>
                                            <td><?php echo $settkpi['name_mark']; ?></td>
                                            <td><a href="<?php echo $actionDetail."/".$settkpi['kry_id']."/".$start."/".$finish; ?>/" data-toggle="tooltip" data-original-title="<?php echo $settkpi['kpi']; ?> %">
                                                <div class="progress progress-xs margin-vertical-10 ">
                                                    <div class="progress-bar <?php echo $cls; ?>" style="width: <?php echo $settkpi['kpi']; ?>%"></div> 
                                                </div>
                                                </a>
                                            </td>
                                            <td><?php echo date("M, Y"); ?></td>
                                            <td class="text-nowrap">
                                                <a href="<?php echo $actionDetail."/".$settkpi['kry_id']."/".$start."/".$finish; ?>" data-toggle="tooltip" data-original-title="View Detail"> <i class="fa fa-camera-retro text-inverse m-r-10"></i> </a>
                                               
                                            </td>
                                        </tr>
                                        
                                        <?php } }?>
                                       
                                        
                                        
                                        
                                    </tbody>
                                </table>
                            </div>



                         <!-- end Code this page -->  

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





