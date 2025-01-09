<?php
include 'includes/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $role = $_POST['role'];

    $query = "INSERT INTO users (username, password, role) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sss", $username, $password, $role);

    if ($stmt->execute()) {
        header('Location: login.php');
    } else {
        $error = "Registration failed!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Register</title>
    <style>
        /* General body styling */
        body {
            font-family: Arial, sans-serif;
            background-color: #eef2f7;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        /* Container for the signup form */
        .container {
            width: 100%;
            max-width: 450px;
            background: #ffffff;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        /* Form heading */
        .container h2 {
            margin-bottom: 20px;
            font-size: 26px;
            color: #2c3e50;
        }

        /* Labels for form fields */
        form label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            text-align: left;
            color: #4b515d;
        }

        /* Input fields */
        form input {
            width: calc(100% - 20px);
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #dcdfe3;
            border-radius: 4px;
            font-size: 16px;
            background-color: #f9fbfc;
            color: #4b515d;
        }

        /* Submit button */
        form button {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 4px;
            background-color: #3498db;
            color: white;
            font-size: 16px;
            cursor: pointer;
            font-weight: bold;
        }

        form button:hover {
            background-color: #2980b9;
        }

        /* Link to the login page */
        form .login-link {
            margin-top: 15px;
            display: block;
            font-size: 14px;
            color: #3498db;
            text-decoration: none;
        }

        form .login-link:hover {
            color: #2980b9;
        }

        /* Error or success message styling */
        .container p {
            color: #e74c3c;
            margin-bottom: 15px;
            font-weight: bold;
        }

        /* Responsive design */
        @media (max-width: 600px) {
            .container {
                padding: 20px;
            }

            form input, form button {
                font-size: 14px;
            }
        }


        /* Styling the select dropdown */
        select.role {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #dcdfe3;
            border-radius: 4px;
            font-size: 16px;
            background-color: #f9fbfc;
            color: #4b515d;
            cursor: pointer;
        }

        /* Customize dropdown arrow */
        select.role:focus {
            outline: none;
            border-color: #3498db;
            box-shadow: 0 0 4px rgba(52, 152, 219, 0.5);
        }

        /* Hover effect for dropdown */
        select.role:hover {
            background-color: #eef3f7;
        }

        /* Adjust the appearance on mobile screens */
        @media (max-width: 600px) {
            select.role {
                font-size: 14px;
            }
        }


    </style>

</head>
<body>
   

    <div class="container">
        <h2>Sign Up</h2>
        <?php // if (isset($error)) echo "<p>$error</p>"; ?>
        <form method="POST" >
            <label>Username:</label>
            <input type="text" name="username" required>
            
            <label>Password:</label>
            <input type="password" name="password" required>
            <select name="role" class="role">
                <option value="student">Student</option>
                <option value="admin">Admin</option>
            </select>
            <button type="submit">Register</button>
            <a class="login-link" href="login.php">Already have an account? Login here</a>
        </form>
    </div>
</body>
</html>
