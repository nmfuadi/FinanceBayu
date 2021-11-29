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
        <h2 style="margin-top:0px">Fin_saldo <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="int">Bank Id <?php echo form_error('bank_id') ?></label>
            <input type="text" class="form-control" name="bank_id" id="bank_id" placeholder="Bank Id" value="<?php echo $bank_id; ?>" />
        </div>
	    <div class="form-group">
            <label for="char">Currancy <?php echo form_error('currancy') ?></label>
            <input type="text" class="form-control" name="currancy" id="currancy" placeholder="Currancy" value="<?php echo $currancy; ?>" />
        </div>
	    <div class="form-group">
            <label for="float">Amount <?php echo form_error('amount') ?></label>
            <input type="text" class="form-control" name="amount" id="amount" placeholder="Amount" value="<?php echo $amount; ?>" />
        </div>
	    <div class="form-group">
            <label for="float">Original Amount <?php echo form_error('original_amount') ?></label>
            <input type="text" class="form-control" name="original_amount" id="original_amount" placeholder="Original Amount" value="<?php echo $original_amount; ?>" />
        </div>
	    <div class="form-group">
            <label for="date">Trx Date <?php echo form_error('trx_date') ?></label>
            <input type="text" class="form-control" name="trx_date" id="trx_date" placeholder="Trx Date" value="<?php echo $trx_date; ?>" />
        </div>
	    <div class="form-group">
            <label for="datetime">Input Date <?php echo form_error('input_date') ?></label>
            <input type="text" class="form-control" name="input_date" id="input_date" placeholder="Input Date" value="<?php echo $input_date; ?>" />
        </div>
	    <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('saldoawal') ?>" class="btn btn-default">Cancel</a>
	</form>
    </body>
</html>