<?php
$current_page = "Adjustments to Income"; // Set the current page title
require('includes/header.php');
?>
<style>
    .hidden {
        display: none;
    }

    .btn-sm {
        padding: 0.25rem 0.5rem;
        font-size: 0.875rem;
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
                    <?php

                    $tax_year = date("Y") - 1;
                    $user_id = $_SESSION['user_id']; // Assuming user_id is stored in session

                    // Initialize deduction variables
                    $education_expenses = $education_expenses_spouse = '';
                    $student_loan_interest = $student_loan_interest_spouse = '';
                    $ira_contribution = $ira_contribution_spouse = '';
                    $hsa_contribution = $hsa_contribution_spouse = '';

                    // Fetch existing deduction records
                    // $query = "SELECT * FROM adjustments_to_income WHERE user_id = ? AND tax_year = ?";
                    // $stmt = $conn->prepare($query);
                    // $stmt->bind_param("is", $user_id, $tax_year);
                    // $stmt->execute();
                    // $result = $stmt->get_result();


                    $query = "SELECT * FROM adjustments_to_income WHERE user_id = ?";
                    $stmt = $conn->prepare($query);
                    $stmt->bind_param("i", $user_id);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();

                        // Populate variables with database values
                        $education_expenses = $row['education_expenses'];
                        $education_expenses_spouse = $row['education_expenses_spouse'];
                        $student_loan_interest = $row['student_loan_interest'];
                        $student_loan_interest_spouse = $row['student_loan_interest_spouse'];
                        $ira_contribution = $row['ira_contribution'];
                        $ira_contribution_spouse = $row['ira_contribution_spouse'];
                        $hsa_contribution = $row['hsa_contribution'];
                        $hsa_contribution_spouse = $row['hsa_contribution_spouse'];
                    }
                    ?>

                    <form id="adjustmentsIncomeForm" class="custom-form" enctype="multipart/form-data">
                        <div class="card curve-card card-dark">
                            <div class="card-header curve-card">
                                <h3 class="card-title"><i class="fas fa-money-check-alt"></i> Adjustments to Income - TY<?= $tax_year ?></h3>
                            </div>
                            <div class="card-body">
                                <!-- Table Structure with iCheck -->
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Question</th>
                                                <th colspan="1">Tax Payer</th>
                                                <th colspan="1">Spouse</th>
                                            </tr>
                                            <tr>
                                                <th></th> <!-- Empty header for alignment -->
                                                <th>
                                                    <div class="icheck-primary d-inline">
                                                        <input type="radio" id="taxpayer_yes_all" name="taxpayer_all" value="yes" onchange="selectAll('taxpayer', 'yes')">
                                                        <label for="taxpayer_yes_all">Yes All</label>
                                                    </div>
                                                    <div class="icheck-primary d-inline">
                                                        <input type="radio" id="taxpayer_no_all" name="taxpayer_all" value="no" onchange="selectAll('taxpayer', 'no')">
                                                        <label for="taxpayer_no_all">No All</label>
                                                    </div>
                                                </th>

                                                <th>
                                                    <div class="icheck-primary d-inline">
                                                        <input type="radio" id="spouse_yes_all" name="spouse_all" value="yes" onchange="selectAll('spouse', 'yes')">
                                                        <label for="spouse_yes_all">Yes All</label>
                                                    </div>
                                                    <div class="icheck-primary d-inline">
                                                        <input type="radio" id="spouse_no_all" name="spouse_all" value="no" onchange="selectAll('spouse', 'no')">
                                                        <label for="spouse_no_all">No All</label>
                                                    </div>
                                                </th>

                                            </tr>
                                        </thead>

                                        <tbody>
                                            <!-- Row 1: Education Expenses -->
                                            <tr>
                                                <td>Have you incurred any Education expenses?</td>
                                                <td>
                                                    <div class="form-group clearfix">
                                                        <div class="icheck-primary d-inline">
                                                            <input type="radio" id="education_expenses_yes" name="education_expenses" value="yes" <?php echo ($education_expenses == 'yes') ? 'checked' : ''; ?> required>
                                                            <label for="education_expenses_yes">Yes</label>
                                                        </div>
                                                        <div class="icheck-primary d-inline ml-3">
                                                            <input type="radio" id="education_expenses_no" name="education_expenses" value="no" <?php echo ($education_expenses == 'no') ? 'checked' : ''; ?> required>
                                                            <label for="education_expenses_no">No</label>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group clearfix">
                                                        <div class="icheck-primary d-inline">
                                                            <input type="radio" id="education_expenses_spouse_yes" name="education_expenses_spouse" value="yes" <?php echo ($education_expenses_spouse == 'yes') ? 'checked' : ''; ?> required>
                                                            <label for="education_expenses_spouse_yes">Yes</label>
                                                        </div>
                                                        <div class="icheck-primary d-inline ml-3">
                                                            <input type="radio" id="education_expenses_spouse_no" name="education_expenses_spouse" value="no" <?php echo ($education_expenses_spouse == 'no') ? 'checked' : ''; ?> required>
                                                            <label for="education_expenses_spouse_no">No</label>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>

                                            <!-- Row 2: Student Loan Interest -->
                                            <tr>
                                                <td>Have you paid any Student Loan Interest?</td>
                                                <td>
                                                    <div class="form-group clearfix">
                                                        <div class="icheck-primary d-inline">
                                                            <input type="radio" id="student_loan_interest_yes" name="student_loan_interest" value="yes" <?php echo ($student_loan_interest == 'yes') ? 'checked' : ''; ?> required>
                                                            <label for="student_loan_interest_yes">Yes</label>
                                                        </div>
                                                        <div class="icheck-primary d-inline ml-3">
                                                            <input type="radio" id="student_loan_interest_no" name="student_loan_interest" value="no" <?php echo ($student_loan_interest == 'no') ? 'checked' : ''; ?> required>
                                                            <label for="student_loan_interest_no">No</label>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group clearfix">
                                                        <div class="icheck-primary d-inline">
                                                            <input type="radio" id="student_loan_interest_spouse_yes" name="student_loan_interest_spouse" value="yes" <?php echo ($student_loan_interest_spouse == 'yes') ? 'checked' : ''; ?> required>
                                                            <label for="student_loan_interest_spouse_yes">Yes</label>
                                                        </div>
                                                        <div class="icheck-primary d-inline ml-3">
                                                            <input type="radio" id="student_loan_interest_spouse_no" name="student_loan_interest_spouse" value="no" <?php echo ($student_loan_interest_spouse == 'no') ? 'checked' : ''; ?> required>
                                                            <label for="student_loan_interest_spouse_no">No</label>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>

                                            <!-- Row 3: IRA Contribution -->
                                            <tr>
                                                <td>Have you made any Contribution to IRA (Retirement Plan)?</td>
                                                <td>
                                                    <div class="form-group clearfix">
                                                        <div class="icheck-primary d-inline">
                                                            <input type="radio" id="ira_contribution_yes" name="ira_contribution" value="yes" <?php echo ($ira_contribution == 'yes') ? 'checked' : ''; ?> required>
                                                            <label for="ira_contribution_yes">Yes</label>
                                                        </div>
                                                        <div class="icheck-primary d-inline ml-3">
                                                            <input type="radio" id="ira_contribution_no" name="ira_contribution" value="no" <?php echo ($ira_contribution == 'no') ? 'checked' : ''; ?> required>
                                                            <label for="ira_contribution_no">No</label>
                                                        </div>
                                                    </div>
                                                    <div id="ira_contribution_details" class="hidden  mt-2">
                                                        <label>Please write type of IRA:</label>
                                                        <input type="text" class="form-control" name="ira_contribution_type" placeholder="Enter type of IRA" value="<?php echo isset($row['ira_contribution_type']) ? $row['ira_contribution_type'] : ''; ?>">
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="form-group clearfix">
                                                        <div class="icheck-primary d-inline">
                                                            <input type="radio" id="ira_contribution_spouse_yes" name="ira_contribution_spouse" value="yes" <?php echo ($ira_contribution_spouse == 'yes') ? 'checked' : ''; ?> required>
                                                            <label for="ira_contribution_spouse_yes">Yes</label>
                                                        </div>
                                                        <div class="icheck-primary d-inline ml-3">
                                                            <input type="radio" id="ira_contribution_spouse_no" name="ira_contribution_spouse" value="no" <?php echo ($ira_contribution_spouse == 'no') ? 'checked' : ''; ?> required>
                                                            <label for="ira_contribution_spouse_no">No</label>
                                                        </div>
                                                    </div>
                                                    <div id="ira_contribution_details_spouse" class="hidden mt-2">
                                                        <label>Please write type of IRA:</label>
                                                        <input type="text" class="form-control" name="ira_contribution_spouse_type" placeholder="Enter type of IRA" value="<?php echo isset($row['ira_contribution_spouse_type']) ? $row['ira_contribution_spouse_type'] : ''; ?>">
                                                    </div>
                                                </td>



                                            </tr>

                                            <!-- Row 4: HSA Contribution -->
                                            <tr>
                                                <td>Have you made any HSA Contributions?</td>
                                                <td>
                                                    <div class="form-group clearfix">
                                                        <div class="icheck-primary d-inline">
                                                            <input type="radio" id="hsa_contribution_yes" name="hsa_contribution" value="yes" <?php echo ($hsa_contribution == 'yes') ? 'checked' : ''; ?> required>
                                                            <label for="hsa_contribution_yes">Yes</label>
                                                        </div>
                                                        <div class="icheck-primary d-inline ml-3">
                                                            <input type="radio" id="hsa_contribution_no" name="hsa_contribution" value="no" <?php echo ($hsa_contribution == 'no') ? 'checked' : ''; ?> required>
                                                            <label for="hsa_contribution_no">No</label>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group clearfix">
                                                        <div class="icheck-primary d-inline">
                                                            <input type="radio" id="hsa_contribution_spouse_yes" name="hsa_contribution_spouse" value="yes" <?php echo ($hsa_contribution_spouse == 'yes') ? 'checked' : ''; ?> required>
                                                            <label for="hsa_contribution_spouse_yes">Yes</label>
                                                        </div>
                                                        <div class="icheck-primary d-inline ml-3">
                                                            <input type="radio" id="hsa_contribution_spouse_no" name="hsa_contribution_spouse" value="no" <?php echo ($hsa_contribution_spouse == 'no') ? 'checked' : ''; ?> required>
                                                            <label for="hsa_contribution_spouse_no">No</label>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
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

                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            const iraContributionTaxpayer = document.getElementsByName('ira_contribution');
                            const iraContributionSpouse = document.getElementsByName('ira_contribution_spouse');

                            iraContributionTaxpayer.forEach(radio => {
                                radio.addEventListener('change', checkIRAFields);
                            });

                            iraContributionSpouse.forEach(radio => {
                                radio.addEventListener('change', checkIRAFields);
                            });

                            // Call checkIRAFields on page load to show/hide fields based on current selection
                            checkIRAFields();
                        });

                        function checkIRAFields() {
                            const taxpayerIRA = document.querySelector('input[name="ira_contribution"]:checked');
                            const spouseIRA = document.querySelector('input[name="ira_contribution_spouse"]:checked');

                            const taxpayerIRASection = document.getElementById('ira_contribution_details');
                            const spouseIRASection = document.getElementById('ira_contribution_details_spouse');

                            // Show/hide fields for Taxpayer
                            if (taxpayerIRA && taxpayerIRA.value === 'yes') {
                                taxpayerIRASection.classList.remove('hidden');
                            } else {
                                taxpayerIRASection.classList.add('hidden');
                            }

                            // Show/hide fields for Spouse
                            if (spouseIRA && spouseIRA.value === 'yes') {
                                spouseIRASection.classList.remove('hidden');
                            } else {
                                spouseIRASection.classList.add('hidden');
                            }
                        }

                        // Function to select "Yes" or "No" for all questions (Taxpayer or Spouse)
                        function selectAll(type, option) {
                            const radioGroups = [
                                `input[name="${type === 'taxpayer' ? 'education_expenses' : 'education_expenses_spouse'}"]`,
                                `input[name="${type === 'taxpayer' ? 'student_loan_interest' : 'student_loan_interest_spouse'}"]`,
                                `input[name="${type === 'taxpayer' ? 'ira_contribution' : 'ira_contribution_spouse'}"]`,
                                `input[name="${type === 'taxpayer' ? 'hsa_contribution' : 'hsa_contribution_spouse'}"]`
                            ];

                            radioGroups.forEach(group => {
                                const radios = document.querySelectorAll(group);
                                radios.forEach(radio => {
                                    if (radio.value === option) {
                                        radio.checked = true;
                                    }
                                });
                            });

                            checkIRAFields(); // To check and show/hide fields based on "Yes" or "No" selection.
                        }
                    </script>

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
        $('#adjustmentsIncomeForm').on('submit', function(event) {
            event.preventDefault(); // Prevent the default form submission

            // Serialize the form data
            var formData = $(this).serialize();

            $.ajax({
                type: 'POST',
                url: 'actions/save_adjustments.php', // Replace with the URL of your PHP script
                data: formData,
                dataType: 'json', // Expect JSON response
                beforeSend: function() {
                    // Optional: Show a loading spinner or disable the submit button
                    $('button[type="submit"]').prop('disabled', true);
                },
                success: function(response) {
                    // Handle success response
                    if (response.status === 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: response.message,
                            confirmButtonText: 'OK'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $('#adjustmentsIncomeForm')[0].reset(); // Reset the form
                                // Optionally redirect or perform other actions
                                // window.location.href = 'redirect-url.php'; // Uncomment to redirect
                                location.reload(); // Reload the page

                            }
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: response.message,
                            confirmButtonText: 'OK'
                        });
                    }
                },
                error: function(xhr, status, error) {
                    // Handle error response
                    Swal.fire({
                        icon: 'error',
                        title: 'An error occurred',
                        text: error,
                        confirmButtonText: 'OK'
                    });
                },
                complete: function() {
                    // Optional: Re-enable the submit button
                    $('button[type="submit"]').prop('disabled', false);
                }
            });
        });
    });
</script>