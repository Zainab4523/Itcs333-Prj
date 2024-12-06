<?php
include 'db/connection.php';

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
</head>
<body>
    <h1>Rooms</h1>
    <a href="profile.php">Profile</a>
    <ul>
        <?php
        while ($room = mysqli_fetch_assoc($result)) {
            echo '<li>';
            echo '<h2>' . $room['name'] . '</h2>';
            echo '<p>Capacity: ' . $room['capacity'] . '</p>';
            echo '<p>Equipment: ' . (!empty($room['equipment']) ? $room['equipment'] : 'None') . '</p>';
            echo '<a href="room_details.php?id=' . $room['room_id'] . '">View Details</a>';
            echo '</li>';
        }
        ?>
    </ul>
</body>
</html>