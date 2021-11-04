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
        <h2 style="margin-top:0px">St_cust Read</h2>
        <table class="table">
	    <tr><td>Project Id</td><td><?php echo $project_id; ?></td></tr>
	    <tr><td>Sales Id</td><td><?php echo $sales_id; ?></td></tr>
	    <tr><td>St Cust</td><td><?php echo $st_cust; ?></td></tr>
	    <tr><td>Source</td><td><?php echo $source; ?></td></tr>
	    <tr><td>Cust Name</td><td><?php echo $cust_name; ?></td></tr>
	    <tr><td>Cust Email</td><td><?php echo $cust_email; ?></td></tr>
	    <tr><td>Cust Phone</td><td><?php echo $cust_phone; ?></td></tr>
	    <tr><td>Cut Addres</td><td><?php echo $cut_addres; ?></td></tr>
	    <tr><td>Cr Dt</td><td><?php echo $cr_dt; ?></td></tr>
	    <tr><td>Cr Up</td><td><?php echo $cr_up; ?></td></tr>
	    <tr><td>U Cr</td><td><?php echo $u_cr; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('marketing/customer') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>