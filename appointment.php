<?php
include 'config.php';


//LOGIN SESSION
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}



//today appointment

include 'config.php';
date_default_timezone_set('Asia/Manila');
$today = date('Y-m-d');

$query = "SELECT * FROM appointments WHERE status='Pending'";
$result = mysqli_query($conn, $query);



// Kunin lahat ng appointments, naka‑ayos by date

$query = mysqli_query($conn, "SELECT * FROM appointments ORDER BY appointment_date ASC");



//para sa pending appointment

$query = "SELECT a.*, c.ownername FROM appointments a
          JOIN customers c ON a.customer_id = c.customer_id
          WHERE a.status = 'Pending'";
$result = mysqli_query($conn, $query);

// CONFIRM BUTTON
if (isset($_POST['confirm'])) {
    $appointment_id = $_POST['appointment_id'];

    // Kunin ang appointment data
    $result = mysqli_query($conn, "SELECT * FROM appointments WHERE appointment_id='$appointment_id'");
    $row = mysqli_fetch_assoc($result);

    // Insert sa medical_records (Done)
    $insert = mysqli_query($conn, "INSERT INTO medical_records 
        (appointment_id, customer_id, pet_name, breed, service, appointment_date, appointment_time, payment_status, status)
        VALUES (
            '{$row['appointment_id']}',
            '{$row['customer_id']}',
            '{$row['pet_name']}',
            '{$row['breed']}',
            '{$row['service']}',
            '{$row['appointment_date']}',
            '{$row['appointment_time']}',
            '{$row['payment_status']}',
            'Done'
        )");

    // Update appointment status
    mysqli_query($conn, "UPDATE appointments SET status='Done' WHERE appointment_id='$appointment_id'");

    // Redirect or refresh
    header("Location: appointments.php?confirmed=1");
    exit();
}

// AUTO‑CANCEL kapag lumipas ang araw
$today = date('Y-m-d');

// Update lahat ng pending na lumipas na
mysqli_query($conn, "UPDATE appointments
                     SET status='Cancelled'
                     WHERE status='Pending' AND appointment_date < '$today'");

// I‑insert lahat ng na‑cancel sa medical_records kung wala pa
$cancelled = mysqli_query($conn, "SELECT * FROM appointments WHERE status='Cancelled' AND appointment_date < '$today'");
while ($row = mysqli_fetch_assoc($cancelled)) {
    $check = mysqli_query($conn, "SELECT * FROM medical_records WHERE appointment_id='{$row['appointment_id']}'");
    if (mysqli_num_rows($check) == 0) {
        mysqli_query($conn, "INSERT INTO medical_records 
            (appointment_id, customer_id, pet_name, breed, service, appointment_date, appointment_time, payment_status, status)
            VALUES (
                '{$row['appointment_id']}',
                '{$row['customer_id']}',
                '{$row['pet_name']}',
                '{$row['breed']}',
                '{$row['service']}',
                '{$row['appointment_date']}',
                '{$row['appointment_time']}',
                '{$row['payment_status']}',
                'Cancelled'
            )");
    }
}


//para sa notif

$notif = "SELECT c.ownername, a.pet_name, a.appointment_date, TIMESTAMPDIFF(MINUTE, a.appointment_date, NOW()) AS mins
          FROM appointments a
          JOIN customers c ON a.customer_id = c.customer_id
          ORDER BY a.appointment_id DESC LIMIT 1";
$notif_result = mysqli_query($conn, $notif);



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



    <meta charset="UTF-8">
    <title>Appointments</title>
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
                <a href="appointments.php" class="active">
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



        <!--MAIN--->

        <main>
            <h1>Pending Appointment <span class="material-symbols-outlined">pets </span></h1>
            
            

            <!--Today's Appointments--->

            <div class="appointment-box">
                <div class="left-box">
                    <h2>Today's Appointments</h2>
                    <table>
                        <thead>
                            <tr>
                                <th>Owner</th>
                                <th>Pet</th>
                                <th>Breed</th>
                                <th>Service</th>
                                <th>Payment</th>
                                <th>Time</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            mysqli_data_seek($result, 0);
                            while ($row = mysqli_fetch_assoc($result)) {
                                if (date('Y-m-d', strtotime($row['appointment_date'])) == $today) { ?>
                                    <tr>
                                        <td><?php echo $row['ownername']; ?></td>
                                        <td><?php echo $row['pet_name']; ?></td>
                                        <td><?php echo $row['breed']; ?></td>
                                        <td><?php echo $row['service']; ?></td>
                                        <td><?php echo $row['payment_status']; ?></td>
                                        
                                        <td><?php echo date('h:i A', strtotime($row['appointment_time'])); ?></td>
                                        <td style="color:magenta;"><?php echo $row['status']; ?></td>
                                        <td>
                                            <form method="POST" style="display:inline;">
                                                <input type="hidden" name="appointment_id" value="<?php echo $row['appointment_id']; ?>">
                                                <?php if ($row['status'] == 'Pending') { ?>
                                                    <button type="submit" name="confirm" class="btn red">Confirm</button>
                                                <?php } elseif ($row['status'] == 'Cancelled') { ?>
                                                    <span style="color:red;font-weight:bold;">Cancelled</span>
                                                <?php } elseif ($row['status'] == 'Done') { ?>
                                                    <span style="color:green;font-weight:bold;">Done</span>
                                                <?php } ?>
                                            </form>

                                        </td>
                                    </tr>
                            <?php }
                            }  ?>
                                </table>
                            </div>

                            

                <!--Upcoming Appointments--->

                <div class="right-box">
                    <h2>Upcoming Appointments</h2>
                    <table>
                        <thead>
                            <tr>
                                <th>Owner</th>
                                <th>Pet</th>
                                <th>Breed</th>
                                <th>Service</th>
                                <th>Payment</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            mysqli_data_seek($result, 0);
                            while ($row = mysqli_fetch_assoc($result)) {
                                if ($row['appointment_date'] > $today) { ?>
                                    <tr>
                                        <td><?php echo $row['ownername']; ?></td>
                                        <td><?php echo $row['pet_name']; ?></td>
                                        <td><?php echo $row['breed']; ?></td>
                                        <td><?php echo $row['service']; ?></td>
                                        <td><?php echo $row['payment_status']; ?></td>
                                        <td><?php echo $row['appointment_date']; ?></td>
                                    </tr>
                            <?php }
                            } ?>
                                </table>
                            </div>
                        </div>

                    </tbody>

                </table>

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

        <div class="calendar_add_on">
            <h2>Client Notifications</h2>
            <div class="updates">
                <?php if (!empty($_SESSION['notif_customer'])): ?>
                <div class="update" style="border:1px solid #ccc; padding:1rem; margin-bottom:1rem; border-radius:10px;">
                    <p><strong>Customer:</strong> <?php echo htmlspecialchars($_SESSION['notif_customer']); ?></p>
                    <p><strong>Payment Status:</strong> <?php echo htmlspecialchars($_SESSION['notif_payment']); ?></p>

                    <form method="POST" style="margin-top:0.5rem;">
                        <input type="hidden" name="customer" value="<?php echo htmlspecialchars($_SESSION['notif_customer']); ?>">
                        <button type="submit" name="confirm" class="btn blue">Confirm</button>
                        <button type="submit" name="cancel" class="btn red">Cancel</button>
                    </form>
                </div>
                <?php unset($_SESSION['notif_customer'], $_SESSION['notif_payment']); ?>
            <?php endif; ?>


            </div>
        </div>




        


    <script src="js/script.js"></script>



</body>

</html>
