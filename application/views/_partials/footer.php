
    <!-- Bootstrap core JavaScript-->
    <script src="<?php echo base_url('assets/jquery/jquery-3.3.1.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/bootstrap/js/bootstrap.bundle.min.js') ?> "></script>

    <!-- Core plugin JavaScript-->
    <script src="<?php echo base_url('assets/jquery-easing/jquery.easing.min.js') ?> "></script>


    <!-- Custom scripts for all pages-->
    <script src="<?php echo base_url('js/sb-admin-2.min.js') ?>"></script>
    <!-- Page level plugins -->
    <?php
        if (empty($plugins) != true){
            foreach ($plugins as $component){
                $this->load->view('js_plugins/'.$component);
            }
        }

    ?>
    </body>

</html>
