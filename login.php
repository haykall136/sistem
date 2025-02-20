<?php
session_start();
include 'dbconnect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $phone_number = $_POST['phone_number'];
    $password = $_POST['password'];

    // Check if user exists
    $sql = "SELECT * FROM users WHERE phone_number = '$phone_number'";
    $result = mysqli_query($condb, $sql);
    $user = mysqli_fetch_assoc($result);

    if ($user && password_verify($password, $user['password'])) {
        // Set session variables
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username']; // Storing username for reference
        $_SESSION['position'] = $user['position']; // Store user's position
        header("Location: index.php"); // Redirect to dashboard
    } else {
        echo "<script>alert('Invalid phone number or password.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #E5F6F8;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-container {
            background-color: #FFFFFF;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        h1 {
            color: #4A628A;
            margin-bottom: 20px;
        }

        label {
            display: block;
            color: #4A628A;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input {
            width: calc(100% - 20px);
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #DDD;
            border-radius: 5px;
            font-size: 16px;
        }

        button {
            background-color: #4A628A;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #7AB2D3;
        }

        .error {
            color: red;
            font-weight: bold;
            margin-bottom: 15px;
        }

        p {
            color: #4A628A;
        }

        a {
            color: #7AB2D3;
            text-decoration: none;
            font-weight: bold;
        }

        a:hover {
            text-decoration: underline;
        }

        @media (max-width: 480px) {
            .login-container {
                padding: 20px;
            }

            input {
                font-size: 14px;
            }

            button {
                font-size: 14px;
                padding: 8px 16px;
            }
        }
    </style>
</head>

<body>
    <div class="login-container">
        <h1>Login</h1>
        <br>
        <form method="POST">
            <label for="phone_number">Phone Number:</label>
            <input type="text" name="phone_number" id="phone_number" required>
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required>
            <a href="forgot_password.php">Forgot Password?</a></p> <!-- New link for forgot password -->
            <br>
            <button type="submit">Login</button>
        </form>
        <p>Don't have an account? <a href="signup.php">Sign up here</a></p>
    </div>
</body>

</html>