<?php
require_once '../core/userController.php';
$userController = new userController();

$barangay_id = isset($_GET['id']) ? $_GET['id'] : null;

if ($barangay_id) {
    $users = $userController->getSK($barangay_id);
    $barangayName = $userController->getBarangayName($barangay_id);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title><?= $barangayName ?> SK</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <link href="../assets/img/LYDOO.jpg" rel="icon">
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
    .btn {
        margin-top: 10px;
        width: 100%;
    }

    .icon-bg {
        border-radius: 4px;
        width: 30px;
        display: inline-block;
        text-align: center;
        cursor: pointer;
    }

    .icon-bg.edit {
        background-color: #007bff;
        color: white;
    }

    .icon-bg.delete {
        background-color: #dc3545;
        color: white;
    }

    .icon-bg i {
        font-size: 16px;
    }

    .icon-bg:hover {
        opacity: 0.8;
    }

    thead {
        background-color: red;
    }
</style>

<body>
    <?php
    include_once '../partials/navbar.php';
    include_once '../partials/sidebar.php';
    ?>

    <main id="main" class="main" style="margin-top: 100px;">
        <div class="pagetitle">
            <h1>Manage SK Members</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Manage</a></li>
                    <li class="breadcrumb-item active">SK</li>
                </ol>
            </nav>
        </div>
        
        <?php
        if (isset($_SESSION['error'])) {
            echo '<div class="alert alert-danger" role="alert">' . $_SESSION['error'] . '</div>';
            unset($_SESSION['error']);
        }

        if (isset($_SESSION['success'])) {
            echo '<div class="alert alert-success" role="alert">' . $_SESSION['success'] . '</div>';
            unset($_SESSION['success']);
        }
        ?>

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Barangay <?php echo $barangayName; ?> SK Members</h5>
                            <div class="datatable-wrapper datatable-loading no-footer sortable searchable fixed-columns">
                                <div class="datatable-top mt-2 mb-2">
                                    <div class="datatable-dropdown">
                                        <label>
                                            <input class="datatable-input me-2" placeholder="Search..." type="search" name="search" title="Search within table">
                                            <select class="datatable-selector" name="per-page">
                                                <option value="5">5</option>
                                                <option value="10" selected="">10</option>
                                                <option value="15">15</option>
                                                <option value="-1">All</option>
                                            </select> entries per page
                                        </label>
                                    </div>
                                    <div class="datatable-search">
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUserModal">
                                            <i class="bi bi-plus"> </i> Add User
                                        </button>
                                    </div>
                                </div>
                                <div class="datatable-container">
                                    <table class="table datatable datatable-table">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Username</th>
                                                <th>Role</th>
                                                <th>Status</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (!empty($users)) : ?>
                                                <?php foreach ($users as $user) : ?>
                                                    <tr>

                                                        <td><?php echo htmlspecialchars($user['name']) ?></td>
                                                        <td><?php echo htmlspecialchars($user['email']); ?></td>
                                                        <td><?php echo htmlspecialchars($user['username']); ?></td>
                                                        <td><?php echo htmlspecialchars($user['role']); ?></td>
                                                        <td><?php echo  htmlspecialchars($user['status']); ?></td>
                                                        <td>
                                                            <span class="icon-bg edit " data-bs-toggle="modal" data-bs-target="#editModal"
                                                                data-id="<?php echo $user['id']; ?>"
                                                                data-name="<?php echo htmlspecialchars($user['name']); ?>"
                                                                data-email="<?php echo htmlspecialchars($user['email']); ?>"
                                                                data-username="<?php echo htmlspecialchars($user['username']); ?>"
                                                                data-role="<?php echo htmlspecialchars($user['role']); ?>"
                                                                data-email="<?php echo htmlspecialchars($user['status']); ?>"
                                                                data-barangay_id="<?php echo $user['barangay_id']; ?>">
                                                                <i class="bi bi-pencil"></i>
                                                            </span>
                                                            <span class="icon-bg delete" data-bs-toggle="modal" data-bs-target="#deleteModal"
                                                                data-id="<?php echo $user['id']; ?>">
                                                                <i class="bi bi-trash"></i>
                                                            </span>
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
                                            <li class="datatable-pagination-list-item datatable-disabled"><button data-page="1">‹</button></li>
                                            <li class="datatable-pagination-list-item datatable-active"><button data-page="1">1</button></li>
                                            <li class="datatable-pagination-list-item"><button data-page="2">2</button></li>
                                            <li class="datatable-pagination-list-item"><button data-page="3">3</button></li>
                                            <li class="datatable-pagination-list-item"><button data-page="4">4</button></li>
                                            <li class="datatable-pagination-list-item"><button data-page="5">5</button></li>
                                            <li class="datatable-pagination-list-item"><button data-page="6">6</button></li>
                                            <li class="datatable-pagination-list-item"><button data-page="7">7</button></li>
                                            <li class="datatable-pagination-list-item"><button data-page="10">10</button></li>
                                            <li class="datatable-pagination-list-item"><button data-page="2">›</button></li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addUserModalLabel">Add New User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="addUserForm" action="./process/addSK.php" method="POST">
                            <div class="mb-3">
                                <input type="hidden" name="barangay_id" value="<?= $barangay_id ?>">
                                <label for="userName" class="form-label">Name</label>
                                <input type="text" class="form-control" name="name" id="userName" required>
                            </div>
                            <div class="mb-3">
                                <label for="userEmail" class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" id="userEmail" required>
                            </div>
                            <div class="mb-3">
                                <label for="userUsername" class="form-label">Username</label>
                                <input type="text" class="form-control" name="username" id="userUsername" required>
                            </div>

                            <div class="mb-3">
                                <label for="userEmail" class="form-label">Status</label>
                                <select name="status" id="" class="form-select">
                                    <option value="Active">Active</option>
                                    <option value="Inactive">Inactive</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="userRole" class="form-label">Role</label>
                                <select class="form-control" id="userRole" name="role" required>
                                    <option value="skchairman">SK Chairman</option>
                                    <option value="sksecretary">SK Secretart</option>
                                </select>
                            </div>
                            <!-- Add more input fields as required -->
                            <button type="submit" class="btn btn-primary">Save User</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit Modal -->
        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Edit Account</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="editForm" action="updateSK.php" method="POST">
                            <input type="hidden" name="barangay_id" value="<?= $barangay_id ?>">
                            <input type="hidden" id="editUserId" name="user_id">
                            <div class="mb-3">
                                <label for="editName" class="form-label">Name</label>
                                <input type="text" class="form-control" id="editName" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="editEmail" class="form-label">Email</label>
                                <input type="email" class="form-control" id="editEmail" name="email" required>
                            </div>

                            <div class="mb-3">
                                <label for="editUsername" class="form-label">Username</label>
                                <input type="text" class="form-control" id="editUsername" name="username" required>
                            </div>
                            <div class="mb-3">
                                <label for="editStatus" class="form-label">Status</label>
                                <select class="form-control" id="editStatus" name="status" required>
                                    <option value="Active">Active</option>
                                    <option value="Inactive">Inactive</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="editRole" class="form-label">Role</label>
                                <select class="form-control" id="editRole" name="role" required>
                                    <option value="skchairman">SK Chairman</option>
                                    <option value="sksecretary">SK Secretary</option>
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
                        <form id="deleteForm" action="delete-secretary.php" method="POST">
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
        document.addEventListener('DOMContentLoaded', function() {
            const editModal = document.getElementById('editModal');
            const deleteModal = document.getElementById('deleteModal');

            // Event listeners for populating the modals
            editModal.addEventListener('show.bs.modal', function(event) {
                const button = event.relatedTarget;
                const id = button.getAttribute('data-id');
                const name = button.getAttribute('data-name');
                const username = button.getAttribute('data-username');
                const email = button.getAttribute('data-email');

                const modalIdInput = document.getElementById('editUserId');
                const modalNameInput = document.getElementById('editName');
                const modalUsernameInput = document.getElementById('editUsername');
                const modalEmailInput = document.getElementById('editEmail');

                modalIdInput.value = id;
                modalNameInput.value = name;
                modalUsernameInput.value = username;
                modalEmailInput.value = email;
            });

            deleteModal.addEventListener('show.bs.modal', function(event) {
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