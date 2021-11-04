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
        <h2 style="margin-top:0px">Com_rules <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="int">Portal Id <?php echo form_error('portal_id') ?></label>
            <input type="text" class="form-control" name="portal_id" id="portal_id" placeholder="Portal Id" value="<?php echo $portal_id; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">User Id <?php echo form_error('user_id') ?></label>
            <input type="text" class="form-control" name="user_id" id="user_id" placeholder="User Id" value="<?php echo $user_id; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Rules Name <?php echo form_error('rules_name') ?></label>
            <input type="text" class="form-control" name="rules_name" id="rules_name" placeholder="Rules Name" value="<?php echo $rules_name; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Description <?php echo form_error('description') ?></label>
            <input type="text" class="form-control" name="description" id="description" placeholder="Description" value="<?php echo $description; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Cu <?php echo form_error('cu') ?></label>
            <input type="text" class="form-control" name="cu" id="cu" placeholder="Cu" value="<?php echo $cu; ?>" />
        </div>
	    <div class="form-group">
            <label for="datetime">Cd <?php echo form_error('cd') ?></label>
            <input type="text" class="form-control" name="cd" id="cd" placeholder="Cd" value="<?php echo $cd; ?>" />
        </div>
	    <input type="hidden" name="rules_id" value="<?php echo $rules_id; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('com_rules') ?>" class="btn btn-default">Cancel</a>
	</form>
    </body>
</html>