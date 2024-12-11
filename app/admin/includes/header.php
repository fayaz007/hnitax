<?php require '../config/database.php'; ?>
<?php require '../config/theme_settings.php'; ?>

<?php
require_once '../middleware/authMiddleware.php';

// Call the middleware function to check if the user is logged in
checkLoggedInUser();

// Check if the user has the "Admin" role
checkUserRole(['Admin']);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= APP_NAME ?> | <?= isset($current_page) ? $current_page : "Dashboard"; ?></title>

    <link rel="shortcut icon" href="<?= BASE_URL ?>assets/uploads/logos/favicon.ico" type="image/x-icon">
    <link rel="icon" href="<?= BASE_URL ?>assets/uploads/logos/favicon.ico" type="image/x-icon">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/plugins/summernote/summernote-bs4.min.css">

    <!-- dropzonejs FilePondjs -->
    <!-- <link rel="stylesheet" href="<?= BASE_URL ?>assets/plugins/dropzone/min/dropzone.min.css"> -->
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/plugins/File_Pond_uploader/filepond-plugin-image-preview.min.css">

    <link rel="stylesheet" href="<?= BASE_URL ?>assets/plugins/File_Pond_uploader/filepond.min.css">

    <!-- DataTables -->
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

    <!-- Select2 -->
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/plugins/toastr/toastr.min.css">

    <link rel="stylesheet" href="<?= BASE_URL ?>assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">

    <link rel="stylesheet" href="<?= BASE_URL ?>assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <?php require('css/custom_styles.php')  ?>
    <link rel="stylesheet" href="includes/css/style-dashboard.css">


</head>
<!-- sidebar-collapse -->

<body class="hold-transition sidebar-mini layout-fixed ">
    <div class="wrapper">
        <!-- Your HTML content here -->
    </div>