<?php
session_start();
include('../includes/config.php');

// Check if user is logged in, else redirect to login


// Fetch session data
$admin_username = $_SESSION['alogin'];


$total_events = $conn->query("SELECT COUNT(*) AS total FROM events")->fetch_assoc()['total'];
$total_ulsc = $conn->query("SELECT COUNT(*) AS total FROM ulsc")->fetch_assoc()['total'];
$total_admins = $conn->query("SELECT COUNT(*) AS total FROM admins")->fetch_assoc()['total'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SPORUAL Event Management</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Button Styling */
        .custom-dropdown-toggle {
            background-color: #ffffff; /* Light gray */
            color: black;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-weight: bold;
            cursor: pointer;
        }

        /* Ensure hover does not change color */
        .custom-dropdown-toggle:hover,
        .custom-dropdown-toggle:focus,
        .custom-dropdown-toggle:active {
            background-color: #ddd !important; /* Same as default */
            color: black !important;
            outline: none !important;
            box-shadow: none !important;
        }

        /* Align Dropdown */
        .dropdown-menu {
            min-width: 150px;
            right: 0;
            left: auto;
        }
    </style>
</head>

<body>
    <header>
        <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; </span>
        <!-- SIDE BAR -->
        <div id="mySidenav" class="sidenav">
            <span class="closebtn" onclick="closeNav()">&times;</span>
            <br><Br>
            <br><br>
            <a href="addevent.php">Add Event</a>
            <br>
            <a href="addulsc.php">Add ULSC</a>
            <br>
            <a href="addadmin.php">Add Admin</a>
            <br>
            <a href="schedule_matches.php">Add Schedule</a>
        </div>


        <div class="logo">
            <br><br>
            <img src="../assets/images/charusat.png" alt="Logo 1">
        </div>
        <h1>Spoural Event Management System</h1>

        <div class="logo">
            <img src="../assets/images/ulsc.png" alt="Logo 2">
        </div>

        <!-- DROPDOWN FOR ADMIN NAME -->
        <div class="dropdown">
            <button class="custom-dropdown-toggle" type="button">
                <?php echo htmlspecialchars($admin_username); ?> <!-- Display admin name -->
            </button>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                <li><a class="dropdown-item" href="#">Profile</a></li>
                <li><a class="dropdown-item" href="logout.php">Logout</a></li>
            </ul>
        </div>
    </header>

    <div class="container mt-4">
        <!-- Statistics Cards -->
        <div class="row text-center">
            <div class="col-md-3">
                <div class="card">
                    <h3><?php echo $total_events; ?></h3>
                    <p>Total Events</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <h3><?php echo $total_ulsc; ?></h3>
                    <p>Total ULSC</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <h3>5</h3>
                    <p>Pending Approvals</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <h3><?php echo $total_admins; ?></h3>
                    <p>Total Admins</p>
                </div>
            </div>
        </div>

        <!-- Manage Events Table -->
        <h4 class="mt-4">Manage Events</h4>
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Event Name</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Location</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Cricket Tournament</td>
                    <td>12-02-2025</td>
                    <td>03:00 PM</td>
                    <td>Main Ground</td>
                    <td>Scheduled</td>
                    <td>
                        <button class="btn btn-success">Edit</button>
                        <button class="btn btn-danger">Delete</button>
                    </td>
                </tr>
            </tbody>
        </table>

    </div>

    <footer>
        <p>&copy; 2025 Sports Event Management System. All Rights Reserved.</p>
    </footer>

    <script>
        function openNav() {
            document.getElementById("mySidenav").style.width = "250px";
        }
        function closeNav() {
            document.getElementById("mySidenav").style.width = "0";
        }
    </script>
</body>

</html>