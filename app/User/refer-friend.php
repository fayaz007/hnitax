<?php
$current_page = "Refer a Friend"; // Set the current page title
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


                <div class="col-md-12">
                    <!-- Refer a Friend Form Card -->
                    <div class="card curve-card card-dark">
                        <div class="card-header curve-card">
                            <h3 class="card-title"><i class="fas fa-user-friends"></i> Refer a Friend</h3>
                        </div>
                        <div class="card-body">
                            <form id="referFriendForm">
                                <!-- Hidden Fields for tax_year and user_id -->
                                <input type="hidden" name="tax_year" id="tax_year" value="<?= date("Y") ?>">
                                <input type="hidden" name="user_id" id="user_id" value="<?= htmlspecialchars($user_id) ?>">
                                <!-- Referral Name -->
                                <div class="form-group row">
                                    <label for="referral_name" class="col-sm-2 col-form-label">Referral Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="referral_name" name="referral_name" placeholder="Enter referral's name" required>
                                    </div>
                                </div>
                                <!-- Phone Number -->
                                <div class="form-group row">
                                    <label for="phone" class="col-sm-2 col-form-label">Phone Number</label>
                                    <div class="col-sm-10">
                                        <input type="tel" class="form-control" id="phone" name="phone" placeholder="Enter phone number" required>
                                    </div>
                                </div>
                                <!-- Email -->
                                <div class="form-group row">
                                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-10">
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" required>
                                    </div>
                                </div>
                                <!-- Submit Button -->
                                <div class="form-group row">
                                    <div class="col-sm-10 offset-sm-2">
                                        <button type="submit" class="btn btn-info curve-card my-btn-primary-color">Submit Referral</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Referral Table -->
                    <div class="card curve-card card-dark mt-4">
                        <div class="card-header curve-card">
                            <h3 class="card-title"><i class="fas fa-table"></i> Referral List</h3>
                        </div>
                        <div class="card-body">
                            <?php
                            $user_id = $_SESSION['user_id'] ?? null;

                            if ($user_id) {
                                // Prepare the SQL statement
                                $stmt = $conn->prepare("SELECT * FROM `referrals` WHERE user_id = ? ORDER BY created_at DESC");

                                // Bind the parameter
                                $stmt->bind_param("i", $user_id);

                                // Execute the statement
                                $stmt->execute();

                                // Fetch the result
                                $result = $stmt->get_result();

                                // Close the statement
                                $stmt->close();
                            } else {
                                $result = null;
                            }

                            $conn->close();
                            ?>

                            <table class="table table-bordered table-striped" id="referralTable">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Phone Number</th>
                                        <th>Email</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="referralList">
                                    <?php if ($result && $result->num_rows > 0): ?>
                                        <?php while ($row = $result->fetch_assoc()): ?>
                                            <tr>
                                                <td><?= htmlspecialchars($row['referral_name']) ?></td>
                                                <td><?= htmlspecialchars($row['phone']) ?></td>
                                                <td><?= htmlspecialchars($row['email']) ?></td>
                                                <td>
                                                    <button class="btn btn-outline-danger btn-sm delete-referral" data-id="<?= $row['id'] ?>">
                                                        <i class="fas fa-trash"></i> <!-- Font Awesome trash icon -->
                                                    </button>
                                                </td>
                                                </td>
                                            </tr>
                                        <?php endwhile; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="4" class="text-center">No referrals yet.</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
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
        // Handle form submission via AJAX
        $('#referFriendForm').on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                url: 'actions/process-referral.php',
                type: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    response = JSON.parse(response);
                    if (response.status === 'success') {
                        Swal.fire('Success', response.message, 'success').then(() => {
                            location.reload(); // Reload the page to show the new referral
                        });
                    } else {
                        Swal.fire('Error', response.message, 'error');
                    }
                }
            });
        });

        // Handle delete referral action
        $(document).on('click', '.delete-referral', function() {
            const referralId = $(this).data('id');
            Swal.fire({
                title: 'Are you sure?',
                text: "This action cannot be undone.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: 'actions/delete-referral.php',
                        type: 'POST',
                        data: {
                            id: referralId
                        },
                        success: function(response) {
                            response = JSON.parse(response);
                            if (response.status === 'success') {
                                Swal.fire('Deleted!', response.message, 'success').then(() => {
                                    location.reload(); // Reload the page to reflect deletion
                                });
                            } else {
                                Swal.fire('Error', response.message, 'error');
                            }
                        }
                    });
                }
            });
        });
    });
</script>