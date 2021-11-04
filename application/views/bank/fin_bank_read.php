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
        <h2 style="margin-top:0px">Fin_bank Read</h2>
        <table class="table">
	    <tr><td>Bank Name</td><td><?php echo $bank_name; ?></td></tr>
	    <tr><td>Bank Code</td><td><?php echo $bank_code; ?></td></tr>
	    <tr><td>Bank Norek</td><td><?php echo $bank_norek; ?></td></tr>
	    <tr><td>Bank Rek Name</td><td><?php echo $bank_rek_name; ?></td></tr>
	    <tr><td>Cr Dt</td><td><?php echo $cr_dt; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('bank') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>