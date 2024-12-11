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
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row justify-content-between">
                                <div class="col-md-4">
                                </div>
                                <div class="col-md-1">

                                    <a href="javascript:void(0)" class="btn btn-sm btn-info float-right curve-card" data-toggle="modal" data-target="#Add-Asset" title="Add Asset">Add Assets </a>
                                </div>
                            </div>
                        </div>

                        <!-- /.card-header -->
                        <div class="card-body table-responsive ">
                            <table class="table hover  nowrap" id="example1">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Asset Name </th>
                                        <th>Category</th>
                                        <th>Brand</th>
                                        <th>Model</th>
                                        <th>Serial Number </th>
                                        <!-- <th>Available Quantity </th> -->
                                        <th>Damage Status </th>
                                        <th>Repair Status </th>
                                        <th>QR Code</th>

                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Speaker A </td>
                                        <td>Audio</td>
                                        <td>BrandX </td>
                                        <td>Model123 </td>
                                        <td>SN001 </td>
                                        <!-- <td>20 </td> -->


                                        <td><span class="badge badge-success">Good</span> </td>
                                        <td>Not Sent for Repair </td>
                                        <td>QR123 </td>


                                        <td>
                                            <a class="btn btn-primary btn-sm rounded-pill order_details" href="#" data-toggle="tooltip" data-placement="top" title="Show">
                                                <i class="fa fa-eye fs-18 fa-sm"></i>
                                            </a>
                                            <a class="btn btn-info btn-sm rounded-pill" href="edit_assets.php?id=1" data-toggle="tooltip" data-placement="top" title="Edit">
                                                <i class="fa fa-pencil fs-18 fa-sm"></i>
                                            </a>
                                            <a class="btn btn-danger btn-sm rounded-pill delete-record" href="#" data-id="1" data-toggle="tooltip" data-placement="top" title="Delete">
                                                <i class="fa fa-trash fs-18 fa-sm"></i>
                                            </a>

                                        </td>

                                    </tr>

                                    <tr>
                                        <td>1</td>
                                        <td>Speaker A </td>
                                        <td>Audio</td>
                                        <td>BrandX </td>
                                        <td>Model123 </td>
                                        <td>SN001 </td>
                                        <!-- <td>20 </td> -->


                                        <td><span class="badge badge-success">Good</span> </td>
                                        <td>Not Sent for Repair </td>
                                        <td>QR123 </td>


                                        <td>
                                            <a class="btn btn-primary btn-sm rounded-pill order_details" href="#" data-toggle="tooltip" data-placement="top" title="Show">
                                                <i class="fa fa-eye fs-18 fa-sm"></i>
                                            </a>
                                            <a class="btn btn-info btn-sm rounded-pill" href="edit_order.php?id=1" data-toggle="tooltip" data-placement="top" title="Edit">
                                                <i class="fa fa-pencil fs-18 fa-sm"></i>
                                            </a>
                                            <a class="btn btn-danger btn-sm rounded-pill delete-record" href="#" data-id="1" data-toggle="tooltip" data-placement="top" title="Delete">
                                                <i class="fa fa-trash fs-18 fa-sm"></i>
                                            </a>

                                        </td>

                                    </tr>
                                </tbody>

                            </table>
                        </div>
                        <!-- /.card-body -->
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