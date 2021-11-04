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
        <h2 style="margin-top:0px">Jr_jobs List</h2>
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <?php echo anchor(site_url('jobs/create'),'Create', 'class="btn btn-primary"'); ?>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 8px" id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-1 text-right">
            </div>
            <div class="col-md-3 text-right">
                <form action="<?php echo site_url('jobs/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('jobs'); ?>" class="btn btn-default">Reset</a>
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
		<th>Jobs Code</th>
		<th>Kry Id</th>
		<th>Jobs Tittle</th>
		<th>Jobs Desc</th>
		<th>Jobs Stat</th>
		<th>Jobs Date</th>
		<th>Jobs Week</th>
		<th>Cr Dt</th>
		<th>Cr Up</th>
		<th>U Cr</th>
		<th>Action</th>
            </tr><?php
            foreach ($jobs_data as $jobs)
            {
                ?>
                <tr>
			<td width="80px"><?php echo ++$start ?></td>
			<td><?php echo $jobs->jobs_code ?></td>
			<td><?php echo $jobs->kry_id ?></td>
			<td><?php echo $jobs->jobs_tittle ?></td>
			<td><?php echo $jobs->jobs_desc ?></td>
			<td><?php echo $jobs->jobs_stat ?></td>
			<td><?php echo $jobs->jobs_date ?></td>
			<td><?php echo $jobs->jobs_week ?></td>
			<td><?php echo $jobs->cr_dt ?></td>
			<td><?php echo $jobs->cr_up ?></td>
			<td><?php echo $jobs->u_cr ?></td>
			<td style="text-align:center" width="200px">
				<?php 
				echo anchor(site_url('jobs/read/'.$jobs->id),'Read'); 
				echo ' | '; 
				echo anchor(site_url('jobs/update/'.$jobs->id),'Update'); 
				echo ' | '; 
				echo anchor(site_url('jobs/delete/'.$jobs->id),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
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
		<?php echo anchor(site_url('jobs/excel'), 'Excel', 'class="btn btn-primary"'); ?>
		<?php echo anchor(site_url('jobs/word'), 'Word', 'class="btn btn-primary"'); ?>
	    </div>
            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
        </div>
    </body>
</html>