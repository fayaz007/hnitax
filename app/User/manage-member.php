<?php
$current_page = "Manage Member"; // Set the current page title 
require('includes/header.php');
require('includes/navbar.php');
require('includes/sidebar.php');

// Check if 'id' is provided in the URL
if (isset($_GET['id']) && !empty($_GET['id'])) {

    $id = $_GET['id'];

    // Prepare a SELECT statement
    $sql = "SELECT 
    mem.name, mem.mobile_number, mem.member_photo, mem.user_id, u.email, u.user_type, u.status 
    FROM 
    members mem
    JOIN 
    users u
    ON mem.user_id = u.user_id
    WHERE 
    u.user_id = ?";





    // Create a prepared statement
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        // Bind the parameter
        $stmt->bind_param("i", $id);

        // Execute the statement
        $stmt->execute();

        // Get the result
        $result = $stmt->get_result();
        // Check if data is found
        if ($result->num_rows == 1) {
            // Fetch the member data
            $row = $result->fetch_assoc();

            // Assign the fetched data to variables
            $user_id = $row['user_id'];
            $name = $row['name'];
            $mobile_number = $row['mobile_number'];
            $email = $row['email'];
            $user_type = $row['user_type'];
            $member_photo = $row['member_photo'];
            $status = $row['status'];
      
 
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">
                        <?= $current_page ?>
                    </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">
                            <?= $current_page ?>
                        </li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card curve-card">
                        <div class="card-header">
                            <ul class="nav nav-pills">
                                <li class="nav-item h5"><a class="nav-link active" href="#editUser" data-toggle="tab">Edit Member</a></li>
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="active tab-pane" id="editUser">
                                    <form id="editUserForm" class="custom-form" enctype="multipart/form-data">
                                        <div class="card-header">
                                            <h3 class="card-title text-center">
                                                <i class="fa-solid fa-tag"></i>
                                                <strong>Edit Member Details:</strong>
                                            </h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group">
                                                <input type="hidden" class="form-control" id="user_id" name="user_id" value="<?= htmlspecialchars($user_id); ?>">
                                            </div>
                                            <div class="form-group">
                                                <img class="profile-user-img img-fluid img-circle" style="border : 1px solid #dfdfdf;border-radius: 50%;width: 100px;height: 100px;" src="<?= BASE_URL ?>assets/uploads/Documents/members/<?= htmlspecialchars($user_id) ?>/<?= htmlspecialchars($member_photo) ?>" alt="User profile picture">
                                            </div>
                                            <div class="row">

                                                <div class="col-md-6">

                                                    <div class="form-group">
                                                        <label for="profile_photo">Member Photo <span class="required">*</span></label>
                                                        <div class="input-group">
                                                            <div class="custom-file">
                                                                <input type="file" class="custom-file-input" value="<?= htmlspecialchars($member_photo) ?>" name="profile_photo" id="profile_photo" accept="image/*">
                                                                <input type="hidden" name="old_profile_photo" value="<?= htmlspecialchars($member_photo) ?>">
                                                                <label class="custom-file-label" for="profile_photo"><?= htmlspecialchars($member_photo) ?></label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="email">Email</label>
                                                        <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($email); ?>" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="user_type">User Type</label>
                                                        <input type="text" class="form-control" id="user_type" value="<?= htmlspecialchars($user_type); ?>" readonly>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="password">Password <span class="required">*</span></label>
                                                        <input type="password" name="password" class="form-control" id="password" placeholder="Leave blank if you don't want to change the password!">
                                                    </div>

                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="name">Name</label>
                                                        <input type="text" class="form-control" id="name" name="name" value="<?= htmlspecialchars($name); ?>" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="mobile_number">Contact Number</label>
                                                        <input type="tel" class="form-control" id="mobile_number" name="mobile_number" value="<?= htmlspecialchars($mobile_number); ?>" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="status">Status</label>
                                                        <select class="form-control" id="status" name="status" value="<?= htmlspecialchars($status); ?>" required>
                                                            <option value="Active" <?= ($status === 'Active') ? 'selected' : '' ?>>
                                                                Active</option>
                                                            <option value="Inactive" <?= ($status === 'Inactive') ? 'selected' : '' ?>>
                                                                Inactive</option>
                                                            <option value="Pending" <?= ($status === 'Pending') ? 'selected' : '' ?>>
                                                                Pending</option>
                                                        </select>
                                                    </div>

                                                    <!-- Additional input fields can be added here -->
                                                </div>

                                            </div>
                                        </div>

                                        <div class="card-footer">
                                            <button type="submit" class="btn my-btn-primary-color curve-card" id="editUserBtn">
                                                <span id="editUserText">Save Change</span>
                                                <span id="editUserLoader" class="d-none">
                                                    <i class="fas fa-spinner fa-spin"></i> Updating...
                                                </span>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<?php 
  } else {
    echo "Member not found.";
}
$stmt->close();
} else {
    echo "Error preparing statement.";
}
} else {
echo "Member ID not provided.";
}
?>
<?php require('includes/footer.php');  ?>

<script>
    $(document).ready(function() {

        // Custom validation method for mobile numbers
        $.validator.addMethod(
            "mobile",
            function(value, element) {
                return this.optional(element) || /^[0-9]{10}$/.test(value);
            },
            "Please provide a valid 10-digit mobile number"
        );
        $.validator.addMethod(
        "fileType",
        function(value, element) {
            // Get the selected file's extension
            var extension = value.split('.').pop().toLowerCase();

            // Check if the input element is 'profile_photo'
            if (element.name === "profile_photo") {
                // Allow only image file types (e.g., JPG, JPEG, PNG)
                var allowedImageExtensions = ["jpg", "JPG", "jpeg", "JPEG", "png", "PNG"];
                return this.optional(element) || $.inArray(extension, allowedImageExtensions) !== -1;
            } else {
                // Allow both image and PDF file types
                var allowedExtensions = ["jpg", "JPG", "jpeg", "JPEG", "png", "PNG", "pdf", "PDF"];
                return this.optional(element) || $.inArray(extension, allowedExtensions) !== -1;
            }
        },
        "Please choose a valid file type (JPG, JPEG, PNG, or PDF)"
    );

    $.validator.addMethod(
        "fileSize",
        function(value, element) {
            // Get the selected file size in bytes
            var fileSize = element.files[0].size;

            // Define the maximum file size in bytes (2MB)
            var maxFileSize = 2 * 1024 * 1024; // 2MB

            // Check if the file size is within the allowed limit
            return this.optional(element) || fileSize <= maxFileSize;
        },
        "File size exceeds the maximum allowed (2 MB)"
    );


        $("#editUserForm").validate({
            rules: {
                email: {
                    required: true,
                    email: true,
                },
                password: {
                    minlength: 6,
                    digits: true, // Ensure the password consists only of digits
                    maxlength: 6,
                },
                name: {
                    required: true,
                },
                status: {
                    required: true,
                },
                user_type: {
                    required: true,
                },
                mobile_number: {
                    required: true,
                    mobile: true, // Use the custom phone validation method
                },
              
            },
            messages: {
                email: {
                    required: "Please enter an email address",
                    email: "Please enter a valid email address"
                },
                password: {
                    minlength: "Your password must be at least 6 characters long",
                    digits: "Password must contain only digits",
                    maxlength: "Password must be exactly 6 digits long",
                },
                name: {
                    required: "Please provide a Member Name",
                },
                status: {
                    required: "Please provide a status",
                },
                user_type: {
                    required: "Please provide a user type",
                },
                mobile_number: {
                    required: "Please provide a valid mobile",
                },
              
            },
            errorElement: "span",
            errorPlacement: function(error, element) {
                error.addClass("invalid-feedback");
                element.closest(".form-group").append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass("is-invalid");
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass("is-invalid");
            },
            submitHandler: function(form) {

                // Disable the submit button and show loading state
                $('#editUserBtn').prop('disabled', true);
                $('#editUserText').addClass('d-none');
                $('#editUserLoader').removeClass('d-none');

                // Create a FormData object from the form
                var formData = new FormData(form);
                


                $.ajax({
                    type: "POST",
                    url: "actions/user-management/edit_member_action.php", // Adjust the path to your PHP file
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        // Handle the response (e.g., show a success message)
                        console.log(response);


                        // Enable the submit button and hide loading state
                        $('#editUserBtn').prop('disabled', false);
                        $('#editUserLoader').addClass('d-none');
                        $('#editUserText').removeClass('d-none');

                        // Handle the response (e.g., show a success message)
                        if (response === "success") {
                            // Reset the form
                            form.reset();

                            // Show success alert
                            Swal.fire({
                                icon: 'success',
                                title: 'Success!',
                                text: 'Member added successfully!',
                            });
                            setTimeout(() => {
                                window.location.href = "user_management.php";
                            }, 500);
                        } else {
                            // Show error alert
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: response,
                            });
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error("AJAX Error: " + textStatus, errorThrown);

                        // Enable the submit button and hide loading state
                        $('#editUserBtn').prop('disabled', false);
                        $('#editUserLoader').addClass('d-none');
                        $('#editUserText').removeClass('d-none');

                        // Show error alert
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'An error occurred while adding the member.',
                        });
                    }
                });
            }
        });
    });
</script>
<!-- /.content-wrapper -->