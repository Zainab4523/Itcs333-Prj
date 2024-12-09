<?php
session_start();
include 'db/connection.php';

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Initialize error message variable
$error_message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $md5_pass = md5($password);
    $gender = $_POST['gender'];
    $birthday = $_POST['birthday'];

    // Set default profile picture
    $profile_picture = 'no_picture.png';
    $upload_dir = "uploads/";

    // Check if the upload directory exists, if not, create it
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    // Handle file upload if a file is provided
    if (!empty($_FILES['profile_picture']['name'])) {
        $profile_picture = $_FILES['profile_picture']['name'];
        if ($_FILES['profile_picture']['error'] == UPLOAD_ERR_OK) {
            move_uploaded_file($_FILES['profile_picture']['tmp_name'], $upload_dir . $profile_picture);
        } else {
            $error_message = "File upload error: " . $_FILES['profile_picture']['error'];
        }
    }

    // Email validation
    $regex = '/@uob\.edu\.bh$/';
    if (!preg_match($regex, $email)) {
        $error_message = "Invalid email format. Please use the format: XXXXXX@uob.edu.bh";
    } else {
        // Prepare and execute SQL Insert
        $sql = "INSERT INTO users (username, email, password, md5_pass, gender, birthday, profile_picture) 
                VALUES ('$username', '$email', '$password', '$md5_pass', '$gender', '$birthday', '$profile_picture')";

        // Debugging output
        echo "Inserting User: Username: $username, Email: $email, Password: $md5_pass, Profile Picture: $profile_picture<br>";

        if (!mysqli_query($conn, $sql)) {
            $error_message = "SQL Error: " . mysqli_error($conn);
        } else {
            header("Location: login.php");
            exit();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="pico-main/css/pico.min.css">
    <title>User Registration</title>
    <style>
        body {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh; 
        }

        fieldset {
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px white;
            width: 600px; 
        }

        h1 {
            text-align: center;  
            margin-bottom: 20px;
        }

        .error {
            color: red; /* Style for error message */
            margin-bottom: 15px; /* Space below the message */
        }
    </style>
</head>
<body>
    <h1>Register</h1>
    <fieldset class="grid">
        <?php if ($error_message): ?>
            <p class="error"><?php echo $error_message; ?></p>
        <?php endif; ?>
        <form action="register.php" method="POST" enctype="multipart/form-data">
            <input type="text" name="username" placeholder="Username" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="date" name="birthday" required>
            <select name="gender" required>
                <option value="male">Male</option>
                <option value="female">Female</option>
            </select>
            <input type="file" name="profile_picture">
            <button type="submit">Register</button>
        </form>
    </fieldset>
</body>
</html>