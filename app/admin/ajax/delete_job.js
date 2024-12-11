//$(document).ready(function() {
//    // Attach a click event handler to all delete buttons with the "delete-record" class
//    $('.delete-record').on('click', function(e) {
//        e.preventDefault();
//
//        // Get the record ID from the data-id attribute
//        const recordId = $(this).data('id');
//
//        // Show a SweetAlert confirmation
//        Swal.fire({
//            title: 'Are you sure?',
//            text: "You won't be able to revert this!",
//            icon: 'warning',
//            showCancelButton: true,
//            confirmButtonColor: '#3085d6',
//            cancelButtonColor: '#d33',
//            confirmButtonText: 'Yes, delete it!'
//        }).then((result) => {
//            if (result.isConfirmed) {
//                // User confirmed, perform the delete action
//                deleteRecord(recordId);
//            }
//        });
//    });
//
//    // Function to delete the record using Ajax
//    function deleteRecord(recordId) {
//        $.ajax({
//            url: 'actions/delete_record.php', // Replace with the actual URL to delete the record
//            type: 'POST',
//            data: { id: recordId },
//            success: function(response) {
//                // Handle the success response
//                if (response === 'success') {
//                    // Reload the page on success
//                    location.reload();
//                } else {
//                    Swal.fire('Error', 'Failed to delete the record', 'error');
//                }
//            },
//            error: function() {
//                Swal.fire('Error', 'Failed to delete the record', 'error');
//            }
//        });
//    }
//});


$(document).ready(function() {
    // Attach a click event handler to the document and delegate it to the delete buttons with the "delete-record" class
    $(document).on('click', '.delete-record', function(e) {
        e.preventDefault();

        // Get the record ID from the data-id attribute
        const recordId = $(this).data('id');

        // Show a SweetAlert confirmation
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                // User confirmed, perform the delete action
                deleteRecord(recordId);
            }
        });
    });

    // Function to delete the record using Ajax
    function deleteRecord(recordId) {
        $.ajax({
            url: 'actions/delete_record.php', // Replace with the actual URL to delete the record
            type: 'POST',
            data: { id: recordId },
            success: function(response) {
                // Handle the success response
                if (response === 'success') {
                    // Reload the page on success
                    location.reload();
                } else {
                    Swal.fire('Error', 'Failed to delete the record', 'error');
                }
            },
            error: function() {
                Swal.fire('Error', 'Failed to delete the record', 'error');
            }
        });
    }
});