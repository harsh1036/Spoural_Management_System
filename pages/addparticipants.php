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

$dept_id = $ulsc['dept_id']; // Auto-assign dept_id


// **Fetch Events for Dropdown**
$sql = "SELECT id, event_name FROM events";
$query = $dbh->prepare($sql);
$query->execute();
$events = $query->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $event_id = $_POST['event']; // Selected Event ID
    $student_ids = $_POST['student_id']; // Array of Student IDs

    if (!empty($event_id) && !empty($student_ids)) {
        // Prepare SQL statement for bulk insertion
        $stmt = $dbh->prepare("INSERT INTO participants (event_id,dept_id, student_id) VALUES (?, ?,?)");

        foreach ($student_ids as $student_id) {
            if (!empty($student_id)) { // Ensure Student ID is not empty
                $stmt->execute([$event_id, $dept_id, $student_id,]);
            }
        }
        echo "<script>alert('Participants added successfully!'); window.location.href='addparticipants.php';</script>";
    } else {
        echo "<script>alert('Please select an event and enter student IDs.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ULSC - Add Participants</title>
    <link rel="stylesheet" href="../assets/css/style.css">

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: #f8f9fa;
        }

        header {
            background: #007BFF;
            color: white;
            padding: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .sidenav {
            width: 0;
            position: fixed;
            left: 0;
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

        .search-box {
            width: 50%;
            margin: 20px auto;
            display: flex;
            align-items: center;
            background: white;
            padding: 10px;
            border-radius: 5px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }

        .search-box input {
            width: 100%;
            padding: 8px;
            border: none;
            outline: none;
            font-size: 16px;
        }

        .search-box i {
            margin-right: 10px;
            color: #007BFF;
        }

        .confirm-overlay,
        .message-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .confirm-box,
        .message-box {
            background: white;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }

        .confirm-box button,
        .message-box button {
            margin: 10px;
            padding: 8px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .confirm-box button:first-child {
            background: #d9534f;
            color: white;
        }

        .confirm-box button:last-child,
        .message-box button {
            background: #5bc0de;
            color: white;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background: #ffffff;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }

        th,
        td {
            border: 1px solid black;
            padding: 10px;
            text-align: center;
        }

        footer {
            background: #007BFF;
            color: white;
            text-align: center;
            padding: 10px;
            position: relative;
            bottom: 0;
            width: 100%;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 20px;
        }

        label {
            font-weight: bold;
            display: block;
            margin-top: 10px;
        }

        select,
        input {
            width: 100%;
            padding: 8px;
            margin: 5px 0;
        }

        .student-entry {
            display: flex;
            gap: 10px;
        }

        .student-entry input {
            flex: 1;
        }

        button {
            background-color: #007bff;
            color: white;
            padding: 10px;
            border: none;
            cursor: pointer;
            margin-top: 15px;
            width: 100%;
        }
        .submit{
            width: 10%;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table,
        th,
        td {
            border: 1px solid #ddd;
        }

        th,
        td {
            padding: 12px;
            text-align: center;
        }

        th {
            background-color: #007bff;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .small-table {
            max-width: 600px;
            /* Adjust width */
            margin: left;
            /* Center the table */
            font-size: 20px;
            /* Smaller text */
        }

        label {
            font-size: 20px;
        }

        input {
            font-size: 15px;
        }

        /* Button Styling */
        .custom-dropdown-toggle {
            background-color: #ffffff;
            /* Light gray */
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
            background-color: #ddd !important;
            /* Same as default */
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

        select {
            width: 10%;
            padding: 6px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 4px;
            outline: none;
        }

        select:focus {
            border-color: #007bff;
        }
    .sub{
        width: 10%;
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

            <a href="addparticipants.php">Add Participants</a><br>
            <a href="viewevents.php">View Events</a>
        </div>

        <div class="logo">
            <br><br>
            <a href="admindashboard.php">
                <img src="../assets/images/charusat.png" alt="Logo 1">
            </a>

        </div>
        <h1>Spoural Event Management System</h1>

        <div class="logo">

            <img src="../assets/images/ulsc.png" alt="Logo 2">
        </div>


        <!-- DROPDOWN FOR ADMIN NAME -->
        <div class="dropdown">
            <button class="custom-dropdown-toggle" type="button">
                <?php echo htmlspecialchars($_SESSION['ulsc_name']); ?> <!-- Display admin name -->
            </button>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                <li><a class="dropdown-item" href="#">Profile</a></li>
                <li><a class="dropdown-item" href="logout.php">Logout</a></li>
            </ul>
        </div>
    </header>

    <main>
        <section>
            <!-- Add Participant Form (As it was) -->
            <form action="addparticipants.php" method="POST">
                <label for="eventSelect">Select Event:</label>
       
                <select id="eventSelect" name="event" onchange="showParticipantsForm()" required>
                    <option value="">Select Event</option>
                    <?php foreach ($events as $event) { ?>
                        <option value="<?php echo $event['id']; ?>"><?php echo $event['event_name']; ?></option>
                    <?php } ?>
                </select>


                <div id="studentsContainer"></div>

                <button  type="submit" class="sub">Submit</button>
        </section>
        </form>


    </main>

    <script>
        function openNav() {
            document.getElementById("mySidenav").style.width = "250px";
        }

        function closeNav() {
            document.getElementById("mySidenav").style.width = "0";
        }

        document.getElementById("searchInput").addEventListener("keyup", function () {
            let filter = this.value.toLowerCase();
            let rows = document.querySelectorAll("#participantsTable tbody tr");
            rows.forEach(row => {
                let studentID = row.cells[1].textContent.toLowerCase();
                let eventName = row.cells[2].textContent.toLowerCase();
                row.style.display = studentID.includes(filter) || eventName.includes(filter) ? "" : "none";
            });
        });

        function confirmDelete(id) {
            let confirmationBox = document.createElement("div");
            confirmationBox.innerHTML = `
                <div class="confirm-box">
                    <p>Are you sure you want to delete this participant?</p>
                    <button onclick="window.location.href='addparticipants.php?delete_id=${id}'">Yes</button>
                    <button onclick="closeConfirmBox()">No</button>
                </div>
            `;
            confirmationBox.classList.add("confirm-overlay");
            document.body.appendChild(confirmationBox);
        }

        function closeConfirmBox() {
            document.querySelector(".confirm-overlay").remove();
        }

        function showParticipantsForm() {
            var event = document.getElementById("eventSelect").value;
            var container = document.getElementById("studentsContainer");

            // Clear previous inputs
            container.innerHTML = "";

            // If any event is selected, show 10 Student ID input fields
            if (event) {
                let formHTML = `<h3>Enter 10 Student IDs for <strong>${event}</strong></h3>`;
                formHTML += '<table border="2" style="width:100%; text-align:center;"  class="table table-bordered table-striped small-table">';
                formHTML += '<tr><th>Student ID</th></tr>';

                for (let i = 1; i <= 2; i++) {
                    formHTML += `
                <tr>
                    <td><input type="text" name="student_id[]" required></td>
                </tr>
            `;
                }

                formHTML += '</table>';
                container.innerHTML = formHTML;
            }
        }
    </script>

    <footer>
        <p>&copy; 2025 ULSC Dashboard. All Rights Reserved.</p>
    </footer>
</body>

</html>