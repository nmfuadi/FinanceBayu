<link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
<div id="wrapper">
         <?php echo $SIDEBAR; ?>
<div class="page-wrapper">
<div class="container-fluid">
<div class="row">
<div class="col-lg-12">
<div class="white-box"> 
	<h2 style="margin-top:0px">User List</h2>
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <?php echo anchor(site_url('admin/com_user/create'),'Create', 'class="btn btn-primary"'); ?>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 8px" id="message">

                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-1 text-right">
            </div>
            <div class="col-md-3 text-right">
                <form action="<?php echo site_url('admin/com_user/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('admin/com_user'); ?>" class="btn btn-default">Reset</a>
                                    <?php
                                }
                            ?>
                          <button class="btn btn-primary" type="submit">Search</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
		
        <table class="tablesaw table-bordered table-hover table" data-tablesaw-mode="swipe" data-tablesaw-sortable data-tablesaw-sortable-switch data-tablesaw-minimap data-tablesaw-mode-switch>
            <tr>
                <th>No</th>
		<th>Username</th>
		<th>Passwords</th>
		<th>Surename</th>
		<th>Email</th>
		<th>Level</th>
		<th>Is Active</th>
		<th>Dc</th>
		<th>Action</th>
            </tr><?php
            foreach ($com_user_data as $com_user)
            {
                ?>
                <tr>
			<td width="80px"><?php echo ++$start ?></td>
			<td><?php echo $com_user->username ?></td>
			<td><?php echo $com_user->passwords ?></td>
			<td><?php echo $com_user->surename ?></td>
			<td><?php echo $com_user->email ?></td>
			<td><?php echo $com_user->level ?></td>
			<td><?php echo $com_user->is_active ?></td>
			<td><?php echo $com_user->dc ?></td>
			<td style="text-align:center" width="200px">
				<?php 
				echo anchor(site_url('admin/com_user/read/'.$com_user->id_user),'Read'); 
				echo ' | '; 
				echo anchor(site_url('admin/com_user/update/'.$com_user->id_user),'Update'); 
				echo ' | '; 
				echo anchor(site_url('admin/com_user/delete/'.$com_user->id_user),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
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
</div>
</div>
</div>
</div>
</div>
</div>
    