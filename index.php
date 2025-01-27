<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$username = htmlspecialchars($_SESSION['username']);

// Mock remaining leave days for demonstration
$remaining_leave_days = 12; // Replace with dynamic data if needed
$total_leave_days = 20;
?>
