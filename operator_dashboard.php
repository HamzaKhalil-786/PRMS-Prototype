<?php
session_start();
include "db.php";

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'operator') {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $age = $_POST['age'];
    $residence = $_POST['residence'];
    $disease = $_POST['disease'];
    $conn->query("INSERT INTO patients (name, age, residence, disease) VALUES ('$name', '$age', '$residence', '$disease')");
}
// Total Patient Added
$result = $conn->query("SELECT COUNT(*) AS total FROM patients");
$row = $result->fetch_assoc();
$total_patients = $row['total'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Entry Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Fontawesom -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
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
        background-image: linear-gradient(rgba(10, 10, 15, 0.8), rgba(10, 10, 15, 0.8)), url('background-2.png');
        background-size: cover;
        background-position: center;
        height: 100vh;
        color: white;
    }

    .morphism {
        background: rgba(15, 15, 20, 0.6);
        backdrop-filter: blur(15px);
        border: 1px solid rgba(0, 255, 136, 0.2);
        border-radius: 15px;
        padding: 30px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.5), inset 0 0 10px rgba(0, 255, 136, 0.05);
    }
    
    .text-neon {
        color: var(--neon-green) !important;
        text-shadow: 0 0 10px rgba(0, 255, 136, 0.5);
    }

    .form-control {
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.1);
        color: white;
        transition: all 0.3s ease;
    }

    .form-control::placeholder {
        color: rgba(255, 255, 255, 0.4);
    }

    .form-control:focus {
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
</style>

<body>

    <div class="container-fluid d-flex justify-content-between align-items-center border-bottom border-secondary py-2">
        <h2 class="text-center fw-bold">Operator Dashboard <span class="lead text-neon ms-2">PRMS - ProtoType</span></h2>
        <a href="logout.php" class="btn btn-neon"><i class="fa-solid fa-right-from-bracket me-1"></i> Logout</a>
    </div>

    <div class="container my-5" style="max-width: 600px;">
        <h2 class="text-center fw-bold">Data Entry Panel</h2>
        <h5 class="text-center text-muted mb-4">Total <span class="lead text-neon fw-bold fs-4 mx-2"><?= $row['total'] ?></span> Patients Added </h5>

        <div class="morphism">
            <h4 class="mb-3 text-center">Add Patient Record</h4>
            <form method="POST">
                <div class="row ">
                    <div class="col-md-12 mb-3">
                        <label for="" class="form-label"></label>
                        <input type="text" name="name" class="form-control" placeholder="Enter Patient Name" required>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="" class="form-label"></label>
                        <input type="number" name="age" class="form-control" placeholder="Enter Patient Age" required>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="" class="form-label"></label>
                        <input type="text" name="residence" class="form-control" placeholder="Enter Patient Residence" required>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="" class="form-label"></label>
                        <input type="text" name="disease" class="form-control" placeholder="Enter Patient Disease" required>
                    </div>
                    <div class="col-md-12 mt-4 text-center">
                        <button type="submit" class="btn btn-neon w-100"><i class="fa-solid fa-user me-2"></i> Add Patient</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

     <footer class="border-top border-1 mt-auto">
        <div class="container py-2 text-center">
            <p class="mb-0 text-muted">&copy; 2024 All rights reserved <b class="text-neon ms-2">PRMS - ProtoType Phase</b></p>
        </div>
    </footer>
</body>

</html>