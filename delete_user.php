<?php
session_start();
include "db.php";

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

if (isset($_GET['id'])) {
    $user_id = $_GET['id'];

    // Check if the user is an admin
    // $check_admin = $conn->query("SELECT * FROM users WHERE id='$user_id' AND role='admin'");
    // if ($check_admin->num_rows > 0) {
    //     echo "<script>alert('You cannot delete an admin!'); window.location.href='admin_dashboard.php';</script>";
    //     exit();
    // }

    // Delete User Query
    $sql = "DELETE FROM users WHERE id='$user_id'";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('User deleted successfully!'); window.location.href='admin_dashboard.php';</script>";
        exit();
    } else {
        echo "<script>alert('Error deleting user!'); window.location.href='admin_dashboard.php';</script>";
    }
} else {
    echo "<script>alert('Invalid request!'); window.location.href='admin_dashboard.php';</script>";
}
