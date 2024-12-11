
    $(document).ready(function() {

        function reloadEmploymentTable() {
            $('#employmentTable').load(location.href + " #employmentTable > *");
        }

        function resetForm() {
            $('#employmentForm')[0].reset();
            $('#employment_id').val(''); // Clear hidden field for ID
        }

        $('.add-clear-form').click(function() {
            resetForm();
        });

        // Save employment details (Add/Edit)
        $('#saveEmployment').click(function() {
            const formData = $('#employmentForm').serialize();

            $.ajax({
                url: 'actions/save_employment.php',
                type: 'POST',
                data: formData,
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        // Display SweetAlert message with the response message
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: response.message,
                            timer: 2000,
                            showConfirmButton: true
                        });
                        reloadEmploymentTable();
                        $('#addEmploymentModal').modal('hide');
                        resetForm();
                    } else {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Missing Information',
                            text: response.message,
                            showConfirmButton: true
                        });
                    }
                },
                error: function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Could not save employment details. Please try again.',
                        showConfirmButton: true
                    });
                }
            });
        });

        // Edit employment details
        $(document).on('click', '.edit-employment', function() {
            const data = $(this).data();
            $('#employer_name_modal').val(data.employer);
            $('#employment_start_date_modal').val(data.start);
            $('#employment_end_date_modal').val(data.end);
            $('#employment_id').val(data.id); // Set ID for editing
            $('#addEmploymentModal').modal('show');
        });

        // Delete employment details
        $(document).on('click', '.delete-employment', function() {
            const employmentId = $(this).data('id');

            Swal.fire({
                title: 'Are you sure?',
                text: "This action cannot be undone.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: 'actions/delete_employment.php',
                        type: 'POST',
                        data: {
                            id: employmentId
                        },
                        dataType: 'json',
                        success: function(response) {
                            if (response.status === 'success') {
                                reloadEmploymentTable();
                                Swal.fire('Deleted!', 'Your employment record has been deleted.', 'success');
                            } else {
                                Swal.fire('Error!', response.message, 'error');
                            }
                        },
                        error: function() {
                            Swal.fire('Error!', 'Could not delete employment record. Please try again.', 'error');
                        }
                    });
                }
            });
        });
    });
