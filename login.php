<!-- 
 IF user database delete , SQL Query
 INSERT INTO users (username, password, role) VALUES ('admin', MD5('123'), 'admin');
 -->
<?php

session_start();
include "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (md5($password) == $user['password']) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = $user['role'];

            header("Location: " . ($user['role'] == 'admin' ? "admin_dashboard.php" : "operator_dashboard.php"));
            exit();
        } else {
            header("Location: login.php?error=Invalid password!");
            exit();
        }
    } else {
        header("Location: login.php?error=User not found!");
        exit();
    }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
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
    }
    
    body {
        font-family: 'Outfit', sans-serif;
        background-image: linear-gradient(rgba(10, 10, 15, 0.8), rgba(10, 10, 15, 0.8)), url('background-3.png');
        background-size: cover;
        background-position: center;
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        color: #e0e0e0;
    }

    .morphism {
        background: rgba(15, 15, 20, 0.6);
        backdrop-filter: blur(15px);
        box-shadow: 0 0 30px rgba(0, 0, 0, 0.8), 0 0 15px rgba(0, 255, 136, 0.1);
        border: 1px solid rgba(0, 255, 136, 0.2);
        padding: 40px;
        border-radius: 20px;
        width: 100%;
        max-width: 400px;
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

    .form-control:focus {
        background: rgba(255, 255, 255, 0.1);
        border-color: var(--neon-green);
        box-shadow: 0 0 10px rgba(0, 255, 136, 0.3);
        color: white;
    }

    .form-control::placeholder {
        color: rgba(255, 255, 255, 0.4);
    }

    .form-label {
        color: #b0b0b0;
        font-weight: 500;
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
        padding: 10px 20px;
    }

    .btn-neon:hover {
        background: var(--neon-green);
        color: #000;
        box-shadow: 0 0 20px rgba(0, 255, 136, 0.6), inset 0 0 10px rgba(0, 255, 136, 0.2);
        transform: translateY(-2px);
    }
</style>

<body>
    <div class="card morphism text-white border-0">
        <h3 class="text-center mb-4"><span class="text-neon fw-bold">Login</span> to <span class="lead text-muted">PRMS</span></h3>
        <!-- Bootstrap Alert Message -->
        <?php if (isset($_GET['error'])): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Oops!</strong> <?= htmlspecialchars($_GET['error']); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <form method="POST">
            <div class="mb-3">
                <label for="uname" class="form-label">User Name</label>
                <input type="text" name="username" id="uname" class="form-control" placeholder="Enter username" required>
            </div>
            <div class="mb-3">
                <label for="pwd" class="form-label">Password</label>
                <input type="password" name="password" id="pwd" class="form-control" placeholder="Enter password" required>
            </div>
            <div class="mt-4 text-center">
                <button type="submit" class="btn btn-neon w-100">Login <i class="fa-solid fa-right-to-bracket ms-2"></i></button>
            </div>
        </form>
    </div>
    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>