
</div>
<!--end of main content-->
<!-- Footer -->
<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy; <?php echo SITE_NAME ?> 2019</span>
            <span>Page rendered in <strong>{elapsed_time}</strong> seconds.</span>
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

<!-- Logout Modal-->
<?php $this->load->view('_partials/logout_modal') ?>
<!-- Bootstrap core JavaScript-->

<script src="<?php echo base_url('assets/bootstrap/js/bootstrap.bundle.min.js') ?> "></script>

<!-- Core plugin JavaScript-->



<!-- Custom scripts for all pages-->
<script src="<?php echo base_url('js/sb-admin-2.min.js') ?>"></script>
<!-- Page level plugins -->
<?php
if (empty($plugins) != true) {
    foreach ($plugins as $component) {
        $this->load->view('js_plugins/' . $component);
    }
}

?>
</body>

</html>
