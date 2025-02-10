<?php
session_start();
include('../includes/config.php'); // Include database connection

$message = "";

// **INSERT ULSC MEMBER**
if (isset($_POST['add_ulsc'])) {
    $ulsc_name = $_POST['ulsc_name'];
    $ulsc_id = $_POST['ulsc_id'];
    $dept_id = $_POST['dept_id'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash password

    $sql = "INSERT INTO ulsc (ulsc_id, ulsc_name, dept_id, password) VALUES (:ulsc_id, :ulsc_name, :dept_id, :password)";
    $query = $dbh->prepare($sql);
    $query->bindParam(':ulsc_id', $ulsc_id, PDO::PARAM_STR);
    $query->bindParam(':ulsc_name', $ulsc_name, PDO::PARAM_STR);
    $query->bindParam(':dept_id', $dept_id, PDO::PARAM_INT);
    $query->bindParam(':password', $password, PDO::PARAM_STR);

    if ($query->execute()) {
        $message = "ULSC member added successfully!";
    } else {
        $message = "Failed to add ULSC member.";
    }
}

// **UPDATE ULSC MEMBER**
if (isset($_POST['edit_ulsc'])) {
    $ulsc_id = $_POST['ulsc_id'];
    $ulsc_name = $_POST['ulsc_name'];
    $dept_id = $_POST['dept_id'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "UPDATE ulsc SET ulsc_name = :ulsc_name, dept_id = :dept_id, password = :password WHERE ulsc_id = :ulsc_id";
    $query = $dbh->prepare($sql);
    $query->bindParam(':ulsc_id', $ulsc_id, PDO::PARAM_STR);
    $query->bindParam(':ulsc_name', $ulsc_name, PDO::PARAM_STR);
    $query->bindParam(':dept_id', $dept_id, PDO::PARAM_INT);
    $query->bindParam(':password', $password, PDO::PARAM_STR);

    if ($query->execute()) {
        $message = "ULSC member updated successfully!";
    } else {
        $message = "Failed to update ULSC member.";
    }
}

// **DELETE ULSC MEMBER**
if (isset($_GET['delete_id'])) {
    $ulsc_id = $_GET['delete_id'];

    $sql = "DELETE FROM ulsc WHERE ulsc_id = :ulsc_id";
    $query = $dbh->prepare($sql);
    $query->bindParam(':ulsc_id', $ulsc_id, PDO::PARAM_STR);

    if ($query->execute()) {
        $message = "ULSC member deleted successfully!";
    } else {
        $message = "Failed to delete ULSC member.";
    }
}

// **FETCH ALL ULSC MEMBERS**
$sql = "SELECT * FROM ulsc";
$query = $dbh->prepare($sql);
$query->execute();
$ulsc_members = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Spoural Management System - ULSC</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <div class="container">
    <header>
            <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; </span>
            <!-- SIDE BAR -->
            <div id="mySidenav" class="sidenav">
                <span class="closebtn" onclick="closeNav()">&times;</span>
                <br><Br>
                <br><br>
                <a href="admindashboard.php">Dashboard</a>
                <br>
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
                        <i class="fas fa-sign-out-alt"></i> Sign-Out
                    </a>
                </div>
            </div>
        </header>

        <main>
            <section>
                <h2>Add ULSC Member</h2>
                <form method="POST" action="addulsc.php">
                    <label>ULSC Name:</label>
                    <input type="text" name="ulsc_name" required>
                    <label>ULSC ID:</label>
                    <input type="text" name="ulsc_id" required>
                    <label>Department ID:</label>
                    <input type="text" name="dept_id" required>
                    <label>Password:</label>
                    <input type="password" name="password" required>
                    <button type="submit" name="add_ulsc">Add ULSC</button>
                </form>
            </section>

            <section>
                <h2>View ULSC Members</h2>
                <table border="2px">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>ULSC ID</th>
                            <th>ULSC Name</th>
                            <th>Department ID</th>
                            <th>Edit</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($ulsc_members as $ulsc) { ?>
                            <tr>
                                <td><?php echo $ulsc['id']; ?></td>
                                <td><?php echo htmlspecialchars($ulsc['ulsc_id']); ?></td>
                                <td><?php echo htmlspecialchars($ulsc['ulsc_name']); ?></td>
                                <td><?php echo htmlspecialchars($ulsc['dept_id']); ?></td>
                                <td>
                                    <form method="POST" action="addulsc.php">
                                        <input type="hidden" name="ulsc_id" value="<?php echo $ulsc['ulsc_id']; ?>">
                                        <input type="text" name="ulsc_name" value="<?php echo $ulsc['ulsc_name']; ?>" required>
                                        <input type="text" name="dept_id" value="<?php echo $ulsc['dept_id']; ?>" required>
                                        <input type="password" name="password" placeholder="New Password">
                                        <button type="submit" name="edit_ulsc">Update</button>
                                    </form>
                                </td>
                                <td>
                                    <a href="addulsc.php?delete_id=<?php echo $ulsc['ulsc_id']; ?>" 
                                       onclick="return confirm('Are you sure you want to delete this ULSC member?');">
                                        Delete
                                    </a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </section>
        </main>
    </div>

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
