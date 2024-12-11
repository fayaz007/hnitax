<?php $current_page = "Admin Dashboard"; // Set the current page title
require('includes/header.php'); ?>
<!-- Preloader -->
<div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="../assets/uploads/logos/<?= !empty(APP_LOGO_PATH) ? APP_LOGO_PATH : "logo-placeholder.png" ?>" alt="App logo" width="360">
</div>
<!-- Navbar -->
<?php require('includes/navbar.php');  ?>
<!-- /.navbar -->
<!-- Main Sidebar Container -->
<?php require('includes/sidebar.php');  ?>
<!-- /.sidebar -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2 ">
                <div class="col-sm-12">
                    <h1 class="m-0"><?= $current_page ?></h1>
                </div><!-- /.col -->
                <!-- <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active"><?= $current_page ?></li>
                    </ol>
                </div> -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <?php

    require('dashboard_content.php');
    ?>
    <!--end Main content -->

</div>
<!-- /.content-wrapper -->

<?php require('includes/footer.php');  ?>
<?php require('assets_modal.php');  ?>


<script src="ajax/delete_job.js"></script>
<script src="ajax/manage_job.js"></script>