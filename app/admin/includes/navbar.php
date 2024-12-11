<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="<?= BASE_URL ?>" class="nav-link">Home</a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->

        <!-- Messages Dropdown Menu -->

        <!-- Notifications Dropdown Menu -->

        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
        <?php
        $stmt = $conn->prepare("SELECT avatar FROM users WHERE user_id =  ?");
        $stmt->bind_param("s", $_SESSION['user_id']);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        $stmt->close();
        ?>
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <div class="d-felx badge-pill">
                    <img src="../assets/uploads/<?= $user['avatar'] ?>" class="img-circle elevation-2" style="width: 2rem; height:auto;" alt="User Image">
                </div>
            </a>
            <div class="dropdown-menu dropdown-menu-md dropdown-menu-right">
                <a href="#" class="dropdown-item">
                    <i class="fa-solid fa-user mr-2"></i> Manage
                </a>
                <div class="dropdown-divider"></div>
                <a href="<?= BASE_URL ?>logout.php" class="dropdown-item">
                    <i class="fas fa-sign-out-alt  mr-2"></i> Logout
                </a>
            </div>
        </li>
    </ul>
</nav>