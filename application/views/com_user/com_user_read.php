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
        <h2 style="margin-top:0px">Com_user Read</h2>
        <table class="table">
	    <tr><td>Username</td><td><?php echo $username; ?></td></tr>
	    <tr><td>Passwords</td><td><?php echo $passwords; ?></td></tr>
	    <tr><td>Surename</td><td><?php echo $surename; ?></td></tr>
	    <tr><td>Email</td><td><?php echo $email; ?></td></tr>
	    <tr><td>Level</td><td><?php echo $level; ?></td></tr>
	    <tr><td>Is Active</td><td><?php echo $is_active; ?></td></tr>
	    <tr><td>Uc</td><td><?php echo $uc; ?></td></tr>
	    <tr><td>Dc</td><td><?php echo $dc; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('com_user') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>