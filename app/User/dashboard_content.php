<style>
    /* General Styles */
    .dashboard-card-table th,
    .dashboard-card-table td {
        border: 2px solid white !important;
        padding: 0 !important;
    }

    .dashboard-header {
        background: #343a40;
        color: white;
        padding: 15px;
        border-radius: 5px;
    }

    .dashboard-card,
    .stat-card {
        border-radius: 10px;
        background-color: #f8f9fa;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        padding: 15px;
        transition: background-color 0.3s ease, transform 0.3s ease;
    }

    .dashboard-card1:hover,
    .stat-card:hover {
        background-color: #f9921e !important;
        transform: scale(1.05);
        color: #fff;

    }

    .card-header-custom {
        background: #6c757d;
        color: white;
        padding: 10px 15px;
        border-radius: 8px 8px 0 0;
    }

    .table-responsive {
        margin-top: 20px;
    }

    .stat-card {
        text-align: center;
        color: #343a40;
    }

    .stat-card i {
        font-size: 2.5rem;
        color: #6c757d;
        transition: color 0.3s ease;
    }

    .stat-card:hover i {
        color: #fff;
    }

    .stat-card p {
        font-weight: bold;
        margin-top: 10px;
        transition: color 0.3s ease;
    }

    .stat-card:hover p {
        color: #fff;
    }

    .progress {
        height: 30px;
        margin-bottom: 20px;
        border-radius: 5px;
    }

    .progress-bar {
        font-weight: bold;
        transition: width 0.6s ease;
        background-color: #28a745;
    }

    /* Step Styles */
    .steps {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        margin-top: 20px;
    }

    .step {
        position: relative;
        display: inline-block;
        width: 14%;
        text-align: center;
        margin-bottom: 15px;
    }

    .step.completed .step-label {
        color: #28a745;
    }

    .step.current .step-label {
        color: #ffc107;
    }

    .step .circle {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        background-color: #6c757d;
        margin: 0 auto;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 14px;
        transition: background-color 0.3s ease;
    }

    .step.completed .circle {
        background-color: #28a745;
    }

    .step.current .circle {
        background-color: #ffc107;
    }

    .step.pending .circle {
        background-color: #6c757d;
    }

    .completed .circle:before {
        content: "\f00c";
        font-family: "Font Awesome 5 Free";
        font-weight: 900;
        font-size: 12px;
    }

    .current .circle:before {
        content: "\f110";
        font-family: "Font Awesome 5 Free";
        font-weight: 900;
        font-size: 12px;
        animation: spin 1s infinite;
    }

    .pending .circle:before {
        content: attr(data-icon);
        font-family: "Font Awesome 5 Free";
        font-weight: 900;
        font-size: 12px;
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }

    /* Media Queries for Responsiveness */
    @media (max-width: 768px) {
        .step {
            width: 30%;
        }

        .step .circle {
            width: 25px;
            height: 25px;
        }
    }

    @media (max-width: 576px) {
        .step {
            width: 45%;
        }

        .step .circle {
            width: 20px;
            height: 20px;
        }
    }
</style>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Dashboard Header -->
        <div class="row">
            <!-- Welcome Card -->
            <div class="col-lg-6 col-md-6">
                <div class="card curve-card card-primary card-outline">
                    <div class="card-body">
                        <h5>Welcome, <strong><?= $_SESSION['username'] ?></strong></h5>
                        <p>Your personal dashboard to manage your tax filings, documents, and payments.</p>
                    </div>
                </div>
            </div>

            <!-- Contact Details Card -->
            <div class="col-lg-6 col-md-6">
                <div class="card curve-card card-primary card-outline">
                    <div class="card-header curve-card">
                        <h3 class="card-title"><i class="fas fa-user-tie mr-1"></i> Point Of Contact</h3>
                    </div>
                    <div class="card-body">
                        <p><strong><i class="fas fa-user-circle mr-1"></i> Name:</strong> Yousuf Khan </p>
                        <p><strong><i class="fas fa-phone-alt mr-1"></i> Phone:</strong> +1 312-788-8232 / +91 93915 07687</p>
                        <p><strong><i class="fas fa-envelope mr-1"></i> Email:</strong>
                            <a href="mailto:yousuf@hnitax.com">yousuf@hnitax.com</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <?php
        $user_id = $_SESSION['user_id'];
        $tax_year  = date("Y") - 1;
        // Define total steps
        $total_steps = 6;

        // Initialize completed sections counter
        $completed_sections = 0;

        // Prepare statement for checking Personal Information
        $query_personal_info = "SELECT COUNT(*) as count FROM personal_information WHERE user_id = ? AND tax_year = ?";
        $stmt = $conn->prepare($query_personal_info);
        $stmt->bind_param("ii", $user_id, $tax_year);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        if ($result['count'] > 0) {
            $completed_sections++;
        }

        // Prepare statement for checking Documents upload
        $query_documents = "SELECT COUNT(*) as count FROM documents WHERE user_id = ? AND tax_year = ?";
        $stmt = $conn->prepare($query_documents);
        $stmt->bind_param("ii", $user_id, $tax_year);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        if ($result['count'] > 0) {
            $completed_sections++;
        }

        // Check if Tax Estimates are completed
        $query_tax_estimates = "SELECT COUNT(*) as count FROM tax_estimates WHERE user_id = ? AND tax_year = ?";
        $stmt = $conn->prepare($query_tax_estimates);
        $stmt->bind_param("ii", $user_id, $tax_year);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        if ($result['count'] > 0) {
            $completed_sections++;
        }


        // Calculate progress percentage
        $progress_percent = ($completed_sections / $total_steps) * 100;

        // Prepare statement to count uploaded documents by the user
        $document_query = "SELECT COUNT(*) AS documents_uploaded FROM documents WHERE user_id = ? AND from_admin = 0";
        $doc_stmt = $conn->prepare($document_query);
        $doc_stmt->bind_param("i", $user_id);
        $doc_stmt->execute();
        $doc_result = $doc_stmt->get_result()->fetch_assoc();
        $documents_uploaded = $doc_result['documents_uploaded'] ?? 0;

        // Fetch tax filing status based on completed sections
        $tax_filing_status = ($completed_sections == $total_steps) ? 'Completed' : 'Pending';
        ?>

        <div class="row">
            <div class="col-12">
                <div class="card curve-card card-primary card-outline">
                    <div class="card-header curve-card">
                        <h3 class="card-title"><i class="fas fa-tachometer-alt mr-2"></i> Your Tax Filing Progress</h3>
                    </div>
                    <div class="card-body">
                        <p>Tax Filing Progress: <strong><?php echo round($progress_percent); ?>%</strong></p>
                        <div class="progress mb-4">
                            <div class="progress-bar bg-success" role="progressbar" style="width: <?php echo round($progress_percent); ?>%;" aria-valuenow="<?php echo round($progress_percent); ?>" aria-valuemin="0" aria-valuemax="100">
                                <?php echo round($progress_percent); ?>%
                            </div>
                        </div>

                        <!-- Step Indicators -->
                        <div class="steps d-flex justify-content-between">
                            <?php
                            $steps = [
                                "Personal Information",
                                "Upload Documents",
                                "Tax Estimates",
                                "Payment",
                                "Review Documents",
                                "E-Filing"
                            ];

                            foreach ($steps as $index => $step_label) {
                                $step_number = $index + 1;
                                $is_completed = $completed_sections >= $step_number;
                                $is_current = $step_number == $completed_sections + 1;
                                $status_class = $is_completed ? 'completed' : ($is_current ? 'current' : 'pending');
                                $circle_class = $is_completed ? 'bg-success' : ($is_current ? 'bg-warning' : 'bg-light');
                            ?>
                                <div class="step <?php echo $status_class; ?>">
                                    <div class="circle <?php echo $circle_class; ?>"></div>
                                    <div class="step-label"><?php echo $step_label; ?></div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Stat Cards Row -->
        <div class="row m-3">
            <div class="col-lg-6 col-md-6 mt-1">
                <div class="stat-card">
                    <i class="fas fa-file-alt"></i>
                    <p>Tax Filing Status</p>
                    <h5><?php echo $tax_filing_status; ?></h5>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 mt-1">
                <div class="stat-card">
                    <i class="fas fa-folder-open"></i>
                    <p>Documents Uploaded</p>
                    <h5><?php echo $documents_uploaded; ?></h5>
                </div>
            </div>
        </div>
</section>