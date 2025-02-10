<?php
session_start();
include('../includes/config.php');

// **Ensure ULSC is Logged In**
if (!isset($_SESSION['ulsc_id'])) {
    header("Location: ulsc_login.php");
    exit;
}

// **Fetch ULSC Member's Department ID**
$ulsc_id = $_SESSION['ulsc_id'];
$sql = "SELECT dept_id FROM ulsc WHERE ulsc_id = :ulsc_id";
$query = $dbh->prepare($sql);
$query->bindParam(':ulsc_id', $ulsc_id, PDO::PARAM_STR);
$query->execute();
$ulsc = $query->fetch(PDO::FETCH_ASSOC);

if (!$ulsc) {
    echo "<script>alert('ULSC member not found'); window.location.href='ulsc_dashboard.php';</script>";
    exit;
}

// **Fetch Events**
$sql = "SELECT id, event_name, event_type FROM events";
$query = $dbh->prepare($sql);
$query->execute();
$events = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ULSC - View Events</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <style>
        .sidenav {
            width: 250px;
            position: fixed;
            left: -250px;
            background: #111;
            height: 100%;
            padding-top: 60px;
            transition: 0.5s;
        }
        .sidenav a {
            color: white;
            display: block;
            padding: 10px;
            text-decoration: none;
        }
        .sidenav.open {
            left: 0;
        }
    </style>
</head>
<body>
    <header>
        <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776;</span>
        <div id="mySidenav" class="sidenav">
            <span class="closebtn" onclick="closeNav()">&times;</span>

            <a href="addparticipants.php">Add Participants</a>
            <a href="viewevents.php">View Events</a>
        </div>

        <div class="logo">
            <a href="ulsc_dashboard.php">
                <img src="../assets/images/charusat.png" alt="Logo">
            </a>
        </div>
        <h1>ULSC - View Events</h1>
        <div class="logo">
            <img src="../assets/images/ulsc.png" alt="ULSC Logo">
        </div>
    </header>

    <main>
        <section>
            <h2>Events List</h2>
            <table>
                <thead>
                    <tr>
                        <th>Sr No.</th>
                        <th>Event Name</th>
                        <th>Event Type</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $sr_no = 1; foreach ($events as $event) { ?>
                        <tr>
                            <td><?php echo $sr_no++; ?></td>
                            <td><?php echo $event['event_name']; ?></td>
                            <td><?php echo $event['event_type']; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </section>
    </main>

    <script>
    function openNav() {
        document.getElementById("mySidenav").classList.add("open");
    }
    function closeNav() {
        document.getElementById("mySidenav").classList.remove("open");
    }
    </script>

    <footer>
        <p>&copy; 2025 ULSC Dashboard. All Rights Reserved.</p>
    </footer>
</body>
</html>