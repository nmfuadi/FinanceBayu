		<!--<div class="preloader">
            <div class="cssload-speeding-wheel"></div>
        </div> -->
        <!-- ===== Top-Navigation ===== -->
        <nav class="navbar navbar-default navbar-static-top m-b-0">
            <div class="navbar-header">
                <a class="navbar-toggle font-20 hidden-sm hidden-md hidden-lg " href="javascript:void(0)" data-toggle="collapse" data-target=".navbar-collapse">
                    <i class="fa fa-bars"></i>
                </a>
                <div class="top-left-part">
                    <a class="logo" href="index.html">
                <b>
                    <img src="<?= $path; ?>plugins/images/bayu_logo_putih.png" alt="home" height="50px"/>
                </b>
<!--                            <span>
						<img src="<?= $path; ?>plugins/images/logo-text.png" alt="homepage" class="dark-logo" />
						</span>-->

					<!--<span style="color: white">X TRAINING | Pendaftaran</span>-->
            </a>
                </div>
                <ul class="nav navbar-top-links navbar-left hidden-xs">
                    <li>
                        <a href="javascript:void(0)" class="sidebartoggler font-20 waves-effect waves-light"><i class="icon-arrow-left-circle"></i></a>
                    </li>
                    <li>
                        <form role="search" class="app-search hidden-xs">
                            <i class="icon-magnifier"></i>
                            <input type="text" placeholder="Search..." class="form-control">
                        </form>
                    </li>
                </ul>
				
            </div>
        </nav>
        <!-- ===== Top-Navigation-End ===== -->
        <!-- ===== Left-Sidebar ===== -->
        <aside class="sidebar">
            <div class="scroll-sidebar">
                <div class="user-profile">
                    <div class="dropdown user-pro-body">
                        <div class="profile-image">
							<?php 
							if (empty($ms['photo'])){
								$photo = 'no_photo.jpg';
								
							}else {
								
								$photo = $ms['photo'];
							}
							
							?>
                            <a href="<?php echo base_url()?>Report/Profile">
							<img src="<?php echo base_url().'file/PP/'.$photo; ?>" alt="user-img" class="img-circle">
							</a>
                            <a href="javascript:void(0);" class="dropdown-toggle u-dropdown text-blue" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                <span class="badge badge-danger">
                                    <i class="fa fa-angle-down"></i>
                                </span>
                            </a>
                            <ul class="dropdown-menu animated flipInY">
                                <li><a href="<?php echo base_url()?>Report/Profile"><i class="fa fa-user"></i> Profile</a></li>
                                 <li role="separator" class="divider"></li>
                                <li><a href="<?php echo base_url()?>Report/Profile"><i class="fa fa-cog"></i> Account Settings</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="<?php echo base_url()?>Report/LoginAdmin/logout"><i class="fa fa-power-off"></i> Logout</a></li>
                            </ul>
                        </div>
                        <p class="profile-text m-t-15 font-16"><a href="javascript:void(0);"><?php echo $ms['emp_name']." <br> (".$dp['dprt_name']." )"; ?></a></p>
                    </div>
                </div>
                <nav class="sidebar-nav">
                    <ul id="side-menu">
                        <?php echo $SIDEBAR; // iki di ambil dari controler admin yow?		?> 
                       
                    </ul>
                </nav>
               
            </div>
        </aside>