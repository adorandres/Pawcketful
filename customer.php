<?php
include 'config.php'; 


//LOGIN SESSION
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}



// ADD CUSTOMER

if (isset($_POST['add_customer'])) {
    $ownername = $_POST['fullname']; 
    $contact = $_POST['contact'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $pets = $_POST['pets'];

    $query = "INSERT INTO customers (ownername, contact, email, address, pets)
              VALUES ('$ownername', '$contact', '$email', '$address', '$pets')";

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Customer added successfully!');</script>";
    } else {
        echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
    }
}



// BOOK APPOINT

if (isset($_POST['book'])) {
    $customer_id = $_POST['customer_id']; 
    $pet_name = $_POST['pet_name'];
    $breed = $_POST['breed'];
    $service = $_POST['service'];
    $payment_status = $_POST['payment_status'];
    $appointment_date = $_POST['appointment_date'];
    $appointment_time = $_POST['appointment_time'];
    $status = 'Pending';

    $query = "INSERT INTO appointments (customer_id, pet_name, breed, service, payment_status, appointment_date, appointment_time, status)
              VALUES ('$customer_id', '$pet_name', '$breed', '$service', '$payment_status', '$appointment_date', '$appointment_time', '$status')";

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Appointment booked successfully!');</script>";
    } else {
        echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pawcketful VetCare - Customers</title>
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



            <!--sidebar--->

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
         <!-- Book Appointment -->

        <main>
            <div class=".customer-section">
                <h1>Book Appointment🐾</h1>


                <div class="main-content">
                    <!-- Book Appointment Form -->
                    <div id="bookForm" class="card owner">
                        <h2>Book Appointment</h2>
                        <form method="POST">
                            <label>Customer ID</label>
                            <input type="number" name="customer_id" placeholder="Enter Customer ID" required>

                            <label>Pet Name</label>
                            <input type="text" name="pet_name" required>

                            <label>Breed</label>
                            <input type="text" name="breed" required>

                            <label>Service</label>
                            <input type="text" name="service" required>

                            <label>Payment</label>
                            <input type="text" name="payment_status" required>

                            <label>Date</label>
                            <input type="date" name="appointment_date" required>

                            <label>Time</label>
                            <input type="time" name="appointment_time" required>

                            <button type="submit" name="book" class="btn red">BOOK</button><button type="button" onclick="toggleForm()" class="btn red">ADD CUSTOMER</button>
                        </form>
                    </div>



                    <!-- Add Customer -->

                    <div id="customerForm" class="card owner" style="display:none;">
                        <h2>Add Customer</h2>
                        <form method="POST">
                            <label>Owner Name</label>
                            <input type="text" name="fullname" required>

                            <label>Contact</label>
                            <input type="text" name="contact" required>

                            <label>Email</label>
                            <input type="email" name="email">

                            <label>Pet Name</label>
                            <input type="text" name="pets">

                            <button type="submit" name="add_customer" class="btn red">SAVE</button>
                            <button type="button" onclick="toggleForm()" class="btn red">Cancel</button>
                        </form>
                    </div>



                    <!-- Customer lIST -->

                    <div class="card list">
                        <h2>Customer List</h2>
                        <?php
                        $customers = mysqli_query($conn, "SELECT * FROM customers ORDER BY ownername ASC");
                        while ($c = mysqli_fetch_assoc($customers)) {
                            echo "<p>{$c['customer_id']} - <b>{$c['ownername']}</b> - {$c['pets']} - {$c['contact']} - {$c['email']}</p>";
                        }
                        ?>
                    </div>

                    <!-- New Appointments -->

                    <div class="card list">
                        <h2>New Appointments</h2>
                        <?php
                        $appointments = mysqli_query($conn, "SELECT * FROM appointments ORDER BY appointment_date DESC LIMIT 5");
                        while ($a = mysqli_fetch_assoc($appointments)) {
                            echo "<p><b>{$a['pet_name']}</b>({$a['breed']}) - {$a['service']} ({$a['appointment_date']})</p>";
                        }
                        ?>
                    </div>
                </div>
        </main>



        </div>



    <script src="js/script.js"></script>


    <script>
        function toggleForm() {
        const form = document.getElementById('customerForm');
        form.style.display = (form.style.display === 'none' || form.style.display === '') 
        ? 'block' 
        : 'none';
        }
    </script>



</body>

</html>
