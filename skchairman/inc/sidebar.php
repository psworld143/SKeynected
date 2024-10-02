<?php
$current_page = basename($_SERVER['PHP_SELF']);
?>

<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link <?php echo ($current_page == 'index.view.php') ? 'active' : ''; ?>"
                href="index.view.php">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <hr>

        <li class="nav-item">
            <a class="nav-link <?php echo ($current_page == '#') ? 'active' : ''; ?>" href="#">
                <i class="bi bi-person"></i>
                <span>Youth</span>
            </a>
        </li>
        <hr>

        <li class="nav-item">
            <a class="nav-link <?php echo ($current_page == '#') ? 'active' : ''; ?>" href="#">
                <i class="bi bi-briefcase"></i>
                <span>Projects</span>
            </a>
        </li>
        <hr>

        <li class="nav-item">
            <a class="nav-link <?php echo ($current_page == 'budget-request.php') ? 'active' : ''; ?>"
                href="budget-request.php">
                <i class="bi bi-cash-stack"></i>
                <span>Budget Request</span>
            </a>
        </li>
        <hr>

    </ul>
</aside><!-- End Sidebar-->