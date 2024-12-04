<?php
session_start();
include 'db/connection.php';

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

$email = $_SESSION['email'];
$sql = "SELECT * FROM users WHERE email='$email'";
$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($result);

// Set a default profile picture if none exists
$profile_picture = !empty($user['profile_picture']) ? "uploads/" . $user['profile_picture'] : "uploads/no_picture.png"; // Path to your no-picture icon
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>User Profile</title>
</head>
<body>
<div class="container">
    <h1>User Profile</h1>
    <img src="<?php echo $profile_picture; ?>" alt="Profile Picture" width="150" height="150">
    <form action="update_profile.php" method="POST" enctype="multipart/form-data">
        <input type="text" name="username" value="<?php echo $user['username']; ?>" required>
        <input type="email" name="email" value="<?php echo $user['email']; ?>" readonly>
        <input type="date" name="birthday" value="<?php echo $user['birthday']; ?>" required>
        <select name="gender" required>
            <option value="male" <?php if($user['gender'] == 'male') echo 'selected'; ?>>Male</option>
            <option value="female" <?php if($user['gender'] == 'female') echo 'selected'; ?>>Female</option>
        </select>
        <input type="file" name="profile_picture">
        <button type="submit">Update Profile</button>
    </form>
    <a href="logout.php">Logout</a>
</div>
</body>
</html>