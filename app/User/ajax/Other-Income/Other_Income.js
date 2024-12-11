$(document).ready(function() {
    $('#otherIncomeForm').submit(function(e) {
        e.preventDefault();

        var formData = new FormData(this);
        let submitButton = $(this).find('button[type="submit"]');

        // Disable the button and show a loading spinner
        submitButton.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Submitting...');

        $.ajax({
            url: 'actions/save_other_income.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                var res = JSON.parse(response);
                if (res.status === 'success') {
                    Swal.fire({
                        title: 'Success!',
                        text: res.message,
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        // Reload the page after success alert is confirmed
                        location.reload();
                    });
                } else {
                    Swal.fire({
                        title: 'Error!',
                        text: res.message,
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            },
            error: function() {
                Swal.fire({
                    title: 'Error!',
                    text: 'An error occurred while processing the form.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            },
            complete: function() {
                // Re-enable the button and reset the text after completion
                submitButton.prop('disabled', false).html('Submit');
            }
        });
    });
});
