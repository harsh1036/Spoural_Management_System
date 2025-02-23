<?php
session_start();
include('../includes/config.php');

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ulsc_id = $_POST['ulsc_id'];
    $password = $_POST['password'];

    $sql = "SELECT ulsc_id, ulsc_name, dept_id, password FROM ulsc WHERE ulsc_id = :ulsc_id";
    $query = $dbh->prepare($sql);
    $query->bindParam(':ulsc_id', $ulsc_id, PDO::PARAM_STR);
    $query->execute();
    $user = $query->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['ulsc_id'] = $user['ulsc_id'];
        $_SESSION['ulsc_name'] = $user['ulsc_name'];
        $_SESSION['dept_id'] = $user['dept_id'];
        $_SESSION['dept_name'] = $user['dept_name']; // Store department ID
         // Store department ID
        header("Location: ulsc_dashboard.php"); 
        exit;
    } else {
        $error = "Invalid ULSC ID or Password!";
    }
}
?>

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
        }
        .error {
            color: red;
            margin-bottom: 10px;
        }
    </style>
</head>
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
