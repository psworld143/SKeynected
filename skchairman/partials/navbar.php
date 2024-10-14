<?php
$base_url = "/SKeynected/skchairman/assets/img/";

?>


<header id="header" class="header fixed-top d-flex align-items-center">
  <div class="d-flex align-items-center justify-content-between">
    <a href="index.html" class="logo d-flex align-items-center">
      <span class="d-none d-lg-block">SKeynected</span>
    </a>
    <i class="bi bi-list toggle-sidebar-btn"></i>
  </div>

  <div class="search-bar">
    <form class="search-form d-flex align-items-center" method="POST" action="#">
      <input type="text" name="query" placeholder="Search" title="Enter search keyword">
      <button type="submit" title="Search"><i class="bi bi-search"></i></button>
    </form>
  </div>

  <nav class="header-nav ms-auto">
    <ul class="d-flex align-items-center">
      <li class="nav-item d-block d-lg-none">
        <a class="nav-link nav-icon search-bar-toggle" href="#">
          <i class="bi bi-search"></i>
        </a>
      </li>
      <a class="nav-link nav-profile d-flex align-items-center pe-3" href="#" data-bs-toggle="dropdown">
        <img src="<?php echo $base_url; ?>profile-img.jpg" alt="Profile" class="rounded-circle">
        <span class="d-none d-md-block dropdown-toggle ps-2"><?= isset($_SESSION['u']) ? htmlspecialchars($_SESSION['u']) : 'Guest'; ?></span>
      </a><!-- End Profile Image Icon -->
      <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
        <li class="dropdown-header">
          <h6><?= isset($_SESSION['u']) ? htmlspecialchars($_SESSION['u']) : 'Guest'; ?></h6>
          <span style="color: #444444;"><?= isset($_SESSION['u']) ? htmlspecialchars($_SESSION['role']) : 'Unknown'; ?></span>
        </li>
        <li>
          <hr class="dropdown-divider">
        </li>
        <li>
          <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
            <i class="bi bi-person"></i>
            <span style="color: #444444;">My Profile</span>
          </a>
        </li>
        <li>
          <hr class="dropdown-divider">
        </li>

        <li>
          <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
            <i class="bi bi-gear"></i>
            <span style="color: #444444;">Account Settings</span>
          </a>
        </li>
        <li>
          <hr class="dropdown-divider">
        </li>

        <li>
          <a class="dropdown-item d-flex align-items-center" href="pages-faq.html">
            <i class="bi bi-question-circle"></i>
            <span style="color: #444444;">Need Help?</span>
          </a>
        </li>
        <li>
          <hr class="dropdown-divider">
        </li>

        <li>
          <a class="dropdown-item d-flex align-items-center" href="#">
            <i class="bi bi-box-arrow-right"></i>
            <span style="color: #444444;">Sign Out</span>
          </a>
        </li>

      </ul><!-- End Profile Dropdown Items -->
    </ul>
  </nav>
</header>

<script>
  document.getElementById('bell-icon').addEventListener('click', function() {
    var notificationCountElement = document.getElementById('notification-count');

    notificationCountElement.textContent = '0';


    fetch('reset-notif.php', {
      method: 'POST',
    }).then(response => {
      // Handle response if needed
    }).catch(error => console.error('Error:', error));
  });
</script>