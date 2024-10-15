<?php
$base_url = '/Skeynected/lydo/';
$base_url2 = '/Skeynected/lydo/manage-user/';
$base_url3 = '/Skeynected/lydo/manage-project/';
$base_url4 = '/Skeynected/lydo/manage-youth/';

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
            <a class="nav-link <?php echo ($current_page == 'manage-user.php') ? 'active' : ''; ?>" href="<?php echo $base_url2; ?>manage-user.php">
                <i class="bi bi-person"></i>
                <span>Manage Accounts</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link <?php echo ($current_page == 'manage-project.php' || $current_page == 'projectLiquidation.php') ? 'active' : ''; ?>" data-bs-target="#projects-nav" data-bs-toggle="collapse" href="#" aria-expanded="false">
                <i class="bi bi-folder"></i>
                <span>Manage Projects</span>
                <i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="projects-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                <li class="nav-item">
                    <a class="nav-link <?php echo ($current_page == 'manage-project.php') ? 'active' : ''; ?>" href="<?php echo $base_url3; ?>manage-project.php">
                        <span>SK Project</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo ($current_page == 'projectLiquidation.php') ? 'active' : ''; ?>" href="<?php echo $base_url3; ?>projectLiquidation.php">
                        <span>Project Liquidation</span>
                    </a>

                </li>

            </ul>
        </li>


        <li class="nav-item">
            <a class="nav-link <?php echo ($current_page == 'manage-youth.php') ? 'active' : ''; ?>" href="<?php echo $base_url4; ?>manage-youth.php">
                <i class="bi bi-people"></i>
                <span>Manage Youth</span>
            </a>
        </li>



    </ul>
</aside><!-- End Sidebar-->