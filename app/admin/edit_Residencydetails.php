<?php
$current_page = "Clients"; // Set the current page title
require('includes/header.php');
?>

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
                    <h1 class="m-0">Edit Details
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Edit</li>
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
                    <form id="taxForm" class="custom-form" enctype="multipart/form-data" method="POST" action="process_form.php">

                        <!-- Residency Details Section -->
                        <div id="residency_section" class="card curve-card card-dark">
                            <div class="card-header curve-card">
                                <h3 class="card-title"><i class="fas fa-home"></i> Residency Details</h3>
                            </div>
                            <div class="card-body">
                                <!-- Add Residency Button -->
                                <div class="mb-3">
                                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addEditResidencyModal">
                                        + CLICK HERE TO ADD OR EDIT RESIDENCY
                                    </button>
                                </div>
                                <?php
                                $user_id = $_GET['user_id'];
                                $tax_year = $_GET['tax_year'];

                                $residency_records = [];

                                if ($user_id && $tax_year) {
                                    $query = "SELECT * FROM residency_details WHERE user_id = ? AND tax_year = ?";
                                    if ($stmt = $conn->prepare($query)) {
                                        $stmt->bind_param("is", $user_id, $tax_year); // Bind both user_id and tax_year
                                        $stmt->execute();
                                        $result = $stmt->get_result();
                                        while ($row = $result->fetch_assoc()) {
                                            $residency_records[] = $row; // Store each row in the array
                                        }
                                        $stmt->close();
                                    }
                                }
                                ?>

                                <!-- Residency Details Table -->
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped" id="residencyTable">
                                        <thead>
                                            <tr>
                                                <th>Residency Details for</th>
                                                <th>State Name</th>
                                                <th>Residency Start Date</th>
                                                <th>Residency End Date</th>
                                                <th>Rent Paid (Annual)</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (!empty($residency_records)): ?>
                                                <?php foreach ($residency_records as $record): ?>
                                                    <tr>
                                                        <td><?= htmlspecialchars($record['residency_for']); ?></td>
                                                        <td><?= htmlspecialchars($record['state_name']); ?></td>
                                                        <td><?= htmlspecialchars($record['residency_start_date']); ?></td>
                                                        <td><?= htmlspecialchars($record['residency_end_date']); ?></td>
                                                        <td><?= htmlspecialchars($record['rent_paid']); ?></td>
                                                        <td>
                                                            <!-- Edit button with icon -->
                                                            <button type="button" class="edit-residency-btn btn btn-sm btn-outline-primary" data-id="<?= $record['residency_id']; ?>" title="Edit">
                                                                <i class="fas fa-edit"></i>
                                                            </button>
                                                            <!-- Delete button with icon -->
                                                            <button type="button" class="delete-residency-btn btn btn-sm btn-outline-danger" data-id="<?= $record['residency_id']; ?>" title="Delete">
                                                                <i class="fas fa-trash-alt"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                                <tr>
                                                    <td colspan="6" class="text-center">No residency records found.</td>
                                                </tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- Add/Edit Residency Modal -->
                        <div class="modal fade" id="addEditResidencyModal" tabindex="-1" role="dialog" aria-labelledby="addEditResidencyModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content curve-card card-dark">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="addEditResidencyModalLabel">Add Residency Details</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="residencyForm">
                                            <input type="hidden" name="residency_id" id="residency_id" value="">
                                            <input type="hidden" name="user_id" class="form-control" id="user_id" value="<?= $user_id ?>">
                                            <input type="hidden" name="tax_year" class="form-control" id="tax_year" value="<?= $tax_year ?>">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="residency_for">Residency Details for</label>
                                                        <select id="residency_for" class="form-control">
                                                            <option value="Taxpayer">Taxpayer</option>
                                                            <option value="Spouse">Spouse</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="state_name_modal">State Name</label>
                                                        <select name="state_name_modal" class="form-control" id="state_name_modal" required>
                                                            <option disabled selected>Choose State</option>
                                                            <!-- Add all states here -->
                                                            <option value="Alabama">Alabama</option>
                                                            <option value="Alaska">Alaska</option>
                                                            <option value="Arizona">Arizona</option>
                                                            <option value="Arkansas">Arkansas</option>
                                                            <option value="California">California</option>
                                                            <option value="Colorado">Colorado</option>
                                                            <option value="Connecticut">Connecticut</option>
                                                            <option value="Delaware">Delaware</option>
                                                            <option value="Florida">Florida</option>
                                                            <option value="Georgia">Georgia</option>
                                                            <option value="Hawaii">Hawaii</option>
                                                            <option value="Idaho">Idaho</option>
                                                            <option value="Illinois">Illinois</option>
                                                            <option value="Indiana">Indiana</option>
                                                            <option value="Iowa">Iowa</option>
                                                            <option value="Kansas">Kansas</option>
                                                            <option value="Kentucky">Kentucky</option>
                                                            <option value="Louisiana">Louisiana</option>
                                                            <option value="Maine">Maine</option>
                                                            <option value="Maryland">Maryland</option>
                                                            <option value="Massachusetts">Massachusetts</option>
                                                            <option value="Michigan">Michigan</option>
                                                            <option value="Minnesota">Minnesota</option>
                                                            <option value="Mississippi">Mississippi</option>
                                                            <option value="Missouri">Missouri</option>
                                                            <option value="Montana">Montana</option>
                                                            <option value="Nebraska">Nebraska</option>
                                                            <option value="Nevada">Nevada</option>
                                                            <option value="New Hampshire">New Hampshire</option>
                                                            <option value="New Jersey">New Jersey</option>
                                                            <option value="New Mexico">New Mexico</option>
                                                            <option value="New York">New York</option>
                                                            <option value="North Carolina">North Carolina</option>
                                                            <option value="North Dakota">North Dakota</option>
                                                            <option value="Ohio">Ohio</option>
                                                            <option value="Oklahoma">Oklahoma</option>
                                                            <option value="Oregon">Oregon</option>
                                                            <option value="Pennsylvania">Pennsylvania</option>
                                                            <option value="Rhode Island">Rhode Island</option>
                                                            <option value="South Carolina">South Carolina</option>
                                                            <option value="South Dakota">South Dakota</option>
                                                            <option value="Tennessee">Tennessee</option>
                                                            <option value="Texas">Texas</option>
                                                            <option value="Utah">Utah</option>
                                                            <option value="Vermont">Vermont</option>
                                                            <option value="Virginia">Virginia</option>
                                                            <option value="Washington">Washington</option>
                                                            <option value="West Virginia">West Virginia</option>
                                                            <option value="Wisconsin">Wisconsin</option>
                                                            <option value="Wyoming">Wyoming</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="residency_start_date_modal">Residency Start Date</label>
                                                        <input type="date" class="form-control" id="residency_start_date_modal" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="residency_end_date_modal">Residency End Date</label>
                                                        <input type="date" class="form-control" id="residency_end_date_modal" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="rent_paid_modal">Rent Paid (Annual)</label>
                                                        <input type="number" class="form-control" id="rent_paid_modal" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default curve-card" data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary curve-card my-btn-primary-color" id="saveResidency">Save </button>
                                    </div>

                                </div>
                            </div>
                        </div>




                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php require('includes/footer.php'); ?>
<!-- Include scripts -->

<script>
    $(document).ready(function() {
        // Open the modal for adding residency details
        $('#addResidencyButton').on('click', function() {
            $('#residency_id').val(''); // Clear residency ID
            $('#addEditResidencyModalLabel').text('Add Residency Details');
            $('#saveResidency').text('Save'); // Set button text for adding
            $('#addEditResidencyModal').modal('show'); // Show the modal
        });

        // Save or update residency details
        $('#saveResidency').on('click', function(e) {
            e.preventDefault();
            const formData = {
                residency_id: $('#residency_id').val(), // Include residency ID for edit
                residency_for: $('#residency_for').val(),
                state_name_modal: $('#state_name_modal').val(),
                residency_start_date_modal: $('#residency_start_date_modal').val(),
                residency_end_date_modal: $('#residency_end_date_modal').val(),
                rent_paid_modal: $('#rent_paid_modal').val(),
                user_id: $('#user_id').val(),
                tax_year: $('#tax_year').val(),
            };

            // Check for required fields
            if (!formData.residency_for || !formData.state_name_modal || !formData.residency_start_date_modal || !formData.residency_end_date_modal || !formData.rent_paid_modal) {
                showAlert('warning', 'Missing Information', 'Please fill all required fields.');
                return;
            }

            // Determine if it's an update or save
            const actionUrl = formData.residency_id ? 'actions/update_residency.php' : 'actions/save_residency.php';

            $.post(actionUrl, formData)
                .done(function(response) {
                    handleResponse(response, formData.residency_id ? 'Residency updated successfully!' : 'Residency saved successfully!', 'addEditResidencyModal');
                })
                .fail(showErrorAlert);
        });

        // Edit residency details
        $(document).on('click', '.edit-residency-btn', function() {
            const residencyId = $(this).data('id');
            $.get('actions/get_residency.php', {
                    id: residencyId
                })
                .done(function(response) {
                    const data = JSON.parse(response);
                    // Populate form with existing data
                    $('#residency_id').val(data.residency_id);
                    $('#residency_for').val(data.residency_for);
                    $('#state_name_modal').val(data.state_name);
                    $('#residency_start_date_modal').val(data.residency_start_date);
                    $('#residency_end_date_modal').val(data.residency_end_date);
                    $('#rent_paid_modal').val(data.rent_paid);

                    // Update modal title and show
                    $('#addEditResidencyModalLabel').text('Edit Residency Details');
                    $('#saveResidency').text('Update'); // Set button text for editing
                    $('#addEditResidencyModal').modal('show');
                })
                .fail(showErrorAlert);
        });

        // Delete residency
        $(document).on('click', '.delete-residency-btn', function() {
            const residencyId = $(this).data('id');
            Swal.fire({
                title: 'Are you sure?',
                text: 'This will delete the residency details.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.post('actions/delete_residency.php', {
                            id: residencyId
                        })
                        .done(function(response) {
                            handleResponse(response, 'Residency deleted successfully!');
                        })
                        .fail(showErrorAlert);
                }
            });
        });

        // Function to handle AJAX response
        function handleResponse(response, successMessage, modalId = null) {
            const data = JSON.parse(response);
            if (data.success) {
                showAlert('success', 'Success!', successMessage);
                // Refresh the residency list or perform other actions
                location.reload(); // For demonstration; consider a better approach
            } else {
                showAlert('error', 'Error!', data.message || 'Something went wrong!');
            }
            if (modalId) {
                $('#' + modalId).modal('hide');
            }
        }

        // Function to show alerts using SweetAlert
        function showAlert(icon, title, text) {
            Swal.fire({
                icon: icon,
                title: title,
                text: text
            });
        }

        // Show error alert for AJAX failures
        function showErrorAlert() {
            showAlert('error', 'Error!', 'An error occurred while processing your request.');
        }
    });
</script>