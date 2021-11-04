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
        <h2 style="margin-top:0px">Jr_jobs_update <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="int">Jobs Id <?php echo form_error('jobs_id') ?></label>
            <input type="text" class="form-control" name="jobs_id" id="jobs_id" placeholder="Jobs Id" value="<?php echo $jobs_id; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Kry Id <?php echo form_error('kry_id') ?></label>
            <input type="text" class="form-control" name="kry_id" id="kry_id" placeholder="Kry Id" value="<?php echo $kry_id; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Jobs Up Descr <?php echo form_error('jobs_up_descr') ?></label>
            <input type="text" class="form-control" name="jobs_up_descr" id="jobs_up_descr" placeholder="Jobs Up Descr" value="<?php echo $jobs_up_descr; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Pic <?php echo form_error('pic') ?></label>
            <input type="text" class="form-control" name="pic" id="pic" placeholder="Pic" value="<?php echo $pic; ?>" />
        </div>
	    <div class="form-group">
            <label for="enum">Job Up St <?php echo form_error('job_up_st') ?></label>
            <input type="text" class="form-control" name="job_up_st" id="job_up_st" placeholder="Job Up St" value="<?php echo $job_up_st; ?>" />
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
	    <a href="<?php echo site_url('jobsupdaate') ?>" class="btn btn-default">Cancel</a>
	</form>
    </body>
</html>