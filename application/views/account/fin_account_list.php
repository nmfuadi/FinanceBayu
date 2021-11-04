<div id="wrapper">
        <div class="page-wrapper">
		
			
            <div class="container-fluid">
                              
				<div class="row">
                <div class="col-sm-12">
                        <div class="white-box">
                       
        <h2 style="margin-top:0px">Account List</h2>
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <?php echo anchor(site_url('Report/Account/create'),'Create', 'class="btn btn-primary"'); ?>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 8px" id="message">
                <?php echo $this->session->userdata('message') <> '' ? '<div class="alert '.$this->session->userdata('status').'">
		                  '.$this->session->userdata('message').'
                 </div>' : ''; ?>
                </div>
            </div>
            <div class="col-md-1 text-right">
            </div>
            <div class="col-md-3 text-right">
                <form action="<?php echo site_url('Report/Account/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('Report/Account'); ?>" class="btn btn-default">Reset</a>
                                    <?php
                                }
                            ?>
                          <button class="btn btn-primary" type="submit">Search</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
        <table class="table table-bordered" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
        <th>Account Code</th>
		<th>Account Name</th>
        <th>Account Type</th>
		<th>Action</th>
            </tr><?php
            foreach ($account_data as $account)
            {
                ?>
                <tr>
			<td width="80px"><?php echo ++$start ?></td>
			<td><?php echo $account->code ?></td>
            <td><?php echo $account->account_name ?></td>
            <td><?php echo $account->trx_type ?></td>
			<td style="text-align:center" width="200px">
				<?php 
				echo anchor(site_url('Report/Account/read/'.$account->code),'Read'); 
				echo ' | '; 
				echo anchor(site_url('Report/Account/update/'.$account->code),'Update'); 
				echo ' | '; 
				echo anchor(site_url('Report/Account/delete/'.$account->code),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
				?>
			</td>
		</tr>
                <?php
            }
            ?>
        </table>
        <div class="row">
            <div class="col-md-6">
                <a href="#" class="btn btn-primary">Total Record : <?php echo $total_rows ?></a>
		<?php echo anchor(site_url('account/excel'), 'Excel', 'class="btn btn-primary"'); ?>
	    </div>
            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
        </div>
        </div>
        </div>
        </div>