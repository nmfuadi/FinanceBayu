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
        <h2 style="margin-top:0px">St_kpi_sett Read</h2>
        <table class="table">
	    <tr><td>Kpi Name</td><td><?php echo $kpi_name; ?></td></tr>
	    <tr><td>Kpi Value</td><td><?php echo $kpi_value; ?></td></tr>
	    <tr><td>Kpi Weight</td><td><?php echo $kpi_weight; ?></td></tr>
	    <tr><td>Dt Cr</td><td><?php echo $dt_cr; ?></td></tr>
	    <tr><td>U Dt</td><td><?php echo $u_dt; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('settkpi') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>