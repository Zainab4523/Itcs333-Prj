<?php
session_start();
include 'db/connection.php';

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $md5_pass = md5($password);
    $gender = $_POST['gender'];
    $birthday = $_POST['birthday'];
    // Prepare and execute SQL Insert
    $sql = "INSERT INTO users (username, email, password, md5_pass, gender, birthday, profile_picture) 
            VALUES ('$username', '$email', '$password', '$md5_pass', '$gender', '$birthday', '$profile_picture')";

    // Debugging output
    echo "Inserting User: Username: $username, Email: $email, Password: $md5_pass, Profile Picture: $profile_picture<br>";

    if (!mysqli_query($conn, $sql)) {
        echo "SQL Error: " . mysqli_error($conn);
    } else {
        header("Location: login.php");
        exit();
    }

    $email = "2020123@stu.uob.edu.bh";
    $regex = '/^\d{7}@stu\.uob\.edu\.bh$/';

if (preg_match($regex, $email)) {
    echo "Valid email.";
} else {
    echo "Invalid email.";
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>User Registration</title>
</head>
<body>

    <h1>Register</h1>
    <form action="register.php" method="POST" enctype="multipart/form-data">
        <input type="text" name="username" placeholder="Username" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="date" name="birthday" required>
        <select name="gender" required>
            <option value="male">Male</option>
            <option value="female">Female</option>
        </select>

        <button type="submit">Register</button>
    </form>

</body>
</html>