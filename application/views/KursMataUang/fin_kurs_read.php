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
        <h2 style="margin-top:0px">Fin_kurs Read</h2>
        <table class="table">
	    <tr><td>Kurs Code</td><td><?php echo $kurs_code; ?></td></tr>
	    <tr><td>Kurs Amount</td><td><?php echo $kurs_amount; ?></td></tr>
	    <tr><td>Kurs Date</td><td><?php echo $kurs_date; ?></td></tr>
	    <tr><td>Input Date</td><td><?php echo $input_date; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('crurencykurs') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>