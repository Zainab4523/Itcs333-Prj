<?php
session_start();
include 'db/connection.php';

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $md5_pass = md5($password);

    $sql = "SELECT * FROM users WHERE email='$email' AND md5_pass='$md5_pass'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $_SESSION['email'] = $email;
        // Redirect to the profile page upon successful login
        header("Location: profile.php");
        exit();
    } else {
        echo "Invalid email or password!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="pico-main/css/pico.min.css">
    <title>User Login</title>
</head>
<body>
<h1   style="text-align: center;" >Login</h1>
<fieldset class="grid">
    <form action="login.php" method="POST">
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
    </form>
</fieldset>
</body>
</html>