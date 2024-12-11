<?php
$current_page = "Clients"; // Set the current page title
require('includes/header.php');
require('includes/navbar.php');
require('includes/sidebar.php');

// Get the `user_id` and `tax_year` from the URL parameters
$user_id = $_GET['user_id'];
$tax_year = $_GET['tax_year'];

// Fetch data from the database
$personal_info_query = "SELECT * FROM personal_information WHERE user_id = ? AND tax_year = ?";
$stmt = $conn->prepare($personal_info_query);
$stmt->bind_param('is', $user_id, $tax_year);
$stmt->execute();
$personal_info = $stmt->get_result()->fetch_assoc();

$spouse_info_query = "SELECT * FROM spouse_information WHERE user_id = ? AND tax_year = ?";
$stmt = $conn->prepare($spouse_info_query);
$stmt->bind_param('is', $user_id, $tax_year);
$stmt->execute();
$spouse_info = $stmt->get_result()->fetch_assoc();

$contact_info_query = "SELECT * FROM contact_information WHERE user_id = ? AND tax_year = ?";
$stmt = $conn->prepare($contact_info_query);
$stmt->bind_param('is', $user_id, $tax_year);
$stmt->execute();
$contact_info = $stmt->get_result()->fetch_assoc();


$insurance_query = "SELECT * FROM insurance_details WHERE user_id = ? AND tax_year = ?";
$stmt = $conn->prepare($insurance_query);
$stmt->bind_param('is', $user_id, $tax_year);
$stmt->execute();
$insurance_info = $stmt->get_result()->fetch_assoc();



$income_query = "SELECT * FROM other_income WHERE user_id = ? AND tax_year = ?";
$stmt = $conn->prepare($income_query);
$stmt->bind_param('is', $user_id, $tax_year);
$stmt->execute();
$income = $stmt->get_result()->fetch_assoc();

$deduction_query = "SELECT * FROM deductions WHERE user_id = ? AND tax_year = ?";
$stmt = $conn->prepare($deduction_query);
$stmt->bind_param('is', $user_id, $tax_year);
$stmt->execute();
$deduction = $stmt->get_result()->fetch_assoc();

$adjustments_query = "SELECT * FROM adjustments_to_income WHERE user_id = ? AND tax_year = ?";
$stmt = $conn->prepare($adjustments_query);
$stmt->bind_param('is', $user_id, $tax_year);
$stmt->execute();
$adjustments = $stmt->get_result()->fetch_assoc();

$fbar_query = "SELECT * FROM fbar WHERE user_id = ? AND tax_year = ?";
$stmt = $conn->prepare($fbar_query);
$stmt->bind_param('is', $user_id, $tax_year);
$stmt->execute();
$fbar_info = $stmt->get_result()->fetch_assoc();

$business_income_query = "SELECT * FROM business_income WHERE user_id = ? AND tax_year = ?";
$stmt = $conn->prepare($business_income_query);
$stmt->bind_param('is', $user_id, $tax_year);
$stmt->execute();
$business_income_info = $stmt->get_result()->fetch_assoc();



$tax_estimates_query = "SELECT federal_refund, state_refund, city_refund FROM tax_estimates WHERE user_id = ? AND tax_year = ?";
$stmt = $conn->prepare($tax_estimates_query);
$stmt->bind_param('is', $user_id, $tax_year);
$stmt->execute();
$tax_estimates = $stmt->get_result()->fetch_assoc();
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
<!-- Include jsPDF and html2canvas libraries -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

<style>
    .hidden {
        display: none;
    }

    .btn-sm {
        padding: 0.25rem 0.5rem;
        font-size: 0.875rem;
    }

    .curve-card {
        border-radius: 15px;
    }

    .nav-tabs .nav-link.active {
        background-color: #f9921e;
        color: white;
    }
    .bg-success-light {
    background-color: #d4edda; /* Light green */
    color: #155724; /* Dark green text for readability */
}

</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <!-- <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Client Profile</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active"><?= $current_page ?></li>
                    </ol>
                </div>
            </div> -->


 <button id="printButton" class="btn btn-outline-dark btn-sm">Print</button>
            <a href="actions/export_tax_details.php?user_id=<?= $user_id ?>&tax_year=<?= $tax_year ?>" class="btn btn-outline-dark btn-sm">Export to Excel</a>            

        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
        <script>
    document.getElementById('printButton').addEventListener('click', function() {
        // Clone the entire card content (all tabs)
        var cardContent = document.querySelector('.card').cloneNode(true);

        // Remove classes that control visibility (e.g., `fade`, `show`, `active`) on the cloned content
        var tabs = cardContent.querySelectorAll('.tab-pane');
        tabs.forEach(function(tab) {
            tab.classList.add('active', 'show'); // Ensure all tabs are visible in print
            tab.classList.remove('fade'); // Remove fade effect for better printing
        });

       // Retrieve the dynamic file number, first name, last name, and tax year from PHP variables
       var fileNo = "<?= htmlspecialchars($personal_info['personal_id']); ?>";
        var firstName = "<?= htmlspecialchars($personal_info['first_name']); ?>";
        var lastName = "<?= htmlspecialchars($personal_info['last_name']); ?>";
        var taxYear = "<?= htmlspecialchars($tax_year); ?>".slice(-2); // Get last 2 digits of tax year

        // Create the print title in the format: FileNo:12345-tax_year-FirstName+LastName
        var printTitle = `FileNo:${fileNo}-${taxYear}-${firstName}${lastName} (TY${taxYear})`;

        // Open a new print window
        var printWindow = window.open('', '_blank', 'height=600,width=800');

        // Start writing HTML to the print window
        printWindow.document.write('<html><head><title>' + printTitle + '</title>');
        printWindow.document.write('<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">');
        printWindow.document.write('</head><body>');

        // Add the cloned card content to the print window
        printWindow.document.write('<div class="card">');
        printWindow.document.write(cardContent.innerHTML);
        printWindow.document.write('</div>');

        // Close the document and trigger the print dialog
        printWindow.document.write('</body></html>');
        printWindow.document.close();

        // Wait for the document to finish loading before triggering print
        printWindow.onload = function() {
            printWindow.print();
        };
    });
</script>



            <div class="card mb-3 curve-card ">
                <div class="card-header curve-card">
                    <ul class="nav nav-tabs" id="taxFilingTabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active curve-card" id="personal-info-tab" data-toggle="tab" href="#personal-info" role="tab" aria-controls="personal-info" aria-selected="true">
                                Personal Information
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link curve-card" id="documents-tab" data-toggle="tab" href="#documents" role="tab" aria-controls="documents" aria-selected="false">
                                Documents
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link curve-card" id="Upload-DocumentsHNITX-tab" data-toggle="tab" href="#upload-documents-hnitx" role="tab" aria-controls="upload-documents-hnitx" aria-selected="false">
                                Upload Documents From Hnitax
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link curve-card" id="tax-estimates-tab" data-toggle="tab" href="#tax-estimates" role="tab" aria-controls="tax-estimates" aria-selected="false">
                                Tax Estimates
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link curve-card" id="referrals-tab" data-toggle="tab" href="#referrals" role="tab" aria-controls="referrals" aria-selected="false">
                                Referrals
                            </a>
                        </li>
                    </ul>
                    
                </div>
                <div class="card-body">
                    <div class="tab-content" id="taxFilingTabsContent">
                        <div class="tab-pane fade show active" id="personal-info" role="tabpanel" aria-labelledby="personal-info-tab">
                            <?= require('profile/Personal_Information.php'); ?>
                        </div>
                        <div class="tab-pane fade" id="documents" role="tabpanel" aria-labelledby="documents-tab">
                            <?= require('profile/Documents.php'); ?>
                        </div>
                        <div class="tab-pane fade" id="upload-documents-hnitx" role="tabpanel" aria-labelledby="Upload-DocumentsHNITX-tab">
                            <?= require('profile/Upload-Documents.php'); ?>
                        </div>
                        <div class="tab-pane fade" id="tax-estimates" role="tabpanel" aria-labelledby="tax-estimates-tab">
                            <?= require('profile/TaxEstimates.php'); ?>
                        </div>
                        <div class="tab-pane fade" id="referrals" role="tabpanel" aria-labelledby="referrals-tab">
                            <?= require('profile/Referrals.php'); ?>
                        </div>
                    </div>
                </div>
            </div>




        </div>
</div>
</div>

<?php
require('includes/footer.php');
?>

<!-- Add necessary scripts for Bootstrap Tabs (Make sure jQuery and Bootstrap JS are loaded) -->


<script src="ajax/documentUploadForm/documentUploadForm.js"></script>
<script src="ajax/Tax-Estimate/TaxEstimate.js"></script>