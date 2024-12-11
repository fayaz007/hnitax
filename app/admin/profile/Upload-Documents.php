<div class="col-md-12">
    <!-- Upload Document Card -->
    <div class="card curve-card card-dark mb-4">
        <div class="card-header curve-card">
            <h3 class="card-title"><i class="fas fa-upload"></i> Upload Document</h3>
        </div>
        <form id="documentUploadForm" method="POST" enctype="multipart/form-data">
            <div class="card-body">
                <div class="row">
                    <input type="hidden" name="user_id" id="user_id" value="<?= $user_id ?>">
                    <input type="hidden" name="tax_year" id="tax_year" value="<?= $tax_year ?>">

                    <!-- Document Name Input -->
                    <div class="col-md-6 mb-3">
                        <div class="form-group">
                            <label for="document_type">Document Name <span class="required">*</span></label>
                            <input type="text" name="document_type" id="document_type" class="form-control" required>
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

                    <!-- Submit Button -->
                    <div class="col-md-2 mb-3">
                        <div class="form-group">
                            <button type="submit" class="btn btn-info curve-card my-btn-primary-color">
                                <i class="fas fa-cloud-upload-alt"></i> Upload
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>



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