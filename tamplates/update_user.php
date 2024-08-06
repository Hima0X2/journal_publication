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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update User Information</title>
    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.15/dist/tailwind.min.css" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Additional custom styles can be added here */
        .btn-back {
            transition: transform 0.3s, background-color 0.3s;
        }

        .btn-back:hover {
            transform: scale(1.05);
        }
    </style>
</head>

<body class="bg-gray-100">
    <div class="container mx-auto mt-8">
        <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <div class="flex items-center justify-between mb-6">
                <h1 class="text-2xl font-bold">Update User Information</h1>
                <a href="dashboard.php" class="btn-back bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Back
                </a>
            </div>
            <form action="update_user.php" method="post">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="new_username">New Username:</label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="new_username" name="new_username" type="text" value="<?php echo htmlspecialchars($user['username']); ?>" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="email">Email:</label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="email" name="email" type="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="pass">Password:</label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="pass" name="pass" type="password" placeholder="Enter new password (optional)">
                </div>
                <div class="flex items-center justify-between">
                    <button class="bg-black hover:bg-gray-800 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
