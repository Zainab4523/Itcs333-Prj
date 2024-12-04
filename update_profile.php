<?php
session_start();
include 'db/connection.php';

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

$email = $_SESSION['email'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $birthday = $_POST['birthday'];
    $gender = $_POST['gender'];
    $profile_picture = $_FILES['profile_picture']['name'];
    $upload_dir = "uploads/";

    $sql = "UPDATE users SET username='$username', birthday='$birthday', gender='$gender'";

    if (!empty($profile_picture)) {
        move_uploaded_file($_FILES['profile_picture']['tmp_name'], $upload_dir . $profile_picture);
        $sql .= ", profile_picture='$profile_picture'";
    }

    $sql .= " WHERE email='$email'";

    if (mysqli_query($conn, $sql)) {
        echo "Profile updated successfully!";
        header("Location: profile.php");
        exit();
    } else {
        echo "Error updating profile: " . mysqli_error($conn);
    }
}
?>