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

$profile_picture = !empty($user['profile_picture']) ? "uploads/" . $user['profile_picture'] : "uploads/no_picture.png"; // Path to your no-picture icon
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="pico-main/css/pico.min.css">
    <title>User Profile</title>
    <style>
        body {
            display: flex;
            flex-direction: column;
            align-items: center; 
            justify-content: center; 
        }
        h1 {
          --pico-font-family: Pacifico, cursive;
          --pico-font-weight: 400;
          --pico-typography-spacing-vertical: 0.5rem;
        }

        img {
            border-radius: 50%;
            margin-bottom: 1rem;
        }

       
    fieldset {
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px white;
            width: 600px;            
        }

    </style>
</head>
<body>

    <h1>User Profile</h1>
    <img src="<?php echo $profile_picture; ?>" alt="Profile Picture" width="150" height="150">
    <fieldset class="grid">
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
        <div role="button" tabindex="0" style="background-color:white;">
        <a href="logout.php" >Logout</a>
        </div>
    </form>
</fieldset>

</body>
</html>