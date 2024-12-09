<?php
require 'db/connection.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];

    //add room
    if ($action === 'add') {
        $room_name = $_POST['room_name'];
        $capacity = $_POST['capacity'];
        $equipment = $_POST['equipment'];

        $stmt = $conn->prepare("INSERT INTO rooms (name, capacity, equipment) VALUES (?, ?, ?)");
        $stmt->bind_param("sis", $room_name, $capacity, $equipment);

        if ($stmt->execute()) {
            header("Location:admin_panel.php?status=success&msg=Room added successfully");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    }

    //edit room
    else if ($action === 'edit') {
        $room_id = $_POST['room_id'];
        $room_name = $_POST['room_name'];
        $capacity = $_POST['capacity'];
        $equipment = $_POST['equipment'];

        $stmt = $conn->prepare("UPDATE rooms SET room_name = ?, capacity = ?, equipment = ? WHERE room_id = ?");
        $stmt->bind_param("sisi", $room_name, $capacity, $equipment, $room_id);

        if ($stmt->execute()) {
            header("Location:admin_panel.php?status=success&msg=Room updated successfully");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    }

    //delete room
    else if ($action === 'delete') {
        $room_id = $_POST['room_id'];

        $stmt = $conn->prepare("DELETE FROM rooms WHERE room_id = ?");
        $stmt->bind_param("i", $room_id);

        if ($stmt->execute()) {
            header("Location:admin_panel.php?status=success&msg=Room deleted successfully");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    }

    //Invalid action
    else {
        echo "Invalid action!";
    }
}
$conn->close();
?>