</div>
</section>

</div>

<footer class="main-footer">
    <strong>Copyright &copy;  2022 <a href="#">IORS Admin Panel</a>.</strong>
    All rights reserved.

</footer>


<aside class="control-sidebar control-sidebar-dark">

</aside>
</div>

<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<script src="dist/js/adminlte.js"></script>
<script src="dist/js/demo.js"></script>
<script src="dist/js/pages/dashboard.js"></script>
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="plugins/jszip/jszip.min.js"></script>
<script src="plugins/pdfmake/pdfmake.min.js"></script>
<script src="plugins/pdfmake/vfs_fonts.js"></script>
<script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>



<script>
    $(function () {
        $('#tabletest').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
        });
        $("#example1").DataTable({
            "ordering": true,
            "lengthChange": true,
            "autoWidth": false,
            "buttons": [{
                extend:'pdf',
                className:'btn-info',
                text:'Save as PDF',
                title:'IORS Audit Log',
             /* download:'open', open in new tab
                exportOptions:{
                    modifier:{
                        page:'current' download current page only
                    }
                }*/
            }
            ],
            "responsive": true,
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $("#example2").DataTable({
            "ordering": true,
            "lengthChange": true,
            "autoWidth": false,
            "buttons": [{
                extend:'pdf',
                className:'btn-info',
                text:'Save as PDF',
                title:'IORS User Information Log',
             /* download:'open', open in new tab
                exportOptions:{
                    modifier:{
                        page:'current' download current page only
                    }
                }*/
            }
            ],
            "responsive": true,
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
        }).buttons().container().appendTo('#example2_wrapper .col-md-6:eq(0)');
    });
</script>
</body>
</html>
