<aside id="sidebar" class="sidebar">
  <ul class="sidebar-nav" id="sidebar-nav">
    <li class="nav-item">
      <a class="nav-link collapsed" href="../dashboard/dashboard.view.php">
        <i class="bi bi-grid"></i>
        <span>Dashboard</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link collapsed" href="../youth/youth.view.php">
        <i class="bi bi-person"></i>
        <span>Purok Youths</span>
      </a>
    </li>

    <!-- Project Management Dropdown -->
    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#project-management" data-bs-toggle="collapse" href="#">
        <i class="bi bi-briefcase"></i>
        <span>Projects</span>
        <i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="project-management" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <li>
          <a href="../project/project.view.php">
            <i class="bi bi-collection" style="font-size: 20px; color: #899bbd""></i><span>View Projects</span>
          </a>
        </li>
        <li>
          <a href=" ../project/add.view.php">
              <i class="bi bi-plus" style="font-size: 20px; color: #899bbd""></i><span>Add Project</span>
          </a>
        </li>
        <li>
          <a href=" ../budget-request/budget-request.view.php">
                <i class="bi bi-cash-stack" style="font-size: 20px; color: #899bbd"></i><span>Budget Request</span>
          </a>
        </li>
      </ul>
    </li>
  </ul> 
</aside>