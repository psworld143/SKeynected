<?php
require_once '../core/userController.php';
require_once '../core/projectController.php';
include_once '../core/sessionController.php';
(new sessionController())->checkLogin();

$barangay_id = $_SESSION['barangay_id'];

$users = (new userController())->getSecretaryUsers($barangay_id);
$success = '';
$error = '';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Manage Accounts</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <link href="../assets/img/sk-logo.png" rel="icon">
    <link href="../assets/img/SK-logo.png" rel="apple-touch-icon">


    <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="../assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="../assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="../assets/vendor/simple-datatables/style.css" rel="stylesheet">
    <link href="../assets/css/style.css" rel="stylesheet">
</head>

<style>

</style>

<body>
    <?php
    include_once '../partials/navbar.php';
    include_once '../partials/sidebar.php';
    ?>

    <main id="main" class="main" style="margin-top: 100px;">
        <div class="pagetitle">
            <h1>Manage Accounts</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Manage</a></li>
                    <li class="breadcrumb-item active">SK Secretary Accounts</li>
                </ol>
            </nav>
        </div>
        <?php if (!empty($success)): ?>
            <div class="alert alert-success">
                <?php echo $success; ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($error)): ?>
            <div class="alert alert-danger">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>

        <section class="section">
            <div class="row">
                <div class="col-lg-9">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Manage SK Secretary Accounts</h5>
                            <div
                                class="datatable-wrapper datatable-loading no-footer sortable searchable fixed-columns">
                                <div class="datatable-top">
                                    <div class="datatable-dropdown">
                                        <label>
                                            <select class="datatable-selector" name="per-page">
                                                <option value="5">5</option>
                                                <option value="10" selected="">10</option>
                                                <option value="15">15</option>
                                                <option value="-1">All</option>
                                            </select> entries per page
                                        </label>
                                    </div>
                                    <div class="datatable-search">
                                        <input class="datatable-input" placeholder="Search..." type="search"
                                            name="search" title="Search within table">
                                    </div>
                                </div>
                                <div class="datatable-container">
                                    <table class="table datatable datatable-table">
                                        <thead>
                                            <tr>
                                                <th><b>Name</b></th>
                                                <th>Username</th>
                                                <th>Email</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (!empty($users)): ?>
                                                <?php foreach ($users as $user): ?>
                                                    <tr>
                                                        <td><?php echo htmlspecialchars($user['name']) ?></td>
                                                        <td><?php echo htmlspecialchars($user['username']); ?></td>
                                                        <td><?php echo htmlspecialchars($user['email']); ?></td>
                                                        <td><?php echo htmlspecialchars($user['status']); ?></td>
                                                        <td>
                                                            <div class="">
                                                                <span class="icon-bg edit me-1" data-bs-toggle="modal"
                                                                    data-bs-target="#editModal"
                                                                    data-id="<?php echo $user['id']; ?>"
                                                                    data-name="<?php echo htmlspecialchars($user['name']); ?>"
                                                                    data-username="<?php echo htmlspecialchars($user['username']); ?>"
                                                                    data-email="<?php echo htmlspecialchars($user['email']); ?>"
                                                                    data-status="<?php echo htmlspecialchars($user['status']); ?>">
                                                                    <i class="bi bi-pencil"></i>
                                                                </span>
                                                                <span class="icon-bg delete" data-bs-toggle="modal"
                                                                    data-bs-target="#deleteModal"
                                                                    data-id="<?php echo $user['id']; ?>">
                                                                    <i class="bi bi-trash"></i>
                                                                </span>
                                                            </div>
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
                                <div class="datatable-bottom">
                                    <div class="datatable-info">Showing 1 to 10 of 100 entries</div>
                                    <nav class="datatable-pagination">
                                        <ul class="datatable-pagination-list">
                                            <li class="datatable-pagination-list-item datatable-disabled"><button
                                                    data-page="1">‹</button></li>
                                            <li class="datatable-pagination-list-item datatable-active"><button
                                                    data-page="1">1</button></li>
                                            <li class="datatable-pagination-list-item"><button data-page="2">2</button>
                                            </li>
                                            <li class="datatable-pagination-list-item"><button data-page="3">3</button>
                                            </li>
                                            <li class="datatable-pagination-list-item"><button data-page="4">4</button>
                                            </li>
                                            <li class="datatable-pagination-list-item"><button data-page="5">5</button>
                                            </li>
                                            <li class="datatable-pagination-list-item"><button data-page="6">6</button>
                                            </li>
                                            <li class="datatable-pagination-list-item"><button data-page="7">7</button>
                                            </li>
                                            <li class="datatable-pagination-list-item"><button
                                                    data-page="10">10</button></li>
                                            <li class="datatable-pagination-list-item"><button data-page="2">›</button>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Add Account</h5>
                            <form action="process/add-secretary.php" method="POST">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" required>
                                </div>
                                <div class="mb-3">
                                    <label for="username" class="form-label">Username</label>
                                    <input type="text" class="form-control" id="username" name="username" required>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                </div>

                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Edit Modal -->
        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Edit Account</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="editForm" action="process/update-secretary.php" method="POST">
                            <input type="hidden" id="editUserId" name="user_id">
                            <div class="mb-3">
                                <label for="editName" class="form-label">Name</label>
                                <input type="text" class="form-control" id="editName" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="editUsername" class="form-label">Username</label>
                                <input type="text" class="form-control" id="editUsername" name="username" required>
                            </div>
                            <div class="mb-3">
                                <label for="editEmail" class="form-label">Email</label>
                                <input type="email" class="form-control" id="editEmail" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="editStatus" class="form-label">Status</label>
                                <select class="form-select" id="editStatus" name="status" required>
                                    <option value="Active">Active</option>
                                    <option value="Inactive">Inactive</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Delete Modal -->
        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Delete Account</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="deleteForm" action="process/delete-secretary.php" method="POST">
                            <input type="hidden" id="deleteUserId" name="user_id">
                            <p>Are you sure you want to delete this account?</p>
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const editModal = document.getElementById('editModal');
            const deleteModal = document.getElementById('deleteModal');

            // Event listeners for populating the modals
            editModal.addEventListener('show.bs.modal', function (event) {
                const button = event.relatedTarget;
                const id = button.getAttribute('data-id');
                const name = button.getAttribute('data-name');
                const username = button.getAttribute('data-username');
                const email = button.getAttribute('data-email');
                const status = button.getAttribute('data-status');

                const modalIdInput = document.getElementById('editUserId');
                const modalNameInput = document.getElementById('editName');
                const modalUsernameInput = document.getElementById('editUsername');
                const modalEmailInput = document.getElementById('editEmail');
                const modalStatusInput = document.getElementById('editStatus');

                modalIdInput.value = id;
                modalNameInput.value = name;
                modalUsernameInput.value = username;
                modalEmailInput.value = email;
                modalStatusInput.value = status;
            });

            deleteModal.addEventListener('show.bs.modal', function (event) {
                const button = event.relatedTarget;
                const id = button.getAttribute('data-id');

                const modalIdInput = document.getElementById('deleteUserId');
                modalIdInput.value = id;
            });
        });
    </script>

    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>