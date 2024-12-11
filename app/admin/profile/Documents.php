<div class="card curve-card card-dark">
    <div class="card-header curve-card">
        <h3 class="card-title"><i class="fas fa-paperclip"></i> Documents</h3>
        <!-- Edit Icon with Tooltip -->
        <a href="edit_documents.php?user_id=<?= $user_id; ?>&tax_year=<?= $tax_year; ?>" class="ml-3 float-right" title="Edit Details">
            <i class="fas fa-edit"></i>
        </a>
    </div>
    <div class="card-body">
        <!-- Uploaded Files Table -->
        <table class="table table-bordered table-striped table-sm">
            <thead>
                <tr>
                    <th>Document Type</th>
                    <th>Download </th>
                </tr>
            </thead>
            <tbody>
                 <!-- Download All as Zip Button -->
        <button id="downloadAll" class="btn btn-primary btn-sm mt-3">Download All as Zip</button>
        <!-- Loader (initially hidden) -->
        <div id="loader" style="display: none;">
            <p>Preparing download...</p>
          
        </div>
                <?php
                // Fetch documents for the user and tax year
                $file_path = '../assets/uploads/documents/';
                $sql = "SELECT document_id, document_type, file_name FROM documents WHERE user_id = ? AND tax_year = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ii", $user_id, $tax_year);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $download_path = htmlspecialchars($file_path . $row['file_name']);
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['document_type']) . "</td>";
                        echo "<td><a href='$download_path' class='btn btn-outline-info btn-sm' download><i class='fas fa-download'></i></a></td>";
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

<script>
    document.getElementById('downloadAll').addEventListener('click', function() {
        document.getElementById('loader').style.display = 'block'; // Show loader

        $.ajax({
            url: 'actions/download_all_documents.php',
            type: 'POST',
            data: {
                user_id: <?= json_encode($user_id); ?>,
                tax_year: <?= json_encode($tax_year); ?>
            },
            xhrFields: {
                responseType: 'blob' // Set response type to blob to handle file download
            },
            success: function(response, status, xhr) {
                // Hide loader
                document.getElementById('loader').style.display = 'none';

                // Get the filename from the Content-Disposition header
                var filename = "";
                var disposition = xhr.getResponseHeader('Content-Disposition');
                if (disposition && disposition.indexOf('attachment') !== -1) {
                    var matches = /filename[^;=\n]*=((['"]).*?\2|[^;\n]*)/.exec(disposition);
                    if (matches != null && matches[1]) filename = matches[1].replace(/['"]/g, '');
                }

                // Create a link element for download
                var link = document.createElement('a');
                var url = window.URL.createObjectURL(response);
                link.href = url;
                link.download = filename || 'download.zip';
                document.body.appendChild(link);
                link.click();
                setTimeout(function() {
                    document.body.removeChild(link);
                    window.URL.revokeObjectURL(url); // Clean up
                }, 100);
            },
            error: function() {
                document.getElementById('loader').style.display = 'none'; // Hide loader on error
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Failed to generate zip file. Please try again.'
                });
            }
        });
    });
</script>
