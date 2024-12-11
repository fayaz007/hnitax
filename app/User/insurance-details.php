<?php
$current_page = "Insurance Details"; // Set the current page title
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
                    <h1 class="m-0"><?= $current_page ?></h1>
                </div>
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
            <?php
            $user_id = $_SESSION['user_id'] ?? null; // Get user_id from session

            // Initialize an array for default empty form values
            $insuranceData = [
                'health_insurance' => '',
                'coverage_duration' => '',
                'insurance_provider' => ''
            ];

            // Fetch insurance details from the database if the user exists
            if ($user_id) {
                $query = "SELECT * FROM insurance_details WHERE user_id = ?";
                if ($stmt = $conn->prepare($query)) {
                    $stmt->bind_param('i', $user_id); // Bind user_id to query
                    $stmt->execute();
                    $result = $stmt->get_result();
                    if ($result->num_rows > 0) {
                        $insuranceData = $result->fetch_assoc(); // Fetch data if exists
                    }
                    $stmt->close();
                }
            }
            ?>

            <div class="row">
                <div class="col-md-12">
                    <form id="insuranceForm" class="custom-form" enctype="multipart/form-data" method="POST">
                        <!-- Personal Information Section -->
                        <div class="card curve-card card-dark">
                            <div class="card-header curve-card">
                                <h3 class="card-title"><i class="fa-solid fa-id-card"></i> Insurance Details</h3>
                            </div>
                            <div class="card-body">
                                <input type="hidden" name="tax_year" class="form-control" id="tax_year" value="<?= date('Y') - 1 ?>">

                                <div class="form-group">
                                    <label for="health_insurance">Are you covered by Health Insurance? <span class="required">*</span></label>
                                    <select name="health_insurance" id="health_insurance" class="form-control" required>
                                        <option value="">Select</option>
                                        <option value="Yes" <?= $insuranceData['health_insurance'] === 'Yes' ? 'selected' : '' ?>>Yes</option>
                                        <option value="No" <?= $insuranceData['health_insurance'] === 'No' ? 'selected' : '' ?>>No</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="coverage_duration">Full Year or Part Year? <span class="required">*</span></label>
                                    <select name="coverage_duration" id="coverage_duration" class="form-control" required>
                                        <option value="">Select</option>
                                        <option value="Full Year" <?= $insuranceData['coverage_duration'] === 'Full Year' ? 'selected' : '' ?>>Full Year</option>
                                        <option value="Part Year" <?= $insuranceData['coverage_duration'] === 'Part Year' ? 'selected' : '' ?>>Part Year</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="insurance_provider">Did you buy Insurance through Employer or Market? <span class="required">*</span></label>
                                    <select name="insurance_provider" id="insurance_provider" class="form-control" required>
                                        <option value="">Select</option>
                                        <option value="Employer" <?= $insuranceData['insurance_provider'] === 'Employer' ? 'selected' : '' ?>>Employer</option>
                                        <option value="Market" <?= $insuranceData['insurance_provider'] === 'Market' ? 'selected' : '' ?>>Market</option>
                                    </select>
                                </div>
                                <?php
                                $uploaded_1095a_file = null;
                                $document_type = 'Form_1095A'; // Define the document type for 1095A
                                $file_path = '../assets/uploads/documents/'; // Define the base path for uploaded documents

                                // Fetch the uploaded document for form 1095A based on user_id and document_type
                                if ($user_id) {
                                    $query = "SELECT * FROM documents WHERE user_id = ? AND document_type = ?";
                                    if ($stmt = $conn->prepare($query)) {
                                        $stmt->bind_param('is', $user_id, $document_type); // Bind user_id and document_type to query
                                        $stmt->execute();
                                        $result = $stmt->get_result();
                                        if ($result->num_rows > 0) {
                                            $document = $result->fetch_assoc(); // Fetch the document details
                                            $uploaded_1095a_file = $document['file_name']; // Get the file name
                                        }
                                        $stmt->close();
                                    }
                                }
                                ?>
                                <input type="hidden" name="old_form_1095a_upload" value="<?= htmlspecialchars($document['file_name']) ?>">

                                <!-- Conditional Form 1095A Upload Section -->
                                <div class="form-group" id="1095a-section" style="display: <?= $insuranceData['insurance_provider'] === 'Market' ? 'block' : 'none'; ?>;">
                                    <label for="form_1095a_upload">Please provide form 1095A if insured through Market</label>
                                    <div class="custom-file">
                                        <input type="file" name="form_1095a_upload" id="form_1095a_upload" accept=".pdf,.jpg,.jpeg,.png" class="form-control">
                                        <label class="custom-file-label" for="form_1095a_upload">Choose file</label>

                                        <!-- Show existing file name if available -->
                                        <?php if ($uploaded_1095a_file): ?>
                                            <div class="mt-2">
                                                <!-- <strong>Uploaded File:</strong> <span id="uploaded-file-name"><?= htmlspecialchars($uploaded_1095a_file) ?></span> -->
                                                <a href="<?= $file_path . htmlspecialchars($uploaded_1095a_file) ?>" target="_blank" class="btn btn-sm  btn-success" download>
                                                    <i class="fas fa-download"></i> Download Uploaded Document
                                                </a>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>


                                <script>
                                    // Show or hide 1095A upload based on insurance provider selection
                                    document.getElementById('insurance_provider').addEventListener('change', function() {
                                        var provider = this.value;
                                        var section1095A = document.getElementById('1095a-section');

                                        if (provider === 'Market') {
                                            section1095A.style.display = 'block'; // Show 1095A upload if Market is selected
                                        } else {
                                            section1095A.style.display = 'none'; // Hide 1095A upload for other selections
                                        }
                                    });
                                </script>
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-info curve-card my-btn-primary-color">
                                    <i class="fas fa-paper-plane"></i> Submit
                                </button>
                                <button type="button" class="btn btn-default float-right curve-card" onclick="history.back();">
                                    <i class="fas fa-arrow-left"></i> Back
                                </button>
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


<script>
    $(document).ready(function() {
        $('#insuranceForm').on('submit', function(e) {
            e.preventDefault(); // Prevent default form submission

            var formData = new FormData(this); // Create a FormData object

            $.ajax({
                url: 'actions/save_insurance-details.php', // URL to your PHP processing script
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    var data = JSON.parse(response);
                    if (data.success) {
                        Swal.fire({
                            title: 'Success!',
                            text: data.success,
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then(() => {
                            location.reload(); // Reload the page to show updated information
                        });
                    } else if (data.error) {
                        Swal.fire({
                            title: 'Error!',
                            text: data.error,
                            icon: 'error',
                            confirmButtonText: 'Try Again'
                        });
                    }
                },
                error: function() {
                    Swal.fire({
                        title: 'Error!',
                        text: 'An error occurred while submitting the form.',
                        icon: 'error',
                        confirmButtonText: 'Try Again'
                    });
                }
            });
        });
    });
</script>