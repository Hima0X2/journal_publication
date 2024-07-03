<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if username, email, and password are set
    if (isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password'])) {
        // Sanitize input to prevent SQL injection
        $username = $conn->real_escape_string($_POST['username']);
        $email = $conn->real_escape_string($_POST['email']);
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash password for security

        // SQL query to insert user data into 'user' table
        $sql = "INSERT INTO user (username, email, pass) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);

        // Check if the prepare() method failed
        if ($stmt === false) {
            die("Prepare failed: " . $conn->error);
        }

        $stmt->bind_param("sss", $username, $email, $password);
        
        // Execute the statement and check for success
        if ($stmt->execute()) {
            // Show alert box using JavaScript after successful insertion
            echo '<script>alert("New account created successfully!");</script>';
            // Redirect to login page after showing the alert
            echo '<script>window.location.href = "login.html";</script>';
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "Please fill in all required fields.";
    }
}

// Close connection
$conn->close();
?>
