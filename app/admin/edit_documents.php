<?php
$current_page = "Clients"; // Set the current page title
$user_id = $_GET['user_id'];
$tax_year = $_GET['tax_year'];
require('includes/header.php'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/signature_pad/1.5.3/signature_pad.min.js"></script>

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
                <div class="col-md-12">
                    <!-- Upload Document Card -->
                    <div class="card curve-card card-dark mb-4">
                        <div class="card-header curve-card">
                            <h3 class="card-title"><i class="fas fa-upload"></i> Upload Document</h3>
                        </div>
                        <form id="documentUploadForm" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="user_id" class="form-control" id="user_id" value="<?= $user_id ?>">
                            <input type="hidden" name="tax_year" class="form-control" id="tax_year" value="<?= $tax_year ?>">
                            <div class="card-body">
                                <div class="row">
                                    <?php
                                    $query = "SELECT document_type FROM documents WHERE user_id = ? AND tax_year = ?";
                                    $stmt = $conn->prepare($query);
                                    $stmt->bind_param("ii", $user_id, $tax_year);
                                    $stmt->execute();
                                    $result = $stmt->get_result();

                                    // Store the uploaded document types in an array
                                    $uploaded_docs = [];
                                    while ($row = $result->fetch_assoc()) {
                                        $uploaded_docs[] = $row['document_type'];
                                    }

                                    $stmt->close();
                                    ?>

                                    <!-- Document Type Dropdown -->
                                    <!-- <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label for="document_type">Document Type <span class="required">*</span></label>
                                            <select name="document_type" id="document_type" class="form-control" required>
                                                <option value="" selected disabled>Select Document Type </option>
                                                <option value="ALL_IN_ONE_ZIP_FILE">ALL IN ONE ZIP FILE</option>
                                                <option value="STOCK_DOCUMENT">Upload Stock Document</option>
                                                <option value="1099INT">Upload 1099INT Form</option>
                                                <option value="1099R">Upload 1099-R Form</option>
                                                <option value="1099DIV">Upload 1099DIV Form</option>
                                                <option value="RENTAL_INCOME_EXPENSES">Upload Rental Income Expenses Document</option>
                                                <option value="1099SA">Upload 1099-SA Form</option>
                                                <option value="FBAR">Upload FBAR Document</option>
                                                <option value="FATCA">Upload FATCA Document</option>
                                                <option value="BUSINESS_INCOME_EXPENSES">Upload Business Income and Expense Information</option>
                                                <option value="1099B">Upload 1099B Form</option>
                                                <option value="1098T">Upload 1098-T Form</option>
                                                <option value="1098T_DEPENDANTS">Upload Form 1098-T for Dependents</option>
                                                <option value="PROPERTY_TAXES">Upload Receipt of Property Taxes Paid</option>
                                                <option value="1098_HOME_MORTGAGE">Upload Form 1098 Home Mortgage Interest Statement</option>
                                                <option value="PREVIOUS_TAX_RETURN">Upload Your Previous Year Tax Return Copy</option>
                                                <option value="1098E">Upload 1098-E Form</option>
                                                <option value="1095A">1095-A from Insurance Provider</option>
                                                <option value="OTHER">Other</option>
                                            </select>
                                        </div>
                                    </div> -->
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label for="document_type">Document Type <span class="required">*</span></label>
                                            <select name="document_type" id="document_type" class="form-control" required>
                                                <option value="" selected disabled>Select Document Type</option>

                                                <?php if (!in_array("ALL_IN_ONE_ZIP_FILE", $uploaded_docs)) : ?>
                                                    <option value="ALL_IN_ONE_ZIP_FILE">ALL IN ONE ZIP FILE</option>
                                                <?php endif; ?>

                                                <?php if (!in_array("STOCK_DOCUMENT", $uploaded_docs)) : ?>
                                                    <option value="STOCK_DOCUMENT">Upload Stock Document</option>
                                                <?php endif; ?>

                                                <?php if (!in_array("1099INT", $uploaded_docs)) : ?>
                                                    <option value="1099INT">Upload 1099INT Form</option>
                                                <?php endif; ?>

                                                <?php if (!in_array("1099R", $uploaded_docs)) : ?>
                                                    <option value="1099R">Upload 1099-R Form</option>
                                                <?php endif; ?>

                                                <?php if (!in_array("1099DIV", $uploaded_docs)) : ?>
                                                    <option value="1099DIV">Upload 1099DIV Form</option>
                                                <?php endif; ?>

                                                <?php if (!in_array("RENTAL_INCOME_EXPENSES", $uploaded_docs)) : ?>
                                                    <option value="RENTAL_INCOME_EXPENSES">Upload Rental Income Expenses Document</option>
                                                <?php endif; ?>

                                                <?php if (!in_array("1099SA", $uploaded_docs)) : ?>
                                                    <option value="1099SA">Upload 1099-SA Form</option>
                                                <?php endif; ?>

                                                <?php if (!in_array("FBAR", $uploaded_docs)) : ?>
                                                    <option value="FBAR">Upload FBAR Document</option>
                                                <?php endif; ?>

                                                <?php if (!in_array("FATCA", $uploaded_docs)) : ?>
                                                    <option value="FATCA">Upload FATCA Document</option>
                                                <?php endif; ?>

                                                <?php if (!in_array("BUSINESS_INCOME_EXPENSES", $uploaded_docs)) : ?>
                                                    <option value="BUSINESS_INCOME_EXPENSES">Upload Business Income and Expense Information</option>
                                                <?php endif; ?>

                                                <?php if (!in_array("1099B", $uploaded_docs)) : ?>
                                                    <option value="1099B">Upload 1099B Form</option>
                                                <?php endif; ?>

                                                <?php if (!in_array("1098T", $uploaded_docs)) : ?>
                                                    <option value="1098T">Upload 1098-T Form</option>
                                                <?php endif; ?>

                                                <?php if (!in_array("1098T_DEPENDANTS", $uploaded_docs)) : ?>
                                                    <option value="1098T_DEPENDANTS">Upload Form 1098-T for Dependents</option>
                                                <?php endif; ?>

                                                <?php if (!in_array("PROPERTY_TAXES", $uploaded_docs)) : ?>
                                                    <option value="PROPERTY_TAXES">Upload Receipt of Property Taxes Paid</option>
                                                <?php endif; ?>

                                                <?php if (!in_array("1098_HOME_MORTGAGE", $uploaded_docs)) : ?>
                                                    <option value="1098_HOME_MORTGAGE">Upload Form 1098 Home Mortgage Interest Statement</option>
                                                <?php endif; ?>

                                                <?php if (!in_array("PREVIOUS_TAX_RETURN", $uploaded_docs)) : ?>
                                                    <option value="PREVIOUS_TAX_RETURN">Upload Your Previous Year Tax Return Copy</option>
                                                <?php endif; ?>

                                                <?php if (!in_array("1098E", $uploaded_docs)) : ?>
                                                    <option value="1098E">Upload 1098-E Form</option>
                                                <?php endif; ?>

                                                <?php if (!in_array("1095A", $uploaded_docs)) : ?>
                                                    <option value="1095A">1095-A from Insurance Provider</option>
                                                <?php endif; ?>

                                                <?php if (!in_array("OTHER", $uploaded_docs)) : ?>
                                                    <option value="OTHER">Other</option>
                                                <?php endif; ?>

                                            </select>
                                        </div>
                                    </div>

                                    <!-- File Upload Section -->
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label for="document">Upload Files (PDF, Images, ZIP) <span class="required">*</span></label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" name="document" id="document" class="custom-file-input" accept=".pdf,.jpg,.jpeg,.png,.zip,.doc,.docx" required>
                                                    <label class="custom-file-label" for="document">Choose file</label>
                                                </div>
                                            </div>
                                            <small class="form-text text-muted">(Optionally, upload all files in a ZIP file) Max file size: 50MB.</small>
                                        </div>


                                    </div>


                                    <!-- <div class="col-md-2 mb-3">
                                        <div class="form-group">

                                            <button type="submit" class="btn btn-info curve-card my-btn-primary-color">
                                                <i class="fas fa-cloud-upload-alt"></i> Upload
                                            </button>
                                            <button type="button" class="btn btn-default float-right curve-card" onclick="history.back();">
                                                <i class="fas fa-arrow-left"></i> Back
                                            </button>
                                        </div>
                                    </div> -->

                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-info curve-card my-btn-primary-color">
                                    <i class="fas fa-cloud-upload-alt"></i> Upload
                                </button>
                                <button type="button" class="btn btn-default float-right curve-card" onclick="history.back();">
                                    <i class="fas fa-arrow-left"></i> Back
                                </button>
                            </div>
                        </form>


                        <!-- Uploaded Files Table -->
                        <table class="table table-bordered mt-3">
                            <thead>
                                <tr>
                                    <th>Document Type</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Fetch documents for the user and tax year

                                $file_path = '../assets/uploads/documents/'; // File path for document directory
                                $sql = "SELECT document_id, document_type, file_name FROM documents WHERE user_id = ? AND tax_year = ? AND `from_admin` = 0  ORDER BY uploaded_at DESC";
                                $stmt = $conn->prepare($sql);
                                $stmt->bind_param("ii", $user_id, $tax_year);
                                $stmt->execute();
                                $result = $stmt->get_result();

                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        $download_path = htmlspecialchars($file_path . $row['file_name']); // Full path to download file
                                        echo "<tr>";
                                        echo "<td>" . htmlspecialchars($row['document_type']) . "</td>";
                                        echo "<td>
                        <a href='$download_path' class='btn btn-outline-info btn-sm' download>
                            <i class='fas fa-download'></i>
                        </a>
                        <button class='btn btn-outline-danger btn-sm' onclick='confirmDelete(" . $row["document_id"] . ")'>
                            <i class='fas fa-trash'></i>
                        </button>
                      </td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='2' class='text-center'>No documents uploaded yet.</td></tr>";
                                }

                                $stmt->close();
                                ?>
                            </tbody>
                        </table>

                    </div>
                </div>

                <!-- E-Signature Card -->
                <div class="col-md-12">
                    <div class="card curve-card card-dark mb-4">
                        <div class="card-header curve-card">
                            <h3 class="card-title"><i class="fas fa-signature"></i> E-Signature</h3>
                        </div>
                        <div class="card-body">
                            <form id="signatureUploadForm" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="user_id" class="form-control" id="user_id" value="<?= $user_id ?>">
                                <input type="hidden" name="tax_year" class="form-control" id="tax_year" value="<?= $tax_year ?>">
                                <div class="form-group">
                                    <label for="signature" class="mb-3">Draw E-Signature or Upload</label>
                                    <div class="row align-items-center">
                                        <!-- Signature Pad Column -->
                                        <div class="col-md-5 mb-3">
                                            <div class="d-flex flex-column align-items-start">
                                                <canvas id="signature-pad" width="300" height="150" class="border mb-3"></canvas>
                                                <button type="button" id="clear-signature" class="btn btn-warning mb-3 curve-card">Clear Signature</button>
                                                <input type="hidden" name="signature" id="signature-input">
                                            </div>
                                        </div>

                                        <!-- OR separator -->
                                        <div class="col-md-2 text-center mb-3">
                                            <h6>OR</h6>
                                        </div>

                                        <!-- Upload Signature Column -->
                                        <div class="col-md-5 mb-3">
                                            <div class="form-group">
                                                <label for="signature_upload">Upload Signature</label>
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input type="file" name="signature_upload" id="signature_upload" accept=".jpg,.jpeg,.png,.pdf" class="custom-file-input" onchange="previewImage(event)">
                                                        <label class="custom-file-label" for="signature_upload">Choose file</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Image Preview Section -->
                                <div class="form-group">
                                    <label for="uploaded_signature" class="mt-3">Uploaded Signature Preview:</label>
                                    <img id="uploaded_signature" src="" alt="Uploaded Signature Preview" class="img-fluid mt-2" style="display:none; max-width: 200px;">
                                </div>

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-info curve-card my-btn-primary-color">
                                        <i class="fas fa-cloud-upload-alt"></i> Upload
                                    </button>
                                    <button type="button" class="btn btn-default float-right curve-card" onclick="history.back();">
                                        <i class="fas fa-arrow-left"></i> Back
                                    </button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->





<?php require('includes/footer.php'); ?>

<script>
    // Initialize Signature Pad
    const signaturePad = new SignaturePad(document.getElementById('signature-pad'));

    // Clear signature button functionality
    document.getElementById('clear-signature').addEventListener('click', function() {
        signaturePad.clear();
        document.getElementById('signature-input').value = '';
    });

    // File upload preview for signature
    function previewImage(event) {
        const output = document.getElementById('uploaded_signature');
        output.src = URL.createObjectURL(event.target.files[0]);
        output.style.display = 'block';
    }

    $(document).ready(function() {
        const MAX_FILE_SIZE_MB = 50;
        const MAX_FILE_SIZE_BYTES = MAX_FILE_SIZE_MB * 1024 * 1024;

        // Document Upload with AJAX and File Size Validation
        $('#documentUploadForm').on('submit', function(event) {
            event.preventDefault();

            const fileInput = $('#document')[0].files[0];
            if (fileInput && fileInput.size > MAX_FILE_SIZE_BYTES) {
                Swal.fire('Error', `File size exceeds ${MAX_FILE_SIZE_MB}MB. Please upload a smaller file.`, 'error');
                return;
            }

            let formData = new FormData(this);
            let uploadButton = $(this).find('button[type="submit"]');
            uploadButton.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Uploading...');

            $.ajax({
                url: 'actions/upload_document.php',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    let res = JSON.parse(response);
                    if (res.status === 'success') {
                        Swal.fire('Success', res.message, 'success').then(() => location.reload());
                    } else {
                        Swal.fire('Error', res.message, 'error');
                    }
                },
                error: function() {
                    Swal.fire('Error', 'An error occurred while uploading the document.', 'error');
                },
                complete: function() {
                    uploadButton.prop('disabled', false).html('<i class="fas fa-cloud-upload-alt"></i> Upload');
                }
            });
        });

        // Signature Upload with AJAX (Drawn or Uploaded)
        $('#signatureUploadForm').on('submit', function(event) {
            event.preventDefault();

            let formData = new FormData(this);
            let signatureInput = document.getElementById('signature-input');
            let uploadButton = $(this).find('button[type="submit"]');
            uploadButton.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Uploading...');

            if (!signaturePad.isEmpty()) {
                let signatureData = signaturePad.toDataURL('image/png');
                formData.append('signature', signatureData);
            } else if (!$('#signature_upload').val()) {
                Swal.fire('Warning', 'Please draw a signature or upload a file.', 'warning');
                uploadButton.prop('disabled', false).html('<i class="fas fa-cloud-upload-alt"></i> Upload');
                return;
            }

            $.ajax({
                url: 'actions/upload_document.php',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    let res = JSON.parse(response);
                    if (res.status === 'success') {
                        Swal.fire('Success', res.message, 'success').then(() => location.reload());
                    } else {
                        Swal.fire('Error', res.message, 'error');
                    }
                },
                error: function() {
                    Swal.fire('Error', 'An error occurred while uploading the signature.', 'error');
                },
                complete: function() {
                    uploadButton.prop('disabled', false).html('<i class="fas fa-cloud-upload-alt"></i> Upload');
                }
            });
        });

        // Preview uploaded signature image
        $('#signature_upload').on('change', previewImage);
    });
</script>

<script>
    function confirmDelete(document_id) {
        Swal.fire({
            title: "Are you sure?",
            text: "This document will be permanently deleted!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.isConfirmed) {
                deleteDocument(document_id);
            }
        });
    }

    function deleteDocument(document_id) {
        $.ajax({
            url: "actions/delete_document.php",
            type: "POST",
            data: {
                document_id: document_id
            },
            success: function(response) {
                if (response == "success") {
                    Swal.fire("Deleted!", "Your document has been deleted.", "success")
                        .then(() => location.reload());
                } else {
                    Swal.fire("Error!", "There was an issue deleting your document.", "error");
                }
            },
            error: function() {
                Swal.fire("Error!", "An error occurred while attempting to delete the document.", "error");
            }
        });
    }
</script>