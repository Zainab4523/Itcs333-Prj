<?php
session_start();
include 'db/connection.php';

// Check if user is logged in
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

$email = $_SESSION['email'];
$sql = "SELECT * FROM users WHERE email='$email'";
$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($result);

$profile_picture = !empty($user['profile_picture']) ? "uploads/" . $user['profile_picture'] : "uploads/no_picture.png"; // Default picture path

// Fetch all rooms
$sql_rooms = "SELECT * FROM rooms";
$result_rooms = mysqli_query($conn, $sql_rooms);

if (!$result_rooms) {
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
</head>
<body>
    <div style="text-align: center; margin-bottom: 20px;">
    <h2><a href="profile.php" style="text-decoration: none; color: inherit;">Your Profile</a></h2>
        <img src="<?php echo htmlspecialchars($profile_picture); ?>" alt="Profile Picture" style="width: 80px; height: 80px; border-radius: 50%; margin-bottom: 10px;">
        <p><strong>Username:</strong> <?php echo htmlspecialchars($user['username']); ?></p>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
    </div>

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
            while ($room = mysqli_fetch_assoc($result_rooms)) {
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