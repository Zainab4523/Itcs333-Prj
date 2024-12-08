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
                echo '<td><a href="room_details.php?id=' . $room['room_id'] . '">View Details</a></td>';
                echo '</tr>';
            }
            ?>
        </tbody>
        </table>
</body>
</html>