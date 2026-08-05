# Pawcketful
VetCare Website


<?php
include 'config.php'; 


//LOGIN SESSION
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}



// Count total medical records

$total_records = mysqli_query($conn, "SELECT COUNT(*) AS total FROM medical_records");
$records = mysqli_fetch_assoc($total_records)['total'];

$total_client = mysqli_query($conn, "SELECT COUNT(*) AS total FROM customers");
$client = mysqli_fetch_assoc($total_client)['total'];

$total_messages = mysqli_query($conn, "SELECT COUNT(*) AS total FROM messages");
$messages = mysqli_fetch_assoc($total_messages)['total'];


//today appointment

include 'config.php';
date_default_timezone_set('Asia/Manila');
$today = date('Y-m-d');

$query = "SELECT * FROM appointments WHERE status='Pending'";
$result = mysqli_query($conn, $query);

$query = "SELECT a.*, c.ownername FROM appointments a
          JOIN customers c ON a.customer_id = c.customer_id
          WHERE a.status = 'Pending'";
$result = mysqli_query($conn, $query);



//para sa notif

$notif = "SELECT c.ownername, a.pet_name, a.appointment_date, TIMESTAMPDIFF(MINUTE, a.appointment_date, NOW()) AS mins
          FROM appointments a
          JOIN customers c ON a.customer_id = c.customer_id
          ORDER BY a.appointment_id DESC LIMIT 5";
$notif_result = mysqli_query($conn, $notif);
?>


<!DOCTYPE html>
<html>
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

        <!--aside--->
        <aside class="navigation">
            <div class="top">
                <div class="logo">
                    <h2><span class="danger">Pawcketful</span></h2>
                </div>
                <span class="material-symbols-outlined">pets</span>
            </div>

            <div class="sidebar" >
                <a href="index.php" class="active">
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
                <a href="message.php">
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



        <main>
            
            <h1>Dashboard <span class="material-symbols-outlined">pets </span></h1>
            <h2>System Overview</h2>
            <div class="date">
                <input type="date">
                
            </div>

            <!-- Total Clients -->

            <div class="insights">
                <span class="material-symbols-outlined">groups</span>
                    <div class="middle">
                        <div class="left">
                            <h3>Total Clients</h3>
                            <h1><?php echo $client; ?></h1>
                        </div>
                        <div class="progress">
                            <div class="number">
                                <a href="analytics.php">
                                    <p class="primary">Details</p>
                                </a>
                            </div>
                        </div>
                    </div>
                <small>Last 24 Hours</small>
            </div>

            <!-- Medical Records -->

            <div class="reports">
                <span class="material-symbols-outlined">calendar_month</span>
                    <div class="middle">
                        <div class="left">
                            <h3>Medical Records</h3>
                            <h1><?php echo $records; ?></h1>
                        </div>
                        <div class="progress">
                            <div class="number">
                                <a href="report.php">
                                    <p class="primary">Details</p>
                                </a>
                            </div>
                        </div>
                    </div>
                <small>Last 24 Hours</small>
            </div>

            <!-- Registered Pets -->

            <div class="pets">
                <span class="material-symbols-outlined">pets</span>
                    <div class="middle">
                        <div class="left">
                            <h3>Registered Pets</h3>
                            <h1>501</h1>
                        </div>
                        <div class="progress">
                            <div class="number">
                                <a href="customer.php">
                                    <p class="primary">Details</p>
                            </a>
                            </div>
                        </div>
                    </div>
                <small>Last 24 Hours</small>
            </div>



            <!-- Today's Appointments -->

            <div class="calendar_add_on">
                <h2>Today's Appointments</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Owner</th>
                            <th>Pet</th>
                            <th>Service</th>
                            <th>Payment</th>
                            <th>Time</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                            mysqli_data_seek($result, 0); // reset pointer
                            while ($row = mysqli_fetch_assoc($result)) {
                                if ($row['appointment_date'] == $today) { ?>
                                    <tr>
                                        <td><?php echo $row['ownername']; ?></td>
                                        <td><?php echo $row['pet_name']; ?></td>
                                        <td><?php echo $row['service']; ?></td>
                                        <td style="color: magenta;"><?php echo $row['payment_status']; ?></td>
                                        <td><?php echo date('h:i A', strtotime($row['appointment_time'])); ?></td>
                            </tr>
                        <?php }
                            } ?>
                    </tbody>

                </table>

                <a href="appointments.php">Show All</a>    
        </main>

        <!-- End of Main -->



        <!-- Right -->

        <div class="right">
            <div class="top">
                <button id="menu_bar">
                    <span class="material-symbols-outlined">menu</span>
                </button>
                <div class="theme-toggler">
                    <span class="material-symbols-outlined active">light_mode</span>
                    <span class="material-symbols-outlined">dark_mode</span>
                </div>

                <div class="profile">
                    <div class="info">
                        <p><b>ADOR</b></p>
                        <p>Admin</p>
                        <small class="text-muted"></small>
                    </div>
                    <div class="profile-photo">
                        <img src="images/pet1.jpg" alt="">
                    </div>
                </div>
        </div>


        <!-- notification -->

        <div class="message-list">
            <a href="message.php"><h2>Messages</h2></a> 
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



    <script src="js/script.js"></script>



</body>

</html>



