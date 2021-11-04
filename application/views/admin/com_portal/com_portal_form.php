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
        <h2 style="margin-top:0px">Com_portal <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="varchar">Portal Name <?php echo form_error('portal_name') ?></label>
            <input type="text" class="form-control" name="portal_name" id="portal_name" placeholder="Portal Name" value="<?php echo $portal_name; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Portal Des <?php echo form_error('portal_des') ?></label>
            <input type="text" class="form-control" name="portal_des" id="portal_des" placeholder="Portal Des" value="<?php echo $portal_des; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Is Active <?php echo form_error('is_active') ?></label>
            <input type="text" class="form-control" name="is_active" id="is_active" placeholder="Is Active" value="<?php echo $is_active; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Cu <?php echo form_error('cu') ?></label>
            <input type="text" class="form-control" name="cu" id="cu" placeholder="Cu" value="<?php echo $cu; ?>" />
        </div>
	    <div class="form-group">
            <label for="datetime">Cd <?php echo form_error('cd') ?></label>
            <input type="text" class="form-control" name="cd" id="cd" placeholder="Cd" value="<?php echo $cd; ?>" />
        </div>
	    <input type="hidden" name="portal_id" value="<?php echo $portal_id; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('com_portal') ?>" class="btn btn-default">Cancel</a>
	</form>
    </body>
</html>