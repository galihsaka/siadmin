<!DOCTYPE html>
<html lang="en">

<head>

    <?php $this->load->view($head); ?>
  
</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <?php $this->load->view($sidebar); ?>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <?php $this->load->view($navbar); ?>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">Blank Page</h1>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <?php $this->load->view($footer) ?>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <?php $this->load->view($scrolltop) ?>

  <!-- Logout Modal-->
  <?php $this->load->view($modal) ?>

  <!-- Javascript Bootstrap & Core Plugin-->
  <?php $this->load->view($core_js) ?>

  <!-- Custom scripts for all pages-->
  <?php $this->load->view($custom_js) ?>

</body>

</html>
