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
        <h2 style="margin-top:0px">Jr_jobs_update List</h2>
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <?php echo anchor(site_url('jobsupdaate/create'),'Create', 'class="btn btn-primary"'); ?>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 8px" id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-1 text-right">
            </div>
            <div class="col-md-3 text-right">
                <form action="<?php echo site_url('jobsupdaate/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('jobsupdaate'); ?>" class="btn btn-default">Reset</a>
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
		<th>Jobs Id</th>
		<th>Kry Id</th>
		<th>Jobs Up Descr</th>
		<th>Pic</th>
		<th>Job Up St</th>
		<th>Cr Dt</th>
		<th>Cr Up</th>
		<th>U Cr</th>
		<th>Action</th>
            </tr><?php
            foreach ($jobsupdaate_data as $jobsupdaate)
            {
                ?>
                <tr>
			<td width="80px"><?php echo ++$start ?></td>
			<td><?php echo $jobsupdaate->jobs_id ?></td>
			<td><?php echo $jobsupdaate->kry_id ?></td>
			<td><?php echo $jobsupdaate->jobs_up_descr ?></td>
			<td><?php echo $jobsupdaate->pic ?></td>
			<td><?php echo $jobsupdaate->job_up_st ?></td>
			<td><?php echo $jobsupdaate->cr_dt ?></td>
			<td><?php echo $jobsupdaate->cr_up ?></td>
			<td><?php echo $jobsupdaate->u_cr ?></td>
			<td style="text-align:center" width="200px">
				<?php 
				echo anchor(site_url('jobsupdaate/read/'.$jobsupdaate->id),'Read'); 
				echo ' | '; 
				echo anchor(site_url('jobsupdaate/update/'.$jobsupdaate->id),'Update'); 
				echo ' | '; 
				echo anchor(site_url('jobsupdaate/delete/'.$jobsupdaate->id),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
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
		<?php echo anchor(site_url('jobsupdaate/excel'), 'Excel', 'class="btn btn-primary"'); ?>
		<?php echo anchor(site_url('jobsupdaate/word'), 'Word', 'class="btn btn-primary"'); ?>
	    </div>
            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
        </div>
    </body>
</html>