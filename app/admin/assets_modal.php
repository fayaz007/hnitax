<div class="modal fade" id="Add-Asset">
    <div class="modal-dialog modal-lg">
        <div class="modal-content card card-outline card-primary card-outline curve-card">
            <div class="modal-header">
                <h4 class="modal-title"><i class="nav-icon fas fas fa-th-list"></i> Add Asset Details</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
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
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-info">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>