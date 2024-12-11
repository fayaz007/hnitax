<?php
$current_page = "Tax Estimates"; // Set the current page title
require('includes/header.php');
$user_id = $_SESSION['user_id'] ?? null;

?>
<style>
    .table-estimates th,
    .table-estimates td {
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
    .bg-success-light {
    background-color: #d4edda;
    color: #155724;
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
                            <h3 class="card-title"><i class="fas fa-calculator"></i> Tax Estimates</h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                               <table class="table table-bordered table-estimates">
    <thead>
        <tr>
            <th>Tax Year</th>
            <th>Federal Refund</th>
            <th>State Refund</th>
            <th>City Refund</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $sql = "SELECT estimate_id, tax_year, federal_refund, state_refund, city_refund 
                FROM tax_estimates 
                WHERE user_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                // Apply 'bg-danger' class if the value is negative, 'bg-success-light' if positive
                $federalClass = $row['federal_refund'] < 0 ? 'bg-danger text-white' : 'bg-success-light';
                $stateClass = $row['state_refund'] < 0 ? 'bg-danger text-white' : 'bg-success-light';
                $cityClass = $row['city_refund'] < 0 ? 'bg-danger text-white' : 'bg-success-light';

                // Calculate total refund for the row
                $totalRefund = $row['federal_refund'] + $row['state_refund'] + $row['city_refund'];
                $totalClass = $totalRefund < 0 ? 'bg-danger text-white' : 'bg-success-light';

                echo "<tr>
                    <td>" . htmlspecialchars($row['tax_year']) . "</td>
                    <td class='{$federalClass}'>$" . htmlspecialchars(number_format($row['federal_refund'], 2)) . "</td>
                    <td class='{$stateClass}'>$" . htmlspecialchars(number_format($row['state_refund'], 2)) . "</td>
                    <td class='{$cityClass}'>$" . htmlspecialchars(number_format($row['city_refund'], 2)) . "</td>
                    <td class='{$totalClass}'>$" . htmlspecialchars(number_format($totalRefund, 2)) . "</td>
                </tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No tax estimates found.</td></tr>";
        }

        $stmt->close();
        $conn->close();
        ?>
    </tbody>
</table>

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