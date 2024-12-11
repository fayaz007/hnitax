<!-- Main Sidebar Container -->
<aside class="curve-card main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index.php" class="brand-link">
        <!-- Optionally place your logo here -->
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="../assets/uploads/<?= $user['avatar'] ?>" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <h5 class="d-block text-light"><?= $_SESSION['user_type'] ?></h5>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Home -->
                <li class="nav-item">
                    <a href="index.php" class="nav-link <?= ($current_page == 'Client Dashboard') ? 'active' : ''; ?>" data-toggle="tooltip" data-placement="right" title="Home">
                        <i class="nav-icon fas fa-home"></i>
                        <p>Home</p>
                    </a>
                </li>


                <!-- Tax Filing Form -->
                <li class="nav-item has-treeview <?= ($current_page == 'Personal Information' || $current_page == 'Residential Information' || $current_page == 'Other Sources of Income' || $current_page == 'Upload Documents' || $current_page == 'Tax Estimates1' || $current_page == 'Payment1' || $current_page == 'Final Documents' || $current_page == 'Review & Confirm' || $current_page == 'Deductions' || $current_page == 'Adjustments to Income'|| $current_page == 'Business Income' || $current_page == 'FBAR'|| $current_page == 'Insurance Details') ? 'menu-open' : ''; ?>">
                    <a href="#" class="nav-link <?= ($current_page == 'Personal Information' || $current_page == 'Residential Information' || $current_page == 'Other Sources of Income' || $current_page == 'Upload Documents' || $current_page == 'Tax Estimates1' || $current_page == 'Payment1' || $current_page == 'Final Documents' || $current_page == 'Review & Confirm' || $current_page == 'Deductions' || $current_page == 'Adjustments to Income' || $current_page == 'Business Income' || $current_page == 'FBAR'|| $current_page == 'Insurance Details') ? 'active' : ''; ?>" data-toggle="tooltip" data-placement="right" title="Tax Filing Form">
                        <i class="nav-icon fas fa-file-alt"></i>
                        <p>
                            Tax Filing Form
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" style="display: <?= ($current_page == 'Personal Information' || $current_page == 'Residential Information' || $current_page == 'Other Sources of Income' || $current_page == 'Upload Documents' || $current_page == 'Tax Estimates1' || $current_page == 'Payment1' || $current_page == 'Final Documents' || $current_page == 'Review & Confirm' || $current_page == 'Deductions' || $current_page == 'Adjustments to Income' || $current_page == 'Business Income' || $current_page == 'FBAR' || $current_page == 'Insurance Details') ? 'block' : 'none'; ?>;">
                        <li class="nav-item">
                            <a href="personal-information.php" class="nav-link <?= ($current_page == 'Personal Information') ? 'active' : ''; ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Personal Information</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="insurance-details.php" class="nav-link <?= ($current_page == 'Insurance Details') ? 'active' : ''; ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Insurance Details</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="Residential-Information.php" class="nav-link <?= ($current_page == 'Residential Information') ? 'active' : ''; ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Residential Information</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="other-income.php" class="nav-link <?= ($current_page == 'Other Sources of Income') ? 'active' : ''; ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Other Income</p>
                            </a>
                        </li>
                        <!-- Additional New Menu Items -->
                        <li class="nav-item">
                            <a href="deductions.php" class="nav-link <?= ($current_page == 'Deductions') ? 'active' : ''; ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Deductions</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="adjustments-to-income.php" class="nav-link <?= ($current_page == 'Adjustments to Income') ? 'active' : ''; ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Adjustments to Income</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="fbar.php" class="nav-link <?= ($current_page == 'FBAR') ? 'active' : ''; ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>FBAR</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="business-income.php" class="nav-link <?= ($current_page == 'Business Income') ? 'active' : ''; ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Business Income</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="document-upload.php" class="nav-link <?= ($current_page == 'Upload Documents') ? 'active' : ''; ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Upload Documents</p>
                            </a>
                        </li>
                        <!-- Commented Out Payment and Review -->
                        <!-- <li class="nav-item">
            <a href="payment-link.php" class="nav-link <?= ($current_page == 'Payment') ? 'active' : ''; ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Payment</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="final-documents.php" class="nav-link <?= ($current_page == 'Final Documents') ? 'active' : ''; ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Final Documents</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="review-confirm.php" class="nav-link <?= ($current_page == 'Review & Confirm') ? 'active' : ''; ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Review & Confirm</p>
            </a>
        </li> -->
                    </ul>
                </li>


                <!-- Download Documents (from agent) -->
                <li class="nav-item">
                    <a href="agent-documents.php" class="nav-link <?= ($current_page == 'Download Documents') ? 'active' : ''; ?>" data-toggle="tooltip" data-placement="right" title="Download Documents">
                        <i class="nav-icon fas fa-cloud-download-alt"></i>
                        <p>Download Documents</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="tax-estimates.php" class="nav-link <?= ($current_page == 'Tax Estimates') ? 'active' : ''; ?>">
                        <i class="fa fa-list-alt nav-icon"></i>
                        <p>Tax Estimates</p>
                    </a>
                </li>
                <!-- E-Signature
                <li class="nav-item">
                    <a href="e-signature.php" class="nav-link <?= ($current_page == 'E-Signature') ? 'active' : ''; ?>" data-toggle="tooltip" data-placement="right" title="E-Signature">
                        <i class="nav-icon fas fa-signature"></i>
                        <p>E-Signature</p>
                    </a>
                </li> -->

                <li class="nav-item">
                    <a href="payment.php" class="nav-link <?= ($current_page == 'Payment') ? 'active' : ''; ?>" data-toggle="tooltip" data-placement="right" title="Payment">
                        <i class=" nav-icon fa-solid fa-dollar-sign"></i>
                        <p>Payment</p>
                    </a>
                </li>

                <!-- Profile Management -->
                <li class="nav-item">
                    <a href="profile-management.php" class="nav-link <?= ($current_page == 'Profile Management') ? 'active' : ''; ?>" data-toggle="tooltip" data-placement="right" title="Profile Management">
                        <i class="nav-icon fas fa-user-cog"></i>
                        <p>Profile Management</p>
                    </a>
                </li>

                <!-- Help & Support -->
                <!-- <li class="nav-item">
                    <a href="help-support.php" class="nav-link <?= ($current_page == 'Help & Support') ? 'active' : ''; ?>" data-toggle="tooltip" data-placement="right" title="Help & Support">
                        <i class="nav-icon fas fa-question-circle"></i>
                        <p>Help & Support</p>
                    </a>
                </li> -->

                <!-- Secure File Cabinet -->
                <!-- <li class="nav-item">
                    <a href="file-cabinet.php" class="nav-link <?= ($current_page == 'Secure File Cabinet') ? 'active' : ''; ?>" data-toggle="tooltip" data-placement="right" title="Secure File Cabinet">
                        <i class="nav-icon fas fa-folder"></i>
                        <p>Secure File Cabinet</p>
                    </a>
                </li> -->
                <!-- Refer a Friend -->
                <li class="nav-item">
                    <a href="refer-friend.php" class="nav-link <?= ($current_page == 'Refer a Friend') ? 'active' : ''; ?>" data-toggle="tooltip" data-placement="right" title="Refer a Friend">
                        <i class="nav-icon fas fa-user-friends"></i>
                        <p>
                            Refer a Friend
                        </p>
                    </a>
                </li>
                <!-- Logout -->
                <li class="nav-item">
                    <a href="<?= BASE_URL ?>logout.php" class="nav-link" data-toggle="tooltip" data-placement="right" title="Logout">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>Logout</p>
                    </a>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>