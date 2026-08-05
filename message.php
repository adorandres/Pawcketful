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

     <!--aside--->
        <aside class="navigation">
            <div class="top">
                <div class="logo">
                    <h2><span class="danger">Pawcketful</span></h2>
                </div>
                <span class="material-symbols-outlined">pets</span>
            </div>

            <div class="sidebar">
                <a href="index.php">
                    <span class="material-symbols-outlined">dashboard</span>
                    <h3>Dashboard</h3>
                </a>
                <a href="appointments.php">
                    <span class="material-symbols-outlined">calendar_add_on</span>
                    <h3>Appointments</h3>
                </a>
                <a href="customer.php">
                    <span class="material-symbols-outlined">pets</span>
                    <h3>Customers</h3>
                </a>
                <a href="analytics.php">
                    <span class="material-symbols-outlined">analytics</span>
                    <h3>Analytics</h3>
                </a>
                <a href="message.php" class="active">
                    <span class="material-symbols-outlined">inbox</span>
                    <h3>Messages</h3>
                </a>
                <a href="report.php">
                    <span class="material-symbols-outlined">medical_information</span>
                    <h3>Reports</h3>
                </a>
                <a href="setting.php">
                    <span class="material-symbols-outlined">settings</span>
                    <h3>Settings</h3>
                </a>
                <a href="logout.php">
                    <span class="material-symbols-outlined">logout</span>
                    <h3>Logout</h3>
                </a>
            </div>
        </aside>

    <!-- Main -->
        <main>
        <h1>Messages</h1>
        <div class="chat-wrapper">
            <!-- Left: Customer list -->
            <div class="chat-list">
                <div class="chat-item active" data-customer="wick">
                    <div class="profile-photo"><img src="images/dog3.jpg" alt=""></div>
                    <div class="chat-info">
                        <h4>Wick</h4>
                        <small>Last message: Buddy Dog</small>
                    </div>
                </div>
                <div class="chat-item" data-customer="smith">
                    <div class="profile-photo"><img src="images/pet.jpg" alt=""></div>
                    <div class="chat-info">
                        <h4>Smith</h4>
                        <small>Last message: Siomai Cat</small>
                    </div>
                </div>
                <div class="chat-item" data-customer="john">
                    <div class="profile-photo"><img src="images/dog2.jpg" alt=""></div>
                    <div class="chat-info">
                        <h4>John</h4>
                        <small>Last message: Brownie Dog</small>
                    </div>
                </div>
            </div>

            <!-- Right: Chat window -->
            <div class="chat-window">
                <div class="chat-header">
                    <h3>Chat with Wick</h3>
                </div>
                <div class="chat-box" id="chat-box">
                    <div class="customer-message">
                        <p>Hello Admin, Buddy Dog has an appointment.</p>
                    </div>
                </div>
                <div class="chat-input">
                    <input type="text" id="admin-input" placeholder="Type your reply...">
                    <button id="send-btn">Send</button>
                </div>
            </div>
        </div>
    </main>

</div>
<script src="js/script.js"></script>
</body>
</html>
