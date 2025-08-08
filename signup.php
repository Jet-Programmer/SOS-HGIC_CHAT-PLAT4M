<?php session_start() ?>
<!DOCTYPE html>
<html>
<head>
    <title>HGIC CHATPLAT4M Sign_Up</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/form.css">
</head>
<body>
<section class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form action="form-processor.php" method="POST" class="card p-4 shadow">
                <h2 class="mb-4 text-center">Sign Up </h2>
                <div class="mb-3">
                    <label for="FirstName" class="form-label">First Name</label>
                    <input type="text" class="form-control" id="FirstName" name="firstname" placeholder="Enter first name" required>
                </div>
                <div class="mb-3">
                    <label for="LastName" class="form-label">Last Name</label>
                    <input type="text" class="form-control" id="LastName" name="lastname" placeholder="Enter last name" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
                </div>
                <div class="mb-3">
                    <label for="role" class="form-label">Role</label>
                    <select id="role" name="role" class="form-select">
                        <option value="None">None</option>
                        <option value="Comportment Prefect">Comportment Prefect</option>
                        <option value="Comportment Monitor">Comportment Monitor</option>
                        <option value="Compound Prefect">Compound Prefect</option>
                        <option value="Compound Monitor">Compound Monitor</option>
                        <option value="Dinning-Hall Prefect">Dinning-Hall Prefect</option>
                        <option value="Dinning Monitor">Dinning-Hall Monitor</option>
                        <option value="Prep & Library Prefect">Prep & Library Prefect</option>
                        <option value="Prep & Library Monitor">Prep & Library Monitor</option>
                        <option value="CAS Prefect">CAS Prefect</option>
                        <option value="CAS Monitor">CAS Monitor</option>
                        <option value="Hostel Prefect">Hostel Prefect</option>
                        <option value="Hostel Monitor">Hostel Monitor</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="Password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="Password" name="password" placeholder="Enter Password" required>
                </div>
                <div class="mb-3">
                    <label for="repeat-Password" class="form-label">Repeat Password</label>
                    <input type="password" class="form-control" id="repeat-Password" name="password_repeat" placeholder="Repeat Password" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Sign Up</button>
                <div class="text-center mt-2">
                    <a href="./auth/register.php">Already have an account? Login</a>
                </div>
            </form>
        </div>
    </div>
</section>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
