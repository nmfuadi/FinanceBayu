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
        <h2>Jr_jobs List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Jobs Code</th>
		<th>Kry Id</th>
		<th>Jobs Tittle</th>
		<th>Jobs Desc</th>
		<th>Jobs Stat</th>
		<th>Jobs Date</th>
		<th>Jobs Week</th>
		<th>Cr Dt</th>
		<th>Cr Up</th>
		<th>U Cr</th>
		
            </tr><?php
            foreach ($jobs_data as $jobs)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $jobs->jobs_code ?></td>
		      <td><?php echo $jobs->kry_id ?></td>
		      <td><?php echo $jobs->jobs_tittle ?></td>
		      <td><?php echo $jobs->jobs_desc ?></td>
		      <td><?php echo $jobs->jobs_stat ?></td>
		      <td><?php echo $jobs->jobs_date ?></td>
		      <td><?php echo $jobs->jobs_week ?></td>
		      <td><?php echo $jobs->cr_dt ?></td>
		      <td><?php echo $jobs->cr_up ?></td>
		      <td><?php echo $jobs->u_cr ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>