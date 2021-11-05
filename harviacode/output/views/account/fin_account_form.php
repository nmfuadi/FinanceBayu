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
        <h2 style="margin-top:0px">Fin_account <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="varchar">Account Name <?php echo form_error('account_name') ?></label>
            <input type="text" class="form-control" name="account_name" id="account_name" placeholder="Account Name" value="<?php echo $account_name; ?>" />
        </div>
	    <input type="hidden" name="code" value="<?php echo $code; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('account') ?>" class="btn btn-default">Cancel</a>
	</form>
    </body>
</html>