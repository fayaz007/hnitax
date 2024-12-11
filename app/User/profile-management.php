<?php
$current_page = "Profile Management"; // Set the current page title
require('includes/header.php');

?>

<style>
    .hidden {
        display: none;
    }

    .curve-card {
        border-radius: 15px;
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
    }

    .breadcrumb-item a {
        color: #007bff;
    }
</style>

<!-- Navbar -->
<?php require('includes/navbar.php'); ?>
<!-- /.navbar -->

<!-- Main Sidebar Container -->
<?php require('includes/sidebar.php'); ?>
<!-- /.sidebar -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><?= $current_page ?></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active"><?= $current_page ?></li>
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
                <?php
                // Assume $user_id is the logged-in user's ID
                $user_id = $_SESSION['user_id'];

                // Fetch user data from the database

                // Fetch details from users, personal_information, and contact_information tables
                $sql = "SELECT u.username, u.email, u.phone as primary_phone, pi.first_name, pi.middle_name, pi.last_name, pi.marital_status,
            pi.taxpayer_dob, ci.street_address, ci.city, ci.state, ci.zip_code, ci.email_id as contact_email,
            ci.work_number as work_number,  ci.mobile_number
        FROM users u
        LEFT JOIN personal_information pi ON u.user_id = pi.user_id
        LEFT JOIN contact_information ci ON u.user_id = ci.user_id
        WHERE u.user_id = ?";

                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $user_id);
                $stmt->execute();
                $result = $stmt->get_result();
                $user = $result->fetch_assoc();
                ?>
                <div class="col-md-12">
                    <!-- Profile Details Update Card -->
                    <div class="card curve-card card-dark">
                        <div class="card-header curve-card">
                            <h3 class="card-title"><i class="fas fa-user-edit"></i> Update Personal Information</h3>
                        </div>
                        <div class="card-body">
                            <?php if (!empty($user['first_name']) && !empty($user['mobile_number'])) : ?>

                                <form method="POST" id="profileUpdateForm">
                                    <div class="form-group row">
                                        <input type="hidden" class="form-control" id="user_id" name="user_id" value="<?= $user_id; ?>" required>

                                        <label for="first_name" class="col-sm-2 col-form-label">First Name</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="first_name" name="first_name" value="<?= htmlspecialchars($user['first_name']) ?>" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="middle_name" class="col-sm-2 col-form-label">Middle Name</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="middle_name" name="middle_name" value="<?= htmlspecialchars($user['middle_name']) ?>" placeholder="Optional">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="last_name" class="col-sm-2 col-form-label">Last Name</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="last_name" name="last_name" value="<?= htmlspecialchars($user['last_name']) ?>" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="email" class="col-sm-2 col-form-label">Email</label>
                                        <div class="col-sm-10">
                                            <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="primary_phone" class="col-sm-2 col-form-label">Primary Phone</label>
                                        <div class="col-sm-10">
                                            <input type="tel" class="form-control" id="primary_phone" name="primary_phone" value="<?= htmlspecialchars($user['mobile_number']) ?>" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="mobile_number" class="col-sm-2 col-form-label">Work Number</label>
                                        <div class="col-sm-10">
                                            <input type="tel" class="form-control" id="mobile_number" name="mobile_number" value="<?= htmlspecialchars($user['work_number']) ?>" placeholder="Optional">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-10 offset-sm-2">
                                            <button type="submit" class="btn btn-info curve-card my-btn-primary-color">Update Information</button>
                                        </div>
                                    </div>
                                </form>
                            <?php else : ?>
                                <p>Welcome! Please provide your Personal Information details by visiting the <a href="personal-information.php">Personal Information</a> page.</p>

                            <?php endif; ?>

                        </div>
                    </div>

                    <!-- Password Update Card -->
                    <div class="card curve-card card-dark mt-4">
                        <div class="card-header curve-card">
                            <h3 class="card-title"><i class="fas fa-key"></i> Change Password</h3>
                        </div>
                        <div class="card-body">
                            <form method="POST" id="passwordUpdateForm">
                                <div class="form-group row">
                                    <label for="old_password" class="col-sm-2 col-form-label">Old Password</label>
                                    <div class="col-sm-10">
                                        <input type="password" class="form-control" id="old_password" name="old_password" placeholder="••••••••" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="new_password" class="col-sm-2 col-form-label">New Password</label>
                                    <div class="col-sm-10">
                                        <input type="password" class="form-control" id="new_password" name="new_password" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="confirm_password" class="col-sm-2 col-form-label">Confirm Password</label>
                                    <div class="col-sm-10">
                                        <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-10 offset-sm-2">
                                        <button type="submit" class="btn btn-info curve-card my-btn-primary-color">Update Password</button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php require('includes/footer.php'); ?>

<script>
    $(document).ready(function() {
        $('#profileUpdateForm').on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: 'actions/process-profile.php', // PHP file that processes the form data
                data: $(this).serialize(),
                success: function(response) {
                    try {
                        let res = JSON.parse(response);
                        if (res.status === 'success') {
                            Swal.fire('Success', res.message, 'success').then((result) => {
                                if (result.isConfirmed) {
                                    location.reload(); // Reload the page on success
                                }
                            });
                        } else {
                            Swal.fire('Error', res.message, 'error');
                        }
                    } catch (error) {
                        Swal.fire('Error', 'An unexpected error occurred. Please try again.', 'error');
                    }
                }
            });
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('#passwordUpdateForm').on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: 'actions/process-password.php', // PHP file that processes the password update
                data: $(this).serialize(),
                success: function(response) {
                    try {
                        let res = JSON.parse(response);
                        if (res.status === 'success') {
                            Swal.fire('Success', res.message, 'success').then((result) => {
                                if (result.isConfirmed) {
                                    location.reload(); // Reload the page on success
                                }
                            });
                        } else {
                            Swal.fire('Error', res.message, 'error');
                        }
                    } catch (error) {
                        Swal.fire('Error', 'An unexpected error occurred. Please try again.', 'error');
                    }
                }
            });
        });
    });
</script>
