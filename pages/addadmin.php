<?php
session_start();
include('../includes/config.php'); // Include database connection

$message = "";

// **INSERT ADMIN**
if (isset($_POST['add_admin'])) {
    $admin_name = $_POST['admin_name'];
    $admin_id = $_POST['admin_id'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash password

    $sql = "INSERT INTO admins (admin_id, admin_name, password) VALUES (:admin_id, :admin_name, :password)";
    $query = $dbh->prepare($sql);
    $query->bindParam(':admin_id', $admin_id, PDO::PARAM_STR);
    $query->bindParam(':admin_name', $admin_name, PDO::PARAM_STR);
    $query->bindParam(':password', $password, PDO::PARAM_STR);

    if ($query->execute()) {
        $message = "Admin added successfully!";
    } else {
        $message = "Failed to add admin.";
    }
}

// **UPDATE ADMIN**
if (isset($_POST['edit_admin'])) {
    $admin_id = $_POST['admin_id'];
    $admin_name = $_POST['admin_name'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "UPDATE admins SET admin_name = :admin_name, password = :password WHERE admin_id = :admin_id";
    $query = $dbh->prepare($sql);
    $query->bindParam(':admin_id', $admin_id, PDO::PARAM_STR);
    $query->bindParam(':admin_name', $admin_name, PDO::PARAM_STR);
    $query->bindParam(':password', $password, PDO::PARAM_STR);

    if ($query->execute()) {
        $message = "Admin updated successfully!";
    } else {
        $message = "Failed to update admin.";
    }
}

// **DELETE ADMIN**
if (isset($_GET['delete_id'])) {
    $admin_id = $_GET['delete_id'];

    $sql = "DELETE FROM admins WHERE admin_id = :admin_id";
    $query = $dbh->prepare($sql);
    $query->bindParam(':admin_id', $admin_id, PDO::PARAM_STR);

    if ($query->execute()) {
        $message = "Admin deleted successfully!";
    } else {
        $message = "Failed to delete admin.";
    }
}

// **FETCH ALL ADMINS**
$sql = "SELECT * FROM admins";
$query = $dbh->prepare($sql);
$query->execute();
$admins = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Spoural Management System - Admin</title>
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
                        <a href="ulsc_logout.php" class="dropdown-item"><i class="fas fa-sign-out-alt"></i> Sign-Out</a>
                    </a>
                </div>
            </div>
        </header>

        <main>
          

            <section>
                <h2>Add Admin</h2>
                <form method="POST" action="addadmin.php">
                    <label>ADMIN Name:</label>
                    <input type="text" name="admin_name" required>
                    <label>ADMIN ID:</label>
                    <input type="text" name="admin_id" required>
                    <label>PASSWORD:</label>
                    <input type="password" name="password" required>
                    <button type="submit" name="add_admin">Add ADMIN</button>
                </form>
            </section>

            <section>
                <h2>View Admin Details</h2>
                <table border="2px">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Admin ID</th>
                            <th>Admin Name</th>
                           
                            <th>Edit</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($admins as $admin) { ?>
                            <tr>
                            <td><?php echo $admin['id']; ?></td>
                                <td><?php echo htmlspecialchars($admin['admin_id']); ?></td>
                                <td><?php echo htmlspecialchars($admin['admin_name']); ?></td>
            
                                <td>
                                    <form method="POST" action="addadmin.php">
                                        <input type="hidden" name="admin_id" value="<?php echo $admin['admin_id']; ?>">
                                        <input type="text" name="admin_name" value="<?php echo $admin['admin_name']; ?>" required>
                                        <input type="password" name="password" placeholder="New Password">
                                        <button type="submit" name="edit_admin">Update</button>
                                    </form>
                                </td>
                                <td>
                                    <a href="addadmin.php?delete_id=<?php echo $admin['admin_id']; ?>" 
                                       onclick="return confirm('Are you sure you want to delete this admin?');">
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
