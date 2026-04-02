<?php
session_start();
include "db.php";

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

// Welcome Message
if ($_SESSION['role'] == 'admin' && !isset($_SESSION['welcome_shown'])) {
    echo "<script>alert('Welcome Back, Admin!');</script>";
    $_SESSION['welcome_shown'] = true;
}

// ADD USER
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_user'])) {
    $newUser = $_POST['username'];
    $newPass = md5($_POST['password']);
    $role = $_POST['role'];

    $query = "INSERT INTO users (username, password, role) VALUES ('$newUser', '$newPass', '$role')";
    if ($conn->query($query)) {
        echo "<script>alert('User added successfully!'); window.location='admin_dashboard.php';</script>";
    } else {
        echo "<script>alert('Error adding user!');</script>";
    }
}

// ADD PATIENT
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_patient'])) {
    $name = $_POST['name'];
    $age = $_POST['age'];
    $residence = $_POST['residence'];
    $disease = $_POST['disease'];

    $query = "INSERT INTO patients (name, age, residence, disease) VALUES ('$name', '$age', '$residence', '$disease')";

    if ($conn->query($query)) {
        echo "<script>alert('Patient added successfully!'); window.location='admin_dashboard.php';</script>";
    } else {
        echo "<script>alert('Error adding patient!');</script>";
    }
}

// EDIT PATIENT
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_patient'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $age = $_POST['age'];
    $residence = $_POST['residence'];
    $disease = $_POST['disease'];

    // Update query
    $query = "UPDATE patients SET name='$name', age='$age', residence='$residence', disease='$disease' WHERE id='$id'";

    if ($conn->query($query)) {
        echo "<script>alert('Patient updated successfully!'); window.location='admin_dashboard.php';</script>";
    } else {
        echo "<script>alert('Error updating patient!');</script>";
    }
}

// EDIT ROLE
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_role'])) {
    $id = $_POST['id'];
    $role = $_POST['role'];

    // Update query
    $query = "UPDATE users SET role='$role' WHERE id='$id'";

    if ($conn->query($query)) {
        echo "<script>alert('User role updated successfully!'); window.location='admin_dashboard.php';</script>";
    } else {
        echo "<script>alert('Error updating user role!');</script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Fontawesom -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
    <!-- Data Tables -->
    <link rel="stylesheet" href="//cdn.datatables.net/2.2.2/css/dataTables.dataTables.min.css" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
</head>

<style>
    :root {
        --neon-green: #00ff88;
        --dark-bg: #0a0a0f;
    }
    
    body {
        font-family: 'Outfit', sans-serif;
        background-image: linear-gradient(rgba(10, 10, 15, 0.85), rgba(10, 10, 15, 0.85)), url('background-1.png');
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        height: 100vh;
        color: #e0e0e0 !important;
    }

    .morphism {
        background: rgba(15, 15, 20, 0.6);
        backdrop-filter: blur(15px);
        border: 1px solid rgba(0, 255, 136, 0.2);
        border-radius: 15px;
        padding: 25px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.5), inset 0 0 10px rgba(0, 255, 136, 0.05);
    }
    
    .text-neon {
        color: var(--neon-green) !important;
        text-shadow: 0 0 10px rgba(0, 255, 136, 0.5);
    }

    .table {
        background: transparent !important;
        border-collapse: collapse;
        color: #e0e0e0 !important;
    }

    .table th,
    .table td {
        background: transparent !important;
        border: 1px solid rgba(0, 255, 136, 0.2);
        color: #e0e0e0 !important;
    }

    .table-dark {
        background: rgba(0, 255, 136, 0.1) !important;
    }

    /* Modal */
    .modal-content {
        background: rgba(15, 15, 20, 0.85) !important;
        backdrop-filter: blur(15px);
        -webkit-backdrop-filter: blur(15px);
        border: 1px solid var(--neon-green);
        box-shadow: 0 0 30px rgba(0, 255, 136, 0.2);
        border-radius: 15px;
        padding: 20px;
        color: white;
    }

    .modal-header,
    .modal-body,
    .modal-footer {
        border-bottom: 1px solid rgba(0, 255, 136, 0.2);
    }

    div.dt-container .dt-paging .dt-paging-button {
        border: 1px solid rgba(0, 255, 136, 0.3) !important;
        color: white !important;
    }
    
    div.dt-container .dt-paging .dt-paging-button:hover {
        background: var(--neon-green) !important;
        color: black !important;
    }
    
    div.dt-container {
        color: white !important;
    }
    
    label {
        color: #b0b0b0;
    }

    /* the close button in green using filter trick */
    .modal-header .btn-close {
        filter: invert(72%) sepia(51%) saturate(2853%) hue-rotate(99deg) brightness(108%) contrast(101%);
    }

    .form-control, .form-select, .modal-body input, .modal-body select {
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.1);
        color: white;
        transition: all 0.3s ease;
    }
    
    .form-select option {
        background: var(--dark-bg);
        color: white;
    }

    .form-control::placeholder, .modal-body input::placeholder {
        color: rgba(255, 255, 255, 0.4);
    }

    .form-control:focus, .form-select:focus, .modal-body input:focus {
        background: rgba(255, 255, 255, 0.1);
        border-color: var(--neon-green);
        box-shadow: 0 0 10px rgba(0, 255, 136, 0.3);
        color: white;
        outline: none;
    }

    .btn-neon {
        background: transparent;
        color: var(--neon-green);
        border: 2px solid var(--neon-green);
        box-shadow: 0 0 10px rgba(0, 255, 136, 0.2), inset 0 0 10px rgba(0, 255, 136, 0.1);
        transition: all 0.3s ease;
        font-weight: 600;
        letter-spacing: 1px;
        border-radius: 30px;
        padding: 5px 20px;
        text-decoration: none;
        display: inline-block;
    }

    .btn-neon:hover {
        background: var(--neon-green);
        color: #000 !important;
        box-shadow: 0 0 20px rgba(0, 255, 136, 0.6), inset 0 0 10px rgba(0, 255, 136, 0.2);
        transform: translateY(-2px);
    }
    
    .btn-danger {
        border-radius: 30px;
        box-shadow: 0 0 10px rgba(220, 53, 69, 0.2);
    }
    
    .btn-success {
        border-radius: 30px;
        background: transparent;
        color: #00ff88;
        border: 2px solid #00ff88;
        box-shadow: 0 0 10px rgba(0, 255, 136, 0.2);
        transition: all 0.3s ease;
    }
    .btn-success:hover {
        background: #00ff88;
        color: #000;
        box-shadow: 0 0 20px rgba(0, 255, 136, 0.6);
        transform: translateY(-2px);
    }

    #update_role {
        color: #fff;
    }
</style>


<body>

    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center border-bottom border-secondary py-3">
            <h2 class="text-center fw-bold">Admin Dashboard <span class="lead text-neon ms-2">PRMS - ProtoType</span></h2>
            <a href="logout.php" class="btn btn-neon">Logout <i class="fa-solid fa-right-from-bracket ms-1"></i></a>
        </div>
    </div>

    <div class="container">
        <!-- Form's -->
        <div class="row mt-5">
            <!-- Add User Form -->
            <div class="col-12 col-lg-6 col-md-6 col-sm-12">
                <div class="morphism p-4 mb-4">
                    <h4 class="mb-4 text-center">Add User</h4>
                    <form method="POST">
                        <div class="row align-items-center">
                            <input type="hidden" name="add_user" value="1">
                            <div class="mb-3 col-12">
                                <label for="name" class="form-label">User Name</label>
                                <input type="text" name="username" id="name" class="form-control" placeholder="Username" required>
                            </div>
                            <div class="mb-3 col-12">
                                <label for="pwd" class="form-label">Password</label>
                                <input type="password" name="password" id="pwd" class="form-control" placeholder="Password" required>
                            </div>
                            <div class="mb-3 col-12">
                                <label for="role" class="form-label">Role</label>
                                <select name="role" class="form-select" id="role" required>
                                    <option value="" disabled selected>-- Select Role --</option>
                                    <option value="admin">Admin</option>
                                    <option value="operator">Operator</option>
                                </select>
                            </div>
                            <div class="mt-3 col-12">
                                <button type="submit" class="btn btn-success me-2">Add User <i class="fa-solid fa-user"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Add Patients Form -->
            <div class="col-12 col-lg-6 col-md-6 col-sm-12">
                <!-- Add Patient Form -->
                <div class="morphism p-4 mb-4">
                    <h4 class="mb-4 text-center">Add Patient</h4>
                    <form method="POST">
                        <input type="hidden" name="add_patient" value="1">
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" class="form-control" name="name" placeholder="Enter Name" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Age</label>
                            <input type="number" class="form-control" name="age" placeholder="Enter Age" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Residence</label>
                            <input type="text" class="form-control" name="residence" placeholder="Enter Residence" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Disease</label>
                            <input type="text" class="form-control" name="disease" placeholder="Enter Disease" required>
                        </div>
                        <button type="submit" class="btn btn-success">Add Patient <i class="fa-solid fa-user-plus"></i></button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Lsit's -->
        <div class="row">
            <!-- Users List -->
            <div class="col-12 col-lg-12 col-md-6 col-sm-12">
                <div class="morphism p-4 mb-4">
                    <h4 class="mb-3">Users List</h4>
                    <table class="table table-bordered myTable">
                        <thead class="table-dark">
                            <tr>
                                <th>Username</th>
                                <th>Role</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $result = $conn->query("SELECT * FROM users");
                            while ($row = $result->fetch_assoc()) {
                                echo "
        <tr>
            <td>{$row['username']}</td>
            <td>{$row['role']}</td>
            <td>
                <a href='#' class='btn btn-neon btn-sm edit-user-btn me-2' 
                    data-id='{$row['id']}' 
                    data-role='{$row['role']}' 
                    data-bs-toggle='modal' 
                    data-bs-target='#editModalRole'>
                    <i class='fa-solid fa-pen-to-square'></i> Edit
                </a>

                <a href='delete_user.php?id={$row['id']}' class='btn btn-danger'>
                    <i class='fa-solid fa-trash'></i> Delete
                </a>
            </td>
        </tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Patients List -->
            <div class="col-12 col-lg-12 col-md-6 col-sm-12">
                <div class="morphism p-4">
                    <h4 class="mb-3">Patients List</h4>
                    <table class="table table-bordered myTable">
                        <thead class="table-dark">
                            <tr>
                                <th>Name</th>
                                <th>Age</th>
                                <th>Residence</th>
                                <th>Disease</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $result = $conn->query("SELECT * FROM patients");
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>
                            <td>{$row['name']}</td>
                            <td>{$row['age']}</td>
                            <td>{$row['residence']}</td>
                            <td>{$row['disease']}</td>
                            <td>
                                <a href='#' class='btn btn-neon btn-sm edit-btn me-2' 
                                   data-id='{$row['id']}' 
                                   data-name='{$row['name']}' 
                                   data-age='{$row['age']}' 
                                   data-residence='{$row['residence']}' 
                                   data-disease='{$row['disease']}' 
                                   data-bs-toggle='modal' data-bs-target='#editModal'>
                                   <i class='fa-solid fa-pen-to-square'></i> Edit
                                </a>
                                <a href='delete_patient.php?id={$row['id']}' class='btn btn-danger'>
                                    <i class='fa-solid fa-trash'></i> Delete
                                </a>
                            </td>
                        </tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

    <!-- Edit Patient Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Patient</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST">
                        <input type="hidden" name="update_patient" value="1">
                        <input type="hidden" id="edit_id" name="id">
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" class="form-control" id="edit_name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Age</label>
                            <input type="number" class="form-control" id="edit_age" name="age" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Residence</label>
                            <input type="text" class="form-control" id="edit_residence" name="residence" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Disease</label>
                            <input type="text" class="form-control" id="edit_disease" name="disease" required>
                        </div>
                        <button type="submit" class="btn btn-success"><i class="fa-solid fa-user"></i> Update Patient</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Role Modal -->
    <div class="modal fade" id="editModalRole" tabindex="-1" aria-labelledby="editUserroleLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editUserroleLabel">Edit User Role</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST">
                        <input type="hidden" name="update_role" value="1">
                        <input type="hidden" id="update_role_id" name="id">
                        <div class="mb-3">
                            <label class="form-label">Role</label>
                            <select name="role" class="form-select" id="update_role" required>
                                <option value="" disabled selected>-- Select Role --</option>
                                <option value="admin">Admin</option>
                                <option value="operator">Operator</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-success"><i class="fa-solid fa-user"></i> Update Role</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Footer -->
    <footer class="border-top border-1 mt-3">
        <div class="container py-2 text-center">
            <p class="mb-0 text-muted">&copy; 2024 All rights reserved <b class="text-neon ms-2">PRMS - ProtoType Phase</b></p>
        </div>
    </footer>


    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="//cdn.datatables.net/2.2.2/js/dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.myTable').DataTable();
        });

        // Modal Open Edit Patient
        $(document).on("click", ".edit-btn", function() {
            $("#edit_id").val($(this).data("id"));
            $("#edit_name").val($(this).data("name"));
            $("#edit_age").val($(this).data("age"));
            $("#edit_residence").val($(this).data("residence"));
            $("#edit_disease").val($(this).data("disease"));
        });
        // Modal Open Edit Role
        $(document).on("click", ".edit-user-btn", function() {
            let userId = $(this).data("id");
            let userRole = $(this).data("role");

            $("#update_role_id").val(userId); // Corrected input ID
            $("#update_role").val(userRole); // Pre-select role
        });
    </script>

</body>

</html>