<?php
include 'db/connection.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Room ID is required.");
}

$room_id = intval($_GET['id']); 


$sql_room = "SELECT * FROM rooms WHERE room_id = ?";
$stmt = mysqli_prepare($conn, $sql_room);
if ($stmt === false) {
    die("Failed to prepare statement: " . mysqli_error($conn));
}
mysqli_stmt_bind_param($stmt, 'i', $room_id);
mysqli_stmt_execute($stmt);
$result_room = mysqli_stmt_get_result($stmt);

if ($result_room === false || mysqli_num_rows($result_room) == 0) {
    die("Room not found.");
}

$room = mysqli_fetch_assoc($result_room);

$sql_timeslots = "SELECT * FROM timeslots WHERE room_id = ? AND is_available = TRUE";
$stmt = mysqli_prepare($conn, $sql_timeslots);
if ($stmt === false) {
    die("Failed to prepare statement: " . mysqli_error($conn));
}
mysqli_stmt_bind_param($stmt, 'i', $room_id);
mysqli_stmt_execute($stmt);
$result_timeslots = mysqli_stmt_get_result($stmt);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room Details</title>
</head>
<body>
    <h1><?php echo isset($room['name']) ? $room['name'] : 'Room Name Not Found'; ?></h1>
    <p><strong>Description:</strong> 
    <?php 
    if (!empty($room['description'])) {
        echo $room['description'];
    } else {
        echo 'No description available.';
    }
    ?>
    </p>

    <p><strong>Capacity:</strong> 
    <?php 
    if (!empty($room['capacity'])) {
        echo $room['capacity'];
    } else {
        echo 'Not specified.';
    }
    ?>
    </p>

    <p><strong>Equipment:</strong> 
    <?php 
    if (!empty($room['equipment'])) {
        echo $room['equipment'];
    } else {
        echo 'None';
    }
    ?>
    </p>

    <h2>Available Timeslots</h2>
    <ul>
        <?php
        if ($result_timeslots && mysqli_num_rows($result_timeslots) > 0) {
            while ($timeslot = mysqli_fetch_assoc($result_timeslots)) {
                echo '<li>' . $timeslot['start_time'] . ' - ' . $timeslot['end_time'] . '</li>';
            }
        } else {
            echo '<p>No available timeslots.</p>';
        }
        ?>
    </ul>
    <a href="browse_rooms.php">Back to Room List</a>
</body>
</html>