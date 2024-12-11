<?php
$current_page = "Clients"; // Set the current page title
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
                    <h1 class="m-0">Edit Details</h1>
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
                <?php

                $user_id = $_GET['user_id'];
                $tax_year = $_GET['tax_year'];

                // Initialize deduction variables
                $charitable_contributions = $charitable_contributions_spouse = '';
                $home_mortgage_interest = $home_mortgage_interest_spouse = '';
                $hybrid_vehicle = $hybrid_vehicle_spouse = '';
                $energy_equipment = $energy_equipment_spouse = '';
                $medical_expenses = $medical_expenses_notes = '';
                $medical_expenses_spouse = $medical_expenses_spouse_notes = '';
                $car_taxes = $car_details = '';
                $car_taxes_spouse = $car_details_spouse = '';
                $motor_vehicle_tax = $motor_vehicle_tax_spouse = '';
                $college_saving_plan = $college_saving_plan_spouse = '';

                // Fetch existing deduction records
                $query = "SELECT * FROM deductions WHERE user_id = ? AND tax_year = ?";
                $stmt = $conn->prepare($query);
                $stmt->bind_param("is", $user_id, $tax_year);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();

                    // Populate variables with database values
                    $charitable_contributions = $row['charitable_contributions'];
                    $charitable_contributions_spouse = $row['charitable_contributions_spouse'];
                    $home_mortgage_interest = $row['home_mortgage_interest'];
                    $home_mortgage_interest_spouse = $row['home_mortgage_interest_spouse'];
                    $hybrid_vehicle = $row['hybrid_vehicle'];
                    $hybrid_vehicle_spouse = $row['hybrid_vehicle_spouse'];
                    $energy_equipment = $row['energy_equipment'];
                    $energy_equipment_spouse = $row['energy_equipment_spouse'];
                    $medical_expenses = $row['medical_expenses'];
                    $medical_expenses_notes = $row['medical_expenses_notes'];
                    $medical_expenses_spouse = $row['medical_expenses_spouse'];
                    $medical_expenses_spouse_notes = $row['medical_expenses_spouse_notes'];
                    $car_taxes = $row['car_taxes'];
                    $car_details = $row['car_details'];
                    $car_taxes_spouse = $row['car_taxes_spouse'];
                    $car_details_spouse = $row['car_details_spouse'];
                    $motor_vehicle_tax = $row['motor_vehicle_tax'];
                    $motor_vehicle_tax_spouse = $row['motor_vehicle_tax_spouse'];
                    $college_saving_plan = $row['college_saving_plan'];
                    $college_saving_plan_spouse = $row['college_saving_plan_spouse'];
                }
                ?>

                <div class="col-md-12">
                    <form id="deductionsForm" class="custom-form" enctype="multipart/form-data">
                        <input type="hidden" name="user_id" class="form-control" id="user_id" value="<?= $user_id ?>">
                        <input type="hidden" name="tax_year" class="form-control" id="tax_year" value="<?= $tax_year ?>">
                        <div class="card curve-card card-dark">
                            <div class="card-header curve-card">
                                <h3 class="card-title"><i class="fas fa-money-check-alt"></i> Deductions</h3>
                            </div>
                            <div class="card-body">
                                <!-- Table Structure with iCheck -->
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <!-- Main Header Row -->
                                            <tr>
                                                <th rowspan="2">TY<?= date("Y"); ?></th> <!-- Column for TY2024 spanning two rows -->
                                                <th colspan="1">Tax Payer</th> <!-- Main header for Tax Payer with Yes/No columns -->
                                                <th colspan="1">Spouse</th> <!-- Main header for Spouse with Yes/No columns -->
                                            </tr>
                                            <!-- Sub Header Row for Yes All/No All Options -->
                                            <tr>
                                                <!-- Tax Payer Yes All Option -->
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


                                                <!-- Spouse Yes All Option -->
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
                                            <!-- Row 1: Charitable Contributions -->
                                            <tr>
                                                <td>Have you made any Charitable Contributions?</td>
                                                <td>
                                                    <div class="form-group clearfix">
                                                        <div class="icheck-primary d-inline">
                                                            <input type="radio" id="charitable_contributions_yes" name="charitable_contributions" value="yes" <?= $charitable_contributions === 'yes' ? 'checked' : ''; ?> required onchange="checkMedicalFields()">
                                                            <label for="charitable_contributions_yes">Yes</label>
                                                        </div>
                                                        <div class="icheck-primary d-inline ml-3">
                                                            <input type="radio" id="charitable_contributions_no" name="charitable_contributions" value="no" <?= $charitable_contributions === 'no' ? 'checked' : ''; ?> required onchange="checkMedicalFields()">
                                                            <label for="charitable_contributions_no">No</label>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group clearfix">
                                                        <div class="icheck-primary d-inline">
                                                            <input type="radio" id="charitable_contributions_spouse_yes" name="charitable_contributions_spouse" value="yes" <?= $charitable_contributions_spouse === 'yes' ? 'checked' : ''; ?> required onchange="checkMedicalFields()">
                                                            <label for="charitable_contributions_spouse_yes">Yes</label>
                                                        </div>
                                                        <div class="icheck-primary d-inline ml-3">
                                                            <input type="radio" id="charitable_contributions_spouse_no" name="charitable_contributions_spouse" value="no" <?= $charitable_contributions_spouse === 'no' ? 'checked' : ''; ?> required onchange="checkMedicalFields()">
                                                            <label for="charitable_contributions_spouse_no">No</label>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>

                                            <!-- Row 2: Home Mortgage Interest -->
                                            <tr>
                                                <td>Have you paid any Home Mortgage Interest?</td>
                                                <td>
                                                    <div class="form-group clearfix">
                                                        <div class="icheck-primary d-inline">
                                                            <input type="radio" id="home_mortgage_interest_yes" name="home_mortgage_interest" value="yes" <?= $home_mortgage_interest === 'yes' ? 'checked' : ''; ?> required onchange="checkMedicalFields()">
                                                            <label for="home_mortgage_interest_yes">Yes</label>
                                                        </div>
                                                        <div class="icheck-primary d-inline ml-3">
                                                            <input type="radio" id="home_mortgage_interest_no" name="home_mortgage_interest" value="no" <?= $home_mortgage_interest === 'no' ? 'checked' : ''; ?> required onchange="checkMedicalFields()">
                                                            <label for="home_mortgage_interest_no">No</label>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group clearfix">
                                                        <div class="icheck-primary d-inline">
                                                            <input type="radio" id="home_mortgage_interest_spouse_yes" name="home_mortgage_interest_spouse" value="yes" <?= $home_mortgage_interest_spouse === 'yes' ? 'checked' : ''; ?> required onchange="checkMedicalFields()">
                                                            <label for="home_mortgage_interest_spouse_yes">Yes</label>
                                                        </div>
                                                        <div class="icheck-primary d-inline ml-3">
                                                            <input type="radio" id="home_mortgage_interest_spouse_no" name="home_mortgage_interest_spouse" value="no" <?= $home_mortgage_interest_spouse === 'no' ? 'checked' : ''; ?> required onchange="checkMedicalFields()">
                                                            <label for="home_mortgage_interest_spouse_no">No</label>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>

                                            <!-- Row 3: Hybrid/Electric Vehicle -->
                                            <tr>
                                                <td>Have you purchased any hybrid/electric vehicle?</td>
                                                <td>
                                                    <div class="form-group clearfix">
                                                        <div class="icheck-primary d-inline">
                                                            <input type="radio" id="hybrid_vehicle_yes" name="hybrid_vehicle" value="yes" <?= $hybrid_vehicle === 'yes' ? 'checked' : ''; ?> required onchange="checkMedicalFields()">
                                                            <label for="hybrid_vehicle_yes">Yes</label>
                                                        </div>
                                                        <div class="icheck-primary d-inline ml-3">
                                                            <input type="radio" id="hybrid_vehicle_no" name="hybrid_vehicle" value="no" <?= $hybrid_vehicle === 'no' ? 'checked' : ''; ?> required onchange="checkMedicalFields()">
                                                            <label for="hybrid_vehicle_no">No</label>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group clearfix">
                                                        <div class="icheck-primary d-inline">
                                                            <input type="radio" id="hybrid_vehicle_spouse_yes" name="hybrid_vehicle_spouse" value="yes" <?= $hybrid_vehicle_spouse === 'yes' ? 'checked' : ''; ?> required onchange="checkMedicalFields()">
                                                            <label for="hybrid_vehicle_spouse_yes">Yes</label>
                                                        </div>
                                                        <div class="icheck-primary d-inline ml-3">
                                                            <input type="radio" id="hybrid_vehicle_spouse_no" name="hybrid_vehicle_spouse" value="no" <?= $hybrid_vehicle_spouse === 'no' ? 'checked' : ''; ?> required onchange="checkMedicalFields()">
                                                            <label for="hybrid_vehicle_spouse_no">No</label>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>

                                            <!-- Row 4: Energy Saving Equipment -->
                                            <tr>
                                                <td>Have you purchased any energy-saving equipment?</td>
                                                <td>
                                                    <div class="form-group clearfix">
                                                        <div class="icheck-primary d-inline">
                                                            <input type="radio" id="energy_equipment_yes" name="energy_equipment" value="yes" <?= $energy_equipment === 'yes' ? 'checked' : ''; ?> required onchange="checkMedicalFields()">
                                                            <label for="energy_equipment_yes">Yes</label>
                                                        </div>
                                                        <div class="icheck-primary d-inline ml-3">
                                                            <input type="radio" id="energy_equipment_no" name="energy_equipment" value="no" <?= $energy_equipment === 'no' ? 'checked' : ''; ?> required onchange="checkMedicalFields()">
                                                            <label for="energy_equipment_no">No</label>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group clearfix">
                                                        <div class="icheck-primary d-inline">
                                                            <input type="radio" id="energy_equipment_spouse_yes" name="energy_equipment_spouse" value="yes" <?= $energy_equipment_spouse === 'yes' ? 'checked' : ''; ?> required onchange="checkMedicalFields()">
                                                            <label for="energy_equipment_spouse_yes">Yes</label>
                                                        </div>
                                                        <div class="icheck-primary d-inline ml-3">
                                                            <input type="radio" id="energy_equipment_spouse_no" name="energy_equipment_spouse" value="no" <?= $energy_equipment_spouse === 'no' ? 'checked' : ''; ?> required onchange="checkMedicalFields()">
                                                            <label for="energy_equipment_spouse_no">No</label>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>

                                            <!-- Row 5: Medical Expenses -->
                                            <tr>
                                                <td>Have you incurred any Medical expenses?</td>
                                                <td>
                                                    <div class="form-group clearfix">
                                                        <div class="icheck-primary d-inline">
                                                            <input type="radio" id="medical_expenses_yes" name="medical_expenses" value="yes" <?= $medical_expenses === 'yes' ? 'checked' : ''; ?> required onchange="checkMedicalFields()">
                                                            <label for="medical_expenses_yes">Yes</label>
                                                        </div>
                                                        <div class="icheck-primary d-inline ml-3">
                                                            <input type="radio" id="medical_expenses_no" name="medical_expenses" value="no" <?= $medical_expenses === 'no' ? 'checked' : ''; ?> required onchange="checkMedicalFields()">
                                                            <label for="medical_expenses_no">No</label>
                                                        </div>
                                                    </div>
                                                    <div id="medical_expenses_details" class="<?= $medical_expenses === 'yes' ? '' : 'hidden'; ?>">
                                                        <label>Please write only unreimbursed medical expenses:</label>
                                                        <input type="text" class="form-control" name="medical_expenses_notes" value="<?= htmlspecialchars($medical_expenses_notes ?? '', ENT_QUOTES); ?>" placeholder="Enter unreimbursed medical expenses">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group clearfix">
                                                        <div class="icheck-primary d-inline">
                                                            <input type="radio" id="medical_expenses_spouse_yes" name="medical_expenses_spouse" value="yes" <?= $medical_expenses_spouse === 'yes' ? 'checked' : ''; ?> required onchange="checkMedicalFields()">
                                                            <label for="medical_expenses_spouse_yes">Yes</label>
                                                        </div>
                                                        <div class="icheck-primary d-inline ml-3">
                                                            <input type="radio" id="medical_expenses_spouse_no" name="medical_expenses_spouse" value="no" <?= $medical_expenses_spouse === 'no' ? 'checked' : ''; ?> required onchange="checkMedicalFields()">
                                                            <label for="medical_expenses_spouse_no">No</label>
                                                        </div>
                                                    </div>
                                                    <div id="medical_expenses_details_spouse" class="<?= $medical_expenses_spouse === 'yes' ? '' : 'hidden'; ?>">
                                                        <label>Please write only unreimbursed medical expenses:</label>
                                                        <input type="text" class="form-control" name="medical_expenses_spouse_notes" value="<?= htmlspecialchars($medical_expenses_spouse_notes ?? '', ENT_QUOTES); ?>" placeholder="Enter unreimbursed medical expenses">
                                                    </div>
                                                </td>
                                            </tr>
                                            <!-- Row 6: Car Taxes -->
                                            <tr>
                                                <td>Have you paid any Car taxes?</td>
                                                <td>
                                                    <div class="form-group clearfix">
                                                        <div class="icheck-primary d-inline">
                                                            <input type="radio" id="car_taxes_yes" name="car_taxes" value="yes" <?= $car_taxes === 'yes' ? 'checked' : ''; ?> required onchange="checkMedicalFields()">
                                                            <label for="car_taxes_yes">Yes</label>
                                                        </div>
                                                        <div class="icheck-primary d-inline ml-3">
                                                            <input type="radio" id="car_taxes_no" name="car_taxes" value="no" <?= $car_taxes === 'no' ? 'checked' : ''; ?> required onchange="checkMedicalFields()">
                                                            <label for="car_taxes_no">No</label>
                                                        </div>
                                                    </div>
                                                    <div id="car_tax_details" class="<?= $car_taxes === 'yes' ? '' : 'hidden'; ?>">
                                                        <label>If yes, please provide car details in Notes:</label>
                                                        <input type="text" class="form-control" name="car_details" placeholder="Make, Model, No of Miles" value="<?= htmlspecialchars($car_details ?? '', ENT_QUOTES); ?>">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group clearfix">
                                                        <div class="icheck-primary d-inline">
                                                            <input type="radio" id="car_taxes_spouse_yes" name="car_taxes_spouse" value="yes" <?= $car_taxes_spouse === 'yes' ? 'checked' : ''; ?> required onchange="checkMedicalFields()">
                                                            <label for="car_taxes_spouse_yes">Yes</label>
                                                        </div>
                                                        <div class="icheck-primary d-inline ml-3">
                                                            <input type="radio" id="car_taxes_spouse_no" name="car_taxes_spouse" value="no" <?= $car_taxes_spouse === 'no' ? 'checked' : ''; ?> required onchange="checkMedicalFields()">
                                                            <label for="car_taxes_spouse_no">No</label>
                                                        </div>
                                                    </div>
                                                    <div id="car_tax_details_spouse" class="<?= $car_taxes_spouse === 'yes' ? '' : 'hidden'; ?>">
                                                        <label>If yes, please provide car details in Notes:</label>
                                                        <input type="text" class="form-control" name="car_details_spouse" placeholder="Make, Model, No of Miles" value="<?= htmlspecialchars($car_details_spouse ?? '', ENT_QUOTES); ?>">
                                                    </div>
                                                </td>
                                            </tr>

                                            <!-- Row 7: Motor Vehicle Tax in CT State -->
                                            <tr>
                                                <td>Have you paid any motor vehicle tax in CT state?</td>
                                                <td>
                                                    <div class="form-group clearfix">
                                                        <div class="icheck-primary d-inline">
                                                            <input type="radio" id="motor_vehicle_tax_yes" name="motor_vehicle_tax" value="yes" <?= $motor_vehicle_tax === 'yes' ? 'checked' : ''; ?> required onchange="checkMedicalFields()">
                                                            <label for="motor_vehicle_tax_yes">Yes</label>
                                                        </div>
                                                        <div class="icheck-primary d-inline ml-3">
                                                            <input type="radio" id="motor_vehicle_tax_no" name="motor_vehicle_tax" value="no" <?= $motor_vehicle_tax === 'no' ? 'checked' : ''; ?> required onchange="checkMedicalFields()">
                                                            <label for="motor_vehicle_tax_no">No</label>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group clearfix">
                                                        <div class="icheck-primary d-inline">
                                                            <input type="radio" id="motor_vehicle_tax_spouse_yes" name="motor_vehicle_tax_spouse" value="yes" <?= $motor_vehicle_tax_spouse === 'yes' ? 'checked' : ''; ?> required onchange="checkMedicalFields()">
                                                            <label for="motor_vehicle_tax_spouse_yes">Yes</label>
                                                        </div>
                                                        <div class="icheck-primary d-inline ml-3">
                                                            <input type="radio" id="motor_vehicle_tax_spouse_no" name="motor_vehicle_tax_spouse" value="no" <?= $motor_vehicle_tax_spouse === 'no' ? 'checked' : ''; ?> required onchange="checkMedicalFields()">
                                                            <label for="motor_vehicle_tax_spouse_no">No</label>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>

                                            <!-- Row 8: 529 College Saving Plan -->
                                            <tr>
                                                <td>Did you contribute to 529 college saving plan?</td>
                                                <td>
                                                    <div class="form-group clearfix">
                                                        <div class="icheck-primary d-inline">
                                                            <input type="radio" id="college_saving_plan_yes" name="college_saving_plan" value="yes" <?= $college_saving_plan === 'yes' ? 'checked' : ''; ?> required onchange="checkMedicalFields()">
                                                            <label for="college_saving_plan_yes">Yes</label>
                                                        </div>
                                                        <div class="icheck-primary d-inline ml-3">
                                                            <input type="radio" id="college_saving_plan_no" name="college_saving_plan" value="no" <?= $college_saving_plan === 'no' ? 'checked' : ''; ?> required onchange="checkMedicalFields()">
                                                            <label for="college_saving_plan_no">No</label>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group clearfix">
                                                        <div class="icheck-primary d-inline">
                                                            <input type="radio" id="college_saving_plan_spouse_yes" name="college_saving_plan_spouse" value="yes" <?= $college_saving_plan_spouse === 'yes' ? 'checked' : ''; ?> required onchange="checkMedicalFields()">
                                                            <label for="college_saving_plan_spouse_yes">Yes</label>
                                                        </div>
                                                        <div class="icheck-primary d-inline ml-3">
                                                            <input type="radio" id="college_saving_plan_spouse_no" name="college_saving_plan_spouse" value="no" <?= $college_saving_plan_spouse === 'no' ? 'checked' : ''; ?> required onchange="checkMedicalFields()">
                                                            <label for="college_saving_plan_spouse_no">No</label>
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
                                <!-- Back Button with Icon and onclick event -->
                                <button type="button" class="btn btn-default float-right curve-card" onclick="history.back();">
                                    <i class="fas fa-arrow-left"></i> Back
                                </button>
                            </div>
                        </div>
                    </form>

                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            // Deduction fields for taxpayers and spouses
                            const medicalDetailsTaxpayer = document.getElementById('medical_expenses_details');
                            const medicalDetailsSpouse = document.getElementById('medical_expenses_details_spouse');
                            const carDetailsTaxpayer = document.getElementById('car_tax_details');
                            const carDetailsSpouse = document.getElementById('car_tax_details_spouse');

                            // Attach change events to each deduction radio button
                            attachRadioEvents('medical_expenses', medicalDetailsTaxpayer);
                            attachRadioEvents('medical_expenses_spouse', medicalDetailsSpouse);
                            attachRadioEvents('car_taxes', carDetailsTaxpayer);
                            attachRadioEvents('car_taxes_spouse', carDetailsSpouse);
                        });

                        function attachRadioEvents(radioGroupName, detailsField) {
                            const radios = document.getElementsByName(radioGroupName);
                            radios.forEach(radio => {
                                radio.addEventListener('change', () => {
                                    detailsField.classList.toggle('hidden', radio.value === 'no');
                                });
                            });
                        }

                        function selectAll(type, option) {
                            // Define radio groups based on type (taxpayer or spouse)
                            const radioGroups = [
                                `input[name="${type === 'taxpayer' ? 'charitable_contributions' : 'charitable_contributions_spouse'}"]`,
                                `input[name="${type === 'taxpayer' ? 'home_mortgage_interest' : 'home_mortgage_interest_spouse'}"]`,
                                `input[name="${type === 'taxpayer' ? 'hybrid_vehicle' : 'hybrid_vehicle_spouse'}"]`,
                                `input[name="${type === 'taxpayer' ? 'energy_equipment' : 'energy_equipment_spouse'}"]`,
                                `input[name="${type === 'taxpayer' ? 'medical_expenses' : 'medical_expenses_spouse'}"]`,
                                `input[name="${type === 'taxpayer' ? 'car_taxes' : 'car_taxes_spouse'}"]`,
                                `input[name="${type === 'taxpayer' ? 'motor_vehicle_tax' : 'motor_vehicle_tax_spouse'}"]`,
                                `input[name="${type === 'taxpayer' ? 'college_saving_plan' : 'college_saving_plan_spouse'}"]`
                            ];

                            // Check all radios in the group based on type and option ('yes' or 'no')
                            radioGroups.forEach(group => {
                                const radios = document.querySelectorAll(group);
                                radios.forEach(radio => {
                                    radio.checked = (radio.value === option);
                                    radio.dispatchEvent(new Event('change')); // Trigger the change event
                                });
                            });

                            // Show or hide input fields for taxpayer or spouse based on the option selected
                            if (option === 'yes') {
                                if (type === 'taxpayer') {
                                    document.getElementById('medical_expenses_details').classList.remove('hidden');
                                    document.getElementById('car_tax_details').classList.remove('hidden');
                                } else if (type === 'spouse') {
                                    document.getElementById('medical_expenses_details_spouse').classList.remove('hidden');
                                    document.getElementById('car_tax_details_spouse').classList.remove('hidden');
                                }
                            } else {
                                if (type === 'taxpayer') {
                                    document.getElementById('medical_expenses_details').classList.add('hidden');
                                    document.getElementById('car_tax_details').classList.add('hidden');
                                } else if (type === 'spouse') {
                                    document.getElementById('medical_expenses_details_spouse').classList.add('hidden');
                                    document.getElementById('car_tax_details_spouse').classList.add('hidden');
                                }
                            }
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
        $('#deductionsForm').on('submit', function(e) {
            e.preventDefault(); // Prevent the form from submitting normally

            $.ajax({
                url: 'actions/save_deductions.php',
                type: 'POST',
                data: $(this).serialize(), // Send the form data
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: response.message
                        }).then(() => {
                            location.reload(); // 
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: response.message
                        });
                    }
                },
                error: function(xhr, status, error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Failed to communicate with server.'
                    });
                }
            });
        });
    });
</script>