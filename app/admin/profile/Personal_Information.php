<!-- Personal Information Section -->
<div class="card mb-3 curve-card card-dark">
    <div class="card-header curve-card">
        <h3 class="card-title"><i class="fas fa-user"></i> Personal Info FileNo#<?= htmlspecialchars($personal_info['personal_id'] . '-' . $tax_year . '-' . $personal_info['first_name'] . ' ' . $personal_info['last_name']); ?> (TY<?= htmlspecialchars($tax_year); ?>)</h3>
     
          <!-- Edit Icon with Tooltip -->
          <a href="edit_personaldetail.php?user_id=<?= $user_id; ?>&tax_year=<?= $tax_year; ?>" class="ml-3 float-right" title="Edit Details">
                <i class="fas fa-edit"></i>
            </a>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-sm">
                <tbody>
                    <tr>
                        <td><strong>First Name</strong></td>
                        <td><?= htmlspecialchars($personal_info['first_name'] ?? 'N/A'); ?></td>
                        <td><strong>Middle Name</strong></td>
                        <td><?= htmlspecialchars($personal_info['middle_name'] ?? 'N/A'); ?></td>
                    </tr>
                    <tr>
                        <td><strong>Last Name</strong></td>
                        <td><?= htmlspecialchars($personal_info['last_name'] ?? 'N/A'); ?></td>
                        <td><strong>Marital Status</strong></td>
                        <td><?= htmlspecialchars($personal_info['marital_status'] ?? 'N/A'); ?></td>
                    </tr>
                    <tr>
                        <td><strong>Filing Status</strong></td>
                        <td><?= htmlspecialchars($personal_info['filing_status'] ?? 'N/A'); ?></td>
                        <td><strong>Marriage Date</strong></td>
                        <td><?= htmlspecialchars($personal_info['marriage_date'] ?? 'N/A'); ?></td>
                    </tr>
                    <tr>
                        <td><strong>Date of Birth</strong></td>
                        <td><?= htmlspecialchars($personal_info['taxpayer_dob'] ?? 'N/A'); ?></td>
                        <td><strong>Occupation</strong></td>
                        <td><?= htmlspecialchars($personal_info['current_occupation'] ?? 'N/A'); ?></td>
                    </tr>
                    <tr>
                        <td><strong>Taxpayer SSN</strong></td>
                        <td><?= htmlspecialchars($personal_info['taxpayer_ssn_input'] ?? 'N/A'); ?></td>
                        <td><strong>Entry Date to the US</strong></td>
                        <td><?= htmlspecialchars($personal_info['taxpayer_entry_date'] ?? 'N/A'); ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>


    <!-- Spouse Information Section -->
    <?php if ($spouse_info): ?>
        <div class="card mb-3 curve-card card-dark">
            <div class="card-header curve-card">
                <h3 class="card-title"><i class="fas fa-user-friends"></i> Spouse Information</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-sm">
                        <tbody>
                            <tr>
                                <td><strong>First Name</strong></td>
                                <td><?= htmlspecialchars($spouse_info['spouse_first_name'] ?? 'N/A'); ?></td>
                                <td><strong>Middle Name</strong></td>
                                <td><?= htmlspecialchars($spouse_info['spouse_middle_name'] ?? 'N/A'); ?></td>
                            </tr>
                            <tr>
                                <td><strong>Last Name</strong></td>
                                <td><?= htmlspecialchars($spouse_info['spouse_last_name'] ?? 'N/A'); ?></td>
                                <td><strong>Date of Birth</strong></td>
                                <td><?= htmlspecialchars($spouse_info['spouse_dob'] ?? 'N/A'); ?></td>
                            </tr>
                            <tr>
                                <td><strong>Visa Category</strong></td>
                                <td><?= htmlspecialchars($spouse_info['spouse_visa_category'] ?? 'N/A'); ?></td>
                                <td><strong>SSN</strong></td>
                                <td><?= htmlspecialchars($spouse_info['spouse_ssn'] ?? 'N/A'); ?></td>
                            </tr>
                            <tr>
                                <td><strong>ITIN</strong></td>
                                <td><?= htmlspecialchars($spouse_info['spouse_itin'] ?? 'N/A'); ?></td>
                                <td><strong>Entry Date to the US</strong></td>
                                <td><?= htmlspecialchars($spouse_info['spouse_entry_date'] ?? 'N/A'); ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    <?php endif; ?>


    <!-- Contact Information Section -->
    <div class="card mb-3 curve-card card-dark">
        <div class="card-header curve-card">
            <h3 class="card-title"><i class="fas fa-address-book"></i> Contact Information</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-sm">
                    <tbody>
                        <tr>
                            <td><strong>Street Address</strong></td>
                            <td><?= htmlspecialchars($contact_info['street_address'] ?? 'N/A'); ?></td>
                            <td><strong>Apartment Number</strong></td>
                            <td><?= htmlspecialchars($contact_info['apartment_number'] ?? 'N/A'); ?></td>
                        </tr>
                        <tr>
                            <td><strong>City</strong></td>
                            <td><?= htmlspecialchars($contact_info['city'] ?? 'N/A'); ?></td>
                            <td><strong>State</strong></td>
                            <td><?= htmlspecialchars($contact_info['state'] ?? 'N/A'); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Zip Code</strong></td>
                            <td><?= htmlspecialchars($contact_info['zip_code'] ?? 'N/A'); ?></td>
                            <td><strong>Email</strong></td>
                            <td><?= htmlspecialchars($contact_info['email_id'] ?? 'N/A'); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Mobile Number</strong></td>
                            <td><?= htmlspecialchars($contact_info['mobile_number'] ?? 'N/A'); ?></td>
                            <td><strong>Work Number</strong></td>
                            <td><?= htmlspecialchars($contact_info['work_number'] ?? 'N/A'); ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Dependents Information Section -->

    <?php $sql = "SELECT * FROM dependents WHERE user_id = ? AND tax_year = ?";
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

            <div class="table-responsive">

                <!-- Dependent Table -->
                <table class="table table-bordered table-striped table-sm" id="dependentsTable">
                    <thead>
                        <tr>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>DOB</th>
                            <th>SSN/ITIN</th>
                            <th>Relationship</th>
                            <th>First Date of Entry to US</th>

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
                                    <td><?php echo htmlspecialchars($row['entry_date']); ?></td>


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

</div>
<!-- Insurance Details Section -->
<div class="card mb-3 curve-card card-dark">
    <div class="card-header curve-card">
        <h3 class="card-title"><i class="fas fa-heartbeat"></i> Insurance Details</h3>
        <h3 class="card-title float-right">

            <a href="edit_insurancedetails.php?user_id=<?= $user_id; ?>&tax_year=<?= $tax_year; ?>" class="ml-3" title="Edit Details">
                <i class="fas fa-edit"></i>
            </a>
        </h3>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-sm" id="">
                <tbody>
                    <tr>
                        <td><strong>Health Insurance</strong></td>
                        <td><?= htmlspecialchars($insurance_info['health_insurance'] ?? 'N/A'); ?></td>
                    </tr>
                    <tr>
                        <td><strong>Coverage Duration</strong></td>
                        <td><?= htmlspecialchars($insurance_info['coverage_duration'] ?? 'N/A'); ?></td>
                    </tr>
                    <tr>
                        <td><strong>Insurance Provider</strong></td>
                        <td><?= htmlspecialchars($insurance_info['insurance_provider'] ?? 'N/A'); ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>



<!-- Residency Details Section -->
<div id="residency_section" class="card curve-card card-dark">
    <div class="card-header curve-card">
        <h3 class="card-title"><i class="fas fa-home"></i> Residency Details</h3>
        <h3 class="card-title float-right">

            <a href="edit_Residencydetails.php?user_id=<?= $user_id; ?>&tax_year=<?= $tax_year; ?>" class="ml-3" title="Edit  Details">
                <i class="fas fa-edit"></i>
            </a>
        </h3>
    </div>
    <div class="card-body">

        <?php


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
            <table class="table table-bordered table-striped table-sm" id="residencyTable">
                <thead>
                    <tr>
                        <th>Residency Details for</th>
                        <th>State Name</th>
                        <th>Residency Start Date</th>
                        <th>Residency End Date</th>
                        <th>Rent Paid (Annual)</th>

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

<?php
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
        <h3 class="card-title float-right">

            <a href="edit_other_incomedetails.php?user_id=<?= $user_id; ?>&tax_year=<?= $tax_year; ?>" class="ml-3" title="Edit Details">
                <i class="fas fa-edit"></i>
            </a>
        </h3>
    </div>
    <div class="card-body">


        <div class="table-responsive">
            <!-- Employment Details Table -->
            <table class="table table-bordered table-striped table-sm" id="employmentTable">
                <thead>
                    <tr>
                        <th>Employer Name</th>
                        <th>Start Date</th>
                        <th>End Date</th>

                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($employment_details)): ?>
                        <?php foreach ($employment_details as $employment): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($employment['employer_name']); ?></td>
                                <td><?php echo htmlspecialchars($employment['employment_start_date']); ?></td>
                                <td><?php echo htmlspecialchars($employment['employment_end_date'] ?? 'N/A'); ?></td>


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




    <!-- Other Income Section -->
    <div class="card mb-3 curve-card card-dark">
        <div class="card-header curve-card">
            <h3 class="card-title"><i class="fas fa-dollar-sign"></i> Other Income</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped table-sm">
                <thead>
                    <tr>
                        <th>Income Type </th>
                        <th>Response</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Have you sold any stocks?</td>
                        <td><?= htmlspecialchars($income['sold_stocks'] ?? 'N/A'); ?></td>
                    </tr>
                    <tr>
                        <td>Have you earned any Interest Income?</td>
                        <td><?= htmlspecialchars($income['interest_income'] ?? 'N/A'); ?></td>
                    </tr>
                    <tr>
                        <td>Do you have any Dividend Income?</td>
                        <td><?= htmlspecialchars($income['dividend_income'] ?? 'N/A'); ?></td>
                    </tr>
                    <tr>
                        <td>Do you have any Rental or Business Income/expenses?</td>
                        <td><?= htmlspecialchars($income['rental_income'] ?? 'N/A'); ?></td>
                    </tr>
                    <tr>
                        <td>Have you earned any Foreign Income?</td>
                        <td><?= htmlspecialchars($income['foreign_income'] ?? 'N/A'); ?></td>
                    </tr>
                    <tr>
                        <td>Nature of Income :</td>
                        <td><?= htmlspecialchars($income['foreign_income_nature'] ?? 'N/A'); ?></td>
                    </tr>
                    <tr>
                        <td>Do you have any Distributions from IRA?</td>
                        <td><?= htmlspecialchars($income['ira_distributions'] ?? 'N/A'); ?></td>
                    </tr>
                    <tr>
                        <td>Do you have any HSA Distributions?</td>
                        <td><?= htmlspecialchars($income['hsa_distributions'] ?? 'N/A'); ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Deductions Section -->
<div class="card mb-3 curve-card card-dark">
    <div class="card-header curve-card">
        <h3 class="card-title"><i class="fas fa-file-invoice-dollar"></i> Deductions</h3>
        <h3 class="card-title float-right">

            <a href="edit_Deductionsdetails.php?user_id=<?= $user_id; ?>&tax_year=<?= $tax_year; ?>" class="ml-3" title="Edit Details">
                <i class="fas fa-edit"></i>
            </a>
        </h3>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-striped table-sm">
            <thead>
                <tr>
                    <th>Deduction Type</th>
                    <th>Taxpayer</th>
                    <th>Spouse</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Have you made any Charitable Contributions?
                    </td>
                    <td><?= htmlspecialchars($deduction['charitable_contributions'] ?? 'N/A'); ?></td>
                    <td><?= htmlspecialchars($deduction['charitable_contributions_spouse'] ?? 'N/A'); ?></td>
                </tr>
                <tr>
                    <td>Have you paid any Home Mortgage Interest?
                    </td>
                    <td><?= htmlspecialchars($deduction['home_mortgage_interest'] ?? 'N/A'); ?></td>
                    <td><?= htmlspecialchars($deduction['home_mortgage_interest_spouse'] ?? 'N/A'); ?></td>
                </tr>
                <tr>
                    <td>Have you purchased any hybrid/electric vehicle?
                    </td>
                    <td><?= htmlspecialchars($deduction['hybrid_vehicle'] ?? 'N/A'); ?></td>
                    <td><?= htmlspecialchars($deduction['hybrid_vehicle_spouse'] ?? 'N/A'); ?></td>
                </tr>
                <tr>
                    <td>Have you purchased any energy-saving equipment?
                    </td>
                    <td><?= htmlspecialchars($deduction['energy_equipment'] ?? 'N/A'); ?></td>
                    <td><?= htmlspecialchars($deduction['energy_equipment_spouse'] ?? 'N/A'); ?></td>
                </tr>
                <tr>
                    <td>Have you incurred any Medical expenses?
                    </td>
                    <td><?= htmlspecialchars($deduction['medical_expenses'] ?? 'N/A'); ?><br>
                        <small>Notes: <?= htmlspecialchars($deduction['medical_expenses_notes'] ?? 'N/A'); ?></small>
                    </td>
                    <td><?= htmlspecialchars($deduction['medical_expenses_spouse'] ?? 'N/A'); ?><br>
                        <small>Notes: <?= htmlspecialchars($deduction['medical_expenses_spouse_notes'] ?? 'N/A'); ?></small>
                    </td>
                </tr>
                <tr>
                    <td>Have you paid any Car taxes?
                    </td>
                    <td><?= htmlspecialchars($deduction['car_taxes'] ?? 'N/A'); ?><br>
                        <small>Details: <?= htmlspecialchars($deduction['car_details'] ?? 'N/A'); ?></small>
                    </td>
                    <td><?= htmlspecialchars($deduction['car_taxes_spouse'] ?? 'N/A'); ?><br>
                        <small>Details: <?= htmlspecialchars($deduction['car_details_spouse'] ?? 'N/A'); ?></small>
                    </td>
                </tr>
                <tr>
                    <td>Have you paid any motor vehicle tax in CT state?
                    </td>
                    <td><?= htmlspecialchars($deduction['motor_vehicle_tax'] ?? 'N/A'); ?></td>
                    <td><?= htmlspecialchars($deduction['motor_vehicle_tax_spouse'] ?? 'N/A'); ?></td>
                </tr>
                <tr>
                    <td>Did you contribute to 529 college saving plan?
                    </td>
                    <td><?= htmlspecialchars($deduction['college_saving_plan'] ?? 'N/A'); ?></td>
                    <td><?= htmlspecialchars($deduction['college_saving_plan_spouse'] ?? 'N/A'); ?></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>



<!-- Adjustments to Income Section -->
<div class="card mb-3 curve-card card-dark">
    <div class="card-header curve-card">
        <h3 class="card-title"><i class="fas fa-arrow-up"></i> Adjustments to Income</h3>
        <h3 class="card-title float-right">

            <a href="edit_Adjustmentsdetails.php?user_id=<?= $user_id; ?>&tax_year=<?= $tax_year; ?>" class="ml-3" title="Edit Details">
                <i class="fas fa-edit"></i>
            </a>
        </h3>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-sm">
                <thead>
                    <tr>
                        <th>Adjustment Type</th>
                        <th>Taxpayer</th>
                        <th>Spouse</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Have you incurred any Education expenses?
                        </td>
                        <td><?= htmlspecialchars($adjustments['education_expenses'] ?? 'N/A'); ?></td>
                        <td><?= htmlspecialchars($adjustments['education_expenses_spouse'] ?? 'N/A'); ?></td>
                    </tr>
                    <tr>
                        <td>Have you paid any Student Loan Interest?
                        </td>
                        <td><?= htmlspecialchars($adjustments['student_loan_interest'] ?? 'N/A'); ?></td>
                        <td><?= htmlspecialchars($adjustments['student_loan_interest_spouse'] ?? 'N/A'); ?></td>
                    </tr>
                    <tr>
                        <td>Have you made any Contribution to IRA (Retirement Plan)?
                        </td>
                        <td>
                            <?= htmlspecialchars($adjustments['ira_contribution'] ?? 'N/A'); ?>
                            <span class="text-muted">(<?= htmlspecialchars($adjustments['ira_contribution_type'] ?? 'N/A'); ?>)</span>
                        </td>
                        <td>
                            <?= htmlspecialchars($adjustments['ira_contribution_spouse'] ?? 'N/A'); ?>
                            <span class="text-muted">(<?= htmlspecialchars($adjustments['ira_contribution_spouse_type'] ?? 'N/A'); ?>)</span>
                        </td>
                    </tr>
                    <tr>
                        <td>Have you made any HSA Contributions?
                        </td>
                        <td><?= htmlspecialchars($adjustments['hsa_contribution'] ?? 'N/A'); ?></td>
                        <td><?= htmlspecialchars($adjustments['hsa_contribution_spouse'] ?? 'N/A'); ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- FBAR Status Section -->
<div class="card mb-3 curve-card card-dark">
    <div class="card-header curve-card">
        <h3 class="card-title"><i class="fas fa-bank"></i> FBAR Status</h3>
        <h3 class="card-title float-right">

            <a href="edit_financial_info.php?user_id=<?= $user_id; ?>&tax_year=<?= $tax_year; ?>" class="ml-3" title="Edit Details">
                <i class="fas fa-edit"></i>
            </a>
        </h3>
    </div>
    <div class="card-body">
        <p><strong>Did you have $10,000 or more balance in your Foreign Bank accounts any time during the tax year 2024?
                :</strong> <?= htmlspecialchars($fbar_info['fbar_status'] ?? 'N/A'); ?></p>
    </div>
    <div class="card-header curve-card">
        <h3 class="card-title"><i class="fas fa-business-time"></i> Business Income</h3>
    </div>
    <div class="card-body">
        <p><strong>Do you have business income during TY2024?
                :</strong> <?= htmlspecialchars($business_income_info['has_business_income'] ?? 'N/A'); ?></p>
    </div>
</div>