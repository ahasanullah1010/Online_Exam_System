<?php
ini_set('session.cookie_lifetime', 604800); // 7 days in seconds
ini_set('session.gc_maxlifetime', 604800); // Garbage collection max lifetime
session_start();
if (isset($_SESSION['userID'])) {
    
    header('Location:dashboard.php');
}
include 'includes/config.php';




if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['userID'] = $user['user_id'];
            $_SESSION['role'] = $user['role'];

            // Set a persistent cookie for 7 days
        setcookie(session_name(), session_id(), time() + 604800, "/"); // 7 days
        
            header('Location: dashboard.php');
        } else {
            $error = "Invalid username or password!";
        }
    } else {
        $error = "Invalid username or password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Online MCQ Exam - Login</title>
    <style>
        /* General body styling */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        /* Container for the login form */
        .container {
            width: 100%;
            max-width: 400px;
            background: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        /* Form heading */
        .container h2 {
            margin-bottom: 20px;
            font-size: 24px;
            color: #333333;
        }

        /* Error message styling */
        .container p {
            color: #ff4d4d;
            margin-bottom: 15px;
            font-weight: bold;
        }

        /* Labels for form fields */
        form label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            text-align: left;
            color: #555555;
        }

        /* Input fields */
        form input {
            width: calc(100% - 20px);
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #dddddd;
            border-radius: 4px;
            font-size: 16px;
        }

        /* Submit button */
        form button {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 4px;
            background-color: #4CAF50;
            color: white;
            font-size: 16px;
            cursor: pointer;
            font-weight: bold;
        }

        form button:hover {
            background-color: #45a049;
        }

        /* Responsive design */
        @media (max-width: 600px) {
            .container {
                padding: 15px;
            }

            form input, form button {
                font-size: 14px;
            }
        }

    </style>

</head>
<body>
    <div class="container">
        <h2>Login</h2>
        <?php if (isset($error)) echo "<p>$error</p>"; ?>
        <form method="POST">
            <label>Username:</label>
            <input type="text" name="username" required>
            <label>Password:</label>
            <input type="password" name="password" required>
            <button type="submit">Login</button>
        </form>
        <p>Don't have an account? <a href="register.php">Sign up here</a></p>
    </div>
</body>
</html>
