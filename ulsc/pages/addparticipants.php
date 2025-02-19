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
$sql = "SELECT u.dept_id, d.dept_name, u.ulsc_name 
        FROM ulsc u 
        JOIN departments d ON u.dept_id = d.id 
        WHERE u.ulsc_id = :ulsc_id";
$query = $dbh->prepare($sql);
$query->bindParam(':ulsc_id', $ulsc_id, PDO::PARAM_STR);
$query->execute();
$ulsc = $query->fetch(PDO::FETCH_ASSOC);

if (!$ulsc) {
    echo "<script>alert('ULSC member not found'); window.location.href='ulsc_dashboard.php';</script>";
    exit;
}

// Store ULSC name and department name
$ulsc_name = htmlspecialchars($ulsc['ulsc_name']);
$dept_name = htmlspecialchars($ulsc['dept_name']);

$dept_id = $ulsc['dept_id']; // Auto-assign dept_id


// **Fetch Events for Dropdown**
$sql = "SELECT id, event_name, min_participants, max_participants FROM events";
$query = $dbh->prepare($sql);
$query->execute();
$events = $query->fetchAll(PDO::FETCH_ASSOC);


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $event_id = $_POST['event']; 
    $student_ids = $_POST['student_id'];
    $min_participants = $_POST['minParticipants'];
    $max_participants = $_POST['maxParticipants'];

    // Count number of participants being added
    $num_participants = count($student_ids);

    // Check current participants count in the database
    $sql = "SELECT COUNT(*) FROM participants WHERE event_id = :event_id";
    $query = $dbh->prepare($sql);
    $query->bindParam(':event_id', $event_id, PDO::PARAM_INT);
    $query->execute();
    $current_count = $query->fetchColumn();

    // Calculate total participants after adding new ones
    $total_participants = $current_count + $num_participants;

    // Validate the number of participants
    if ($total_participants < $min_participants) {
        echo "<script>alert('Participants must be at least $min_participants.'); window.location.href='addparticipants.php';</script>";
        exit;
    } 
    if ($total_participants > $max_participants) {
        echo "<script>alert('Participants cannot exceed $max_participants.'); window.location.href='addparticipants.php';</script>";
        exit;
    }

    // Insert participants into the database
    $stmt = $dbh->prepare("INSERT INTO participants (event_id, dept_id, student_id) VALUES (?, ?, ?)");
    foreach ($student_ids as $student_id) {
        if (!empty($student_id)) {
            $stmt->execute([$event_id, $dept_id, $student_id]);
        }
    }
    echo "<script>alert('Participants added successfully!'); window.location.href='addparticipants.php';</script>";
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
    /* General Styling */
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background: #f8f9fa;
        text-align: center;
    }

    .container {
        width: 50%;
        margin: auto;
        background: white;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
    }

    /* Label */
    label {
        font-weight: bold;
        display: block;
        text-align: left;
        margin-bottom: 5px;
    }

    /* Dropdown */
    select {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 16px;
    }

    /* Participant Entry */
    .participant-entry {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 10px;
        margin-top: 10px;
    }

    .participant-entry input {
        width: 60%;
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 16px;
    }

    .add-btn {
        background-color: #007bff;
        color: white;
        border: none;
        cursor: pointer;
        font-size: 18px;
        padding: 5px 12px;
        border-radius: 5px;
    }

    .add-btn:hover {
        background-color: #0056b3;
    }

    /* Add Participants Button */
    .submit-btn {
        background-color: #234a9c;
        color: white;
        padding: 10px;
        border: none;
        cursor: pointer;
        margin-top: 15px;
        width: 80%;
        font-size: 16px;
        border-radius: 5px;
    }

    .submit-btn:hover {
        background-color: #1a3573;
    }

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

    /* Responsive */
    @media screen and (max-width: 768px) {
        .container {
            width: 90%;
        }

        .participant-entry {
            flex-direction: column;
        }

        .participant-entry input {
            width: 100%;
        }

        .submit-btn {
            width: 100%;
        }
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
        
        <h1>ULSC - Add Participants</h1>

        <div class="logo">
            <img src="../assets/images/ulsc.png" alt="ULSC Logo">
        </div>

        <div class="dropdown">
            <button class="dropdown-trigger">
                <?php echo "$ulsc_name - $dept_name"; ?> <i class="fas fa-caret-down"></i>
            </button>
            <div class="dropdown-menu">
                <a href="#" class="dropdown-item"><i class="fas fa-user"></i> My Profile</a>
                <hr>
                <a href="ulsc_logout.php" class="dropdown-item"><i class="fas fa-sign-out-alt"></i> Sign-Out</a>
            </div>
        </div>
    </header>

    <main>
        <section>
            
            <!-- Add Participant Form (As it was) -->
            <form action="addparticipants.php" method="POST">
        <label for="eventSelect">Select Event:</label>
        <select id="eventSelect" name="event" onchange="showParticipantsForm()" required>
        <option value="">Select Event...</option>
        <?php foreach ($events as $event) : ?>
            <option value="<?= $event['id']; ?>"><?= htmlspecialchars($event['event_name']); ?></option>
        <?php endforeach; ?>
        </select>

        <div id="participantsContainer" style="display:none; margin-top: 15px;">

            <input type="hidden" id="minParticipants" name="minParticipants" value="">
            <input type="hidden" id="maxParticipants" name="maxParticipants" value="">
            <label>Enter Participant IDs:</label>
            <div id="participantFields">
                <div class="participant-entry">
                    <input type="text" name="student_id[]" placeholder="Enter Student ID" required>
                    <button type="button" class="add-btn" onclick="addParticipantField()">+</button><br>
                </div>
            </div>
        </div>

        <button type="submit" class="submit">Add Participants</button>
    </form>

    </main>

    <script>
        function openNav() {
        document.getElementById("mySidenav").classList.add("open");
    }
    function closeNav() {
        document.getElementById("mySidenav").classList.remove("open");
    }
    document.addEventListener("click", function(event) {
        var sidebar = document.getElementById("mySidenav");
        var sidebarButton = document.querySelector("span[onclick='openNav()']");

        // Check if the click is outside the sidebar and not on the open button
        if (!sidebar.contains(event.target) && !sidebarButton.contains(event.target)) {
            closeNav();
        }
    });
    
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

function showParticipantsForm() {
    var eventSelect = document.getElementById("eventSelect");
    var participantsContainer = document.getElementById("participantsContainer");

    if (eventSelect.value !== "") {
        participantsContainer.style.display = "block";
    } else {
        participantsContainer.style.display = "none";
    }
}

function addParticipantField() {
    var container = document.getElementById("participantFields");

    var newDiv = document.createElement("div");
    newDiv.classList.add("participant-entry");

    var newInput = document.createElement("input");
    newInput.type = "text";
    newInput.name = "student_id[]";
    newInput.placeholder = "Enter Student ID";
    newInput.required = true;

    var removeBtn = document.createElement("button");
    removeBtn.type = "button";
    removeBtn.innerHTML = "-";
    removeBtn.classList.add("remove-btn");
    removeBtn.onclick = function () {
        container.removeChild(newDiv);
    };

    newDiv.appendChild(newInput);
    newDiv.appendChild(removeBtn);
    container.appendChild(newDiv);
    }

    function fetchEventLimits() {
    var eventId = document.getElementById("eventSelect").value;
    if (eventId !== "") {
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "fetch_event_limits.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                var response = JSON.parse(xhr.responseText);
                if (response.success) {
                    document.getElementById("minParticipants").value = response.minParticipants;
                    document.getElementById("maxParticipants").value = response.maxParticipants;
                    document.getElementById("participantsContainer").style.display = "block";
                }
            }
        };
        xhr.send("event_id=" + eventId);
    } else {
        document.getElementById("participantsContainer").style.display = "none";
    }
}



</script>


    <footer>
        <p>&copy; 2025 ULSC Dashboard. All Rights Reserved.</p>
    </footer>
</body>

</html>