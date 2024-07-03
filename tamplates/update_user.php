<?php
session_start();
include 'db.php'; // Ensure this path is correct relative to update_user.php

if (!isset($_SESSION['username'])) {
    header('Location: login.html');
    exit;
}

$username = $_SESSION['username'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $new_username = $_POST['new_username'];
    $email = $_POST['email'];
    $password = $_POST['pass']; // Assuming 'pass' field name from your database

    // Encrypt the new password if it's not empty
    if (!empty($password)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT); // Hash the new password
    } else {
        // If password field is empty, retrieve the existing hashed password from database
        $sql_existing_pass = "SELECT pass FROM user WHERE username = ?";
        $stmt_existing_pass = $conn->prepare($sql_existing_pass);

        if ($stmt_existing_pass === false) {
            die("Prepare failed: " . $conn->error);
        }

        $stmt_existing_pass->bind_param("s", $username);
        $stmt_existing_pass->execute();
        $result_existing_pass = $stmt_existing_pass->get_result();
        $user_existing_pass = $result_existing_pass->fetch_assoc();

        $hashed_password = $user_existing_pass['pass']; // Use existing hashed password
    }

    // Prepare SQL statement
    $sql = "UPDATE user SET username = ?, email = ?, pass = ? WHERE username = ?";
    $stmt = $conn->prepare($sql);

    // Check for prepare() error
    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }

    // Bind parameters and execute query
    $stmt->bind_param("ssss", $new_username, $email, $hashed_password, $username);
    if ($stmt->execute()) {
        $_SESSION['username'] = $new_username; // Update session variable if username is changed
        echo '<script>alert("User information updated successfully.");</script>';
    } else {
        echo '<script>alert("Error updating user information.");</script>';
    }

    // Close statement
    $stmt->close();
}

// Fetch user information
$sql = "SELECT * FROM user WHERE username = ?";
$stmt = $conn->prepare($sql);

// Check for prepare() error
if ($stmt === false) {
    die("Prepare failed: " . $conn->error);
}

// Bind parameters and execute query
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// Close statement
$stmt->close();

// Close connection
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update User Information</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            padding: 0;
        }

        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 80%;
            max-width: 400px;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 8px;
            font-weight: bold;
        }

        input[type="text"], input[type="email"], input[type="password"] {
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button {
            padding: 12px;
            background-color: black;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: gray;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Update User Information</h1>
        <form action="update_user.php" method="post">
            <label for="new_username">New Username:</label>
            <input type="text" id="new_username" name="new_username" value="<?php echo htmlspecialchars($user['username']); ?>" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>

            <label for="pass">Password:</label>
            <input type="text" id="pass" name="pass"  value="<?php echo htmlspecialchars($user['pass']); ?>" required> <!-- Placeholder text for new password -->

            <button type="submit">Update</button>
        </form>
    </div>
</body>
</html>
