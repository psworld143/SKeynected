<?php
$base_url = '/Skeynected/skchairman/';
$base_url2 = '/Skeynected/skchairman/manage-user/';
$base_url3 = '/Skeynected/skchairman/manage-project/';
?>

<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-item">
            <a class="nav-link" href="<?php echo $base_url; ?>index.php">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="<?php echo $base_url2; ?>manage-user.php">
                <i class="bi bi-person"></i>
                <span>Manage Accounts</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" data-bs-target="#projects-nav" data-bs-toggle="collapse" href="#" aria-expanded="false">
                <i class="bi bi-folder"></i>
                <span>Projects</span>
                <i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="projects-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="#" class="dropdown-item">
                        <i class="bi bi-circle"></i>
                        <span>Project 1</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="dropdown-item">
                        <i class="bi bi-circle"></i>
                        <span>Project 2</span>
                    </a>
                </li>
                <!-- Add more projects here -->
                <li>
                    <button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#addProjectModal">
                        <i class="bi bi-plus-circle"></i> <span>Add Project</span>
                    </button>

                </li>
            </ul>
        </li>

    </ul>
</aside><!-- End Sidebar-->