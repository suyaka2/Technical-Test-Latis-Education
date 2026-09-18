</div>
 
 <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Muhamamad Rafli Suyaka Bintoro 2026</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    >

    <!-- Bootstrap core JavaScript-->
    <script src="/assets/vendor/jquery/jquery.min.js"></script>
    <script src="/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="/assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="/assets/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="/assets/vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="/assets/js/demo/chart-area-demo.js"></script>
    <script src="/assets/js/demo/chart-pie-demo.js"></script>

    <!-- <script src="https://cdn.datatables.net/v/dt/dt-3.0.4/datatables.min.js" ></script> -->
         <!-- Page level plugins -->
    <!-- <script src="/assets/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="/assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <script src="/assets/js/demo/datatables-demo.js"></script> -->



<script src="https://cdn.datatables.net/v/bs4/jszip-3.10.1/dt-3.0.4/b-4.0.3/datatables.min.js" integrity="sha384-OJ+GvvML0QusJFVm/rpK/CJTN1D0RHNgbJOKW1yEZOcN1eTeIlq04VwxsPYdYnYt" crossorigin="anonymous"></script>
<script src="/assets/js/js/sweetalert2.min.js"></script>

<?php if (session()->getFlashdata('success')) : ?>
	<script type="text/javascript">
		$(document).ready(function() {
			swal("Success!", "<?php echo $_SESSION['success'] ?>", "success");
		});
	</script>
<?php endif; ?>
<?php if (session()->getFlashdata('error')) : ?>
	<script type="text/javascript">
		$(document).ready(function() {
			swal("Sorry!", "<?php echo $_SESSION['error'] ?>", "error");
		});
	</script>
<?php endif; ?>
<?php if (session()->getFlashdata('warning')) : ?>
	<script type="text/javascript">
		$(document).ready(function() {
			swal("Warning!", "<?php echo $_SESSION['warning'] ?>", "warning");
		});
	</script>
<?php endif; ?>
<?php if (session()->getFlashdata('info')) : ?>
	<script type="text/javascript">
		$(document).ready(function() {
			swal("Info!", "<?php echo $_SESSION['info'] ?>", "info");
		});
	</script>
<?php endif; ?>	

<script>
    $(document).ready(function() {
     
        var tabelSiswa = $('#myTable').DataTable({
            layout: {
                topStart: {
                    buttons: [
                {
                    extend: 'excel',
                    // Ini kuncinya: Cuma export kolom index 0 sampai 4 (No, Nama, NIS, Email, Lembaga)
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4] 
                    }
                }
            ]
                }
            },
            columnDefs: [
                { 
               
                    targets: [0, 3, 5, 6], 
                    searchable: false 
                }
            ]
        });

   
        $('#filterLembaga').on('change', function () {
            tabelSiswa.column(4).search(this.value).draw();
        });
    });
</script>

</body>

</html>