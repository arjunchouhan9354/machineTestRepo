    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="<?=base_url('admin/logout')?>">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <?= script_tag("public/assets/vendor/jquery/jquery.min.js") ?>
    <?= script_tag("public/assets/vendor/bootstrap/js/bootstrap.bundle.min.js") ?>


    <!-- Core plugin JavaScript-->
    <?= script_tag("public/assets/vendor/jquery-easing/jquery.easing.min.js") ?>

    <!-- Custom scripts for all pages-->
    <?= script_tag("public/assets/js/sb-admin-2.min.js") ?>

    <?= script_tag("public/assets/vendor/datatables/jquery.dataTables.min.js") ?>
    <?= script_tag("public/assets/vendor/datatables/dataTables.bootstrap4.min.js") ?>
    <script type="text/javascript">
        // Call the dataTables jQuery plugin
        $(document).ready(function() {
          $('#dataTable').DataTable();
        });

    </script>
</body>

</html>