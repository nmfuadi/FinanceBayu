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
                        <?php echo $this->session->userdata('message') <> '' ? '<div class="alert '.$this->session->userdata('status').'">
					
                    '.$this->session->userdata('message').'
                 </div>' : ''; ?>
                            <h3 class="box-title m-b-0">Data Import Mutasi</h3>
                            <p class="text-muted m-b-30">Silahkan Pilih Account untuk memposting hasil import ini</p>
                            <div class="table-responsive">
                                <table id="myTable" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Tanggal</th>
                                            <th>Keterangan</th>
                                            <th>Jumlah</th>
                                            <th>Jenis</th>
                                            <th>Bank Info</th>
                                            <th>Pilih Account</th>
                                            <th>Action</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        if(!empty($data)){
                                            foreach($data as $val){
                                                $ret_d = date_create($val['trx_date']); 
                                            ?>
                                        
                                        
                                        <tr>
                                            <td><?php echo date_format($ret_d,"d/m/y"); ?></td>
                                            <td><?php echo $val['remark']; ?></td>
                                            <td><?php echo number_format($val['amount']); ?></td>
                                            <td><?php echo $val['type_mutation']; ?></td>
                                            <td><?php echo $val['bank_name'].'('.$val['bank_norek'].')'; ?> </td>
                                            <td>
                                            
                                         
                                            <select name="account" id="account<?php echo $val['id']; ?>" required>
                                            <option value="">Pilih Account</option>
                                                <?php if(!empty($account)){
                                                    
                                             foreach($account as $acc){ ?>

                                                <?php if($val['type_mutation'] == $acc['trx_type'] ) { ?>
                                                <option value="<?php echo $acc['code']?>"><?php echo $acc['account_name']?></option>
                                                
                                                <?php  }}} ?>
                                                </select>
                                            </td>
                                            <td>
                                            <div class="button-box">
                                                <input id="id<?php echo $val['id']; ?>" type="hidden" name="id" value="<?php echo $val['id']; ?>">
                                                <input id ="tglGet<?php echo $val['id']; ?>" type="hidden" name="tglGet" value="<?php echo $val['posting_date']; ?>">
                                                <input id ="actionType<?php echo $val['id']; ?>" type="hidden" name="actionType" value="UPDATE">
                                            <button id="submit<?php echo $val['id']; ?>" type="submit" class="btn btn-primary btn-outline btn-xs">POSTING <i class="fa fa-pencil" aria-hidden="true"></i></button>
                                            
                                            <a class="btn btn-danger btn-outline btn-xs" onclick="return confirm('Are you sure you want to delete this item?');" href="<?php echo site_url('Report/Finance/postingPorcess/'.$val['id'].'/'.$val['posting_date'].'/DELETE')?>">DELETE <i class="fa fa-trash" aria-hidden="true"></i></a>
                                            <a class="btn btn-success btn-outline btn-xs"  href="<?php echo site_url('Report/Finance/editMutasi/'.$val['id'].'/'.$val['posting_date'])?>">Edit <i class="fa fa-pencil" aria-hidden="true"></i></a>
                                  
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
                                                        var dataString = 'id='+ id + '&tglGet='+ tglGet +'&actionType='+ actionType + '&account=' + account;
                                                        if ( id == '' || tglGet == '' || actionType == '' || account == '') {
                                                            alert("Please Fill All Fields");
                                                        } else {
                                                            // AJAX Code To Submit Form.
                                                            $.ajax({
                                                                type: "GET",
                                                                url: "<?php echo site_url('Report/Finance/postingPorcess/')?>",
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
	
	





	
	