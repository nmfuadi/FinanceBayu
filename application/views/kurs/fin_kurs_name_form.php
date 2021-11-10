<div id="wrapper">
    <div class="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="white-box">
                        <h2 style="margin-top:0px">Fin_kurs_name <?php echo $button ?></h2>
                        <form action="<?php echo $action; ?>" method="post">
                        <div class="form-group">
                                <label for="varchar">Kurs mata uang <?php echo form_error('Kurs') ?></label>
                                <input type="text" class="form-control" name="kurs" id="Kurs" placeholder="IDR" value="<?php echo $kurs; ?>" />
                            </div>
                            <div class="form-group">
                                <label for="varchar">Keterangan <?php echo form_error('Kurs_det') ?></label>
                                <input type="text" class="form-control" name="Kurs_det" id="Kurs_det" placeholder="Rupiah" value="<?php echo $Kurs_det; ?>" />
                            </div>
                            <input type="hidden" name="kurs_code" value="<?php echo $kurs_code; ?>" />
                            <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
                            <a href="<?php echo site_url('Report/kurs') ?>" class="btn btn-default">Cancel</a>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>