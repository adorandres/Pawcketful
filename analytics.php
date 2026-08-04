<?php
include 'config.php'; 


//LOGIN SESSION
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}



$customers = mysqli_query($conn, "SELECT customer_id, ownername FROM customers ORDER BY ownername ASC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pawcketful VetCare - Analytics</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">

        <!-- aside -->
        <aside>

            <div class="top">

                <div class="logo">
                    <h2><span class="danger">Pawcketful</span></h2>
                </div>
                <div class="close" id="close_btn">
                    <span class="material-symbols-outlined"> close </span>
                </div>
            </div>



            <!-- Sidebar -->

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
        <!-- Analytics Overview -->

        <main>
            <h1>Analytics Overview 🐾</h1>

            <div class="analytics-cards">
                <div class="card">
                    <span class="material-symbols-outlined">groups</span>
                    <div class="chart-section">
                        <h2>Client List</h2>
                        <table class="customer-list">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Owner Name</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $customers = mysqli_query($conn, "SELECT * FROM customers ORDER BY ownername ASC");
                                while ($c = mysqli_fetch_assoc($customers)) {
                                    echo "<p>{$c['customer_id']} - <b>{$c['ownername']}</b> - {$c['pets']} - {$c['contact']} - {$c['email']}</p>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="card">
                    <span class="material-symbols-outlined">calendar_month</span>
                    <h3>Appointments</h3>
                    <h1>120</h1>
                    <small>This Week</small>
                </div>

                <div class="card">
                    <span class="material-symbols-outlined">pets</span>
                    <h3>Registered Pets</h3>
                    <h1>320</h1>
                    <small>This Month</small>
                </div>
            </div>



            <!-- Monthly Appointment Trends -->

            <div class="chart-section">
                <h2>Monthly Appointment Trends</h2>
                <canvas id="appointmentChart"></canvas>
            </div>

            <!-- Service Distribution -->

            <div class="chart-section">
                <h2>Service Distribution</h2>
                <canvas id="serviceChart"></canvas>
            </div>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>

        // Line Chart for Appointments
        
        const ctx1 = document.getElementById('appointmentChart');
        new Chart(ctx1, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                datasets: [{
                    label: 'Appointments',
                    data: [30, 45, 60, 80, 70, 90],
                    borderColor: '#4A90E2',
                    backgroundColor: 'rgba(74,144,226,0.2)',
                    fill: true,
                    tension: 0.3
                }]
            },
            options: {
                responsive: true,
                plugins: { legend: { display: false } }
            }
        });



        // Pie Chart for Services

        const ctx2 = document.getElementById('serviceChart');
        new Chart(ctx2, {
            type: 'pie',
            data: {
                labels: ['Vaccination', 'Checkup', 'Medication', 'Grooming'],
                datasets: [{
                    data: [40, 25, 20, 15],
                    backgroundColor: ['#4A90E2', '#50E3C2', '#F5A623', '#D0021B']
                }]
            },
            options: {
                responsive: true,
                plugins: { legend: { position: 'bottom' } }
            }
        });
    </script>
</body>
</html>
