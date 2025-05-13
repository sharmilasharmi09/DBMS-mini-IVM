<?php
session_start();
include("includes/db_connect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    
    $stmt = $conn->prepare("SELECT * FROM users WHERE username=?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($user = $result->fetch_assoc()) {
        if (password_verify($password, $user["password"])) {
            $_SESSION["user_id"] = $user["id"];
            header("Location: dashboard.php");
            exit();
        } else {
            echo "<p>Incorrect password!</p>";
        }
    } else {
        echo "<p>User not found!</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Nunito', sans-serif;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: url('https://cdn1.expresscomputer.in/wp-content/uploads/2023/01/04165947/EC_Retail_ECommerce_750.jpg') no-repeat center center fixed;
            background-size: cover;
            position: relative;
        }

        body::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 0;
        }

        .quote {
            position: absolute;
            bottom: 15%;
            right: 10%;
            font-size: 28px;
            color: #fff;
            font-style: italic;
            max-width: 80%;
            text-shadow: 2px 2px 10px rgba(0, 0, 0, 0.7);
            animation: fadeInQuote 2s ease-in-out infinite alternate;
        }

        @keyframes fadeInQuote {
            0% {
                opacity: 0.5;
                transform: translateY(10px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .login-container {
            position: relative;
            z-index: 1;
            background: linear-gradient(135deg, #3498db, #8e44ad);
            padding: 40px 60px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            width: 100%;
            max-width: 400px;
            text-align: center;
            animation: fadeIn 1.5s ease;
            border: 2px solid #fff;
        }

        .login-container h2 {
            color: #fff;
            margin-bottom: 30px;
            font-size: 32px;
            font-weight: 700;
        }

        .login-container input[type="text"],
        .login-container input[type="password"] {
            width: 100%;
            padding: 12px 20px;
            margin-bottom: 20px;
            border-radius: 8px;
            border: 1px solid #ddd;
            font-size: 16px;
            color: #333;
            background: #fff;
            transition: all 0.3s ease;
        }

        .login-container input[type="text"]:focus,
        .login-container input[type="password"]:focus {
            border-color: #fff;
            background: #e6f7ff;
            outline: none;
        }

        .login-container button {
            padding: 14px 28px;
            background-color: #fff;
            color: #3498db;
            border: none;
            border-radius: 50px;
            font-size: 16px;
            font-weight: bold;
            width: 100%;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .login-container button:hover {
            background-color: #3498db;
            color: #fff;
            transform: translateY(-3px);
        }

        .footer-note {
            margin-top: 20px;
            font-size: 14px;
            color: #fff;
        }

        .footer-note a {
            color: #ff80ab;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .footer-note a:hover {
            color: #fff;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (max-width: 500px) {
            .login-container {
                padding: 30px 20px;
            }
        }
    </style>
</head>
<body>



<div class="login-container">
    <h2>Login</h2>
    <form method="post">
        Username: <input type="text" name="username" required><br>
        Password: <input type="password" name="password" required><br>
        <button type="submit">Login</button>
    </form>

    <div class="footer-note">
        <p>Don't have an account? <a href="register.php">Register here</a></p>
    </div>
</div>

</body>
</html>

