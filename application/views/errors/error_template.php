<!-- Begin Page Content -->

<div class="container-fluid">

    <!-- 404 Error Text -->
    <div class="text-center">
        <div class="error mx-auto" data-text="<?= $error_code ?>"><?= $error_code ?></div>
        <p class="lead text-gray-800 mb-5"><?= $error_message ?></p>
        <p class="text-gray-500 mb-0">It looks like you found a glitch in the matrix...</p>
        <a href="<?php echo base_url('home') ?>">&larr; Back to Dashboard</a>
    </div>

</div>
<!-- /.container-fluid -->