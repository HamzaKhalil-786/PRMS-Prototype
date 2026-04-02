<?php
session_start();
include "db.php";

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

if (isset($_GET['id'])) {
    $patient_id = $_GET['id'];

    $sql = "DELETE FROM patients WHERE id='$patient_id'";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Patient deleted successfully!'); window.location.href='admin_dashboard.php';</script>";
        exit();
    } else {
        echo "<script>alert('Error deleting patient!'); window.location.href='admin_dashboard.php';</script>";
    }
} else {
    echo "<script>alert('Invalid request!'); window.location.href='admin_dashboard.php';</script>";
}
?>
