<?php
session_start();
include 'db/connection.php';

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

$user_email = $_SESSION['email'];

// Fetch all available timeslots
$sql_user_booking = "SELECT b.booking_id, r.name AS room_name, t.start_time, t.end_time 
                      FROM booking b
                      JOIN rooms r ON b.room_id = r.room_id
                      JOIN timeslots t ON b.timeslot_id = t.timeslot_id
                      WHERE b.user_email = ?";
$stmt_user_booking = mysqli_prepare($conn, $sql_user_booking);
mysqli_stmt_bind_param($stmt_user_booking, 's', $user_email);
mysqli_stmt_execute($stmt_user_booking);
$result_user_booking = mysqli_stmt_get_result($stmt_user_booking);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="pico-main/css/pico.min.css">
    <title>Your Bookings</title>
    <style>
        .notification {
            margin: 1rem auto;
            padding: 1rem;
            max-width: 600px;
            text-align: center;
        }
        .success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
    </style>
</head>
<body>

    <style>
        .notification {
            margin: 1rem auto;
            padding: 1rem;
            max-width: 600px;
            text-align: center;
        }
        .success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
    </style>

    <main>
        <!-- Display success or error messages -->
        <?php
        if (isset($_SESSION['success_message'])) {
            echo "<div class='notification success'>{$_SESSION['success_message']}</div>";
            unset($_SESSION['success_message']);
        }
        if (isset($_SESSION['error_message'])) {
            echo "<div class='notification error'>{$_SESSION['error_message']}</div>";
            unset($_SESSION['error_message']);
        }
        ?>

    <h2>Your Bookings</h2>
    <ul>
    <?php if (mysqli_num_rows($result_user_booking) > 0) { ?>
        <ul>
            <?php while ($booking = mysqli_fetch_assoc($result_user_booking)) { ?>
                <li>
                    <strong><?php echo $booking['room_name']; ?></strong><br>
                    <p>Time: <?php echo $booking['start_time'] . ' - ' . $booking['end_time']; ?></p>
                    <form action="cancel_booking.php" method="POST">
                        <input type="hidden" name="booking_id" value="<?php echo $booking['booking_id']; ?>">
                        <button type="submit">Cancel Booking</button>
                    </form>
                </li>
            <?php } ?>
        </ul>
    <?php } else { ?>
        <p>You have no bookings yet.</p>
    <?php } ?>
    </main>
</body>
</html>
