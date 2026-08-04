<?php
include 'config.php';


//LOGIN SESSION
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}



// Kunin lahat ng medical records, nakaayos by date
$query = mysqli_query($conn, "SELECT * FROM medical_records ORDER BY appointment_date ASC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <title>Pawcketful VetCare</title>

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
                <span class="material-symbols-outlined">close</span>
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

    <!-- Main Content -->
    <main>
        <h1>Medical Record <span class="material-symbols-outlined">pets</span></h1>

        <div class="report">
            <table>
                <thead>
                    <tr>
                        <th>Record No.</th>
                        <th>Owner ID</th>
                        <th>Pet Name</th>
                        <th>Breed</th>
                        <th>Service</th>
                        <th>Payment</th>
                        <th>Date</th>
                        <th>Time</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($query)) { ?>
                        <tr>
                            <td><?php echo $row['record_id']; ?></td>
                            <td><?php echo $row['customer_id']; ?></td>
                            <td><?php echo $row['pet_name']; ?></td>
                            <td><?php echo $row['breed']; ?></td>
                            <td><?php echo $row['service']; ?></td>
                            <td><?php echo $row['payment_status']; ?></td>
                            <td><?php echo $row['appointment_date']; ?></td>
                            <td><?php echo date('h:i A', strtotime($row['appointment_time'])); ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </main>

    <!-- Right Panel -->
    <div class="right">
        <div class="top">
            <button id="menu_bar"><span class="material-symbols-outlined">menu</span></button>
            <div class="theme-toggler">
                <span class="material-symbols-outlined active">light_mode</span>
                <span class="material-symbols-outlined">dark_mode</span>
            </div>
            <div class="profile">
                <div class="info">
                    <p><b>ADOR</b></p>
                    <p>Admin</p>
                </div>
                <div class="profile-photo">
                    <img src="images/pet1.jpg" alt="">
                </div>
            </div>
        </div>
    </div>

</div>

<script src="js/script.js"></script>
</body>
</html>
