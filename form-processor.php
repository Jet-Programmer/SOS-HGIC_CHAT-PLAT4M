<?php
require_once("./inc/db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!preg_match("/^[a-zA-Z-' ]*$/", $_POST["firstname"]) || !preg_match("/^[a-zA-Z-' ]*$/", $_POST["lastname"])) {
        echo "<script>alert('Only letters and white space allowed in names'); window.location='signup.php';</script>";
        exit;
    } elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Invalid email format'); window.location='signup.php';</script>";
        exit;
    } elseif (empty($_POST["password"]) || empty($_POST["password_repeat"])) {
        echo "<script>alert('Password fields cannot be empty'); window.location='signup.php';</script>";
        exit;
    } elseif (strlen($_POST["password"]) < 8) {
        echo "<script>alert('Password must be at least 8 characters long'); window.location='signup.php';</script>";
        exit;
    } else {
        $firstname = trim($_POST["firstname"]);
        $lastname = trim($_POST["lastname"]);
        $email = trim($_POST["email"]);
        $password = trim($_POST["password"]);
        $password_repeat = trim($_POST["password_repeat"]);
        $role = trim($_POST["role"]);
    }

    if ($password != $password_repeat) {
        echo "<script type='text/javascript'>alert('Passwords do not match'); window.location='index.php';</script>";
        exit;
    } elseif (empty($firstname) || empty($lastname) || empty($email) || empty($password) || empty($password_repeat)) {
        echo "<script type='text/javascript'>alert('All fields are required'); window.location='signup.php';</script>";
        exit;
    } else {
        $password_hash = password_hash($password, PASSWORD_BCRYPT);
        
        $sql = "INSERT INTO your_table_name (firstname, lastname, email, password_hash, role) VALUES (?, ?, ?, ?, ?)";
        try {
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$firstname, $lastname, $email, $password_hash, $role]);
            echo "<script>alert('Registration successful'); window.location='./auth/register.php';</script>";
        } catch (PDOException $e) {
            echo "<script>alert('Error: " . $e->getMessage() . "'); window.location='signup.php';</script>";
        }
    }
} else {
    header("Location: signup.php");
}