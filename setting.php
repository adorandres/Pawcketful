<?php
include 'config.php'; // para ma-load ang $conn

//LOGIN SESSION
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Pawcketful VetCare - Settings</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="container">

    <!--aside--->
        <aside>

            <div class="top">

                <div class="logo">
                    <h2><span class="danger">Pawcketful</span></h2>
                </div>
                <div class="close" id="close_btn">
                    <span class="material-symbols-outlined"> close </span>
                </div>
            </div>



            <div class="sidebar">
                <a href="index.php">
                    <span class="material-symbols-outlined">dashboard </span>
                    <h3>Dashboard</h3>
                </a>
                <a href="appointments.php">
                    <span class="material-symbols-outlined">calendar_add_on </span>
                    <h3>Appointments</h3>
                </a>
                <a href="customer.php">
                    <span class="material-symbols-outlined">pets </span>
                    <h3>Customers</h3>
                </a>
                <a href="analytics.php">
                    <span class="material-symbols-outlined">analytics </span>
                    <h3>Analytics</h3>
                </a>
                <a href="message.php">
                    <span class="material-symbols-outlined">inbox </span>
                    <h3>Messages</h3>
                </a>
                <a href="report.php">
                    <span class="material-symbols-outlined">medical_information </span>
                    <h3>Reports</h3>
                </a>
                <a href="setting.php">
                    <span class="material-symbols-outlined">settings </span>
                    <h3>Settings</h3>
                </a>
                <a href="logout.php">
                    <span class="material-symbols-outlined">logout </span>
                    <h3>Logout</h3>
                </a>
            </div>

        </aside>


    <!-- Main -->
    <main>
        <h1>Settings</h1>
        <h2>Manage Your Account</h2>

        <div class="settings-container">
            <!-- Profile Settings -->
            <div class="settings-card">
                <h3>Profile</h3>
                <p><b>Name:</b> Ador</p>
                <p><b>Email:</b> ador@example.com</p>
                <p><b>Role:</b> Admin</p>
                <button class="btn blue">Edit Profile</button>
            </div>

            <!-- Theme Settings -->
            <div class="settings-card">
                <h3>Theme</h3>
                <p>Choose your preferred theme:</p>
                <select>
                    <div class="theme-toggler">
                        <span class="material-symbols-outlined active"><option>light_mode</option></span>
                        <span class="material-symbols-outlined"><option>dark_mode</option></span>
                    </div>
                </select>
            </div>

            <!-- Notification Settings -->
            <div class="settings-card">
                <h3>Notifications</h3>
                <label><input type="checkbox" checked> Email Alerts</label><br>
                <label><input type="checkbox"> SMS Alerts</label><br>
                <label><input type="checkbox" checked> Appointment Reminders</label>
            </div>

            <!-- Security Settings -->
            <div class="settings-card">
                <h3>Security</h3>
                <button class="btn red">Change Password</button>
                <button class="btn red">Enable 2FA</button>
            </div>
        </div>
    </main>
</div>
<script src="js/script.js"></script>
</body>
</html>
