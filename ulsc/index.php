<?php
session_start();
<<<<<<< HEAD
include('includes/config.php'); // Include database connection

$error = "";

// **LOGIN ULSC**
=======
include('../includes/config.php');

$error = "";

>>>>>>> 8244d27 (Download PDF)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ulsc_id = $_POST['ulsc_id'];
    $password = $_POST['password'];

<<<<<<< HEAD
    $sql = "SELECT * FROM ulsc WHERE ulsc_id = :ulsc_id";
=======
    $sql = "SELECT ulsc_id, ulsc_name, dept_id, password FROM ulsc WHERE ulsc_id = :ulsc_id";
>>>>>>> 8244d27 (Download PDF)
    $query = $dbh->prepare($sql);
    $query->bindParam(':ulsc_id', $ulsc_id, PDO::PARAM_STR);
    $query->execute();
    $user = $query->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['ulsc_id'] = $user['ulsc_id'];
        $_SESSION['ulsc_name'] = $user['ulsc_name'];
<<<<<<< HEAD
        echo "<script>window.location.href='pages/ulsc_dashboard.php';</script>";
=======
        $_SESSION['dept_id'] = $user['dept_id'];
        $_SESSION['dept_name'] = $user['dept_name']; // Store department ID
         // Store department ID

        header("Location: viewevents.php"); 
>>>>>>> 8244d27 (Download PDF)
        exit;
    } else {
        $error = "Invalid ULSC ID or Password!";
    }
}
?>
<<<<<<< HEAD
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ULSC Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(to right, #1e3c72, #2a5298);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-container {
            background: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }

        .login-container h3 {
            text-align: center;
            margin-bottom: 1.5rem;
        }

        .form-control {
            border-radius: 20px;
        }

        .btn-primary {
            border-radius: 20px;
            background: #2a5298;
            border: none;
        }

        .btn-primary:hover {
            background: #1e3c72;
=======

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ULSC Login - Spoural Management System</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        body {
            background: linear-gradient(to right, #4A90E2, #007AFF); 
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
        }
        .login-container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
            width: 320px;
            text-align: center;
        }
        .login-container h2 {
            margin-bottom: 20px;
            color: #333;
        }
        .login-container input {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }
        .login-container button {
            width: 100%;
            padding: 10px;
            background: #007AFF;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 18px;
            cursor: pointer;
            transition: 0.3s;
        }
        .login-container button:hover {
            background: #005ecb;
>>>>>>> 8244d27 (Download PDF)
        }
        .error {
            color: red;
            margin-bottom: 10px;
        }
    </style>
</head>
<<<<<<< HEAD

<body>
   
<div class="login-container">
        <h2>ULSC Login</h2>
        
        <?php if ($error) { ?>
            <p class="error"><?php echo $error; ?></p>
        <?php } ?>
        <form method="POST">
            <input type="text" name="ulsc_id" placeholder="Enter ULSC ID" required>
            <input type="password" name="password" placeholder="Enter Password" required>
            <button type="submit" name="login">Login</button>
        </form>
    </div>
</body>

</html>
=======
<body>

    <div class="login-container">
        <h2>ULSC Login</h2>

        <?php if ($error) { ?>
            <p class="error"><?php echo $error; ?></p>
        <?php } ?>

        <form method="POST" action="ulsc_login.php">
            <input type="text" name="ulsc_id" placeholder="Enter ULSC ID" required>
            <input type="password" name="password" placeholder="Enter Password" required>
            <button type="submit">Login</button>
        </form>
    </div>

</body>
</html>
>>>>>>> 8244d27 (Download PDF)
