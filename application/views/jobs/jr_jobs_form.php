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
        <h2 style="margin-top:0px">Jr_jobs <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="int">Jobs Code <?php echo form_error('jobs_code') ?></label>
            <input type="text" class="form-control" name="jobs_code" id="jobs_code" placeholder="Jobs Code" value="<?php echo $jobs_code; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Kry Id <?php echo form_error('kry_id') ?></label>
            <input type="text" class="form-control" name="kry_id" id="kry_id" placeholder="Kry Id" value="<?php echo $kry_id; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Jobs Tittle <?php echo form_error('jobs_tittle') ?></label>
            <input type="text" class="form-control" name="jobs_tittle" id="jobs_tittle" placeholder="Jobs Tittle" value="<?php echo $jobs_tittle; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Jobs Desc <?php echo form_error('jobs_desc') ?></label>
            <input type="text" class="form-control" name="jobs_desc" id="jobs_desc" placeholder="Jobs Desc" value="<?php echo $jobs_desc; ?>" />
        </div>
	    <div class="form-group">
            <label for="enum">Jobs Stat <?php echo form_error('jobs_stat') ?></label>
            <input type="text" class="form-control" name="jobs_stat" id="jobs_stat" placeholder="Jobs Stat" value="<?php echo $jobs_stat; ?>" />
        </div>
	    <div class="form-group">
            <label for="date">Jobs Date <?php echo form_error('jobs_date') ?></label>
            <input type="text" class="form-control" name="jobs_date" id="jobs_date" placeholder="Jobs Date" value="<?php echo $jobs_date; ?>" />
        </div>
	    <div class="form-group">
            <label for="enum">Jobs Week <?php echo form_error('jobs_week') ?></label>
            <input type="text" class="form-control" name="jobs_week" id="jobs_week" placeholder="Jobs Week" value="<?php echo $jobs_week; ?>" />
        </div>
	    <div class="form-group">
            <label for="datetime">Cr Dt <?php echo form_error('cr_dt') ?></label>
            <input type="text" class="form-control" name="cr_dt" id="cr_dt" placeholder="Cr Dt" value="<?php echo $cr_dt; ?>" />
        </div>
	    <div class="form-group">
            <label for="datetime">Cr Up <?php echo form_error('cr_up') ?></label>
            <input type="text" class="form-control" name="cr_up" id="cr_up" placeholder="Cr Up" value="<?php echo $cr_up; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">U Cr <?php echo form_error('u_cr') ?></label>
            <input type="text" class="form-control" name="u_cr" id="u_cr" placeholder="U Cr" value="<?php echo $u_cr; ?>" />
        </div>
	    <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('jobs') ?>" class="btn btn-default">Cancel</a>
	</form>
    </body>
</html>