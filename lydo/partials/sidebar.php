<?php
$base_url = '/Skeynected/lydo/';
$base_url2 = '/Skeynected/lydo/manage-user/';
$base_url3 = '/Skeynected/lydo/manage-project/';
$base_url4 = '/Skeynected/lydo/manage-youth/';
$base_url5 = '/Skeynected/lydo/manage-budget/';
$base_url6 = '/Skeynected/lydo/manage-barangay/';

$current_page = basename($_SERVER['PHP_SELF']);
?>

<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">
    <div class="sidebar-logo">
        <a href="<?php echo $base_url; ?>" class="logo">
            <img src="<?php echo $base_url; ?>assets/img/LYDOO.jpg" alt="SK Chairman">
        </a>
        <div class="welcome-message">
            <p>Welcome, <?= isset($_SESSION['role']) ? htmlspecialchars($_SESSION['role']) : 'Guest'; ?></p>
        </div>
    </div>

    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-item">
            <a class="nav-link <?php echo ($current_page == 'dashboard.php') ? 'active' : ''; ?>" href="<?php echo $base_url; ?>dashboard.php">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link <?php echo ($current_page == 'adminTables.php') ? 'active' : ''; ?>" href="<?php echo $base_url2; ?>adminTables.php">
                <i class="bi bi-person"></i>
                <span>Manage Accounts</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link <?php echo ($current_page == 'barangay.php') ? 'active' : ''; ?>" href="<?php echo $base_url6; ?>barangay.php">
                <i class="bi bi-house"></i>
                <span>Manage Barangay</span>
            </a>
        </li>
    </ul>
</aside><!-- End Sidebar-->