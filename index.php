# Pawcketful
VetCare Website


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
                <a href="#">
                    <span class="material-symbols-outlined">dashboard </span>
                    <h3>Dashboard</h3>
                </a>
                <a href="#">
                    <span class="material-symbols-outlined">calendar_add_on </span>
                    <h3>Appointments</h3>
                </a>
                <a href="#">
                    <span class="material-symbols-outlined">pets </span>
                    <h3>Customers</h3>
                </a>
                <a href="#">
                    <span class="material-symbols-outlined">analytics </span>
                    <h3>Analytics</h3>
                </a>
                <a href="#">
                    <span class="material-symbols-outlined">inbox </span>
                    <h3>Messages</h3>
                </a>
                <a href="#">
                    <span class="material-symbols-outlined">medical_information </span>
                    <h3>Reports</h3>
                </a>
                <a href="#">
                    <span class="material-symbols-outlined">settings </span>
                    <h3>Settings</h3>
                </a>
                <a href="#">
                    <span class="material-symbols-outlined">logout </span>
                    <h3>Logout</h3>
                </a>
            </div>

        </aside>

        <main>
            <h1>Dashboard</h1>
            <h2>System Overview</h2>
            <div class="date">
                <input type="date">
                
            </div>

            
            <div class="insights">
                <span class="material-symbols-outlined">analytics</span>
                    <div class="middle">
                        <div class="left">
                            <h3>Total Clients</h3>
                            <h1>501</h1>
                        </div>
                        <div class="progress">
                            <div class="number">
                                <p class="primary">Details</p>
                            </div>
                        </div>
                    </div>
                <small>Last 24 Hours</small>
            </div>


            <div class="reports">
                <span class="material-symbols-outlined">medical_information</span>
                    <div class="middle">
                        <div class="left">
                            <h3>Medical Records</h3>
                            <h1>501</h1>
                        </div>
                        <div class="progress">
                            <div class="number">
                                <p class="primary">Details</p>
                            </div>
                        </div>
                    </div>
                <small>Last 24 Hours</small>
            </div>

            <div class="pets">
                <span class="material-symbols-outlined">pets</span>
                    <div class="middle">
                        <div class="left">
                            <h3>Registered Pets</h3>
                            <h1>501</h1>
                        </div>
                        <div class="progress">
                            <div class="number">
                                <p class="primary">Details</p>
                            </div>
                        </div>
                    </div>
                <small>Last 24 Hours</small>
            </div>


            <div class="calendar_add_on">
                <h2>Upcoming Appointments</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Owner</th>
                            <th>Pet</th>
                            <th>Service</th>
                            <th>Payment</th>
                            <th>Status</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td>Wick</td>
                            <td>Buddy Dog</td>
                            <td>Medication</td>
                            <td>Due</td>
                            <td class="warning">Pending</td>
                            <td class="primary">Details</td>
                        </tr>

                        <tr>
                            <td>Smith</td>
                            <td>Siomai Cat</td>
                            <td>Vaccination</td>
                            <td>Paid</td>
                            <td class="warning">Pending</td>
                            <td class="primary">Details</td>
                        </tr>

                        <tr>
                            <td>John</td>
                            <td>Brownie Dog</td>
                            <td>Vaccination</td>
                            <td>Paid</td>
                            <td class="warning">Pending</td>
                            <td class="primary">Details</td>
                        </tr>

                        <!-- Add more rows as needed -->
                    </tbody>

                </table>

                <a href="#">Show All</a>    
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


    <div class="calendar_add_on">
            <h2>Notifications</h2>
            <div class="updates">
                <div class="update">
                    <div class="profile-photo">
                        <img src="images/dog3.jpg" alt="">
                    </div>
                    <div class="message">
                        <p><b>Wick</b> booked an appointment for <b>Buddy Dog</b></p>
                        <small class="text-muted">2 Minutes Ago</small>
                    </div>
                </div>

                <div class="update">
                    <div class="profile-photo">
                        <img src="images/pet.jpg" alt="">
                    </div>
                    <div class="message">
                        <p><b>Smith</b> booked an appointment for <b>Siomai Cat</b></p>
                        <small class="text-muted">5 Minutes Ago</small>
                    </div>
                </div>

                <div class="update">
                    <div class="profile-photo">
                        <img src="images/dog2.jpg" alt="">
                    </div>
                    <div class="message">
                        <p><b>John</b> booked an appointment for <b>Brownie Dog</b></p>
                        <small class="text-muted">10 Minutes Ago</small>
                    </div>
                </div>
                <!-- Add more updates as needed -->
                <!-- End of Updates -->


            </div>

    <script src="js/script.js"></script>
</body>

</html>


