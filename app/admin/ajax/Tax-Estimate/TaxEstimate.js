    $(document).ready(function() {
        // Save or Update Tax Estimate
        $('#saveTaxEstimate').on('click', function() {
            const formData = {
                estimate_id: $('#estimate_id').val(),
                user_id: $('#user_id').val(),
                tax_year: $('#tax_year').val(),
                federal_refund: $('#federal_refund').val(),
                state_refund: $('#state_refund').val(),
                city_refund: $('#city_refund').val()
            };

            $.ajax({
                url: 'actions/save_tax_estimate.php',
                type: 'POST',
                data: formData,
                dataType: 'json',
                success: function(response) {
                    Swal.fire({
                        icon: response.success ? 'success' : 'error',
                        title: response.success ? 'Success!' : 'Error',
                        text: response.message,
                        showConfirmButton: !response.success,
                        timer: response.success ? 1500 : undefined
                    }).then(() => {
                        if (response.success) {
                            $('#addTaxEstimateModal').modal('hide');
                            refreshTableData();
                        }
                    });
                },
                error: function(xhr, status, error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Error in AJAX request: ' + error
                    });
                }
            });
        });

        // Edit Tax Estimate
        $(document).on('click', '.edit-tax-estimate', function() {
            const { id, federal, state, city } = $(this).data();

            $('#estimate_id').val(id);
            $('#federal_refund').val(federal);
            $('#state_refund').val(state);
            $('#city_refund').val(city);

            $('#addTaxEstimateModal').modal('show');
        });

        // Delete Tax Estimate
        $(document).on('click', '.delete-tax-estimate', function() {
            const estimateId = $(this).data('id');

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
                    $.ajax({
                        url: 'actions/delete_tax_estimate.php',
                        type: 'POST',
                        data: { estimate_id: estimateId },
                        dataType: 'json',
                        success: function(response) {
                            Swal.fire({
                                icon: response.success ? 'success' : 'error',
                                title: response.success ? 'Deleted!' : 'Error',
                                text: response.success ? 'Tax estimate has been deleted.' : response.message,
                                showConfirmButton: !response.success,
                                timer: response.success ? 1500 : undefined
                            }).then(() => {
                                if (response.success) refreshTableData();
                            });
                        },
                        error: function() {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Error in AJAX request.'
                            });
                        }
                    });
                }
            });
        });

     const userId = $('#user_id').val();
    const taxYear = $('#tax_year').val();

    // Function to refresh table data
    function refreshTableData() {
        $.ajax({
            url: 'actions/fetch_tax_estimates.php',
            type: 'GET',
            data: { user_id: userId, tax_year: taxYear }, // Pass user_id and tax_year
            success: function(data) {
                $('#EstimateTable tbody').html(data);
            },
            error: function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Could not reload table data.'
                });
            }
        });
    }


        // Initial data load
        refreshTableData();
    });
