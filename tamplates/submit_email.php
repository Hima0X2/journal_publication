<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Handle invalid email format
        echo "Invalid email format";
        exit; 
    }

    // Here you can process the email submission, such as sending it to a database or an email service
    // Example: Saving the email to a file
    $file = 'submitted_emails.txt';
    $current = file_get_contents($file);
    $current .= $email . "\n";
    file_put_contents($file, $current);

    // Redirect back to the previous page or a thank you page
    header("Location: ".$_SERVER['HTTP_REFERER']."?success=true");
    exit; // Stop further execution
}
?>
