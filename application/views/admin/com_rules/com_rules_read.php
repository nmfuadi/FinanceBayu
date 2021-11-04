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
        <h2 style="margin-top:0px">Com_rules Read</h2>
        <table class="table">
	    <tr><td>Portal Id</td><td><?php echo $portal_id; ?></td></tr>
	    <tr><td>User Id</td><td><?php echo $user_id; ?></td></tr>
	    <tr><td>Rules Name</td><td><?php echo $rules_name; ?></td></tr>
	    <tr><td>Description</td><td><?php echo $description; ?></td></tr>
	    <tr><td>Cu</td><td><?php echo $cu; ?></td></tr>
	    <tr><td>Cd</td><td><?php echo $cd; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('com_rules') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>