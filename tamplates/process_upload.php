<?php
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection
    include 'db.php'; // Replace with your database connection code

    // Function to sanitize input data
    function sanitize($data) {
        return htmlspecialchars(strip_tags(trim($data)));
    }

    // Validate and sanitize inputs
    $title = sanitize($_POST['title']);
    $description = sanitize($_POST['description']);

    // Insert data into database
    $sql = "INSERT INTO papers (title, description, status) VALUES ('$title', '$description', 'pending')";
    
    if ($conn->query($sql) === TRUE) {
        // Redirect to success page or display success message
        echo '<script>alert("Paper submitted.Waiting for admin approval.");</script>';
        header("Location: dashboard.html");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close database connection
    $conn->close();
}
?>
