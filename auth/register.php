<?php
require_once("../inc/db.php");?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HGIC CHATPLAT4M Register</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/form.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/script.js"></script>
</head>

<body>
    <section class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form action="../auth/register.php" method="POST">
                    <h2 class="mb-4 text-center"> Complete Registration</h2>
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <button type="submit" class="btn btn-primary">Register</button>
            </form>
            </div>
        </div>
    </section>
    <footer class="mt-5">
        <p class="text-center">© 2025 HGIC CHATPLAT4M. All rights reserved.</p>
    </footer>

    <?php
    require_once("../inc/db.php");
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = trim($_POST["username"]);
        $email = trim($_POST["email"]);
        $password = trim($_POST["password"]);

        if (empty($username) || empty($email) || empty($password)) {
            echo "<script>alert('All fields are required'); window.location='register.php';</script>";
            exit;
        } else {
            $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
            $stmt->execute([$username]);
            $user = $stmt->fetch();

            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['username'] = $user['username'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['password'] = $user['password'];

                // Log login time
                $log = $pdo->prepare("INSERT INTO logs (user_id, ip_address) VALUES (?, ?)");
                $log->execute([$_SESSION['username'], $_SERVER['REMOTE_ADDR']]);

                header("<script>window.location.href='../index.php';</script>");
                exit;
            } else {
                echo "<script>alert('Username or password is incorrect'); window.location='register.php';</script>";
            }
            }
    } else {
        header("Location: index.php");
        exit;
    }
    ?>
</body>

</html>