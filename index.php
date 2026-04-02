<?php
session_start();

if (isset($_SESSION['role'])) {
    if ($_SESSION['role'] == 'admin') {
        header("Location: admin_dashboard.php");
    } elseif ($_SESSION['role'] == 'operator') {
        header("Location: operator_dashboard.php");
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <!-- Bootstrap -->
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
        --glass-border: rgba(0, 255, 136, 0.3);
    }
    
    body {
        font-family: 'Outfit', sans-serif;
        background-image: linear-gradient(rgba(10, 10, 15, 0.85), rgba(10, 10, 15, 0.85)), url('background-1.png');
        background-position: center;
        background-size: cover;
        color: #e0e0e0 !important;
        overflow: hidden;
    }

    header {
        background: rgba(0, 0, 0, 0.4);
        backdrop-filter: blur(10px);
        border-bottom: 1px solid var(--glass-border) !important;
    }
    
    footer {
        background: rgba(0, 0, 0, 0.4);
        backdrop-filter: blur(10px);
        border-top: 1px solid var(--glass-border) !important;
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
    }

    .btn-neon:hover {
        background: var(--neon-green);
        color: #000;
        box-shadow: 0 0 20px rgba(0, 255, 136, 0.6), inset 0 0 10px rgba(0, 255, 136, 0.2);
        transform: translateY(-2px);
    }
    
    .display-2 {
        font-weight: 700;
        background: linear-gradient(90deg, #fff, var(--neon-green));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        filter: drop-shadow(0 0 15px rgba(0, 255, 136, 0.3));
    }
    
    .text-neon {
        color: var(--neon-green) !important;
        text-shadow: 0 0 10px rgba(0, 255, 136, 0.5);
    }
</style>

<body class="d-flex flex-column min-vh-100">

    <!-- Header -->
    <header class="border-bottom border-1">
        <div class="container py-2 d-flex justify-content-between align-items-center">
            <a href="index.php" class="text-decoration-none text-white d-flex align-items-center">
                <img src="logo.png" class="img-fluid" alt="Logo" style="width: 50px;">
                <p class="mx-2 mb-0 h5"><b>PRMS</b> <span class="text-neon fs-6">ProtoType Phase</span></p>
            </a>
            <a href="login.php" class="btn btn-neon" title="Click here to login">Login <i class="fa-solid fa-right-to-bracket ms-1"></i></a>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow-1 d-flex align-items-center">
        <div class="container text-center">
            <h1 class="display-2">Welcome to<br> Patient Recoard Management System</h1>
            <p class="py-3">
                Lorem ipsum dolor sit amet consectetur, adipisicing elit. Explicabo quibusdam magni porro, aliquam
                consequuntur, recusandae non veritatis ipsa odio dolores minus veniam est sed, officiis nesciunt labore
                saepe tenetur totam beatae rem et eos nemo quo nisi? Corporis, porro temporibus suscipit maiores, vitae
                id sapiente qui similique at aperiam laudantium! Obcaecati beatae ab corporis deserunt saepe ut eius
                inventore, a expedita cumque, dolor officiis at assumenda facere optio, culpa itaque. Facilis minus,
                vel, itaque ex doloribus dolore deserunt sit, blanditiis facere vero dolor nihil quidem cupiditate
                officia quos deleniti quam? Corrupti eligendi, pariatur quaerat molestiae doloremque voluptatem
                perspiciatis similique.
            </p>
        </div>
    </main>

    <!-- Footer -->
    <footer class="border-top border-1 mt-auto">
        <div class="container py-2 text-center">
            <p class="mb-0 text-muted">&copy; 2024 All rights reserved <b class="text-neon ms-2">PRMS - ProtoType Phase</b></p>
        </div>
    </footer>
</body>

</html>