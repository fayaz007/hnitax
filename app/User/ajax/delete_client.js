
    $(document).ready(function() {
        $('.delete-client').click(function() {
            // Get the service ID from the data attribute
            var serviceId = $(this).data('serviceid');

            // Show a SweetAlert confirmation
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!'
            }).then((result) => {
                if (result.value) {
                    // User confirmed, send the AJAX request to delete the service
                    $.ajax({
                        type: 'POST',
                        url: 'actions/delete-client.php',
                        data: {
                            id: serviceId
                        },
                        success: function(response) {
                            // Check the response for success or error
                            if (response === 'success') {
                                Swal.fire('Deleted!', 'client has been deleted.', 'success');
                                location.reload();                            } else {
                                Swal.fire('Error', 'client deletion failed.', 'error');
                            }
                        }
                    });
                }
            });
        });
    });
