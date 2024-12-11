$(document).ready(function() {
    // Handle form submission to save or update a dependent
    $('#saveDependent').click(function() {
        var formData = $('#dependentForm').serialize();
        var dependentId = $('#dependent_id').val();

        $.ajax({
            type: "POST",
            url: dependentId ? "actions/update_dependent.php" : "actions/save_dependent.php",
            data: formData,
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: response.message,
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $('#addDependentModal').modal('hide');
                            location.reload();
                        }
                    });
                } else {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Missing Information!',
                        text: response.message,
                        confirmButtonText: 'OK'
                    });
                }
            },
            error: function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'An error occurred while saving the dependent. Please try again.',
                    confirmButtonText: 'OK'
                });
            }
        });
    });

    // Function to handle editing of a dependent
    window.editDependent = function(dependentId) {
        $.ajax({
            type: "GET",
            url: "actions/get_dependent.php",
            data: { dependent_id: dependentId },
            dataType: 'json',
            success: function(response) {
                $('#dependent_first_name_modal').val(response.first_name);
                $('#dependent_last_name_modal').val(response.last_name);
                $('#dependent_dob_modal').val(response.dob);
                $('#dependent_ssn_modal').val(response.ssn);
                $('#dependent_ssn_select').val(response.ssn_select); // Add SSN/ITIN selection
                $('#dependent_relationship_modal').val(response.relationship);
                $('#dependent_entry_date_modal').val(response.entry_date);
                $('#dependent_id').val(response.dependent_id);

                $('#addDependentModalLabel').text('Edit Dependent');
                $('#addDependentModal').modal('show');
            },
            error: function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Failed to fetch dependent details. Please try again.',
                    confirmButtonText: 'OK'
                });
            }
        });
    };

    // Function to handle deletion of a dependent
    window.deleteDependent = function(dependentId) {
        Swal.fire({
            title: 'Are you sure?',
            text: "This will permanently delete the dependent!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: "actions/delete_dependent.php",
                    data: { dependent_id: dependentId },
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Deleted!',
                                text: response.message,
                                confirmButtonText: 'OK'
                            }).then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: response.message,
                                confirmButtonText: 'OK'
                            });
                        }
                    },
                    error: function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'Failed to delete the dependent. Please try again.',
                            confirmButtonText: 'OK'
                        });
                    }
                });
            }
        });
    };

    // Reset modal form when closed or adding a new dependent
    $('#addDependentModal').on('hidden.bs.modal', function() {
        $('#dependentForm')[0].reset();
        $('#dependent_id').val('');
        $('#dependent_ssn_select').val(''); // Reset SSN/ITIN selection field
        $('#addDependentModalLabel').text('Add Dependent');
    });
});
