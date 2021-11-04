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
        <h2 style="margin-top:0px">Jr_jobs Read</h2>
        <table class="table">
	    <tr><td>Jobs Code</td><td><?php echo $jobs_code; ?></td></tr>
	    <tr><td>Kry Id</td><td><?php echo $kry_id; ?></td></tr>
	    <tr><td>Jobs Tittle</td><td><?php echo $jobs_tittle; ?></td></tr>
	    <tr><td>Jobs Desc</td><td><?php echo $jobs_desc; ?></td></tr>
	    <tr><td>Jobs Stat</td><td><?php echo $jobs_stat; ?></td></tr>
	    <tr><td>Jobs Date</td><td><?php echo $jobs_date; ?></td></tr>
	    <tr><td>Jobs Week</td><td><?php echo $jobs_week; ?></td></tr>
	    <tr><td>Cr Dt</td><td><?php echo $cr_dt; ?></td></tr>
	    <tr><td>Cr Up</td><td><?php echo $cr_up; ?></td></tr>
	    <tr><td>U Cr</td><td><?php echo $u_cr; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('jobs') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>