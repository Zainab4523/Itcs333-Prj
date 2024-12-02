<?php
session_start();
include('db/connection.php');
session_unset();
session_destroy();
header('location:index.php');
?>