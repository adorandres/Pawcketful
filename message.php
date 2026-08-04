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
    <title>Pawcketful VetCare - Messages</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="container">

     <!-- Sidebar -->
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
        <h1>Messages</h1>
        <h2>Inbox</h2>

        <div class="messages-container">
            <!-- Left: Message list -->
            <div class="message-list">
                <div class="message-item active">
                    <div class="profile-photo"><img src="images/dog3.jpg" alt=""></div>
                    <div class="message-info">
                        <h4>Wick</h4>
                        <p>Booked appointment for Buddy Dog</p>
                        <small>2 mins ago</small>
                    </div>
                </div>

                <div class="message-item">
                    <div class="profile-photo"><img src="images/pet.jpg" alt=""></div>
                    <div class="message-info">
                        <h4>Smith</h4>
                        <p>Booked appointment for Siomai Cat</p>
                        <small>5 mins ago</small>
                    </div>
                </div>

                <div class="message-item">
                    <div class="profile-photo"><img src="images/dog2.jpg" alt=""></div>
                    <div class="message-info">
                        <h4>John</h4>
                        <p>Booked appointment for Brownie Dog</p>
                        <small>10 mins ago</small>
                    </div>
                </div>
            </div>

            <!-- Right: Message preview -->
            <div class="message-preview">
                <h3>Message from Wick</h3>
                <p><b>Buddy Dog</b> has an appointment scheduled for <b>Medication</b>.</p>
                <p>Status: Pending</p>
                <button class="btn red">Reply</button>
                <button class="btn blue">Mark as Read</button>
            </div>
        </div>
    </main>
</div>
<script src="js/script.js"></script>
</body>
</html>
