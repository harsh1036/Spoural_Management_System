<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Spoural Management System</title>
    <link rel="stylesheet" href="../assets/css/style.css">

</head>

<body>
    <div class="container">
        <header>
            <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; </span>
            <!-- SIDE BAR -->
            <div id="mySidenav" class="sidenav">
                <span class="closebtn" onclick="closeNav()">&times;</span>
                <br><br>
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
                <a href="admindashboard.php">
                    <img src="../assets/images/charusat.png" alt="Logo 1">
                </a>

            </div>
            <h1>Spoural Event Management System</h1>

            <div class="logo">

                <img src="../assets/images/ulsc.png" alt="Logo 2">
            </div>

            <!--LOGOUT-->
            <div class="dropdown">
                <button class="dropdown-trigger">
                    Harsh <i class="fas fa-caret-down"></i>
                </button>
                <div class="dropdown-menu">
                    <a href="#" class="dropdown-item">
                        <i class="fas fa-user"></i> My Profile
                    </a>

                    <hr>
                    <a href="#" class="dropdown-item">
                        <a href="ulsc_logout.php" class="dropdown-item"><i class="fas fa-sign-out-alt"></i> Sign-Out</a>
                    </a>
                </div>
            </div>
        </header>
        <main>
            <?php
            session_start();
            include('../includes/config.php');

            // **INSERT EVENT**
            if (isset($_POST['add_event'])) {
                $event_name = $_POST['event_name'];
                $event_type = $_POST['event_type'];

                $sql = "INSERT INTO events (event_name, event_type) VALUES (:event_name, :event_type)";
                $query = $dbh->prepare($sql);
                $query->bindParam(':event_name', $event_name, PDO::PARAM_STR);
                $query->bindParam(':event_type', $event_type, PDO::PARAM_STR);

                if ($query->execute()) {
                    echo "<script>alert('Event Added Successfully'); window.location.href='addevent.php';</script>";
                } else {
                    echo "<script>alert('Failed to Add Event');</script>";
                }
            }

            // **DELETE EVENT**
            if (isset($_GET['delete_id'])) {
                $id = $_GET['delete_id'];

                $sql = "DELETE FROM events WHERE id = :id";
                $query = $dbh->prepare($sql);
                $query->bindParam(':id', $id, PDO::PARAM_INT);

                if ($query->execute()) {
                    echo "<script>alert('Event Deleted Successfully'); window.location.href='addevent.php';</script>";
                } else {
                    echo "<script>alert('Failed to Delete Event');</script>";
                }
            }

            // **EDIT EVENT**
            if (isset($_POST['edit_event'])) {
                $id = $_POST['event_id'];
                $event_name = $_POST['event_name'];
                $event_type = $_POST['event_type'];

                $sql = "UPDATE events SET event_name = :event_name, event_type = :event_type WHERE id = :id";
                $query = $dbh->prepare($sql);
                $query->bindParam(':id', $id, PDO::PARAM_INT);
                $query->bindParam(':event_name', $event_name, PDO::PARAM_STR);
                $query->bindParam(':event_type', $event_type, PDO::PARAM_STR);

                if ($query->execute()) {
                    echo "<script>alert('Event Updated Successfully'); window.location.href='addevent.php';</script>";
                } else {
                    echo "<script>alert('Failed to Update Event');</script>";
                }
            }

            // **FETCH ALL EVENTS**
            $sql = "SELECT * FROM events";
            $query = $dbh->prepare($sql);
            $query->execute();
            $events = $query->fetchAll(PDO::FETCH_ASSOC);
            ?>
            <form method="post" action="addevent.php">
                <label>Event Name:</label>
                <input type="text" name="event_name" required>

                <label>Event Type:</label>
                <input type="radio" name="event_type" value="Sports" required> Sports
                <input type="radio" name="event_type" value="Cultural" required> Cultural

                <button type="submit" name="add_event">Add Event</button>
            </form>

            <table border="2px">
                <thead>
                    <tr>
                        <th>Event Id</th>
                        <th>Event Name</th>
                        <th>Event Type</th>
                        <th>Edit</th>
                        <th>Remove</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($events as $event) { ?>
                        <tr>
                            <td><?php echo $event['id']; ?></td>
                            <td><?php echo $event['event_name']; ?></td>
                            <td><?php echo $event['event_type']; ?></td>
                            <td>
                                <form method="post" action="addevent.php">
                                    <input type="hidden" name="event_id" value="<?php echo $event['id']; ?>">
                                    <input type="text" name="event_name" value="<?php echo $event['event_name']; ?>"
                                        required>
                                    <input type="radio" name="event_type" value="Sports" <?php echo ($event['event_type'] == 'Sports') ? 'checked' : ''; ?>> Sports
                                    <input type="radio" name="event_type" value="Cultural" <?php echo ($event['event_type'] == 'Cultural') ? 'checked' : ''; ?>> Cultural
                                    <button type="submit" name="edit_event">Update</button>
                                </form>
                            </td>
                            <td><a href="addevent.php?delete_id=<?php echo $event['id']; ?>"
                                    onclick="return confirm('Are you sure you want to delete this event?');">Delete</a></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>

        </main>
    </div>
    <!--SIDEBAR JAVASCRIPT-->
    <script>

        function openNav() {
            document.getElementById("mySidenav").style.width = "250px";
            document.querySelector(".main-content").style.marginLeft = "250px";
        }
        function closeNav() {
            document.getElementById("mySidenav").style.width = "0";
            document.querySelector(".main-content").style.marginLeft = "0";
        }



    </script>

</body>

</html>