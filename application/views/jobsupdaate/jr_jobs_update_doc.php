<!doctype html>
<html>
    <head>
        <title>harviacode.com - codeigniter crud generator</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <style>
            .word-table {
                border:1px solid black !important; 
                border-collapse: collapse !important;
                width: 100%;
            }
            .word-table tr th, .word-table tr td{
                border:1px solid black !important; 
                padding: 5px 10px;
            }
        </style>
    </head>
    <body>
        <h2>Jr_jobs_update List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Jobs Id</th>
		<th>Kry Id</th>
		<th>Jobs Up Descr</th>
		<th>Pic</th>
		<th>Job Up St</th>
		<th>Cr Dt</th>
		<th>Cr Up</th>
		<th>U Cr</th>
		
            </tr><?php
            foreach ($jobsupdaate_data as $jobsupdaate)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $jobsupdaate->jobs_id ?></td>
		      <td><?php echo $jobsupdaate->kry_id ?></td>
		      <td><?php echo $jobsupdaate->jobs_up_descr ?></td>
		      <td><?php echo $jobsupdaate->pic ?></td>
		      <td><?php echo $jobsupdaate->job_up_st ?></td>
		      <td><?php echo $jobsupdaate->cr_dt ?></td>
		      <td><?php echo $jobsupdaate->cr_up ?></td>
		      <td><?php echo $jobsupdaate->u_cr ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>