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
        <h2 style="margin-top:0px">Fin_saldo Read</h2>
        <table class="table">
	    <tr><td>Bank Id</td><td><?php echo $bank_id; ?></td></tr>
	    <tr><td>Currancy</td><td><?php echo $currancy; ?></td></tr>
	    <tr><td>Amount</td><td><?php echo $amount; ?></td></tr>
	    <tr><td>Original Amount</td><td><?php echo $original_amount; ?></td></tr>
	    <tr><td>Trx Date</td><td><?php echo $trx_date; ?></td></tr>
	    <tr><td>Input Date</td><td><?php echo $input_date; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('saldoawal') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>