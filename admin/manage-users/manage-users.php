<?php
require_once '../core/Database.php';
require_once '../core/userController.php';

$users = (new userController())->getUsers();


$success = '';
$error = '';



?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>LYDO - Admin</title>
  <link rel="stylesheet" href="assets/vendors/feather/feather.css">
  <link rel="stylesheet" href="assets/vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
  <link rel="stylesheet" href="assets/vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" type="text/css" href="assets/js/select.dataTables.min.css">
  <link rel="stylesheet" href="assets/css/vertical-layout-light/style.css">
  <link rel="shortcut icon" href="assets/images/LYDO-logo.png" />
  <style>
    .add-user-btn button {
      border-radius: none;
      padding: 8px;
      width: 120px;
      font-weight: bold;
      border: solid 2px #4B49AC;
    }

    .modal-footer button {
      padding: 8px;
      width: 120px;
    }
  </style>
</head>

<body>
  <div class="container-scroller">
    <?php
    include_once '../partials/navbar.php'
    ?>
    <div class="container-fluid page-body-wrapper">
      <?php
      include_once '../partials/sidebar.php';
      ?>
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-12 grid-margin">
              <div class="row">
                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                  <h3 class="font-weight-bold">User Management</h3>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-12 d-flex justify-content-end mb-3 add-user-btn">
            <?php if ($error): ?>
              <p style="color: red;"><?php echo $error; ?></p>
            <?php endif; ?>

            <?php if ($success): ?>
              <p style="color: green;"><?php echo $success; ?></p>
            <?php endif; ?>
            <button type="button" class="btn btn-outline-primary btn-icon-text" data-toggle="modal" data-target="#addUserModal">
              <i class="ti-plus btn-icon-prepend"></i>
              Add User
            </button>
          </div>
          <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">User Accounts</h4>
                <div class="table-responsive">
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>
                          Name
                        </th>
                        <th>
                          Email
                        </th>
                        <th>
                          Username
                        </th>
                        <th>
                          Role
                        </th>
                        <th>
                          Actions
                        </th>
                      </tr>

                    </thead>
                    <tbody>
                      <?php if (!empty($users)): ?>
                        <?php foreach ($users as $user): ?>
                          <tr>
                            <td><?php echo htmlspecialchars($user['firstname'] . ' ' . $user['middlename'] . ' ' . $user['lastname']); ?></td>
                            <td><?php echo htmlspecialchars($user['email']); ?></td>
                            <td><?php echo htmlspecialchars($user['username']); ?></td>
                            <td><?php echo htmlspecialchars($user['role']); ?></td>
                            <td>
                              <i class="ti-pencil" style="cursor:pointer;" data-id="<?php echo $user['id']; ?>" onclick="editUser(this)"></i> <!-- Edit Icon -->
                              <i class="ti-trash" style="cursor:pointer; margin-left:10px;" data-id="<?php echo $user['id']; ?>" onclick="deleteUser(this)"></i> <!-- Delete Icon -->
                            </td>
                          </tr>
                        <?php endforeach; ?>
                      <?php else: ?>
                        <tr>
                          <td colspan="5">No users found.</td>
                        </tr>
                      <?php endif; ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="addUserModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="addUserModalLabel">Add User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body custom-modal">
                <form method="POST" action="add-users.php">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="userName">First name: </label>
                        <input type="text" class="form-control" id="userName" placeholder="Enter first name" name="fname">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="userName">Middle name: </label>
                        <input type="text" class="form-control" id="userName" placeholder="Enter middle name" name="mname">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="userName">Last name: </label>
                        <input type="text" class="form-control" id="userName" placeholder="Enter last name" name="lname">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="userUsername" placeholder="Enter username" name="username">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="userEmail">Email</label>
                        <input type="email" class="form-control" id="userEmail" placeholder="Enter email" name="email">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="userRole">Role</label>
                        <select class="form-control" id="userRole" name="role">
                          <option value="admin">Admin</option>
                          <option value="skchairman">SK Chairman</option>
                        </select>
                      </div>
                    </div>
                  </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Add User</button>
              </div>
              </form>
            </div>
          </div>
        </div>
      </div>





      <script src="assets/vendors/js/vendor.bundle.base.js"></script>
      <script src="assets/vendors/chart.js/Chart.min.js"></script>
      <script src="assets/vendors/datatables.net/jquery.dataTables.js"></script>
      <script src="assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
      <script src="assets/js/dataTables.select.min.js"></script>

      <!-- End plugin js for this page -->
      <!-- inject:js -->
      <script src="assets/js/off-canvas.js"></script>
      <script src="assets/js/hoverable-collapse.js"></script>
      <script src="assets/js/template.js"></script>
      <script src="assets/js/settings.js"></script>
      <script src="assets/js/todolist.js"></script>
      <!-- endinject -->
      <!-- Custom js for this page-->
      <script src="assets/js/dashboard.js"></script>
      <script src="assets/js/Chart.roundedBarCharts.js"></script>
</body>

</html>