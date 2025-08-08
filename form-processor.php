<?php
// database is required here. This allows any error thrown to be captured
require_once("./inc/db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // preg_match ensures data authentication and validation. It scans/loops through the given data and check if it has
    //of the symbols listed in the parenthesis
    if (!preg_match("/^[a-zA-Z-' ]*$/", $_POST["firstname"]) || !preg_match("/^[a-zA-Z-' ]*$/", $_POST["lastname"])) {
        echo "<script>alert('Only letters and white space allowed in names'); window.location='signup.php';</script>";
        exit;
        // php filter variable make sure the email entered corresponds to a valid email address
    } elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Invalid email format'); window.location='signup.php';</script>";
        exit;
    } elseif (empty($_POST["password"]) || empty($_POST["password_repeat"])) {
        echo "<script>alert('Password fields cannot be empty'); window.location='signup.php';</script>";
        exit;
        //this line check the length of the password and throws an alert telling the user to follow the prescribed
        //password length
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
    //this line makes sure that the password and its repeat corresponds before proceeding to the next execution
    if ($password != $password_repeat) {
        echo "<script type='text/javascript'>alert('Passwords do not match'); window.location='index.php';</script>";
        exit;
    } elseif (empty($firstname) || empty($lastname) || empty($email) || empty($password) || empty($password_repeat)) {
        echo "<script type='text/javascript'>alert('All fields are required'); window.location='signup.php';</script>";
        exit;
        //for security purposes, use the php function "password_hash" to encrypt the password entered before submitting
        //to the database
    } else {
        $password_hash = password_hash($password, PASSWORD_BCRYPT);
        //preparing the data to be inserted into the database table
        $sql = "INSERT INTO your_table_name (firstname, lastname, email, password_hash, role) VALUES (?, ?, ?, ?, ?)";
        try {
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$firstname, $lastname, $email, $password_hash, $role]);
            //display a message of success and direct the user to the registration page to verify signUp
            echo "<script>alert('Registration successful'); window.location='./auth/register.php';</script>";
            // the catch function catches every error and throws the error to the user.
        } catch (PDOException $e) {
            echo "<script>alert('Error: " . $e->getMessage() . "'); window.location='signup.php';</script>";
        }
    }
} else {
    header("Location: signup.php");
}