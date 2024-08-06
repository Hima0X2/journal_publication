<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            color: #333;
        }

        .navbar {
            background-color: #343a40;
            color: #fff;
            padding: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 98%;
            margin: 0;
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
            color: #cce5ff;
        }

        .about-section {
            background: #ffffff;
            padding: 50px;
            text-align: center;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 800px;
            margin: 30px auto;
        }

        .about-section h1 {
            margin-bottom: 20px;
            font-size: 36px;
            color: #007bff;
            animation: fadeInDown 1s ease-out;
        }

        .about-section p {
            font-size: 18px;
            line-height: 1.6;
            animation: fadeInUp 1s ease-out;
        }

        @keyframes fadeInDown {
            0% {
                opacity: 0;
                transform: translateY(-20px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
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

        footer {
            background-color: #343a40;
            color: #fff;
            padding: 20px;
            text-align: center;
            margin-top: 30px;
        }

        footer p {
            margin: 0;
        }
    </style>
</head>
<body>
    <div class="navbar">
    <h2><a href="about.php" style="color: white; text-decoration: none;">About Us</a></h2>
        <ul>
            <li><a href="dashboard.php">Dashboard</a></li>
            <li><a href="upload.php">Upload Paper</a></li>
            <li><a href="about.php">About Us</a></li>
            <li><a href="update_user.php">Settings</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>

    <div class="about-section">
        <h1>About Us</h1>
        <p>Welcome to our publication website! We are dedicated to providing a platform for researchers and academics to share their work with the world. Our mission is to support and encourage the dissemination of knowledge through easy and accessible paper submissions and reviews. We value integrity, transparency, and excellence in all our endeavors.</p>
        <p>Our team consists of experienced professionals from various fields who are passionate about advancing research and fostering a community of innovation and collaboration.</p>
    </div>

    <footer>
        <p>&copy; 2024 Publication Website. All Rights Reserved.</p>
    </footer>
</body>
</html>
