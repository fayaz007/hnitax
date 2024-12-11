<?php
$current_page = "Download Documents"; // Set the current page title
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

    .curve-card {
        border-radius: 15px;
    }

    .nav-tabs .nav-link.active {
        background-color: #f9921e;
        color: white;
    }
</style>
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
            <!-- Tabs for Document Sections -->
            <ul class="nav nav-tabs" id="documentTabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="hni-tax-tab" data-toggle="tab" href="#hni-tax" role="tab" aria-controls="hni-tax" aria-selected="true">Documents From HNI Tax Filer</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="tax-documents-tab" data-toggle="tab" href="#tax-documents" role="tab" aria-controls="tax-documents" aria-selected="false">My Tax Documents</a>
                </li>
                <!-- <li class="nav-item">
                    <a class="nav-link" id="consent-documents-tab" data-toggle="tab" href="#consent-documents" role="tab" aria-controls="consent-documents" aria-selected="false">Consent Documents</a>
                </li> -->
                <!-- <li class="nav-item">
                    <a class="nav-link" id="e-signature-tab" data-toggle="tab" href="#e-signature" role="tab" aria-controls="e-signature" aria-selected="false">E-Signature</a>
                </li> -->
            </ul>

            <!-- Tab Content -->
            <div class="tab-content mt-4" id="documentTabContent">
                <!-- Tab Pane for Documents From HNI Tax Filer -->
                <div class="tab-pane fade show active" id="hni-tax" role="tabpanel" aria-labelledby="hni-tax-tab">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card curve-card card-dark">
                                <div class="card-header curve-card">
                                    <h3 class="card-title"><i class="fas fa-folder-open"></i> Documents From HNI Tax Filer</h3>
                                </div>
                                <div class="card-body">
                                    <p>Here you can find all the documents uploaded by HNI Tax Filer.</p>
                                    <!-- Document list or download links would be here -->

                                    <!-- Uploaded Files Table -->
                                    <table class="table table-bordered mt-3">
                                        <thead>
                                            <tr>
                                                <th>Document Name</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            // Fetch documents for the user and tax year
                                            $user_id = $_SESSION['user_id']; // Assuming a session with user_id
                                            $tax_year = date('Y') - 1;
                                            $file_path = '../assets/uploads/documents/'; // File path for document directory
                                            $sql = "SELECT document_id,admin_file, document_type, file_name FROM documents WHERE user_id = ? AND tax_year = ? AND `from_admin` = 1";
                                            $stmt = $conn->prepare($sql);
                                            $stmt->bind_param("ii", $user_id, $tax_year);
                                            $stmt->execute();
                                            $result = $stmt->get_result();

                                            if ($result->num_rows > 0) {
                                                while ($row = $result->fetch_assoc()) {
                                                    $download_path = htmlspecialchars($file_path . $row['file_name']); // Full path to download file
                                                    echo "<tr>";
                                                    echo "<td>" . htmlspecialchars($row['admin_file']) . "</td>";
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
                        </div>
                    </div>
                </div>

                <!-- Tab Pane for My Tax Documents -->
                <div class="tab-pane fade" id="tax-documents" role="tabpanel" aria-labelledby="tax-documents-tab">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card curve-card card-dark">
                                <div class="card-header curve-card">
                                    <h3 class="card-title"><i class="fas fa-file-alt"></i> My Tax Documents</h3>
                                </div>
                                <div class="card-body">
                                    Your personal tax documents for the current tax year.

                                    <!-- Uploaded Files Table -->
                                    <table class="table table-bordered mt-3">
                                        <thead>
                                            <tr>
                                                <th>Document Type</th>
                                                <th>Download</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            // Fetch documents for the user and tax year
                                            $user_id = $_SESSION['user_id']; // Assuming a session with user_id
                                            $tax_year = date('Y') - 1;
                                            $file_path = '../assets/uploads/documents/'; // File path for document directory
                                            $sql = "SELECT document_id, document_type, file_name FROM documents WHERE user_id = ? AND tax_year = ? AND `from_admin` = 0";
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
                        </div>
                    </div>
                </div>

                <!-- Tab Pane for Consent Documents -->
                <div class="tab-pane fade" id="consent-documents" role="tabpanel" aria-labelledby="consent-documents-tab">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card curve-card card-dark">
                                <div class="card-header curve-card">
                                    <h3 class="card-title"><i class="fas fa-file-signature"></i> Consent Documents</h3>
                                </div>
                                <div class="card-body">
                                    <p>Your consent documents that are required for tax processing.</p>
                                    <!-- Document list or download links would be here -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tab Pane for E-Signature -->
                <div class="tab-pane fade" id="e-signature" role="tabpanel" aria-labelledby="e-signature-tab">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card curve-card card-dark">
                                <div class="card-header curve-card">
                                    <h3 class="card-title"><i class="fas fa-signature"></i> E-Signature</h3>
                                </div>
                                <div class="card-body">
                                    <p>Provide your electronic signature for document approval and submission.</p>

                                    <form id="signatureForm" method="POST" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label for="signature" class="mb-3">Draw E-Signature or Upload</label>

                                            <div class="row align-items-center">
                                                <div class="col-md-5">
                                                    <div class="d-flex flex-column align-items-start">
                                                        <!-- Signature Pad -->
                                                        <canvas id="signature-pad" class="border mb-3" width="400" height="200"></canvas>
                                                        <button type="button" id="clear-signature" class="btn btn-warning mb-3 curve-card">Clear Signature</button>
                                                        <input type="hidden" name="signature" id="signature-input">
                                                    </div>
                                                </div>

                                                <!-- OR separator centered -->
                                                <div class="col-md-2 text-center">
                                                    <h6 class="m-0">OR</h6>
                                                </div>

                                                <!-- Upload Signature Column -->
                                                <div class="col-md-5">
                                                    <div class="form-group">
                                                        <label for="signature_upload">Upload Signature </label>
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
                                            <img id="uploaded_signature" src="" alt="Uploaded Signature Preview" class="img-fluid mt-2" style="display:none; max-width: 200px; height: auto;">
                                        </div>


                                        <div class="card-footer">
                                            <button type="submit" class="btn btn-info curve-card my-btn-primary-color">
                                                <i class="fas fa-paper-plane"></i> Submit Signature
                                            </button>
                                            <!-- Back Button with Icon and onclick event -->
                                            <button type="button" class="btn btn-default float-right curve-card" onclick="history.back();">
                                                <i class="fas fa-arrow-left"></i> Back
                                            </button>
                                        </div>

                                    </form>

                                    <script>
                                        function previewImage(event) {
                                            const file = event.target.files[0];
                                            const img = document.getElementById('uploaded_signature');
                                            const reader = new FileReader();

                                            reader.onload = function(e) {
                                                img.src = e.target.result;
                                                img.style.display = 'block'; // Show the image element
                                            }

                                            if (file) {
                                                reader.readAsDataURL(file); // Convert the file to base64 URL
                                            } else {
                                                img.src = '';
                                                img.style.display = 'none'; // Hide the image if no file is selected
                                            }
                                        }
                                    </script>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End of Tab Content -->
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php require('includes/footer.php'); ?>