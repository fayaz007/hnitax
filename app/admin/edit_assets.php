<?php
$current_page = "Asset Management";
require('includes/header.php');
require('includes/navbar.php');
require('includes/sidebar.php');

?>
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Asset Management</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#" class="text-dark">Home</a></li>
                        <li class="breadcrumb-item active">Asset Management</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- curve-card -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8">
                    <div class="card card-default">
                        <div class="card-header">
                            <h3 class="card-title"> Edit Asset Details
                            </h3>
                        </div>
                        <div class="card-body p-0">
                            <form action="actions/save_assets.php" method="post" enctype="multipart/form-data">

                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="AssetName">Asset Name <span class="required">*</span></label>
                                                <input type="text" class="form-control" name="AssetName" id="AssetName" required>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="Category">Category <span class="required">*</span></label>
                                                <select class="form-control select2 select2-secondary" data-dropdown-css-class="select2-secondary" style="width: 100%;" name="Category" id="Category" required>
                                                    <option selected>Select Asset Category</option>
                                                    <?php
                                                    $result = mysqli_query($conn, "SELECT * FROM Category");
                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                        echo '<option value="' . $row['category_id'] . '">' . $row['category_name'] . '</option>';
                                                    }
                                                    mysqli_free_result($result);
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="Brand">Brand <span class="required">*</span> </label>
                                                <input type="text" class="form-control" name="Brand" id="Brand" required>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="Model">Model <span class="required">*</span></label>
                                                <input type="text" class="form-control" name="Model" id="Model" required>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="SerialNumber">Serial Number <span class="required">*</span></label>
                                                <input type="text" class="form-control" name="SerialNumber" id="SerialNumber" required>
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="RepairStatus">Repair Status </label>
                                                <select class="form-control" name="RepairStatus" id="RepairStatus">
                                                    <option selected>Not Sent for Repair</option>
                                                    <option>Sent for Repair</option>
                                                    <option>Repaired</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="DamageStatus">Damage Status </label>
                                                <select class="form-control" name="DamageStatus" id="DamageStatus">
                                                    <option selected>Good</option>
                                                    <option>Damaged</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer justify-content-between">
                                    <button type="button" class="btn btn-default" onclick="window.history.back();">Back</button>
                                    <button type="submit" class="btn btn-info">Save</button>
                                </div>
                            </form>
                        </div>

                    </div>

                </div>
            </div>
        </div>
</div>
</section>
</div>

<?php require('includes/footer.php'); ?>
<?php require('assets_modal.php');  ?>


<script src="ajax/delete_job.js"></script>

<script>
    <?php
    if (isset($_SESSION['status'])) {
    ?>

        <?php
        if ($_SESSION['status_code'] == 'success') {
        ?>
            toastr.success("<?php echo $_SESSION['status']; ?>");
        <?php
        } else if ($_SESSION['status_code'] == 'error') {
        ?>
            toastr.error("Error: <?php echo $_SESSION['status']; ?>");
        <?php
        }
        ?>

        <?php
        unset($_SESSION['status']);
        unset($_SESSION['status_code']);
        ?>
    <?php
    }
    ?>
</script>