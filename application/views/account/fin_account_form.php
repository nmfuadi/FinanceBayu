<div id="wrapper">
    <div class="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="white-box">
                    <?php echo $this->session->userdata('message') <> '' ? '<div class="alert '.$this->session->userdata('status').'">
					
                    '.$this->session->userdata('message').'
                 </div>' : ''; ?>
                        <h2 style="margin-top:0px">Fin_account <?php echo $button ?></h2>
                        <form action="<?php echo $action; ?>" method="post" class="form-horizontal">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Account Code <?php echo form_error('code_acc') ?></label>
                                        <div class="col-md-6">
                                            <input class="form-control" type="text" name="code_acc" value="<?php echo $code_acc; ?>" minlength="5" maxlength="5" />
                                        </div>
                                    </div>
                                </div>


                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">Tipe Mutasi </label>
                                                        <div class="col-md-9">
                                                            <select  name="trx_type" class="form-control">
                                                            <option value="CR" <?php echo $trx_type == 'CR' ? 'selected': '' ?>>Credit</option>
                                                            <option value="DB" <?php echo $trx_type =='DB' ? 'selected': '' ?>>Debit</option>
                                                                
                                                                
                                                            </select> </div>
                                                    </div>
                                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Account Name <?php echo form_error('account_name') ?></label>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" name="account_name" id="account_name" placeholder="Account Name" value="<?php echo $account_name; ?>" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="col-md-6">
                                        <input type="hidden" name="code" value="<?php echo $code; ?>" />
                                        <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
                                        <a href="<?php echo site_url('Report/Account') ?>" class="btn btn-default">Cancel</a>
                                    </div>
                                </div>
                            </div>




                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>