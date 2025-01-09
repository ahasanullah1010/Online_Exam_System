<?php
session_start();
include 'includes/config.php';
if (isset($_SESSION['role'])) {
    if ($_SESSION['role'] == 'admin') {
        header('Location:adminDashboard.php');
    } elseif ($_SESSION['role'] == 'student') {
        header('Location:studentDashboard.php');
    }
}



?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Exam Platform</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
        }

        header {
            background-color: #007BFF;
            color: white;
            padding: 20px;
            text-align: center;
        }

        .hero {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 400px;
            background: linear-gradient(rgba(0, 123, 255, 0.8), rgba(0, 123, 255, 0.8)), url('exam-background.jpg') no-repeat center center/cover;
            color: white;
            text-align: center;
            flex-direction: column;
        }

        .hero h1 {
            font-size: 3rem;
            margin: 0;
        }

        .hero p {
            font-size: 1.5rem;
            margin: 10px 0 20px;
        }

        .hero a {
            display: inline-block;
            background-color: #FFC107;
            color: #333;
            padding: 10px 20px;
            font-size: 1.2rem;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .hero a:hover {
            background-color: #e0a800;
        }

        .features {
            max-width: 1200px;
            margin: 40px auto;
            padding: 20px;
            text-align: center;
        }

        .features h2 {
            margin-bottom: 30px;
            font-size: 2rem;
            color: #333;
        }

        .feature-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }

        .card {
            background: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: center;
            transition: transform 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card h3 {
            margin-bottom: 15px;
            color: #007BFF;
        }

        .card p {
            margin-bottom: 20px;
            color: #555;
        }

        .card a {
            display: inline-block;
            padding: 10px 15px;
            color: white;
            background-color: #007BFF;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .card a:hover {
            background-color: #0056b3;
        }

        footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 10px 0;
            margin-top: 30px;
        }

        footer p {
            margin: 0;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <header>
        <h1>Welcome to the Online Exam Platform</h1>
    </header>

    <div class="hero">
        <h1>Revolutionize Your Exam Experience</h1>
        <p>Effortless, reliable, and innovative online exam management.</p>
        <a href="register.php">Get Started</a>
    </div>

    <div class="features">
        <h2>Why Choose Us?</h2>
        <div class="feature-cards">
            <div class="card">
                <h3>Easy Signup</h3>
                <p>Create an account in just a few clicks and get started right away.</p>
                <a href="register.php">Sign Up</a>
            </div>

            <div class="card">
                <h3>User Dashboard</h3>
                <p>Track exams, view results, and access personalized tools.</p>
                <a href="dashboard.php">View Dashboard</a>
            </div>

            <div class="card">
                <h3>Secure Platform</h3>
                <p>Your data is safe with us, ensuring a worry-free experience.</p>
                <a href="#">Learn More</a>
            </div>

            <div class="card">
                <h3>Admin Tools</h3>
                <p>Manage exams, questions, and users effortlessly.</p>
                <a href="adminDashboard.php">Admin Login</a>
            </div>
        </div>
    </div>

    <footer>
        <p>&copy; 2024 Online Exam Platform. All rights reserved.</p>
    </footer>
</body>
</html>
