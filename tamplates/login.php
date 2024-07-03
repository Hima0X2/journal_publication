<?php
session_start();
include 'db.php';

if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    $sql = "SELECT * FROM user WHERE username = ?";
    $stmt = $conn->prepare($sql);

    // Check if the prepare() method failed
    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Verify the password
        if (password_verify($password, $row['pass'])) {
            // Login successful, set session variables
            $_SESSION['username'] = $username;
            header('Location: dashboard.html');
            exit;
        } else {
            echo '<script>alert("Invalid password. Please try again.");</script>';
            echo '<script>window.location.href = "login.html";</script>';
        }
    } else {
        echo '<script>alert("Invalid username. Please try again.");</script>';
        echo '<script>window.location.href = "login.html";</script>';
    }

    // Close connection
    $stmt->close();
    $conn->close();
} else {
    echo '<script>alert("Please enter both username and password.");</script>';
    echo '<script>window.location.href = "login.html";</script>';
}
?>
