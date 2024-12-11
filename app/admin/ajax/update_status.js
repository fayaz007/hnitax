$("#jobTable").on("change", ".job_status", function () {
    const id = $(this).data("id");
    const column = "job_status";
    const value = $(this).val();
    const project = "project";
    // Send AJAX request to update the data
    $.ajax({
      type: "POST",
      url: "actions/update_status.php",
      data: {
        from: project,
        id: id,
        column: column,
        value: value,
      },
      success: (response) => console.log(response),
      success: function (response) {
        console.log(response);
        toastr.info("Record updated!");
        // location.reload();
      },
      error: function (xhr, status, error) {
        console.error(xhr.responseText);
        toastr.error("Failed to update record!");
      },
    });
  });


  $("#jobTable").on("change", ".billing_status", function () {
    const id = $(this).data("id");
    const column = "billing_status";
    const value = $(this).val();
    const project = "project";
    // Send AJAX request to update the data
    $.ajax({
      type: "POST",
      url: "actions/update_status.php",
      data: {
        from: project,
        id: id,
        column: column,
        value: value,
      },
      success: (response) => console.log(response),
      success: function (response) {
        console.log(response);
        toastr.info("Record updated!");
        // location.reload();
      },
      error: function (xhr, status, error) {
        console.error(xhr.responseText);
        toastr.error("Failed to update record!");
      },
    });
  });

  $("#jobTable").on("change", ".collection_status", function () {
    const id = $(this).data("id");
    const column = "collection";
    const value = $(this).val();
    const project = "project";
    // Send AJAX request to update the data
    $.ajax({
      type: "POST",
      url: "actions/update_status.php",
      data: {
        from: project,
        id: id,
        column: column,
        value: value,
      },
      success: (response) => console.log(response),
      success: function (response) {
        console.log(response);
        toastr.info("Record updated!");
        // location.reload();
      },
      error: function (xhr, status, error) {
        console.error(xhr.responseText);
        toastr.error("Failed to update record!");
      },
    });
  });


  $("#jobTable").on("change", ".billing_mode_status_status", function () {
    const id = $(this).data("id");
    const column = "billing_mode";
    const value = $(this).val();
    const project = "project";
    // Send AJAX request to update the data
    $.ajax({
      type: "POST",
      url: "actions/update_status.php",
      data: {
        from: project,
        id: id,
        column: column,
        value: value,
      },
      success: (response) => console.log(response),
      success: function (response) {
        console.log(response);
        toastr.info("Record updated!");
        // location.reload();
      },
      error: function (xhr, status, error) {
        console.error(xhr.responseText);
        toastr.error("Failed to update record!");
      },
    });
  });

   // Update data on blur of editable fields
  $("#jobTable").on(
    "blur",
    ".remarks",
    function () {
      const id = $(this).data("id");
      // const column = $(this).attr("id");
     const column = 'remarks';
      const value = $(this).text();
      const project = 'project';

    // Send AJAX request to update the data
  $.ajax({
    type: "POST",
    url: "actions/update_status.php",
    data: {
      from: project,
      id: id,
      column: column,
      value: value,
    },
        // success: (response) => console.log(response),
        success: function (response) {
          console.log(response);
          toastr.info("Record updated!");
        },
        error: function (xhr, status, error) {
          console.error(xhr.responseText);
          toastr.error("Failed to update record!");
        },
      });
    }
  );

   // Update data on blur of editable fields
  $("#jobTable").on(
    "blur",
    ".job_path",
    function () {
      const id = $(this).data("id");
      // const column = $(this).attr("id");
     const column = 'job_path';
      const value = $(this).text();
      const project = 'project';

    // Send AJAX request to update the data
  $.ajax({
    type: "POST",
    url: "actions/update_status.php",
    data: {
      from: project,
      id: id,
      column: column,
      value: value,
    },
        // success: (response) => console.log(response),
        success: function (response) {
          console.log(response);
          toastr.info("Record updated!");
        },
        error: function (xhr, status, error) {
          console.error(xhr.responseText);
          toastr.error("Failed to update record!");
        },
      });
    }
  );