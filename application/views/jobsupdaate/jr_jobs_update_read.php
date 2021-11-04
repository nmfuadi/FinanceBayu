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
        <h2 style="margin-top:0px">Jr_jobs_update Read</h2>
        <table class="table">
	    <tr><td>Jobs Id</td><td><?php echo $jobs_id; ?></td></tr>
	    <tr><td>Kry Id</td><td><?php echo $kry_id; ?></td></tr>
	    <tr><td>Jobs Up Descr</td><td><?php echo $jobs_up_descr; ?></td></tr>
	    <tr><td>Pic</td><td><?php echo $pic; ?></td></tr>
	    <tr><td>Job Up St</td><td><?php echo $job_up_st; ?></td></tr>
	    <tr><td>Cr Dt</td><td><?php echo $cr_dt; ?></td></tr>
	    <tr><td>Cr Up</td><td><?php echo $cr_up; ?></td></tr>
	    <tr><td>U Cr</td><td><?php echo $u_cr; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('jobsupdaate') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>