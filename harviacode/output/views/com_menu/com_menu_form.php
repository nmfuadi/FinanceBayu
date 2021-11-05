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
        <h2 style="margin-top:0px">Com_menu <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="int">Rules Id <?php echo form_error('rules_id') ?></label>
            <input type="text" class="form-control" name="rules_id" id="rules_id" placeholder="Rules Id" value="<?php echo $rules_id; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Parent Id <?php echo form_error('parent_id') ?></label>
            <input type="text" class="form-control" name="parent_id" id="parent_id" placeholder="Parent Id" value="<?php echo $parent_id; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Menu Name <?php echo form_error('menu_name') ?></label>
            <input type="text" class="form-control" name="menu_name" id="menu_name" placeholder="Menu Name" value="<?php echo $menu_name; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Description <?php echo form_error('description') ?></label>
            <input type="text" class="form-control" name="description" id="description" placeholder="Description" value="<?php echo $description; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Number <?php echo form_error('number') ?></label>
            <input type="text" class="form-control" name="number" id="number" placeholder="Number" value="<?php echo $number; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Url <?php echo form_error('url') ?></label>
            <input type="text" class="form-control" name="url" id="url" placeholder="Url" value="<?php echo $url; ?>" />
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
	    <input type="hidden" name="menu_id" value="<?php echo $menu_id; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('com_menu') ?>" class="btn btn-default">Cancel</a>
	</form>
    </body>
</html>