<div id="wrapper">
    <div class="page-wrapper">


        <div class="container-fluid">

            <div class="row">
                <div class="col-sm-12">
                    <div class="white-box">
                        <h2 style="margin-top:0px">Fin_kurs_name List</h2>
                        <div class="row" style="margin-bottom: 10px">
                            <div class="col-md-4">
                                <?php echo anchor(site_url('Report/kurs/create'), 'Create', 'class="btn btn-primary"'); ?>
                            </div>
                            <div class="col-md-4 text-center">
                                <div style="margin-top: 8px" id="message">
                                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                                </div>
                            </div>
                            <div class="col-md-1 text-right">
                            </div>
                            <div class="col-md-3 text-right">
                                <form action="<?php echo site_url('Report/kurs/index'); ?>" class="form-inline" method="get">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                                        <span class="input-group-btn">
                                            <?php
                                            if ($q <> '') {
                                            ?>
                                                <a href="<?php echo site_url('Report/kurs'); ?>" class="btn btn-default">Reset</a>
                                            <?php
                                            }
                                            ?>
                                            <button class="btn btn-primary" type="submit">Search</button>
                                        </span>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <table class="table table-bordered" style="margin-bottom: 10px">
                            <tr>
                                <th>No</th>
                                <th>Kurs</th>
                                <th>Keterangan</th>
                                <th>Action</th>
                            </tr><?php
                                    foreach ($kurs_data as $kurs) {
                                    ?>
                                <tr>
                                    <td width="80px"><?php echo ++$start ?></td>
                                    <td><?php echo $kurs->kurs_code ?></td>
                                    <td><?php echo $kurs->Kurs_det ?></td>
                                    <td style="text-align:center" width="200px">
                                        <?php
                                     
                                        echo anchor(site_url('Report/kurs/update/' . $kurs->kurs_code), 'Update');
                                        echo ' | ';
                                        echo anchor(site_url('Report/kurs/delete/' . $kurs->kurs_code), 'Delete', 'onclick="javasciprt: return confirm(\'Are You Sure ?\')"');
                                        ?>
                                    </td>
                                </tr>
                            <?php
                                    }
                            ?>
                        </table>
                        <div class="row">
                            <div class="col-md-6">
                                <a href="#" class="btn btn-primary">Total Record : <?php echo $total_rows ?></a>
                            </div>
                            <div class="col-md-6 text-right">
                                <?php echo $pagination ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>