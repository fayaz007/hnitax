<?php
$current_page = "Clients"; // Set the current page title
require('includes/header.php'); ?>

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
                    <h1 class="m-0">Edit Details</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Edit </li>
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

                    $user_id = $_GET['user_id'];
                    $tax_year = $_GET['tax_year'];



                    // Fetch employment details for the authenticated user
                    $stmt = $conn->prepare("SELECT * FROM employment_details WHERE user_id = ? AND tax_year = ?");
                    $stmt->bind_param("is", $user_id, $tax_year);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    // Prepare an array to hold employment details
                    $employment_details = [];

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $employment_details[] = $row;
                        }
                    }


                    ?>

                    <!-- Employment Details Section -->
                    <div id="employment_section" class="card curve-card card-dark">
                        <div class="card-header curve-card">
                            <h3 class="card-title"><i class="fas fa-briefcase"></i> Employment Details</h3>
                        </div>
                        <div class="card-body">

                            <!-- Add Employment Button -->
                            <div class="mb-3">
                                <button type="button" class="btn btn-success add-clear-form" data-toggle="modal" data-target="#addEmploymentModal">
                                    + CLICK HERE TO ADD EMPLOYMENT DETAILS
                                </button>
                            </div>
                            <div class="table-responsive">
                                <!-- Employment Details Table -->
                                <table class="table table-bordered table-striped" id="employmentTable">
                                    <thead>
                                        <tr>
                                            <th>Employer Name</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($employment_details)): ?>
                                            <?php foreach ($employment_details as $employment): ?>
                                                <tr>
                                                    <td><?php echo htmlspecialchars($employment['employer_name']); ?></td>
                                                    <td><?php echo htmlspecialchars($employment['employment_start_date']); ?></td>
                                                    <td><?php echo htmlspecialchars($employment['employment_end_date'] ?? 'N/A'); ?></td>
                                                    <td>
                                                        <button class="btn btn-sm btn-outline-primary edit-employment" data-employer="<?php echo htmlspecialchars($employment['employer_name']); ?>" data-start="<?php echo htmlspecialchars($employment['employment_start_date']); ?>" data-end="<?php echo htmlspecialchars($employment['employment_end_date']); ?>" data-id="<?php echo $employment['employment_id']; ?>">
                                                            <i class="fas fa-edit"></i>
                                                        </button>

                                                        <button class="btn btn-sm btn-outline-danger  delete-employment" data-id="<?php echo $employment['employment_id']; ?>">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </td>

                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="4" class="text-center">No employment details found.</td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>


                    </div>


                    <!-- Add Employment Modal -->
                    <div class="modal fade" id="addEmploymentModal" tabindex="-1" role="dialog" aria-labelledby="addEmploymentModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content curve-card card-dark">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="addEmploymentModalLabel">Add Employment Details</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="card curve-card">
                                        <div class="card-body">
                                            <form id="employmentForm">
                                                <input type="hidden" name="employment_id" id="employment_id"> <!-- Hidden field for editing -->
                                                <input type="hidden" name="user_id" class="form-control" id="user_id" value="<?= $user_id ?>">
                                                <input type="hidden" name="tax_year" class="form-control" id="tax_year" value="<?= $tax_year ?>">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="employer_name_modal">Employer Name</label>
                                                            <input type="text" name="employer_name_modal" class="form-control" id="employer_name_modal" placeholder="Enter Employer Name" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="employment_start_date_modal">Start Date</label>
                                                            <input type="date" name="employment_start_date_modal" class="form-control" id="employment_start_date_modal" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="employment_end_date_modal">End Date</label>
                                                            <input type="date" name="employment_end_date_modal" class="form-control" id="employment_end_date_modal" required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default curve-card" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary curve-card my-btn-primary-color" id="saveEmployment">Save Employment</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php

                    // Initialize variables to store existing data
                    $tax_year = date('Y'); // Current tax year
                    $sold_stocks = '';
                    $interest_income = '';
                    $dividend_income = '';
                    $rental_income = '';
                    $ira_distributions = '';
                    $foreign_income = '';
                    $hsa_distributions = '';
                    $foreign_income_nature = ''; // Initialize foreign income nature variable

                    // Fetch existing records for the user (replace user_id with actual user id)

                    $query = "SELECT * FROM other_income WHERE user_id = ? AND tax_year = ?";
                    $stmt = $conn->prepare($query);
                    $stmt->bind_param("is", $user_id, $tax_year);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        // Populate form variables from the database
                        $sold_stocks = $row['sold_stocks'];
                        $interest_income = $row['interest_income'];
                        $dividend_income = $row['dividend_income'];
                        $rental_income = $row['rental_income'];
                        $ira_distributions = $row['ira_distributions'];
                        $foreign_income = $row['foreign_income'];
                        $hsa_distributions = $row['hsa_distributions'];
                        $foreign_income_nature = $row['foreign_income_nature']; // Fetch foreign income nature
                    }
                    ?>

                    <!-- Form for Other Sources of Income -->
                    <form id="otherIncomeForm" class="custom-form" enctype="multipart/form-data">
                        <div class="card curve-card card-dark">
                            <div class="card-header curve-card">
                                <h3 class="card-title"><i class="fas fa-money-check-alt"></i> Other Sources of Income</h3>
                            </div>
                            <div class="card-body">
                                <input type="hidden" name="tax_year" class="form-control" id="tax_year" value="<?= $tax_year; ?>">

                                <input type="hidden" name="user_id" class="form-control" id="user_id" value="<?= $user_id ?>">

                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Income Type</th>
                                                <th>
                                                    <div class="icheck-primary d-inline">
                                                        <input type="radio" id="taxpayer_yes_all" name="taxpayer_all" value="yes" onchange="selectAll('yes')">
                                                        <label for="taxpayer_yes_all">Yes All</label>
                                                    </div>
                                                    <div class="icheck-primary d-inline ml-3">
                                                        <input type="radio" id="taxpayer_no_all" name="taxpayer_all" value="no" onchange="selectAll('no')">
                                                        <label for="taxpayer_no_all">No All</label>
                                                    </div>
                                                </th>
                                                <th>Additional Details</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Have you sold any stocks?</td>
                                                <td>
                                                    <div class="form-group clearfix">
                                                        <div class="icheck-primary d-inline">
                                                            <input type="radio" id="sold_stocks_yes" name="sold_stocks" value="yes" <?= $sold_stocks === 'yes' ? 'checked' : ''; ?> onchange="toggleField('sold_stocks', true)">
                                                            <label for="sold_stocks_yes">Yes</label>
                                                        </div>
                                                        <div class="icheck-primary d-inline ml-3">
                                                            <input type="radio" id="sold_stocks_no" name="sold_stocks" value="no" <?= $sold_stocks === 'no' ? 'checked' : ''; ?> onchange="toggleField('sold_stocks', false)">
                                                            <label for="sold_stocks_no">No</label>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <?php
                                                    $uploaded_1099b_file = null; // Variable to hold the uploaded 1099B file name
                                                    $document_type = '1099B'; // Define the document type for 1099B
                                                    $file_path = '../assets/uploads/documents/'; // Define the base path for uploaded documents

                                                    if ($user_id) {
                                                        $query = "SELECT * FROM documents WHERE user_id = ? AND document_type = ?"; // Prepare query
                                                        if ($stmt = $conn->prepare($query)) {
                                                            $stmt->bind_param('is', $user_id, $document_type); // Bind parameters
                                                            $stmt->execute(); // Execute the statement
                                                            $result = $stmt->get_result(); // Get the result set
                                                            if ($result->num_rows > 0) {
                                                                $document = $result->fetch_assoc(); // Fetch document details
                                                                $uploaded_1099b_file = $document['file_name']; // Get the file name
                                                            }
                                                            $stmt->close(); // Close the statement
                                                        }
                                                    }
                                                    ?>
                                                    <input type="hidden" name="old_form_1099b_upload" value="<?= htmlspecialchars($uploaded_1099b_file) ?>"> <!-- Store existing file name -->


                                                    <!-- Additional details section (optional) -->
                                                    <div id="sold_stocks_details" class="additional-details" style="display: <?= $sold_stocks === 'yes' ? 'block' : 'none'; ?>;">
                                                        <label for="upload_1099B">Attach 1099B document</label>
                                                        <input type="file" id="upload_1099B" name="upload_1099B" accept=".pdf,.jpg,.jpeg,.png" class="form-control-file">
                                                        <!-- Show existing file name if available -->
                                                        <?php if ($uploaded_1099b_file): ?>
                                                            <div class="mt-2">
                                                                <a href="<?= $file_path . htmlspecialchars($uploaded_1099b_file) ?>" target="_blank" class="btn btn-sm btn-success" download>
                                                                    <i class="fas fa-download"></i> Download Uploaded Document
                                                                </a>
                                                            </div>
                                                        <?php endif; ?>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Have you earned any Interest Income?</td>
                                                <td>
                                                    <div class="form-group clearfix">
                                                        <div class="icheck-primary d-inline">
                                                            <input type="radio" id="interest_income_yes" name="interest_income" value="yes" <?= $interest_income === 'yes' ? 'checked' : ''; ?> onchange="toggleField('interest_income', true)">
                                                            <label for="interest_income_yes">Yes</label>
                                                        </div>
                                                        <div class="icheck-primary d-inline ml-3">
                                                            <input type="radio" id="interest_income_no" name="interest_income" value="no" <?= $interest_income === 'no' ? 'checked' : ''; ?> onchange="toggleField('interest_income', false)">
                                                            <label for="interest_income_no">No</label>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div id="interest_income_details" class="additional-details" style="display: <?= $interest_income === 'yes' ? 'block' : 'none'; ?>;">
                                                        <label for="upload_1099INT">Attach 1099-INT document</label>
                                                        <?php
                                                        // 1099INT File Upload Logic
                                                        $uploaded_1099int_file = null;
                                                        $document_type_int = '1099INT';

                                                        if ($user_id) {
                                                            $query = "SELECT * FROM documents WHERE user_id = ? AND document_type = ?";
                                                            if ($stmt = $conn->prepare($query)) {
                                                                $stmt->bind_param('is', $user_id, $document_type_int);
                                                                $stmt->execute();
                                                                $result = $stmt->get_result();
                                                                if ($result->num_rows > 0) {
                                                                    $document = $result->fetch_assoc();
                                                                    $uploaded_1099int_file = $document['file_name'];
                                                                }
                                                                $stmt->close();
                                                            }
                                                        }
                                                        ?>
                                                        <input type="hidden" name="old_form_1099int_upload" value="<?= htmlspecialchars($uploaded_1099int_file) ?>">
                                                        <input type="file" id="upload_1099INT" name="upload_1099INT" accept=".pdf,.jpg,.jpeg,.png" class="form-control-file">
                                                        <?php if ($uploaded_1099int_file): ?>
                                                            <div class="mt-2">
                                                                <a href="<?= $file_path . htmlspecialchars($uploaded_1099int_file) ?>" target="_blank" class="btn btn-sm btn-success" download>
                                                                    <i class="fas fa-download"></i> Download Uploaded Document
                                                                </a>
                                                            </div>
                                                        <?php endif; ?>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>Do you have any Dividend Income?</td>
                                                <td>
                                                    <div class="form-group clearfix">
                                                        <div class="icheck-primary d-inline">
                                                            <input type="radio" id="dividend_income_yes" name="dividend_income" value="yes" <?= $dividend_income === 'yes' ? 'checked' : ''; ?> onchange="toggleField('dividend_income', true)">
                                                            <label for="dividend_income_yes">Yes</label>
                                                        </div>
                                                        <div class="icheck-primary d-inline ml-3">
                                                            <input type="radio" id="dividend_income_no" name="dividend_income" value="no" <?= $dividend_income === 'no' ? 'checked' : ''; ?> onchange="toggleField('dividend_income', false)">
                                                            <label for="dividend_income_no">No</label>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div id="dividend_income_details" class="additional-details" style="display: <?= $dividend_income === 'yes' ? 'block' : 'none'; ?>;">
                                                        <label for="upload_1099DIV">Attach 1099-DIV document</label>
                                                        <?php
                                                        // 1099DIV File Upload Logic
                                                        $uploaded_1099div_file = null;
                                                        $document_type_div = '1099DIV';

                                                        if ($user_id) {
                                                            $query = "SELECT * FROM documents WHERE user_id = ? AND document_type = ?";
                                                            if ($stmt = $conn->prepare($query)) {
                                                                $stmt->bind_param('is', $user_id, $document_type_div);
                                                                $stmt->execute();
                                                                $result = $stmt->get_result();
                                                                if ($result->num_rows > 0) {
                                                                    $document = $result->fetch_assoc();
                                                                    $uploaded_1099div_file = $document['file_name'];
                                                                }
                                                                $stmt->close();
                                                            }
                                                        }
                                                        ?>
                                                        <input type="hidden" name="old_form_1099div_upload" value="<?= htmlspecialchars($uploaded_1099div_file) ?>">
                                                        <input type="file" id="upload_1099DIV" name="upload_1099DIV" accept=".pdf,.jpg,.jpeg,.png" class="form-control-file">
                                                        <?php if ($uploaded_1099div_file): ?>
                                                            <div class="mt-2">
                                                                <a href="<?= $file_path . htmlspecialchars($uploaded_1099div_file) ?>" target="_blank" class="btn btn-sm btn-success" download>
                                                                    <i class="fas fa-download"></i> Download Uploaded Document
                                                                </a>
                                                            </div>
                                                        <?php endif; ?>
                                                    </div>
                                                </td>

                                            <tr>
                                                <td>Do you have any Rental or Business Income/expenses?</td>
                                                <td>
                                                    <div class="form-group clearfix">
                                                        <div class="icheck-primary d-inline">
                                                            <input type="radio" id="rental_income_yes" name="rental_income" value="yes" <?= $rental_income === 'yes' ? 'checked' : ''; ?>>
                                                            <label for="rental_income_yes">Yes</label>
                                                        </div>
                                                        <div class="icheck-primary d-inline ml-3">
                                                            <input type="radio" id="rental_income_no" name="rental_income" value="no" <?= $rental_income === 'no' ? 'checked' : ''; ?>>
                                                            <label for="rental_income_no">No</label>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td></td>
                                            </tr>

                                            <tr>
                                                <td>Do you have any Distributions from IRA?</td>
                                                <td>
                                                    <div class="form-group clearfix">
                                                        <div class="icheck-primary d-inline">
                                                            <input type="radio" id="ira_distributions_yes" name="ira_distributions" value="yes" <?= $ira_distributions === 'yes' ? 'checked' : ''; ?>>
                                                            <label for="ira_distributions_yes">Yes</label>
                                                        </div>
                                                        <div class="icheck-primary d-inline ml-3">
                                                            <input type="radio" id="ira_distributions_no" name="ira_distributions" value="no" <?= $ira_distributions === 'no' ? 'checked' : ''; ?>>
                                                            <label for="ira_distributions_no">No</label>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td>Have you earned any Foreign Income?</td>
                                                <td>
                                                    <div class="form-group clearfix">
                                                        <div class="icheck-primary d-inline">
                                                            <input type="radio" id="foreign_income_yes" name="foreign_income" value="yes" <?= $foreign_income === 'yes' ? 'checked' : ''; ?> onchange="toggleField('foreign_income', true)">
                                                            <label for="foreign_income_yes">Yes</label>
                                                        </div>
                                                        <div class="icheck-primary d-inline ml-3">
                                                            <input type="radio" id="foreign_income_no" name="foreign_income" value="no" <?= $foreign_income === 'no' ? 'checked' : ''; ?> onchange="toggleField('foreign_income', false)">
                                                            <label for="foreign_income_no">No</label>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div id="foreign_income_details" class="additional-details" style="display: <?= $foreign_income === 'yes' ? 'block' : 'none'; ?>;">
                                                        <label for="foreign_income_nature">Please write the nature of Income here</label>
                                                        <input type="text" id="foreign_income_nature" name="foreign_income_nature" class="form-control" placeholder="Enter the nature of income" value="<?= htmlspecialchars($foreign_income_nature); ?>">
                                                    </div>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td>Do you have any HSA Distributions?</td>
                                                <td>
                                                    <div class="form-group clearfix">
                                                        <div class="icheck-primary d-inline">
                                                            <input type="radio" id="hsa_distributions_yes" name="hsa_distributions" value="yes" <?= $hsa_distributions === 'yes' ? 'checked' : ''; ?>>
                                                            <label for="hsa_distributions_yes">Yes</label>
                                                        </div>
                                                        <div class="icheck-primary d-inline ml-3">
                                                            <input type="radio" id="hsa_distributions_no" name="hsa_distributions" value="no" <?= $hsa_distributions === 'no' ? 'checked' : ''; ?>>
                                                            <label for="hsa_distributions_no">No</label>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-info curve-card my-btn-primary-color">
                                    <i class="fas fa-paper-plane"></i> Submit
                                </button>
                                <!-- Back Button with Icon and onclick event -->
                                <button type="button" class="btn btn-default float-right curve-card" onclick="history.back();">
                                    <i class="fas fa-arrow-left"></i> Back
                                </button>
                            </div>
                        </div>
                    </form>

                    <script>
                        function toggleField(fieldName, isVisible) {
                            const fieldDetails = document.getElementById(`${fieldName}_details`);
                            if (fieldDetails) {
                                fieldDetails.style.display = isVisible ? 'block' : 'none';
                            }
                        }

                        function selectAll(option) {
                            const radioGroups = [
                                'sold_stocks',
                                'interest_income',
                                'dividend_income',
                                'rental_income',
                                'ira_distributions',
                                'foreign_income',
                                'hsa_distributions'
                            ];

                            radioGroups.forEach(group => {
                                const radios = document.querySelectorAll(`input[name="${group}"]`);
                                radios.forEach(radio => {
                                    radio.checked = radio.value === option;
                                });

                                const isYesSelected = document.querySelector(`input[name="${group}"][value="yes"]`).checked;
                                toggleField(group, isYesSelected);
                            });
                        }
                    </script>





                </div>
            </div>
        </div><!-- /.row -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php require('includes/footer.php'); ?>

<script src="ajax/Employment-Details/Employment_Details.js"></script>
<script src="ajax/Other-Income/Other_Income.js"></script>