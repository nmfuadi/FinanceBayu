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
        <h2 style="margin-top:0px">Com_user <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="varchar">Username <?php echo form_error('username') ?></label>
            <input type="text" class="form-control" name="username" id="username" placeholder="Username" value="<?php echo $username; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Passwords <?php echo form_error('passwords') ?></label>
            <input type="text" class="form-control" name="passwords" id="passwords" placeholder="Passwords" value="<?php echo $passwords; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Surename <?php echo form_error('surename') ?></label>
            <input type="text" class="form-control" name="surename" id="surename" placeholder="Surename" value="<?php echo $surename; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Email <?php echo form_error('email') ?></label>
            <input type="text" class="form-control" name="email" id="email" placeholder="Email" value="<?php echo $email; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Level <?php echo form_error('level') ?></label>
            <input type="text" class="form-control" name="level" id="level" placeholder="Level" value="<?php echo $level; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Is Active <?php echo form_error('is_active') ?></label>
            <input type="text" class="form-control" name="is_active" id="is_active" placeholder="Is Active" value="<?php echo $is_active; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Uc <?php echo form_error('uc') ?></label>
            <input type="text" class="form-control" name="uc" id="uc" placeholder="Uc" value="<?php echo $uc; ?>" />
        </div>
	    <div class="form-group">
            <label for="datetime">Dc <?php echo form_error('dc') ?></label>
            <input type="text" class="form-control" name="dc" id="dc" placeholder="Dc" value="<?php echo $dc; ?>" />
        </div>
	    <input type="hidden" name="id_user" value="<?php echo $id_user; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('com_user') ?>" class="btn btn-default">Cancel</a>
	</form>
    </body>
</html>