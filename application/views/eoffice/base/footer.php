<!-- jQuery -->
<script src="<?= $path; ?>plugins/components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="<?= $path; ?>bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- Menu Plugin JavaScript -->
    <script src="<?= $path; ?>js/sidebarmenu.js"></script>
    <!--slimscroll JavaScript -->
    <script src="<?= $path; ?>js/jquery.slimscroll.js"></script>
    <!--Wave Effects -->
    <script src="<?= $path; ?>js/waves.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="<?= $path; ?>js/custom.js"></script>
    <!--Morris JavaScript -->
    <script src="<?= $path; ?>plugins/components/raphael/raphael-min.js"></script>
    <script src="<?= $path; ?>plugins/components/morrisjs/morris.js"></script>
    <script src="<?= $path; ?>js/morris-data.js"></script>
    <!--Style Switcher -->
	<script src="<?= $path; ?>plugins/components/bootstrap-table/dist/bootstrap-table.min.js"></script>
    <script src="<?= $path; ?>plugins/components/bootstrap-table/dist/bootstrap-table.ints.js"></script>
    <script src="<?= $path; ?>plugins/components/styleswitcher/jQuery.style.switcher.js"></script>
	
	<script src="<?= $path; ?>plugins/components/datatables/jquery.dataTables.min.js"></script>
    <!-- start - This is for export functionality only -->
    <script src="<?= $path; ?>plugins/components/cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
    <script src="<?= $path; ?>plugins/componentscdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
    <script src="<?= $path; ?>plugins/componentscdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script src="<?= $path; ?>plugins/componentscdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
    <script src="<?= $path; ?>plugins/componentscdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
    <script src="<?= $path; ?>plugins/componentscdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
    <script src="<?= $path; ?>plugins/componentscdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>

	<script>
		$(function() {

    "use strict";

    // Dashboard 1 Morris-chart	
	
	<?php echo $chart_garis; ?>
	<?php echo $source; ?>
	
	
	<?php echo $custSource; ?>
	<?php echo $konvAll; ?>
	
	

<?= $LOAD_BOTTOM_JS; ?>

</body>

</html>