
            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2021</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

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
            <div class="modal-body text-center">
                Select "Logout" below if you are ready to end your current session.<br/>
                <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 15rem;" src="<?php echo base_url().'assets/logout.jpg'; ?>">
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="<?php echo base_url(); ?>logout">Logout</a>
            </div>
        </div>
    </div>
</div>

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Bootstrap core JavaScript-->
    <script src="<?php echo base_url(); ?>assets/sb2/vendor/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/sb2/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?php echo base_url(); ?>assets/sb2/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?php echo base_url(); ?>assets/sb2/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="<?php echo base_url(); ?>assets/sb2/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/sb2/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- jquery.qrcode.js -->
    <script src="<?php echo base_url(); ?>assets/sb2/vendor/jquery/jquery.qrcode.min.js"></script>
    <!-- Page level custom scripts -->

    <script type="text/javascript">
        var windowURL = window.location.href;
        let today = new Date();
        function convertToRupiah(amount){
        return new Intl.NumberFormat("id-ID", {
            currency: "IDR"
        }).format(amount);
        }
        pageURL = windowURL.substring(0, windowURL.lastIndexOf('/'));
        $('a.nav-link, a.collapse-item').each(function() {
            var link = $(this).attr('href');
            if (link === windowURL || link === pageURL) {
                $(this).addClass('active');
                $(this).parent().addClass('active');
                $(this).closest('.collapse').addClass('show');
                $(this).closest('.nav-item').addClass('active');
            }
        });
        function notifInput(type, wording) {
            let html = `<div class="row hide">
                            <div class="col-md-12" id='infoProses'>
                                <div class="alert alert-${type} alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    ${wording}
                                </div>
                            </div>
                        </div>`;
            $('#notif').html(html);
        }
        // function sleep(ms) {
        //     return new Promise(resolve => setTimeout(resolve, ms));
        // }

        // async function jeda() {
        //     console.log("Mulai");

        //     await sleep(2000); // Tidur selama 2 detik

        //     console.log("Setelah 2 detik");
        // }
    </script>
</body>

</html>