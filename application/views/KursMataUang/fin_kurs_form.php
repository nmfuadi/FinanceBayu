<div id="wrapper">
    <div class="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="white-box">
                        <h2 style="margin-top:0px">Fin_kurs <?php echo $button ?></h2>
                        <form action="<?php echo $action; ?>" method="post">

                            <div class="form-group">
                                <label for="varchar">Kurs<?php echo form_error('kurs_code') ?></label>

                                <select name="kurs_code" class="form-control">
                                    <?php if (!empty($kurs)) {
                                        foreach ($kurs as $kurs) {
                                    ?>
                                            <option value="<?php echo $kurs['kurs_code'] ?>" <?php echo  $kurs['kurs_code'] == $kurs_code ? 'selected' : '' ?>><?php echo $kurs['kurs_code'] ?></option>
                                    <?php }
                                    } ?>

                                </select>
                            </div>

                            <div class="form-group">
                                <label for="double">Kurs Amount <?php echo form_error('kurs_amount') ?></label>
                                <input type="number" class="form-control" name="kurs_amount" id="kurs_amount" placeholder="Kurs Amount" value="<?php echo $kurs_amount; ?>" />
                            </div>
                            <div class="form-group">
                                <label for="date">Kurs Date <?php echo form_error('kurs_date') ?></label>
                                <input type="date" class="form-control" name="kurs_date" id="kurs_date" placeholder="Kurs Date" value="<?php echo $kurs_date; ?>" />
                            </div>
 
                            <input type="hidden" name="id" value="<?php echo $id; ?>" />
                            <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
                            <a href="<?php echo site_url('Report/KursMataUang') ?>" class="btn btn-default">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
