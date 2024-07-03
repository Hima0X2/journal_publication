<?php
session_start();
$username = $_POST['username'];
$password = $_POST['password'];

$adminUsername = 'samanta';
$adminPassword = 'samanta';

if ($username === $adminUsername && $password === $adminPassword) {
    header('Location: admin_dashboard.html');
    exit;
} else {
    echo '<script>alert("Invalid username or password. Please try again.");</script>';
        echo '<script>window.location.href = "admin.html";</script>';
        exit();
    header('Location: admin.html');
}
?>
