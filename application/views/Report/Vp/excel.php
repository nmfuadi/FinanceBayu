<?php 
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Report_$dd");
echo $html;
?>