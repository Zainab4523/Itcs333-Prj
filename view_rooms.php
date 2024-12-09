<?php
session_start();
include 'db/connection.php';

// check the user info 
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

$email = $_SESSION['email'];
$sql = "SELECT * FROM users WHERE email='$email'";
$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($result);

$profile_picture = !empty($user['profile_picture']) ? "uploads/" . $user['profile_picture'] : "uploads/no_picture.png"; 
// Fetch all rooms
$sql = "SELECT * FROM rooms";
$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Database query failed: " . mysqli_error($conn));
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="pico-main/css/pico.min.css">
    <title>Room Browsing</title>
    <style>
        nav {
            background-color: #080F2D; 
            padding: 15px;
            border-radius: 20px;
            margin-bottom: 20px;
            text-align: center; 
            display: flex; 
            align-items: center;
        }
        

    </style>

</head>
<body>
    <nav style="text-align: center; margin-bottom: 20px;">
        <img src="<?php echo htmlspecialchars($profile_picture); ?>" alt="Profile Picture" style="width: 100px; height: 100px; border-radius: 50%; margin-bottom: 10px;">
        <h2><a href="profile.php" style="text-decoration: none; color: inherit;">Go to Your Profile</a></h2>
        <p><strong>Username:</strong> <?php echo htmlspecialchars($user['username']); ?></p>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
    </nav>

    <h1 style="text-align:center;">Rooms</h1>
    <table class="striped">
        <thead>
            <tr>
                <th>Name</th>
                <th>Capacity</th>
                <th>Equipment</th>
                <th>Details</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($room = mysqli_fetch_assoc($result)) {
                echo '<tr>';
                echo '<td>' . htmlspecialchars($room['name']) . '</td>';
                echo '<td>' . htmlspecialchars($room['capacity']) . '</td>';
                echo '<td>' . (!empty($room['equipment']) ? htmlspecialchars($room['equipment']) : 'None') . '</td>';
                echo '<td><a href="rooms_details.php?id=' . $room['room_id'] . '">View Details</a></td>';
                echo '</tr>';
            }
            ?>
        </tbody>
        </table> 


        <div style="text-align: center; margin-top: 20px;">
        <a href="booking_interface.php" style="padding: 10px 20px; background-color: #1843ad; color: white; text-decoration: none; border-radius: 5px;">
            Your Bookings
        </a>
        </div>

</body>
</html>