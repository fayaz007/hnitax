    //model for task get project id
    $(document).ready(function() {
        // Listen for click event on the "Add Task" button
        $('.add-project-btn').click(function() {

            // Open the modal
            $('.Project').modal('show');
        });
    });

//ajax fetch data service by category:

$(document).ready(function () {
    // Listen to the change event of the client dropdown
    $('#client').on('change', function () {
        var client_id = $(this).val();

        // Make an AJAX request to get the client's contact number
        $.ajax({
            url: 'actions/get_client_contact.php',
            type: 'POST',
            data: { client_id: client_id },
            success: function (response) {
                $('#Client_No').val(response);
            },
            error: function () {
                $('#Client_No').val('Contact Number not found');
            }
        });
    });
});










$(document).ready(function() {
    $('#services_cat').on('change', function() {
        var category = $(this).val();
        if (category) {
            $.ajax({
                url: 'actions/get_services.php',
                type: 'POST',
                data: {
                    category: category
                },
                dataType: 'json',
                success: function(data) {
                    $('#service').empty();
                    $('#service').append(
                        '<option selected disabled>Select Services</option>'
                    );
                    $.each(data, function(key, value) {
                        $('#service').append('<option value="' +
                            value
                            .service_name + '">' + value
                            .service_name + '</option>');
                    });
                }
            });
        } else {
            $('#service').empty();
            $('#service').append('<option selected disabled>Select Services</option>');
        }
    });
});



$(document).ready(function () {
  $(".view-button").on("click", function (e) {
    e.preventDefault();
    var projectId = $(this).attr("href").split("=")[1];
    // Send an AJAX request to fetch the task project details
    $.ajax({
      url: "actions/fetch_project_details.php",
      type: "GET",
      data: { id: projectId },
      success: function (response) {
        $("#viewModal .modal-body").html(response);
      },
      error: function (xhr, status, error) {
        console.error(error);
      },
    });
  });
});


