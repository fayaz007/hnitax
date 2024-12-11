<?php
$current_page = "Clients"; // Set the current page title
require('includes/header.php');
?>
<!-- Tooltip Styling -->
<style>
    .tool {
        cursor: pointer;
        color: #007bff;
        border-bottom: 1px dotted;
    }

    .tooltext:hover::after {
        content: attr(data-tip);
        position: absolute;
        background-color: #000;
        color: #fff;
        padding: 5px;
        border-radius: 5px;
        font-size: 12px;
        white-space: pre-wrap;
        top: 100%;
        left: 0;
        z-index: 10;
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
                    <h1 class="m-0">Edit Detail </h1>
                </div>
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
                    <form id="taxpayer-info-form" class="custom-form" enctype="multipart/form-data" method="POST" action="actions/">
                        <?php
                        // Get the `user_id` and `tax_year` from the URL parameters
                        $user_id = $_GET['user_id'];
                        $tax_year = $_GET['tax_year'];

                        // Initialize an array for default empty form values
                        $userData = [
                            'first_name' => '',
                            'middle_name' => '',
                            'last_name' => '',
                            'marital_status' => '',
                            'filing_status' => '',
                            'marriage_date' => '',
                            'taxpayer_dob' => '',
                            'current_occupation' => '',
                            'taxpayer_ssn_select' => '',
                            'taxpayer_ssn_input' => '',
                            'taxpayer_entry_date' => ''
                        ];

                        // Fetch data from the database if the user exists
                        if ($user_id) {
                            $query = "SELECT * FROM personal_information WHERE user_id = ? AND tax_year = ?";
                            if ($stmt = $conn->prepare($query)) {
                                $stmt->bind_param('is', $user_id, $tax_year); // Bind user_id to query
                                $stmt->execute();
                                $result = $stmt->get_result();
                                if ($result->num_rows > 0) {
                                    $userData = $result->fetch_assoc(); // Fetch data if exists
                                }
                                $stmt->close();
                            }
                        }
                        ?>

                        <!-- Form Starts Here -->
                        <form id="taxpayer-info-form" class="custom-form" enctype="multipart/form-data" method="POST">

                            <!-- Personal Information Section -->
                            <div class="card curve-card card-dark">
                                <div class="card-header curve-card">
                                    <h3 class="card-title"><i class="fa-solid fa-id-card"></i> Tax Payer Personal Information</h3>
                                    <h3 class="card-title float-right">
                                        TY<?= htmlspecialchars($tax_year); ?></h3>
                                </div>
                                <div class="card-body">
                                    <!-- Row 1: First Name, Middle Name, Last Name -->
                                    <div class="row">
                                        <input type="hidden" name="user_id" class="form-control" id="user_id" value="<?= $user_id ?>">
                                        <input type="hidden" name="tax_year" class="form-control" id="tax_year" value="<?= $tax_year ?>">

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="first_name">First Name <span class="required">*</span></label>
                                                <input type="text" name="first_name" class="form-control" id="first_name" placeholder="Enter first name as per SSN" value="<?= htmlspecialchars($userData['first_name'] ?? '') ?>" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="middle_name">Middle Name</label>
                                                <input type="text" name="middle_name" class="form-control" id="middle_name" placeholder="Enter middle name as per SSN" value="<?= htmlspecialchars($userData['middle_name'] ?? '') ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="last_name">Last Name (As Per SSN) <span class="required">*</span></label>
                                                <input type="text" name="last_name" class="form-control" id="last_name" placeholder="Enter last name as per SSN" value="<?= htmlspecialchars($userData['last_name'] ?? '') ?>" required>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Row 2: Marital Status, Filing Status, Date of Marriage -->
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="marital_status">Marital Status <span class="required">*</span></label>
                                                <select name="marital_status" class="form-control" id="marital_status" required onchange="toggleSpouseSection()">
                                                    <option value="" disabled <?= empty($userData['marital_status']) ? 'selected' : '' ?>>Choose marital status</option>
                                                    <option value="Single" <?= $userData['marital_status'] === 'Single' ? 'selected' : '' ?>>Single</option>
                                                    <option value="Married" <?= $userData['marital_status'] === 'Married' ? 'selected' : '' ?>>Married</option>
                                                    <option value="Divorced" <?= $userData['marital_status'] === 'Divorced' ? 'selected' : '' ?>>Divorced</option>
                                                    <option value="Head of House Hold" <?= $userData['marital_status'] === 'Head of House Hold' ? 'selected' : '' ?>>Head of House Hold</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="filing_status">Filing Status <span class="required">*</span></label>
                                                <select name="filing_status" class="form-control" id="filing_status" required>
                                                    <option disabled <?= empty($userData['filing_status']) ? 'selected' : '' ?>>Choose filing status</option>
                                                    <option value="Single" <?= $userData['filing_status'] === 'Single' ? 'selected' : '' ?>>Single</option>
                                                    <option value="Married Filing Jointly" <?= $userData['filing_status'] === 'Married Filing Jointly' ? 'selected' : '' ?>>Married Filing Jointly</option>
                                                    <option value="Married Filing Separately" <?= $userData['filing_status'] === 'Married Filing Separately' ? 'selected' : '' ?>>Married Filing Separately</option>
                                                    <option value="Head of House Hold" <?= $userData['filing_status'] === 'Head of House Hold' ? 'selected' : '' ?>>Head of House Hold</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="marriage_date">Date of Marriage</label>
                                                <input type="date" name="marriage_date" class="form-control" id="marriage_date" value="<?= htmlspecialchars($userData['marriage_date'] ?? '') ?>">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Row 3: Taxpayer DOB, Occupation, SSN -->
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="taxpayer_dob">Taxpayer DOB <span class="required">*</span></label>
                                                <input type="date" name="taxpayer_dob" class="form-control" id="taxpayer_dob" value="<?= htmlspecialchars($userData['taxpayer_dob'] ?? '') ?>" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="current_occupation">Current Occupation <span class="required">*</span></label>
                                                <input type="text" name="current_occupation" class="form-control" id="current_occupation" placeholder="Enter current occupation" value="<?= htmlspecialchars($userData['current_occupation'] ?? '') ?>" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="taxpayer_ssn_select">Taxpayer Holding SSN? <span class="required">*</span></label>
                                                <select name="taxpayer_ssn_select" id="taxpayer_ssn_select" class="form-control" required onchange="toggleSSNInput()">
                                                    <option value="">-- Select Option --</option>
                                                    <option value="yes" <?= $userData['taxpayer_ssn_select'] === 'yes' ? 'selected' : '' ?>>Yes</option>
                                                    <option value="no" <?= $userData['taxpayer_ssn_select'] === 'no' ? 'selected' : '' ?>>No</option>
                                                    <option value="Need to apply" <?= $userData['taxpayer_ssn_select'] === 'Need to apply' ? 'selected' : '' ?>>Need to apply</option>
                                                </select>
                                            </div>
                                        </div>

                                        <!-- SSN Input Field (Hidden if SSN not selected) -->
                                        <div class="col-md-4 form-group" id="ssn_input_container" style="<?= $userData['taxpayer_ssn_select'] !== 'yes' ? 'display: none;' : '' ?>">
                                            <label for="taxpayer_ssn_input">Enter SSN <span class="required">*</span></label>
                                            <input type="text" name="taxpayer_ssn_input" class="form-control" id="taxpayer_ssn_input" placeholder="Enter SSN (Format: XXX-XX-XXXX)" title="Please enter a valid SSN in the format XXX-XX-XXXX" value="<?= htmlspecialchars($userData['taxpayer_ssn_input'] ?? '') ?>">
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="taxpayer_entry_date">Taxpayer First Date of Entry to USA <span class="required">*</span></label>
                                                <input type="date" name="taxpayer_entry_date" class="form-control" id="taxpayer_entry_date" value="<?= htmlspecialchars($userData['taxpayer_entry_date'] ?? '') ?>" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>




                            <script>
                                // Function to toggle SSN input visibility based on select option
                                function toggleSSNInput() {
                                    var ssnSelect = document.getElementById('taxpayer_ssn_select');
                                    var ssnInputContainer = document.getElementById('ssn_input_container');

                                    if (ssnSelect.value === 'yes') {
                                        ssnInputContainer.style.display = 'block'; // Show SSN input
                                        document.getElementById('taxpayer_ssn_input').setAttribute('required', 'required'); // Add required attribute
                                    } else {
                                        ssnInputContainer.style.display = 'none'; // Hide SSN input
                                        document.getElementById('taxpayer_ssn_input').removeAttribute('required'); // Remove required attribute
                                    }
                                }
                            </script>
                </div>
            </div>
            <?php
            // Fetch spouse information if user ID exists
            if ($user_id) {
                // Prepare the query to fetch spouse information
                $query = "SELECT * FROM spouse_information WHERE user_id = ? AND tax_year =?";
                if ($stmt = $conn->prepare($query)) {
                    $stmt->bind_param('is', $user_id, $tax_year); // Bind the user_id parameter
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $spouseData = $result->fetch_assoc();
                    $stmt->close();
                }
            } else {
                // Set default empty values if no data is found
                $spouseData = [
                    'spouse_first_name' => '',
                    'spouse_middle_name' => '',
                    'spouse_last_name' => '',
                    'spouse_dob' => '',
                    'spouse_visa_category' => '',
                    'spouse_itin' => '',
                    'spouse_ssn' => '',
                    'spouse_entry_date' => '',
                ];
            }
            ?>

            <!-- Spouse Information Section -->
            <div id="spouse_info_section" class="card curve-card card-dark">
                <div class="card-header curve-card">
                    <h3 class="card-title"><i class="fa-solid fa-id-card"></i> Spouse Information</h3>
                </div>
                <div class="card-body">
                    <!-- Row 1: First Name, Middle Name, Last Name -->
                    <div class="row">
                        <!-- First Name -->
                        <div class="col-md-4">
                            <input type="hidden" name="user_id" class="form-control" id="user_id" value="<?= $user_id ?>">
                            <input type="hidden" name="tax_year" class="form-control" id="tax_year" value="<?= $tax_year ?>">
                            <div class="form-group">
                                <label for="spouse_first_name">First Name <span class="required">*</span></label>
                                <input type="text" name="spouse_first_name" class="form-control" id="spouse_first_name"
                                    placeholder="Enter spouse's first name as per SSN"
                                    value="<?= htmlspecialchars($spouseData['spouse_first_name'] ?? '') ?>" required>
                            </div>
                        </div>
                        <!-- Middle Name -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="spouse_middle_name">Middle Name</label>
                                <input type="text" name="spouse_middle_name" class="form-control" id="spouse_middle_name"
                                    placeholder="Enter spouse's middle name as per SSN"
                                    value="<?= htmlspecialchars($spouseData['spouse_middle_name'] ?? '') ?>">
                            </div>
                        </div>
                        <!-- Last Name -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="spouse_last_name">Last Name (As per SSN) <span class="required">*</span></label>
                                <input type="text" name="spouse_last_name" class="form-control" id="spouse_last_name"
                                    placeholder="Enter spouse's last name as per SSN"
                                    value="<?= htmlspecialchars($spouseData['spouse_last_name'] ?? '') ?>" required>
                            </div>
                        </div>

                        <!-- Spouse DOB -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="spouse_dob">Spouse DOB <span class="required">*</span></label>
                                <input type="date" name="spouse_dob" class="form-control" id="spouse_dob"
                                    value="<?= htmlspecialchars($spouseData['spouse_dob'] ?? '') ?>" required>
                            </div>
                        </div>
                        <!-- Spouse Visa Category -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="spouse_visa_category">Spouse Visa Category <span class="required">*</span></label>
                                <select name="spouse_visa_category" class="form-control" id="spouse_visa_category" required>
                                    <option disabled <?= empty($spouseData['spouse_visa_category']) ? 'selected' : '' ?>>Choose spouse visa category</option>
                                    <option value="US Citizen" <?= (isset($spouseData['spouse_visa_category']) && $spouseData['spouse_visa_category'] == 'US Citizen') ? 'selected' : '' ?>>US Citizen</option>
                                    <option value="H1B" <?= (isset($spouseData['spouse_visa_category']) && $spouseData['spouse_visa_category'] == 'H1B') ? 'selected' : '' ?>>H1B</option>
                                    <option value="H4" <?= (isset($spouseData['spouse_visa_category']) && $spouseData['spouse_visa_category'] == 'H4') ? 'selected' : '' ?>>H4</option>
                                    <option value="H4-EAD" <?= (isset($spouseData['spouse_visa_category']) && $spouseData['spouse_visa_category'] == 'H4-EAD') ? 'selected' : '' ?>>H4-EAD</option>
                                    <option value="L1B" <?= (isset($spouseData['spouse_visa_category']) && $spouseData['spouse_visa_category'] == 'L1B') ? 'selected' : '' ?>>L1B</option>
                                    <option value="L1A" <?= (isset($spouseData['spouse_visa_category']) && $spouseData['spouse_visa_category'] == 'L1A') ? 'selected' : '' ?>>L1A</option>
                                    <option value="L2" <?= (isset($spouseData['spouse_visa_category']) && $spouseData['spouse_visa_category'] == 'L2') ? 'selected' : '' ?>>L2</option>
                                    <option value="F1" <?= (isset($spouseData['spouse_visa_category']) && $spouseData['spouse_visa_category'] == 'F1') ? 'selected' : '' ?>>F1</option>
                                    <option value="F2" <?= (isset($spouseData['spouse_visa_category']) && $spouseData['spouse_visa_category'] == 'F2') ? 'selected' : '' ?>>F2</option>
                                    <option value="J1" <?= (isset($spouseData['spouse_visa_category']) && $spouseData['spouse_visa_category'] == 'J1') ? 'selected' : '' ?>>J1</option>
                                    <option value="J2" <?= (isset($spouseData['spouse_visa_category']) && $spouseData['spouse_visa_category'] == 'J2') ? 'selected' : '' ?>>J2</option>
                                    <option value="GC" <?= (isset($spouseData['spouse_visa_category']) && $spouseData['spouse_visa_category'] == 'GC') ? 'selected' : '' ?>>GC</option>
                                    <option value="Others" <?= (isset($spouseData['spouse_visa_category']) && $spouseData['spouse_visa_category'] == 'Others') ? 'selected' : '' ?>>Others</option>
                                </select>
                            </div>
                        </div>

                        <!-- Spouse ITIN -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="spouse_itin">Spouse Holding ITIN? <span class="required">*</span></label>
                                <select id="spouse_itin" name="spouse_itin" class="form-control" required>
                                    <option value="" disabled <?= empty($spouseData['spouse_itin']) ? 'selected' : '' ?>>Select</option>
                                    <option value="yes" <?= (isset($spouseData['spouse_itin']) && $spouseData['spouse_itin'] == 'yes') ? 'selected' : '' ?>>Yes</option>
                                    <option value="no" <?= (isset($spouseData['spouse_itin']) && $spouseData['spouse_itin'] == 'no') ? 'selected' : '' ?>>No</option>
                                    <option value="Need to apply" <?= (isset($spouseData['spouse_itin']) && $spouseData['spouse_itin'] == 'Need to apply') ? 'selected' : '' ?>>Need to apply</option>
                                </select>
                            </div>
                        </div>


                        <!-- SSN/ITIN Field (Shown if ITIN is Yes) -->
                        <div class="col-md-4" id="spouse_itin_input_container" style="display: <?= ($spouseData['spouse_itin'] == 'yes') ? 'block' : 'none' ?>;">
                            <div class="form-group">
                                <label for="spouse_ssn">Spouse SSN/ITIN</label>
                                <input type="text" name="spouse_ssn" class="form-control" id="spouse_ssn"
                                    placeholder="Enter SSN/ITIN"
                                    value="<?= htmlspecialchars($spouseData['spouse_ssn'] ?? '') ?>"
                                    title="Please enter a valid SSN/ITIN in the format XXX-XX-XXXX">
                            </div>
                        </div>

                        <!-- Spouse Entry Date -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="spouse_entry_date">Spouse First Date of Entry to USA <span class="required">*</span></label>
                                <input type="date" name="spouse_entry_date" class="form-control" id="spouse_entry_date"
                                    value="<?= htmlspecialchars($spouseData['spouse_entry_date'] ?? '') ?>">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                // Handle dynamic display of SSN/ITIN input based on the ITIN selection
                document.getElementById('spouse_itin').addEventListener('change', function() {
                    var itinInputContainer = document.getElementById('spouse_itin_input_container');
                    if (this.value === 'yes') {
                        itinInputContainer.style.display = 'block'; // Show the input field if "Yes" is selected
                    } else {
                        itinInputContainer.style.display = 'none'; // Hide the input field if "No" is selected
                    }
                });
            </script>

            <!-- php code  -->
            <?php

            $sql = "SELECT * FROM contact_information WHERE user_id = ? AND tax_year =?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("is", $user_id, $tax_year);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $contactInfo = $result->fetch_assoc();
            } else {
                // Handle if no contact information is found, initialize as empty
                $contactInfo = [
                    'street_address' => '',
                    'apartment_number' => '',
                    'city' => '',
                    'state' => '',
                    'zip_code' => '',
                    'email_id' => '',
                    'mobile_number' => '',
                    'work_number' => ''
                ];
            }
            ?>
            <!-- Contact Information Section -->
            <div class="card curve-card card-dark">
                <div class="card-header curve-card">
                    <h3 class="card-title"><i class="fa-solid fa-address-card"></i> Contact Information</h3>
                </div>
                <div class="card-body">
                    <!-- Row 1: Current Street Address, Apartment Number -->
                    <input type="hidden" name="user_id" class="form-control" id="user_id" value="<?= $user_id ?>">
                    <input type="hidden" name="tax_year" class="form-control" id="tax_year" value="<?= $tax_year ?>">

                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="street_address"><i class="fa-solid fa-road"></i> Current Street Address <span class="required">*</span></label>
                                <input type="text" name="street_address" class="form-control" id="street_address" placeholder="Enter your current street address" required value="<?php echo htmlspecialchars($contactInfo['street_address']); ?>">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="apartment_number"><i class="fa-solid fa-building"></i> Apartment Number</label>
                                <input type="text" name="apartment_number" class="form-control" id="apartment_number" placeholder="Enter apartment number" value="<?php echo htmlspecialchars($contactInfo['apartment_number']); ?>">
                            </div>
                        </div>
                    </div>

                    <!-- Row 2: City, State, Zip Code -->
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="city"><i class="fa-solid fa-city"></i> City <span class="required">*</span></label>
                                <input type="text" name="city" class="form-control" id="city" placeholder="Enter city" required value="<?php echo htmlspecialchars($contactInfo['city']); ?>">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="state"><i class="fa-solid fa-map-marker-alt"></i> State <span class="required">*</span></label>
                                <input type="text" name="state" class="form-control" id="state" placeholder="Enter state" required value="<?php echo htmlspecialchars($contactInfo['state']); ?>">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="zip_code"><i class="fa-solid fa-map-pin"></i> Zip Code <span class="required">*</span></label>
                                <input type="text" name="zip_code" class="form-control" id="zip_code" placeholder="Enter zip code" required value="<?php echo htmlspecialchars($contactInfo['zip_code']); ?>">
                            </div>
                        </div>
                    </div>

                    <!-- Row 3: Email ID, Mobile Number, Work Number -->
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="email_id"><i class="fa-solid fa-envelope"></i> Email ID <span class="required">*</span></label>
                                <input type="email" name="email_id" class="form-control" id="email_id" placeholder="Enter email ID" required value="<?php echo htmlspecialchars($contactInfo['email_id']); ?>">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="mobile_number"><i class="fa-solid fa-mobile-alt"></i> Mobile Number <span class="required">*</span></label>
                                <input type="tel" name="mobile_number" class="form-control" id="mobile_number" placeholder="Enter mobile number" required value="<?php echo htmlspecialchars($contactInfo['mobile_number']); ?>">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="work_number"><i class="fa-solid fa-phone"></i> Work Number</label>
                                <input type="tel" name="work_number" class="form-control" id="work_number" placeholder="Enter work number" value="<?php echo htmlspecialchars($contactInfo['work_number']); ?>">
                            </div>
                        </div>
                    </div>
                </div>
            </div>




            <?php $sql = "SELECT * FROM dependents WHERE user_id = ? And tax_year = ?   ";
            $stmt = $conn->prepare($sql);

            // Bind parameters
            $stmt->bind_param("is", $user_id, $tax_year); // Assuming user_id is an integer
            $stmt->execute();

            // Get the result
            $result = $stmt->get_result();

            // Check if the query was successful
            if ($result === false) {
                die("Error fetching data: " . $conn->error);
            }
            ?>

            <!-- Dependent Information Section -->
            <div id="dependent_section" class="card curve-card card-dark">
                <div class="card-header curve-card">
                    <h3 class="card-title"><i class="fa-solid fa-users"></i> Dependent Information</h3>
                </div>
                <div class="card-body">

                    <!-- Add Dependent Button -->
                    <div class="mb-3">
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addDependentModal">
                            + CLICK HERE TO ADD DEPENDENT
                        </button>
                    </div>
                    <div class="table-responsive">

                        <!-- Dependent Table -->
                        <table class="table table-bordered table-striped" id="dependentsTable">
                            <thead>
                                <tr>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>DOB</th>
                                    <th>SSN/ITIN</th>
                                    <th>Relationship</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($result->num_rows > 0): ?>
                                    <?php while ($row = $result->fetch_assoc()): ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($row['first_name']); ?></td>
                                            <td><?php echo htmlspecialchars($row['last_name']); ?></td>
                                            <td><?php echo htmlspecialchars(date('Y-m-d', strtotime($row['dob']))); ?></td>
                                            <td><?php echo htmlspecialchars($row['ssn']); ?></td>
                                            <td><?php echo htmlspecialchars($row['relationship']); ?></td>
                                            <td>
                                                <a href="javascript:void(0);" onclick="editDependent(<?php echo $row['dependent_id']; ?>)" class="btn btn-outline-primary btn-sm">
                                                    <i class="fas fa-edit"></i> <!-- Font Awesome edit icon -->
                                                </a>
                                                <a href="javascript:void(0);" onclick="deleteDependent(<?php echo $row['dependent_id']; ?>)" class="btn btn-outline-danger btn-sm ml-2">
                                                    <i class="fas fa-trash"></i> <!-- Font Awesome delete icon -->
                                                </a>
                                            </td>

                                        </tr>
                                    <?php endwhile; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="6" class="text-center">No dependents found.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>


            </div>

            <div class="card-footer curve-card">
                <button type="submit" id="submit-btn" class="btn btn-info curve-card my-btn-primary-color">
                    <i class="fas fa-paper-plane"></i> Submit
                </button>
                <!-- Back Button with Icon and onclick event -->
                <button type="button" class="btn btn-default float-right curve-card" onclick="history.back();">
                    <i class="fas fa-arrow-left"></i> Back
                </button>
            </div>

            <?php
            // Free the result and close the database connection if not needed further
            $stmt->close(); // Close the prepared statement
            $conn->close(); // Close the database connection
            ?>
            </form>
        </div>
</div>
<!-- Add Dependent Modal -->
<div class="modal fade" id="addDependentModal" tabindex="-1" role="dialog" aria-labelledby="addDependentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content curve-card card-dark">
            <div class="modal-header">
                <h5 class="modal-title" id="addDependentModalLabel">Add Dependent</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="card curve-card">
                    <div class="card-body">
                        <form id="dependentForm">
                            <input type="hidden" id="dependent_id" name="dependent_id" value=""> <!-- Hidden field to store dependent ID -->

                            <input type="hidden" name="user_id" class="form-control" id="user_id" value="<?= $user_id ?>">
                            <input type="hidden" name="tax_year" class="form-control" id="tax_year" value="<?= $tax_year ?>">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="dependent_first_name_modal">First Name</label>
                                        <input type="text" name="dependent_first_name_modal" class="form-control" id="dependent_first_name_modal" placeholder="Enter dependent's first name as Per SSN" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="dependent_last_name_modal">Last Name (as Per SSN)</label>
                                        <input type="text" name="dependent_last_name_modal" class="form-control" id="dependent_last_name_modal" placeholder="Enter dependent's last name as Per SSN" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="dependent_dob_modal">Date of Birth</label>
                                        <input type="date" name="dependent_dob_modal" class="form-control" id="dependent_dob_modal" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="dependent_ssn_select">Dependent Holding SSN/ITIN? <span class="required">*</span></label>
                                        <select name="dependent_ssn_select" id="dependent_ssn_select" class="form-control" required onchange="toggleDependentSSNInput()">
                                            <option value="">-- Select Option --</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                            <option value="Need to apply">Need to apply</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- SSN/ITIN Input Field (Hidden if not selected) -->
                            <div class="col-md-12 form-group" id="dependent_ssn_input_container" style="display: none;">
                                <label for="dependent_ssn_modal">Enter SSN/ITIN <span class="required">*</span></label>
                                <input type="text" name="dependent_ssn_modal" class="form-control" id="dependent_ssn_modal" placeholder="Enter SSN/ITIN (Format: XXX-XX-XXXX)" title="Please enter a valid SSN/ITIN in the format XXX-XX-XXXX">
                            </div>
                            <div class="form-group">
                                <label for="dependent_relationship_modal">Relationship to Taxpayer</label>
                                <select name="dependent_relationship_modal" class="form-control" id="dependent_relationship_modal" required>
                                    <option disabled selected>Choose relationship</option>
                                    <option value="Son">Son</option>
                                    <option value="Step Son">Step Son</option>
                                    <option value="Daughter">Daughter</option>
                                    <option value="Step Daughter">Step Daughter</option>
                                    <option value="Brother">Brother</option>
                                    <option value="Sister">Sister</option>
                                    <option value="Mother">Mother</option>
                                    <option value="Father">Father</option>
                                    <option value="Mother in Law">Mother in Law</option>
                                    <option value="Father in Law">Father in Law</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="dependent_entry_date_modal">First Date of Entry to US <span class="required">*</span></label>
                                <input type="date" name="dependent_entry_date_modal" class="form-control" id="dependent_entry_date_modal" required>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


            <div class="modal-footer">
                <button type="button" class="btn btn-default curve-card" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary curve-card my-btn-primary-color" id="saveDependent">Save </button>
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
    // Function to toggle SSN/ITIN input based on selection
    function toggleDependentSSNInput() {
        var ssnSelect = document.getElementById('dependent_ssn_select').value;
        var ssnInputContainer = document.getElementById('dependent_ssn_input_container');
        if (ssnSelect === 'yes') {
            ssnInputContainer.style.display = 'block';
        } else {
            ssnInputContainer.style.display = 'none';
        }
    }
</script>
<script>
    // Function to toggle spouse and dependent sections visibility
    function toggleSpouseSection() {
        var maritalStatus = document.getElementById('marital_status').value;
        var spouseSection = document.getElementById('spouse_info_section');
        var dependentSection = document.getElementById('dependent_section');

        if (maritalStatus === 'Married') {
            spouseSection.style.display = 'block'; // Show spouse section if married
            dependentSection.style.display = 'block'; // Show dependent section if married

            // Make spouse fields required
            document.getElementById('spouse_first_name').setAttribute('required', 'required');
            document.getElementById('spouse_last_name').setAttribute('required', 'required');
            document.getElementById('spouse_dob').setAttribute('required', 'required');
            document.getElementById('spouse_itin').setAttribute('required', 'required');
        } else if (maritalStatus === 'Head of House Hold') {
            spouseSection.style.display = 'none'; // Hide spouse section if head of household
            dependentSection.style.display = 'block'; // Show dependent section for head of household

            // Remove required attributes for spouse fields
            document.getElementById('spouse_first_name').removeAttribute('required');
            document.getElementById('spouse_last_name').removeAttribute('required');
            document.getElementById('spouse_dob').removeAttribute('required');
            document.getElementById('spouse_itin').removeAttribute('required');
        } else {
            spouseSection.style.display = 'none'; // Hide spouse section for other statuses
            dependentSection.style.display = 'none'; // Hide dependent section for other statuses

            // Remove required attributes for spouse fields
            document.getElementById('spouse_first_name').removeAttribute('required');
            document.getElementById('spouse_last_name').removeAttribute('required');
            document.getElementById('spouse_dob').removeAttribute('required');
            document.getElementById('spouse_itin').removeAttribute('required');
        }
    }
    window.onload = toggleSpouseSection;
</script>

<script src="ajax/personal-information/personal-information.js"></script>
<script src="ajax/personal-information/Dependent.js"></script>