<?php
$current_page = "Payment"; // Set the current page title
require('includes/header.php');
?>
<style>
    .table-estimates th, .table-estimates td {
        text-align: center;
        vertical-align: middle;
    }

    .curve-card {
        border-radius: 15px;
    }

    .table thead th {
        border-bottom: 2px solid #dee2e6;
        color: white;
        background-color: #6c757d;
    }

    .table tbody tr:hover {
        background-color: #f1f1f1;
    }

    .breadcrumb-item a {
        color: #007bff;
    }

    .pay-button {
        background-color: #007bff;
        color: white;
        border-radius: 5px;
        padding: 10px 20px;
        text-align: center;
        display: inline-block;
        font-size: 18px;
        font-weight: bold;
    }

    .pay-button:hover {
        background-color: #0056b3;
        color: white;
        text-decoration: none;
    }
</style>

<!-- Navbar -->
<?php require('includes/navbar.php'); ?>
<!-- /.navbar -->

<!-- Main Sidebar Container -->
<?php require('includes/sidebar.php'); ?>
<!-- /.sidebar -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><?= $current_page ?></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active"><?= $current_page ?></li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card curve-card card-dark">
                        <div class="card-header curve-card">
                            <h3 class="card-title"><i class="fas fa-credit-card"></i> Make a Payment</h3>
                        </div>
                        <div class="card-body">
                            <p class="text-center">To complete your payment, please click the button below:</p>
                            <div class="text-center">
                                <a href="https://www.hnitax.com/paynow/" target="_blank" class="pay-button">Pay Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php require('includes/footer.php'); ?>
