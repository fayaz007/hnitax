<!-- Main Sidebar Container -->
<aside class="curve-card main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index.php" class="brand-link">
        <!-- Logo can be placed here -->
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
                <!-- Dashboard -->
                <li class="nav-item">
                    <a href="index.php" class="nav-link <?= ($current_page == 'Admin Dashboard') ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <!-- Client Management -->
                <li class="nav-item">
                    <a href="clients.php" class="nav-link <?= ($current_page == 'Clients') ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Clients</p>
                    </a>
                </li>

               
               

                <!-- Blog -->
                <li class="nav-item">
                    <a href="blog.php" class="nav-link <?= ($current_page == 'Blog') ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-blog"></i>
                        <p>Blogs</p>
                    </a>
                </li>

                <!-- Settings -->
                <li class="nav-item">
                    <a href="settings.php" class="nav-link <?= ($current_page == 'Settings') ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-cog"></i>
                        <p>Settings</p>
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
