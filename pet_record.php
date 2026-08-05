<?php
include 'config.php';
session_start();

// Session check
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'customer') {
    header("Location: login.php");
    exit();
}

// Fetch appointments for this customer
$customer_id = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT pet_name, breed, service, payment_status, appointment_date, appointment_time, status 
                        FROM appointments WHERE customer_id = ? ORDER BY appointment_date DESC");
$stmt->bind_param("i", $customer_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Customer Dashboard - Pet Records</title>
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
            max-width: 900px;
            margin: auto;
        }

        .card h2 {
            text-align: center;
            color: #0991be;
            margin-bottom: 1.5rem;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
        }

        table th, table td {
            padding: 0.8rem;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        table th {
            background: #0991be;
            color: #fff;
        }
    </style>
</head>
<body>

    <div class="sidebar">
        <h2>Pawcketful Chat</h2>
        <ul>
            <li><a href="customer_dashboard.php">Chat Bot</a></li>
            <li><a href="appointment_customer.php">Appointments</a></li>
            <li class="active"><a href="pet_records.php">Pet Records</a></li>
            <li><a href="setting_customer.php">Settings</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>

    <div class="main-content">
        <div class="card">
            <h2>My Pet Records 🐾</h2>
            <table>
                <tr>
                    <th>Pet Name</th>
                    <th>Breed</th>
                    <th>Service</th>
                    <th>Payment</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Status</th>
                </tr>
                <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $row['pet_name']; ?></td>
                    <td><?php echo $row['breed']; ?></td>
                    <td><?php echo $row['service']; ?></td>
                    <td><?php echo ucfirst($row['payment_status']); ?></td>
                    <td><?php echo $row['appointment_date']; ?></td>
                    <td><?php echo $row['appointment_time']; ?></td>
                    <td><?php echo ucfirst($row['status']); ?></td>
                </tr>
                <?php } ?>
            </table>
        </div>
    </div>

</body>
</html>
