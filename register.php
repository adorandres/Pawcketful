<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullname = $_POST['fullname'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];

    if ($role === 'admin') {
        $query = "INSERT INTO admin (fullname, username, email, password)
                  VALUES ('$fullname', '$username', '$email', '$password')";
    } else {
        $query = "INSERT INTO custom (ownername, username, email, password)
                  VALUES ('$fullname', '$username', '$email', '$password')";
    }

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Registration successful! You can now log in.'); window.location.href='login.php';</script>";
    } else {
        echo "<script>alert('Error: Registration failed.');</script>";
    }
}
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pawcketful Registration</title>
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
</head>
<body>
    <div class="register-container">
        <h2>Create Account</h2>
        <form method="POST" action="">

            <label>Role:</label>
            <select name="role" required>
                <option value="admin">Admin</option>
                <option value="customer">Customer</option>
            </select>


            <label>Full Name:</label>
            <input type="text" name="fullname" required>

            <label>Username:</label>
            <input type="text" name="username" required>

            <label>Email:</label>
            <input type="email" name="email" required>

            <label>Password:</label>
            <input type="password" name="password" required>

            <button type="submit">Register</button>
        </form>
        <p>Already have an account? <a href="login.php">Login here</a></p>
    </div>
</body>
</html>
