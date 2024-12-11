<footer class="main-footer">
    <strong>&copy;<?php echo date("Y"); ?> <a class="text-dark" href="<?= !empty(FOOTER_LABLE_LINKS) ? FOOTER_LABLE_LINKS : "#" ?>"><?= !empty(FOOTER_LABLE) ? FOOTER_LABLE : "Company Name" ?></a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 1.0.0
    </div>
</footer>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->

</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="<?= BASE_URL ?>assets/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?= BASE_URL ?>assets/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="<?= BASE_URL ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<!-- <script src="<?= BASE_URL ?>assets/plugins/chart.js/Chart.min.js"></script> -->
<!-- Sparkline -->
<!-- <script src="<?= BASE_URL ?>assets/plugins/sparklines/sparkline.js"></script> -->
<!-- JQVMap -->
<!-- <script src="<?= BASE_URL ?>assets/plugins/jqvmap/jquery.vmap.min.js"></script> -->
<!-- <script src="<?= BASE_URL ?>assets/plugins/jqvmap/maps/jquery.vmap.usa.js"></script> -->
<!-- jQuery Knob Chart -->
<!-- <script src="<?= BASE_URL ?>assets/plugins/jquery-knob/jquery.knob.min.js"></script> -->



<!-- daterangepicker -->
<script src="<?= BASE_URL ?>assets/plugins/moment/moment.min.js"></script>
<script src="<?= BASE_URL ?>assets/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?= BASE_URL ?>assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="<?= BASE_URL ?>assets/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?= BASE_URL ?>assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= BASE_URL ?>assets/dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<!-- <script src="<?= BASE_URL ?>assets/dist/js/demo.js"></script> -->
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?= BASE_URL ?>assets/dist/js/pages/dashboard.js"></script>

<!-- jquery-validation -->
<script src="<?= BASE_URL ?>assets/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="<?= BASE_URL ?>assets/plugins/jquery-validation/additional-methods.min.js"></script>

<!-- <script src="<?= BASE_URL ?>/admin/includes/js/validation.js"></script> -->

<!-- dropzonejs -->
<!-- <script src="<?= BASE_URL ?>assets/plugins/dropzone/min/dropzone.min.js"></script> -->
<script src="<?= BASE_URL ?>assets/plugins/File_Pond_uploader/filepond-plugin-file-encode.min.js"></script>
<script src="<?= BASE_URL ?>assets/plugins/File_Pond_uploader/filepond-plugin-file-validate-size.min.js"></script>
<script src="<?= BASE_URL ?>assets/plugins/File_Pond_uploader/filepond-plugin-image-exif-orientation.min.js"></script>
<script src="<?= BASE_URL ?>assets/plugins/File_Pond_uploader/filepond-plugin-image-preview.min.js"></script>
<script src="<?= BASE_URL ?>assets/plugins/File_Pond_uploader/filepond-plugin-file-validate-type.js"></script>
<script src="<?= BASE_URL ?>assets/plugins/File_Pond_uploader/filepond.min.js"></script>

<!-- DataTables & Plugins -->
<script src="<?= BASE_URL ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= BASE_URL ?>assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= BASE_URL ?>assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= BASE_URL ?>assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?= BASE_URL ?>assets/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?= BASE_URL ?>assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?= BASE_URL ?>assets/plugins/jszip/jszip.min.js"></script>
<script src="<?= BASE_URL ?>assets/plugins/pdfmake/pdfmake.min.js"></script>
<script src="<?= BASE_URL ?>assets/plugins/pdfmake/vfs_fonts.js"></script>
<script src="<?= BASE_URL ?>assets/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?= BASE_URL ?>assets/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?= BASE_URL ?>assets/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

<!-- Select2 -->
<script src="<?= BASE_URL ?>assets/plugins/select2/js/select2.full.min.js"></script>
<!-- Bootstrap Switch -->
<script src="<?= BASE_URL ?>assets/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>

<script src="<?= BASE_URL ?>assets/plugins/sweetalert2/sweetalert2.min.js"></script>
<script src="<?= BASE_URL ?>assets/plugins/toastr/toastr.min.js"></script>

<script src="<?= BASE_URL ?>assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>

<!-- Page specific script -->
<script>
    $(function() {
        //Initialize Select2 Elements
        $('.select2').select2();

        $("#example1").DataTable({
            "responsive": false,
            "lengthChange": false,
            "autoWidth": false,
            // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });



    });

    $(function() {
        bsCustomFileInput.init();
    });



    $('#jobTable').DataTable({
        "paging": false,
        "lengthChange": false,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": false,
        "order": [
            [1, "desc"]
        ]
    });
</script>



<?php
if (isset($current_page) && $current_page == 'Admin Dashboard') : ?>

    <script src="<?= BASE_URL ?>assets/plugins/jquery-mousewheel/jquery.mousewheel.js"></script>

    <script src="<?= BASE_URL ?>assets/plugins/raphael/raphael.min.js"></script>

    <script src="<?= BASE_URL ?>assets/plugins/jquery-mapael/jquery.mapael.min.js"></script>
    <script src="<?= BASE_URL ?>assets/plugins/jquery-mapael/maps/usa_states.min.js"></script>

    <script src="<?= BASE_URL ?>assets/plugins/chart.js/Chart.min.js"></script>

    <script src="<?= BASE_URL ?>assets/dist/js/pages/dashboard2.js"></script>
    <script src="<?= BASE_URL ?>assets/dist/js/pages/dashboard2.js"></script>


<?php endif; ?>
</body>

</html>