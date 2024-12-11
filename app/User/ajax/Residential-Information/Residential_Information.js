$(document).ready(function() {
    // Save Residency (Already provided)
    $('#saveResidency').on('click', function(e) {
        e.preventDefault();
        const formData = {
            residency_for: $('#residency_for').val(),
            state_name_modal: $('#state_name_modal').val(),
            residency_start_date_modal: $('#residency_start_date_modal').val(),
            residency_end_date_modal: $('#residency_end_date_modal').val(),
            rent_paid_modal: $('#rent_paid_modal').val(),
            tax_year: $('#tax_year').val(),
        };
        if (!formData.residency_for || !formData.state_name_modal || !formData.residency_start_date_modal || !formData.residency_end_date_modal || !formData.rent_paid_modal) {
            Swal.fire({ icon: 'warning', title: 'Missing Information', text: 'Please fill all required fields.' });
            return;
        }
        $.post('actions/save_residency.php', formData)
            .done(function(response) {
                handleResponse(response, 'Residency saved successfully!', 'addResidencyModal');
            })
            .fail(showErrorAlert);
    });

    // Edit Residency - Open modal and load data
    $(document).on('click', '.edit-residency-btn', function() {
        const residencyId = $(this).data('id');
        $.get('get_residency.php', { id: residencyId }, function(response) {
            const data = JSON.parse(response);
            if (data.status === 'success') {
                const details = data.details;
                $('#residency_for').val(details.residency_for);
                $('#state_name_modal').val(details.state_name);
                $('#residency_start_date_modal').val(details.residency_start_date);
                $('#residency_end_date_modal').val(details.residency_end_date);
                $('#rent_paid_modal').val(details.rent_paid);
                $('#tax_year').val(details.tax_year);
                $('#addResidencyModal').modal('show');
                $('#saveResidency').data('id', residencyId); // Store the ID for update
            } else {
                Swal.fire({ icon: 'error', title: 'Error!', text: data.message });
            }
        });
    });

    // Save Edited Residency
    $('#saveResidency').on('click', function(e) {
        e.preventDefault();
        const residencyId = $(this).data('id'); // Get the residency ID if editing
        const formData = {
            residency_for: $('#residency_for').val(),
            state_name_modal: $('#state_name_modal').val(),
            residency_start_date_modal: $('#residency_start_date_modal').val(),
            residency_end_date_modal: $('#residency_end_date_modal').val(),
            rent_paid_modal: $('#rent_paid_modal').val(),
            tax_year: $('#tax_year').val(),
        };
        if (!formData.residency_for || !formData.state_name_modal || !formData.residency_start_date_modal || !formData.residency_end_date_modal || !formData.rent_paid_modal) {
            Swal.fire({ icon: 'warning', title: 'Missing Information', text: 'Please fill all required fields.' });
            return;
        }

        const url = residencyId ? 'actions/update_residency.php' : 'actions/save_residency.php'; // Choose script based on action
        formData.id = residencyId; // Add the ID if editing

        $.post(url, formData)
            .done(function(response) {
                handleResponse(response, 'Residency updated successfully!', 'addResidencyModal');
            })
            .fail(showErrorAlert);
    });

    // Delete Residency
    $(document).on('click', '.delete-residency-btn', function() {
        const residencyId = $(this).data('id');
        Swal.fire({
            title: 'Are you sure?',
            text: 'This will delete the residency record permanently!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.post('actions/delete_residency.php', { id: residencyId })
                    .done(function(response) {
                        handleResponse(response, 'Residency deleted successfully!', null);
                    })
                    .fail(showErrorAlert);
            }
        });
    });

    // Helper function for handling responses
    function handleResponse(response, successMessage, modalId) {
        try {
            const data = JSON.parse(response);
            Swal.fire({
                icon: data.status === 'success' ? 'success' : 'error',
                title: data.status === 'success' ? 'Success!' : 'Error!',
                text: data.message
            }).then(() => {
                if (data.status === 'success' && modalId) {
                    $(`#${modalId}`).modal('hide'); // Hide the modal
                    location.reload(); // Reload or dynamically update the table
                }
            });
        } catch (error) {
            showErrorAlert();
        }
    }

    // Error alert handler
    function showErrorAlert() {
        Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: 'Something went wrong. Please try again later.'
        });
    }
});
