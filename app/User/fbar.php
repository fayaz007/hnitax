<?php
$current_page = "FBAR"; // Set the current page title
require('includes/header.php');
?>
<style>
    .hidden {
        display: none;
    }

    .curve-card {
        border-radius: 15px;
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
    }

    .breadcrumb-item a {
        color: #007bff;
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
                    <!-- FBAR Checklist Form Card -->
                    <div class="card curve-card card-dark">
                        <div class="card-header curve-card">
                            <h3 class="card-title"><i class="fas fa-check-circle"></i> FBAR Checklist</h3>
                        </div>
                        <div class="card-body">
                            <?php
                            $tax_year = date('Y')-1;
                            $user_id = $_SESSION['user_id']; // Retrieve user_id from session

                            // Initialize FBAR variable
                            $fbar_status = '';

                            // Fetch FBAR record
                            $query = "SELECT fbar_status FROM fbar WHERE user_id = ?";
                            $stmt = $conn->prepare($query);
                            $stmt->bind_param("i", $user_id);
                            $stmt->execute();
                            $result = $stmt->get_result();

                            // $query = "SELECT fbar_status FROM fbar WHERE user_id = ? AND tax_year = ?";
                            // $stmt = $conn->prepare($query);
                            // $stmt->bind_param("ii", $user_id, $tax_year);
                            // $stmt->execute();
                            // $result = $stmt->get_result();

                            if ($result->num_rows > 0) {
                                $row = $result->fetch_assoc();
                                // Populate the FBAR status variable
                                $fbar_status = $row['fbar_status'];
                            }

                            $stmt->close();
                            $conn->close();
                            ?>
                            <form id="fbarForm" method="POST">
                                <!-- FBAR Question -->
                                <div class="form-group row">
                                    <label class="col-sm-12 col-form-label">Did you have $10,000 or more balance in your Foreign Bank accounts any time during the tax year 2024?</label>
                                </div>

                                <!-- Radio Buttons -->
                                <div class="form-group row">
                                    <div class="col-sm-10">
                                        <div class="icheck-primary d-inline">
                                            <input type="radio" id="fbar_yes" name="fbar_status" value="yes"
                                                onchange="toggleFbarSheet(true)"
                                                <?php echo ($fbar_status == 'yes') ? 'checked' : ''; ?> required>
                                            <label for="fbar_yes">Yes</label>
                                        </div>
                                        <div class="icheck-primary d-inline ml-3">
                                            <input type="radio" id="fbar_no" name="fbar_status" value="no"
                                                onchange="toggleFbarSheet(false)"
                                                <?php echo ($fbar_status == 'no') ? 'checked' : ''; ?> required>
                                            <label for="fbar_no">No</label>
                                        </div>
                                    </div>
                                </div>

                                <!-- Submit Button -->
                                <div class="form-group row">
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-info curve-card my-btn-primary-color">Submit</button>
                                    </div>
                                </div>
                            </form>
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

<script>
    function toggleFbarSheet(show) {
        const fbarSheet = document.getElementById('fbar_sheet');
        fbarSheet.style.display = show ? 'block' : 'none';
    }
</script>
<script>
    $(document).ready(function() {
        $('#fbarForm').on('submit', function(event) {
            event.preventDefault(); // Prevent the default form submission

            // Serialize the form data
            var formData = $(this).serialize();

            // Perform the AJAX request
            $.ajax({
                url: 'actions/save-fbar.php', // URL to the PHP script that handles the request
                type: 'POST', // Method type
                data: formData, // Data to be sent
                dataType: 'json', // Expecting JSON response
                success: function(response) {
                    // Handle the response from the server
                    if (response.status === 'success') {
                        // Show a success message with SweetAlert
                        Swal.fire({
                            title: 'Success!',
                            text: response.message,
                            icon: 'success'
                        }).then(() => {
                            location.reload(); // Reload the page to show updated information
                        });
                    } else {
                        // Show an error message with SweetAlert
                        Swal.fire({
                            title: 'Error!',
                            text: response.message,
                            icon: 'error'
                        });
                    }
                },
                error: function(xhr, status, error) {
                    // Handle any AJAX errors
                    Swal.fire({
                        title: 'AJAX Error!',
                        text: error,
                        icon: 'error'
                    });
                }
            });
        });
    });
</script>