<?php
$current_page = "Clients";
require('includes/header.php');
?>

<!-- Navbar -->
<?php require('includes/navbar.php'); ?>
<!-- /.navbar -->

<!-- Main Sidebar Container -->
<?php require('includes/sidebar.php'); ?>
<!-- /.sidebar -->

<?php
// Secure query to get clients with their personal details
$stmt = $conn->prepare("
    SELECT 
        p.personal_id, p.user_id, p.first_name, p.middle_name, p.last_name, p.marital_status, 
        p.filing_status, p.marriage_date, p.taxpayer_dob, p.current_occupation, 
        p.taxpayer_ssn_select, p.taxpayer_ssn_input, p.taxpayer_entry_date, p.tax_year,
        p.review_documents_status, p.tax_filing_status, p.payment_status
    FROM personal_information p
    ORDER BY p.created_at DESC
");

$stmt->execute();
$result = $stmt->get_result();
?>

<!-- Include DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

<div class="content-wrapper">
    <!-- Content Header -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Clients</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                        <li class="breadcrumb-item active">Clients</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card curve-card">
                <div class="card-header">
                    <h3 class="card-title">Tax Filer List</h3>

                </div>

                <div class="card-body">
                    <a href="actions/export_client_details.php" class="btn btn-outline-dark btn-sm">
                        <i class="fa fa-file-excel"></i> Export All
                    </a>
                    <table id="ClientsTable" class="table table-bordered table-hover table-responsive">
                        <thead>
                            <tr>
                                <th>Unique FileNo</th>
                                <th>UserID</th>
                                <th>Tax Year</th>
                                <th>Full Name</th>
                                <th>Marital Status</th>
                                <th>Filing Status</th>
                                <th>Date of Marriage</th>
                                <th>DOB</th>
                                <th>Occupation</th>
                                <th>Holding SSN?</th>
                                <th>SSN</th>
                                <th>Entry Date to USA</th>
                                <th>Review Status</th>
                                <th>Filing Status</th>
                                <th>Payment Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($result->num_rows > 0): ?>
                                <?php while ($row = $result->fetch_assoc()): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($row['personal_id']); ?></td>
                                        <td><?= htmlspecialchars($row['user_id']); ?></td>
                                        <td><?= htmlspecialchars($row['tax_year']); ?></td>
                                        <td><?= htmlspecialchars($row['first_name'] . ' ' . $row['middle_name'] . ' ' . $row['last_name']); ?></td>
                                        <td><?= htmlspecialchars($row['marital_status']); ?></td>
                                        <td><?= htmlspecialchars($row['filing_status']); ?></td>
                                        <td><?= htmlspecialchars($row['marriage_date']); ?></td>
                                        <td><?= htmlspecialchars($row['taxpayer_dob']); ?></td>
                                        <td><?= htmlspecialchars($row['current_occupation']); ?></td>
                                        <td><?= htmlspecialchars($row['taxpayer_ssn_select']); ?></td>
                                        <td><?= htmlspecialchars($row['taxpayer_ssn_input']); ?></td>
                                        <td><?= htmlspecialchars($row['taxpayer_entry_date']); ?></td>
                                        <td>
                                            <!-- Review Documents Status Dropdown -->
                                            <select class="form-control form-control-sm update-status" data-field="review_documents_status" data-id="<?= $row['user_id']; ?>" data-tax-year="<?= $row['tax_year']; ?>">
                                                <option value="Pending" <?= $row['review_documents_status'] == 'Pending' ? 'selected' : ''; ?>>Pending</option>
                                                <option value="In Progress" <?= $row['review_documents_status'] == 'In Progress' ? 'selected' : ''; ?>>In Progress</option>
                                                <option value="Completed" <?= $row['review_documents_status'] == 'Completed' ? 'selected' : ''; ?>>Completed</option>
                                            </select>

                                        </td>
                                        <td>
                                            <!-- Filing Status Dropdown -->
                                            <select class="form-control form-control-sm update-status" data-field="tax_filing_status" data-id="<?= $row['user_id']; ?>" data-tax-year="<?= $row['tax_year']; ?>">
                                                <option value="Pending" <?= $row['tax_filing_status'] == 'Pending' ? 'selected' : ''; ?>>Pending</option>
                                                <option value="In Progress" <?= $row['tax_filing_status'] == 'In Progress' ? 'selected' : ''; ?>>In Progress</option>
                                                <option value="Completed" <?= $row['tax_filing_status'] == 'Completed' ? 'selected' : ''; ?>>Completed</option>
                                            </select>

                                        </td>
                                        <td>
                                            <!-- Payment Status Dropdown -->
                                            <select class="form-control form-control-sm update-status" data-field="payment_status" data-id="<?= $row['user_id']; ?>" data-tax-year="<?= $row['tax_year']; ?>">
                                                <option value="Pending" <?= $row['payment_status'] == 'Pending' ? 'selected' : ''; ?>>Pending</option>
                                                <option value="Paid" <?= $row['payment_status'] == 'Paid' ? 'selected' : ''; ?>>Paid</option>
                                                <option value="Failed" <?= $row['payment_status'] == 'Failed' ? 'selected' : ''; ?>>Failed</option>
                                            </select>
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a class="btn btn-sm btn-primary" href="profile.php?user_id=<?= $row['user_id']; ?>&tax_year=<?= $row['tax_year']; ?>" title="View Profile">
                                                    <i class="fa fa-eye fs-18"></i>
                                                </a>
                                                <button class="btn btn-sm btn-danger delete-client" data-id="<?= $row['user_id']; ?>" data-tax-year="<?= $row['tax_year']; ?>" title="Delete Client">
                                                    <i class="fa fa-trash fs-18"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="16" class="text-center">No tax filers found.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </section>
</div>

<?php include 'includes/footer.php'; ?>

<script>
    $(document).ready(function() {
        // Handle status change for tax_filing_status, review_documents_status, and payment_status
        $('#ClientsTable').on('change', '.update-status', function() {
            var statusField = $(this).data('field');
            var userId = $(this).data('id');
            var taxYear = $(this).data('tax-year');
            var newStatus = $(this).val();
            var oldStatus = $(this).data('old-value'); // Store the old value before change

            // Show SweetAlert confirmation before updating the status
            Swal.fire({
                title: 'Are you sure?',
                text: "You want to change the status to " + newStatus + "?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, update it!',
            }).then((result) => {
                if (result.isConfirmed) {
                    // Proceed with the update if confirmed
                    $.ajax({
                        url: 'actions/update_status.php', // PHP script to handle the status update
                        type: 'POST',
                        data: {
                            field: statusField,
                            user_id: userId,
                            tax_year: taxYear,
                            status: newStatus
                        },
                        success: function(response) {
                            // Show success message
                            Swal.fire(
                                'Updated!',
                                'The status has been updated.',
                                'success'
                            );
                        },
                        error: function() {
                            // Show error message and reset dropdown to the previous value
                            Swal.fire(
                                'Error!',
                                'There was an error updating the status.',
                                'error'
                            );
                            $(this).val(oldStatus); // Reset to old value if there's an error
                        }
                    });
                } else {
                    // Reset the dropdown to the previous value if cancelled
                    $(this).val(oldStatus);
                }
            });
        });
    });

    $(document).ready(function() {
        // Initialize DataTable
        $("#ClientsTable").DataTable({
            responsive: true,
            lengthChange: false,
            autoWidth: false,
            paging: true,
            pageLength: 50,
            order: [
                [0, 'desc']
            ]
        });

        // Handle delete button click
        $('#ClientsTable').on('click', '.delete-client', function() {
            var userId = $(this).data('id');
            var taxYear = $(this).data('tax-year');

            // Show confirmation dialog with tax year included
            Swal.fire({
                title: 'Are you sure?',
                text: `This will delete all related records for this user in tax year ${taxYear}.`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    // If confirmed, send an AJAX request to delete the records
                    $.ajax({
                        url: 'actions/delete_client.php', // Server-side script for deletion
                        type: 'POST',
                        data: {
                            user_id: userId,
                            tax_year: taxYear
                        },
                        success: function(response) {
                            try {
                                // Ensure the response is parsed correctly
                                var res = JSON.parse(response);

                                if (res.success) {
                                    Swal.fire('Deleted!', res.message, 'success').then(() => {
                                        location.reload(); // Reload to update the table
                                    });
                                } else {
                                    Swal.fire('Error!', res.message, 'error');
                                }
                            } catch (e) {
                                console.error('Error parsing response:', e);
                                Swal.fire('Error!', 'An error occurred while processing the response.', 'error');
                            }
                        },
                        error: function(xhr, status, error) {
                            Swal.fire('Error!', 'An error occurred while deleting the record.', 'error');
                        }
                    });
                }
            });
        });

    });
</script>