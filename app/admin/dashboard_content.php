<?php

// Query to get the total number of clients, tax filings, pending reports, and in-progress filings
$totalClientsQuery = "SELECT COUNT(*) AS total_clients FROM users WHERE user_type = 'User'";
$totalTaxFilingsQuery = "SELECT COUNT(*) AS total_filings FROM personal_information";
$pendingReportsQuery = "SELECT COUNT(*) AS pending_reports FROM personal_information WHERE tax_filing_status = 'Pending'";
$inProgressQuery = "SELECT COUNT(*) AS in_progress FROM personal_information WHERE tax_filing_status = 'In Progress'";

$totalClientsResult = $conn->query($totalClientsQuery);
$totalTaxFilingsResult = $conn->query($totalTaxFilingsQuery);
$pendingReportsResult = $conn->query($pendingReportsQuery);
$inProgressResult = $conn->query($inProgressQuery);

$totalClients = $totalClientsResult->fetch_assoc()['total_clients'] ?? 0;
$totalTaxFilings = $totalTaxFilingsResult->fetch_assoc()['total_filings'] ?? 0;
$pendingReports = $pendingReportsResult->fetch_assoc()['pending_reports'] ?? 0;
$inProgress = $inProgressResult->fetch_assoc()['in_progress'] ?? 0;

// Close database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.css">
    <style>
        .small-box {
            border-radius: 10px;
            padding: 20px;
            color: #fff;
        }
        .small-box .icon {
            position: absolute;
            right: 10px;
            top: 10px;
            font-size: 30px;
        }
        .small-box-footer {
            color: rgba(255, 255, 255, 0.8);
        }
        .small-box-footer:hover {
            color: #fff;
            text-decoration: underline;
        }
        .card {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Overview Row -->
            <div class="row">
                <!-- Total Clients -->
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3><?php echo $totalClients; ?></h3>
                            <p>Total Clients</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-user-tie"></i>
                        </div>
                        <a href="clients.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <!-- Total Tax Filings -->
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3><?php echo $totalTaxFilings; ?></h3>
                            <p>Total Tax Filings</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-file-alt"></i>
                        </div>
                        <a href="clients.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <!-- Pending Reports -->
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3><?php echo $pendingReports; ?></h3>
                            <p>Pending</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-chart-pie"></i>
                        </div>
                        <a href="clients.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <!-- Total Blogs -->
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>0</h3>
                            <p>Total Blogs</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-blog"></i>
                        </div>
                        <a href="blogs.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
            <!-- /.row -->

            <!-- Data Visualization Row -->
            <div class="row">
                <!-- Tax Filing Chart -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Tax Filing Progress</h5>
                        </div>
                        <div class="card-body">
                            <canvas id="taxFilingChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Dynamic data from PHP
        const completed = <?php echo $totalTaxFilings - $pendingReports; ?>;
        const pending = <?php echo $pendingReports; ?>;
        const inProgress = <?php echo $inProgress; ?>; // This will now be dynamically set from the database

        // Tax Filing Progress Chart
        const ctx2 = document.getElementById('taxFilingChart').getContext('2d');
        const taxFilingChart = new Chart(ctx2, {
            type: 'bar',
            data: {
                labels: ['Completed', 'Pending', 'In Progress'],
                datasets: [{
                    label: 'Tax Filings',
                    data: [completed, pending, inProgress],
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.7)',
                        'rgba(255, 206, 86, 0.7)',
                        'rgba(255, 99, 132, 0.7)'
                    ],
                    borderColor: [
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(255, 99, 132, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>
</html>
