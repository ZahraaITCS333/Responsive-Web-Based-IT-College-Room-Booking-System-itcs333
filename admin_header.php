<?php
require_once 'config.php';
requireAdminLogin();
?>

<nav class="col-md-3 col-lg-2 d-md-block bg-dark sidebar collapse">
    <div class="position-sticky pt-3">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link text-white <?php echo (basename($_SERVER['PHP_SELF']) == 'admin_dashboard.php') ? 'active' : ''; ?>" href="admin_dashboard.php">
                    <i class="bi bi-speedometer2"></i> Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white <?php echo (basename($_SERVER['PHP_SELF']) == 'manage_rooms.php') ? 'active' : ''; ?>" href="manage_rooms.php">
                    <i class="bi bi-door-open"></i> Manage Rooms
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white <?php echo (basename($_SERVER['PHP_SELF']) == 'manage_bookings.php') ? 'active' : ''; ?>" href="manage_bookings.php">
                    <i class="bi bi-calendar"></i> Manage Bookings
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white <?php echo (basename($_SERVER['PHP_SELF']) == 'manage_users.php') ? 'active' : ''; ?>" href="manage_users.php">
                    <i class="bi bi-people"></i> Manage Users
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white" href="admin_logout.php">
                    <i class="bi bi-box-arrow-right"></i> Logout
                </a>
            </li>
        </ul>
    </div>
</nav>