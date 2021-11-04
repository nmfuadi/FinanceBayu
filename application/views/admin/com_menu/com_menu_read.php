<link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css'); ?>"/>
<div id="wrapper">
         <?php echo $SIDEBAR; ?>

<div class="page-wrapper">
<div class="container-fluid">
<div class="row">
<div class="col-lg-12">
<div class="white-box"> 

<h2 style="margin-top:0px">Com_menu Read</h2>
        <table class="table">
	    <tr><td>Rules Id</td><td><?php echo $rules_id; ?></td></tr>
	    <tr><td>Parent Id</td><td><?php echo $parent_id; ?></td></tr>
	    <tr><td>Menu Name</td><td><?php echo $menu_name; ?></td></tr>
	    <tr><td>Description</td><td><?php echo $description; ?></td></tr>
	    <tr><td>Number</td><td><?php echo $number; ?></td></tr>
	    <tr><td>Url</td><td><?php echo $url; ?></td></tr>
	    <tr><td>Is Active</td><td><?php echo $is_active; ?></td></tr>
	    <tr><td>Cu</td><td><?php echo $cu; ?></td></tr>
	    <tr><td>Cd</td><td><?php echo $cd; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('admin/com_menu') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>



</div>
</div>
</div>
</div>
</div>
</div>
        
        