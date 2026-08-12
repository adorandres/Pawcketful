<?php
include 'config.php';
session_start();

// Session check
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'customer') {
    header("Location: login.php");
    exit();
}

// Handle form submission
if (isset($_POST['book'])) {
    $customer_id = $_POST['customer_id'];
    $pet_name = $_POST['pet_name'];
    $breed = $_POST['breed'];
    $service = $_POST['service'];
    $payment_status = $_POST['payment_status'];
    $appointment_date = $_POST['appointment_date'];
    $appointment_time = $_POST['appointment_time'];

    $stmt = $conn->prepare("INSERT INTO appointments 
        (customer_id, pet_name, breed, service, payment_status, appointment_date, appointment_time) 
        VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("issssss", $customer_id, $pet_name, $breed, $service, $payment_status, $appointment_date, $appointment_time);

    if ($stmt->execute()) {
        echo "<script>alert('Appointment booked successfully!');</script>";
    } else {
        echo "<script>alert('Error booking appointment.');</script>";
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Customer Dashboard - Appointments</title>
    <link rel="stylesheet" href="css/customer.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #f6f6f9;
            margin: 0;
            display: flex;
        }

        .customer-dashboard {
            display: flex;
            width: 100%;
            height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            width: 250px;
            background: #0991be;
            color: #fff;
            padding: 1.5rem;
            border-radius: 0 20px 20px 0;
            box-shadow: 5px 0 15px rgba(0,0,0,0.1);
        }

        .sidebar h2 {
            text-align: center;
            margin-bottom: 1.5rem;
        }

        .sidebar ul {
            list-style: none;
            padding: 0;
        }

        .sidebar ul li {
            margin-bottom: 0.8rem;
        }

        .sidebar ul li a {
            color: #fff;
            text-decoration: none;
            display: block;
            padding: 0.8rem 1rem;
            border-radius: 10px;
            transition: background 0.3s ease;
        }

        .sidebar ul li a:hover,
        .sidebar ul li.active a {
            background: rgba(255,255,255,0.2);
        }

        .main-content {
            flex: 1;
            padding: 2rem;
        }

        .card {
            background: #fff;
            border-radius: 20px;
            box-shadow: 0 6px 20px rgba(0,0,0,0.1);
            padding: 2rem;
            max-width: 600px;
            margin: auto;
        }

        .card h2 {
            text-align: center;
            color: #0991be;
            margin-bottom: 1.5rem;
        }

        label {
            font-weight: 600;
            color: #0991be;
            display: block;
            margin-bottom: 0.3rem;
        }

        input, select {
            width: 100%;
            padding: 0.8rem;
            border-radius: 10px;
            border: 1px solid #ccc;
            margin-bottom: 1rem;
            font-size: 0.95rem;
        }

        .btn {
            background: #0991be;
            color: #fff;
            border: none;
            padding: 0.8rem 1.5rem;
            border-radius: 25px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .btn:hover {
            background: #077aa0;
        }

        .btn.red {
            background: #ff4d4d;
        }

        .btn.red:hover {
            background: #d63a3a;
        }
    </style>
</head>
<body>

    <div class="sidebar">
        <h2>Pawcketful Chat</h2>
        <ul>
            <li><a href="customer_dashboard.php">Chat Bot</a></li>
            <li class="active"><a href="appointment_customer.php">Appointments</a></li>
            <li><a href="pet_records.php">Pet Records</a></li>
            <li><a href="setting_customer.php">Settings</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>

    <div class="main-content">
        <div class="card">
            <h2>Book Appointment 🐾</h2>
            <form method="POST" action="appointment_customer.php">
                <label>Customer ID</label>
                <input type="number" name="customer_id" placeholder="Enter Customer ID" required>

                <label>Pet Name</label>
                <input type="text" name="pet_name" required>

                <label>Breed</label>
                <input type="text" name="breed" required>

                <label>Service</label>
                <select id="service" name="service" required>
                    <option value="" disabled selected>Select Service</option>
                    <option value="checkup">Check Ups</option>
                    <option value="grooming">Grooming</option>
                    <option value="consultation">Consultations</option>
                    <option value="boarding">Pet Boarding</option>
                    <option value="minor_surgery">Minor Surgeries</option>
                    <option value="cesarean">Cesarean Section Delivery</option>
                    <option value="spay">Spay</option>
                    <option value="neutering">Neutering</option>
                    <option value="vaccination">Vaccination</option>
                    <option value="treatment">Treatment & Confinement</option>
                </select>

                <label>Payment GCash (Reference No.)</label>
                <input id="payment" name="payment_status" placeholder="Enter Reference Number">

                <label>Date</label>
                <input type="date" name="appointment_date" required>

                <label>Time</label>
                <input type="time" name="appointment_time" required>

                <button type="submit" name="book" class="btn red">BOOK</button>
            </form>
        </div>
    </div>

</body>
</html>
