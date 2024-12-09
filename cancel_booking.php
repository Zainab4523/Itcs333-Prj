<?php
session_start();
include 'db/connection.php';

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $booking_id = intval($_POST['booking_id']);
    $user_email = $_SESSION['email'];

    // Begin a transaction
    mysqli_begin_transaction($conn);

    try {
        // Check if the booking exists and belongs to the user
        $sql_check = "SELECT * FROM booking WHERE booking_id = ? AND user_email = ?";
        $stmt_check = mysqli_prepare($conn, $sql_check);
        mysqli_stmt_bind_param($stmt_check, 'is', $booking_id, $user_email);
        mysqli_stmt_execute($stmt_check);
        $result_check = mysqli_stmt_get_result($stmt_check);

        if (mysqli_num_rows($result_check) > 0) {
            $booking = mysqli_fetch_assoc($result_check);
            $timeslot_id = $booking['timeslot_id'];

            // Delete the booking from the bookings table
            $sql_delete = "DELETE FROM booking WHERE booking_id = ?";
            $stmt_delete = mysqli_prepare($conn, $sql_delete);
            mysqli_stmt_bind_param($stmt_delete, 'i', $booking_id);

            if (mysqli_stmt_execute($stmt_delete)) {
                // Mark the timeslot as available again
                $sql_update = "UPDATE timeslots SET is_available = TRUE WHERE timeslot_id = ?";
                $stmt_update = mysqli_prepare($conn, $sql_update);
                mysqli_stmt_bind_param($stmt_update, 'i', $timeslot_id);
                
                if (mysqli_stmt_execute($stmt_update)) {
                    // Commit the transaction
                    mysqli_commit($conn);

                    // Redirect with success message
                    header("Location: booking_interface.php?status=success");
                    exit();
                } else {
                    throw new Exception("Error updating the timeslot.");
                }
            } else {
                throw new Exception("Error cancelling booking.");
            }
        } else {
            throw new Exception("Booking not found or unauthorized cancellation attempt.");
        }
    } catch (Exception $e) {
        // Rollback the transaction on error
        mysqli_rollback($conn);
        
        // Redirect with error message
        header("Location: booking_interface.php?status=error&message=" . urlencode($e->getMessage()));
        exit();
    }
}
?>
