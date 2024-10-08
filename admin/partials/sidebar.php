<?php
$base_url = '/Skeynected/admin/';
$base_url2 = '/Skeynected/admin/manage-users/';
$base_url3 = '/Skeynected/admin/manage-budget/';
$base_url4 = '/Skeynected/admin/manage-project/'; // New base URL for Project Management
?>
<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="<?php echo $base_url; ?>dashboard.php">
                <i class="icon-grid menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
                <i class="icon-head menu-icon"></i>
                <span class="menu-title mr-2">User Management </span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="auth">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo $base_url2; ?>manage-sk.php">
                            <img src="assets/images/SK-logo.png" alt="Barangay SK" style="width: 20px; height: 20px; margin-right: 5px;">
                            Barangay SK
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo $base_url2; ?>manage-admin.php">
                            <img src="assets/images/LYDO-logo.png" alt="Admin" style="width: 20px; height: 20px; margin-right: 5px;">
                            Admin
                        </a>
                    </li>
                </ul>
            </div>
        </li>

        <!-- New Project Management Section -->
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#project-management" aria-expanded="false" aria-controls="project-management">
                <i class="icon-briefcase menu-icon"></i>
                <span class="menu-title">Project Management</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="project-management">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo $base_url4; ?>manage-project.php">
                            Manage Projects
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo $base_url4; ?>create-project.php">
                            Create Project
                        </a>
                    </li>
                </ul>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="<?php echo $base_url3; ?>budget.php">
                <i class="icon-bar-graph menu-icon"></i>
                <span class="menu-title">Budgets</span>
            </a>
        </li>

        <!-- Other existing nav items can go here -->
    </ul>
</nav>