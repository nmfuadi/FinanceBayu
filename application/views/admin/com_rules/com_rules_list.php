<!doctype html>
<html>
    <head>
        <title>harviacode.com - codeigniter crud generator</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <style>
            body{
                padding: 15px;
            }
        </style>
    </head>
    <body>
        <h2 style="margin-top:0px">Com_rules List</h2>
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <?php echo anchor(site_url('com_rules/create'),'Create', 'class="btn btn-primary"'); ?>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 8px" id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-1 text-right">
            </div>
            <div class="col-md-3 text-right">
                <form action="<?php echo site_url('com_rules/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('com_rules'); ?>" class="btn btn-default">Reset</a>
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
		<th>Portal Id</th>
		<th>User Id</th>
		<th>Rules Name</th>
		<th>Description</th>
		<th>Cu</th>
		<th>Cd</th>
		<th>Action</th>
            </tr><?php
            foreach ($com_rules_data as $com_rules)
            {
                ?>
                <tr>
			<td width="80px"><?php echo ++$start ?></td>
			<td><?php echo $com_rules->portal_id ?></td>
			<td><?php echo $com_rules->user_id ?></td>
			<td><?php echo $com_rules->rules_name ?></td>
			<td><?php echo $com_rules->description ?></td>
			<td><?php echo $com_rules->cu ?></td>
			<td><?php echo $com_rules->cd ?></td>
			<td style="text-align:center" width="200px">
				<?php 
				echo anchor(site_url('com_rules/read/'.$com_rules->rules_id),'Read'); 
				echo ' | '; 
				echo anchor(site_url('com_rules/update/'.$com_rules->rules_id),'Update'); 
				echo ' | '; 
				echo anchor(site_url('com_rules/delete/'.$com_rules->rules_id),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
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
	    </div>
            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
        </div>
    </body>
</html>