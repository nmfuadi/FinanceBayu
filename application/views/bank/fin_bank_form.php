<div id="wrapper">
    <div class="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="white-box">
                        <?php echo $this->session->userdata('message') <> '' ? '<div class="alert ' . $this->session->userdata('status') . '">
					
                    ' . $this->session->userdata('message') . '
                 </div>' : ''; ?>
                        <h2 style="margin-top:0px">Fin_bank <?php echo $button ?></h2>
                        <form action="<?php echo $action; ?>" method="post">
                            <div class="form-group">
                                <label for="varchar">Bank Name <?php echo form_error('bank_name') ?></label>
                                <input type="text" class="form-control" name="bank_name" id="bank_name" placeholder="Bank Name" value="<?php echo $bank_name; ?>" />
                            </div>
                            <div class="form-group">
                                <label for="char">Branch <?php echo form_error('branch') ?></label>
                                <input type="text" class="form-control" name="branch" id="branch" placeholder="Branch" value="<?php echo $branch; ?>" />
                            </div>


                            <div class="form-group">
                                <label for="varchar">Kurs<?php echo form_error('currency_code') ?></label>

                                <select name="currency_code" class="form-control">
                                    <?php if (!empty($kurs)) {
                                        foreach ($kurs as $kurs) {
                                    ?>
                                            <option value="<?php echo $kurs['kurs_code'] ?>" <?php echo  $kurs['kurs_code'] == $currency_code ? 'selected' : '' ?>><?php echo $kurs['kurs_code'] ?></option>
                                    <?php }
                                    } ?>

                                </select>
                            </div>


                            <div class="form-group">
                                <label for="varchar">Bank Norek <?php echo form_error('bank_norek') ?></label>
                                <input type="text" class="form-control" name="bank_norek" id="bank_norek" placeholder="Bank Norek" value="<?php echo $bank_norek; ?>" />
                            </div>
                            <div class="form-group">
                                <label for="varchar">Bank Rek Name <?php echo form_error('bank_rek_name') ?></label>
                                <input type="text" class="form-control" name="bank_rek_name" id="bank_rek_name" placeholder="Bank Rek Name" value="<?php echo $bank_rek_name; ?>" />
                            </div>
                            <div class="form-group">
                                <label for="char">G/L Account <?php echo form_error('gl_account') ?></label>
                                <input type="text" class="form-control" name="gl_account" id="gl_account" placeholder="G/L Account" value="<?php echo $gl_account; ?>" />
                            </div>

                            <input type="hidden" name="id" value="<?php echo $id; ?>" />
                            <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
                            <a href="<?php echo site_url('Report/Bank') ?>" class="btn btn-default">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>