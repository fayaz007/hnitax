
$(document).ready(function() {
    $('#taxpayer-info-form').on('submit', function(e) {
        e.preventDefault(); // Prevent default form submission

        $.ajax({
            url: 'actions/save_personal_info.php', // PHP file to handle submission
            method: 'POST',
            data: $(this).serialize(), // Serialize form data
            success: function(response) {
                // Parse the JSON response from the PHP file
                var result = JSON.parse(response);

                // Check if the operation was successful
                if (result.message.includes("updated") || result.message.includes("inserted")) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: result.message,
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: result.message,
                    });
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Something went wrong: ' + errorThrown,
                });
            }
        });
    });
});

