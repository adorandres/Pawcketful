<?php
include 'config.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    // Query depende sa role
    if ($role === 'admin') {
        $query = "SELECT * FROM admin WHERE username='$username'";
    } else {
        $query = "SELECT * FROM custom WHERE username='$username'";
    }

    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);

        // Verify hashed password
        if (password_verify($password, $row['password'])) {
            $_SESSION['role'] = $role;
            $_SESSION['user_id'] = ($role === 'admin') ? $row['id'] : $row['customer_id'];

            // Redirect depende sa role
            header("Location: " . ($role === 'admin' ? "index.php" : "customer_dashboard.php"));
            exit();
        } else {
            $error = "Invalid password!";
        }
    } else {
        $error = "User not found!";
    }
}
?>



<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pawcketful Login</title>
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
</head>
<body>



    <div class="login-container">
        <h1>Login to Pawcketful VetCare</h1>
        <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>

        <form method="POST" action="">
            
            <dev class="role">
                <label>Role:</label>
                <select name="role" required>
                    <option value="admin">ADMIN</option>
                    <option value="customer">CUSTOMER</option>
                </select>
            </dev>

            <div class="input-box">
                <span class="material-symbols-outlined"> person </span>
                <input type="text" name="username" placeholder="Username " required>
            </div>

            <div class="input-box">
                <span class="material-symbols-outlined"> lock </span>
                <input type="password" name="password" placeholder="Password" required>
            </div>

            <div class="remember-forgot">
                <label><input type="checkbox"> Remember me</label>
                <a href="forgot_password.php">Forgot Password?</a>
            </div>

            <button type="submit" class='btn'>Login</button>

            <div class="register-link">
                <p>Don't have an account? <a href="register.php">Register</a></p>
            </div>

            
        </form>

    </div>
</body>
</html>
