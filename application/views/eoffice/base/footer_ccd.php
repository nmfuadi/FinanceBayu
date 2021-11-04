<!-- jQuery
 <script src='https://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js'></script>  -->
<!-- Bootstrap Core JavaScript -->
<script src="<?= $path; ?>plugins/components/jquery/dist/jquery.min.js"></script>
<script src="<?= $path; ?>bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Menu Plugin JavaScript -->
<script src="<?= $path; ?>js/sidebarmenu.js"></script>
<!-- icheck -->
<script src="<?= $path; ?>plugins/components/icheck/icheck.min.js"></script>
<script src="<?= $path; ?>plugins/components/icheck/icheck.init.js"></script>
<!--slimscroll JavaScript -->
<script src="<?= $path; ?>js/jquery.slimscroll.js"></script>
<!--Wave Effects -->
<script src="<?= $path; ?>js/waves.js"></script>
<!-- Custom Theme JavaScript -->
<script src="<?= $path; ?>js/custom.js"></script>
<script src="<?= $path; ?>plugins/components/datatables/jquery.dataTables.min.js"></script>

 <!--Morris JavaScript -->






 <script>
    $(function() {
        $('#myTable').DataTable();

        var table = $('#example').DataTable({
            "columnDefs": [{
                "visible": false,
                "targets": 2
            }],
            "order": [
                [2, 'asc']
            ],
            "displayLength": 25,
            "drawCallback": function(settings) {
                var api = this.api();
                var rows = api.rows({
                    page: 'current'
                }).nodes();
                var last = null;
                api.column(2, {
                    page: 'current'
                }).data().each(function(group, i) {
                    if (last !== group) {
                        $(rows).eq(i).before('<tr class="group"><td colspan="5">' + group + '</td></tr>');
                        last = group;
                    }
                });
            }
        });
        // Order by the grouping
        $('#example tbody').on('click', 'tr.group', function() {
            var currentOrder = table.order()[0];
            if (currentOrder[0] === 2 && currentOrder[1] === 'asc') {
                table.order([2, 'desc']).draw();
            } else {
                table.order([2, 'asc']).draw();
            }
        });
    });
    $('#example23').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });
    </script>
	
		
	

<?= $LOAD_BOTTOM_JS; ?>

</body>

</html>