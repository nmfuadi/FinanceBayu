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
        <h2 style="margin-top:0px">Com_menu List</h2>
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <?php echo anchor(site_url('com_menu/create'),'Create', 'class="btn btn-primary"'); ?>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 8px" id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-1 text-right">
            </div>
            <div class="col-md-3 text-right">
                <form action="<?php echo site_url('com_menu/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('com_menu'); ?>" class="btn btn-default">Reset</a>
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
		<th>Rules Id</th>
		<th>Parent Id</th>
		<th>Menu Name</th>
		<th>Description</th>
		<th>Number</th>
		<th>Url</th>
		<th>Is Active</th>
		<th>Cu</th>
		<th>Cd</th>
		<th>Action</th>
            </tr><?php
            foreach ($com_menu_data as $com_menu)
            {
                ?>
                <tr>
			<td width="80px"><?php echo ++$start ?></td>
			<td><?php echo $com_menu->rules_id ?></td>
			<td><?php echo $com_menu->parent_id ?></td>
			<td><?php echo $com_menu->menu_name ?></td>
			<td><?php echo $com_menu->description ?></td>
			<td><?php echo $com_menu->number ?></td>
			<td><?php echo $com_menu->url ?></td>
			<td><?php echo $com_menu->is_active ?></td>
			<td><?php echo $com_menu->cu ?></td>
			<td><?php echo $com_menu->cd ?></td>
			<td style="text-align:center" width="200px">
				<?php 
				echo anchor(site_url('com_menu/read/'.$com_menu->menu_id),'Read'); 
				echo ' | '; 
				echo anchor(site_url('com_menu/update/'.$com_menu->menu_id),'Update'); 
				echo ' | '; 
				echo anchor(site_url('com_menu/delete/'.$com_menu->menu_id),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
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