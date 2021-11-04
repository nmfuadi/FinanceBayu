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
        <h2 style="margin-top:0px">Com_portal Read</h2>
        <table class="table">
	    <tr><td>Portal Name</td><td><?php echo $portal_name; ?></td></tr>
	    <tr><td>Portal Des</td><td><?php echo $portal_des; ?></td></tr>
	    <tr><td>Is Active</td><td><?php echo $is_active; ?></td></tr>
	    <tr><td>Cu</td><td><?php echo $cu; ?></td></tr>
	    <tr><td>Cd</td><td><?php echo $cd; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('com_portal') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>