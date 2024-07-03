<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>Upload Paper</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }

        .navbar {
            background-color: #343a40;
            color: #fff;
            padding: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            margin: 0; /* Reset margin to ensure no additional margins */
        }

        .navbar h2 {
            margin: 0;
            font-size: 24px;
        }

        .navbar ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
            display: flex;
        }

        .navbar ul li {
            margin-left: 20px;
        }

        .navbar ul li a {
            text-decoration: none;
            color: #fff;
            transition: 0.3s;
        }

        .navbar ul li a:hover {
            color: #adb5bd;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            animation: fadeInUp 0.5s ease-out; /* Example animation */
        }

        form {
            max-width: 600px;
            margin: 20px auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            animation: slideInRight 0.5s ease-out; /* Example animation */
        }
        .email{
            background-color: #343a40;
        }
        @keyframes fadeInUp {
            0% {
                opacity: 0;
                transform: translateY(20px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideInRight {
            0% {
                opacity: 0;
                transform: translateX(20px);
            }
            100% {
                opacity: 1;
                transform: translateX(0);
            }
        }

        label {
            font-weight: bold;
        }

        input[type="text"], textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 14px;
        }

        textarea {
            resize: vertical;
            min-height: 100px;
        }

        input[type="submit"] {
            background-color: black;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background-color: gray;
        }

        footer {
            background-color: #343a40;
            color: #fff;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 20px;
        }

        .footer-left {
            display: flex;
            align-items: center;
        }

        .social-icons {
            display: flex;
            align-items: center;
            margin-right: 20px;
        }

        .social-icons a {
            margin-right: 10px;
        }

        .social-icons .icon {
            width: 30px; /* Adjust the width as needed */
            height: auto;
        }

        .contact-info {
            text-align: right;
        }

        .contact-info p {
            margin: 5px 0;
        }

        .contact-info form {
            display: flex;
            align-items: center;
        }

        .contact-info input[type="email"] {
            padding: 8px;
            margin-right: 10px;
            width: 200px;
        }

        .contact-info button {
            padding: 8px 15px;
            background-color: #007bff;
            border: none;
            color: #fff;
            cursor: pointer;
        }

        .contact-info button:hover {
            background-color: #0056b3;
        }
        .bold-label {
    font-weight: bold;
}
    </style>
</head>
<body>
    <div class="navbar">
        <h2>Dashboard</h2>
        <ul>
            <li><a href="dashboard.html">Dashboard</a></li>
            <li><a href="upload.php">Upload Paper</a></li>
            <li><a href="update_user.php">Settings</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>

    <h2>Upload Paper</h2>
    <form action="process_upload.php" method="POST" enctype="multipart/form-data">
        <label for="title">Title:</label><br>
        <input  type="text" id="title" name="title" class="bold-label" required><br><br>
        
        <label for="description">Description:</label><br>
        <textarea id="description" name="description" rows="4" required></textarea><br><br>
        
        <!-- <label for="file">Upload Paper:</label><br>
        <input type="file" id="file" name="file" accept=".pdf,.doc,.docx" required><br><br> -->
        
        <input type="submit" value="Submit">
    </form>

    <footer>
        <div class="footer-left">
            <div class="social-icons">
                <a href="#" target="_blank"><img src="../images/facebook.png" class="icon"></a>
                <a href="#" target="_blank"><img src="../images/instagram.png" class="icon"></a>
                <a href="#" target="_blank"><img src="../images/twit.png" class="icon"></a>
                <a href="#" target="_blank"><img src="../images/linkedin.png" class="icon"></a>
            </div>
        </div>
        <div class="contact-info">
            <p>Get in Touch</p>
            <p><i class="fas fa-map-marker-alt"></i> Chandpur, Dhaka, Bangladesh</p>
            <p><i class="fas fa-envelope"></i> info@example.com</p>
            <p><i class="fas fa-phone"></i> +8801872879611</p>
        
            <form class="email" action="submit_email.php" method="POST">
                <input type="email" id="email" name="email" placeholder="Your email...">
                <button type="submit">Submit</button>
            </form>
        </div>
    </footer>
</body>
</html>
