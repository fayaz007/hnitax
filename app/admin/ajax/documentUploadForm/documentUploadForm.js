    $(document).ready(function() {
        $('#taxFilingTabs a').on('click', function(e) {
            e.preventDefault();
            $(this).tab('show');
        });
    });
    $(document).ready(function() {
        $('#documentUploadForm').on('submit', function(e) {
            e.preventDefault(); // Prevent form from submitting traditionally

            // Create a FormData object
            var formData = new FormData(this);

            // AJAX request
            $.ajax({
                url: 'actions/admin_upload_document.php', // PHP file to process the upload
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    // Show SweetAlert success message
                    Swal.fire({
                        icon: 'success',
                        title: 'Upload Successful!',
                        text: response.message,
                    }).then(() => {
                        // Reload the page or reset the form if needed
                        $('#documentUploadForm')[0].reset();
                        $('.custom-file-label').html('Choose file');
                    });
                },
                error: function(xhr) {
                    // Show SweetAlert error message
                    Swal.fire({
                        icon: 'error',
                        title: 'Upload Failed',
                        text: xhr.responseText,
                    });
                }
            });
        });
    });

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
