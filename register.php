<?php 
include("includes/db_connect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $email, $password);
    
    if ($stmt->execute()) {
        echo "Registered successfully! <a href='login.php'>Login</a>";
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        /* Body Styles */
        body {
            margin: 0;
            padding: 0;
            font-family: 'Nunito', sans-serif;
            background: url('https://cdn.shopify.com/s/files/1/1246/6441/articles/inventory-management-software.png?v=1727354809') no-repeat center center fixed;
            background-size: cover;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #fff;
        }

        /* Form Container Styles */
        .register-container {
            background: rgba(255, 255, 255, 0.8);
            padding: 40px 60px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            width: 100%;
            max-width: 400px;
            text-align: center;
            animation: fadeIn 1.5s ease;
        }

        .register-container h2 {
            margin-bottom: 30px;
            font-size: 32px;
            font-weight: 700;
            color: #333;
        }

        /* Label Text Color */
        .register-container label {
            font-size: 18px;
            color: #000; /* Set label text to black */
            text-align: left;
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        /* Input Fields */
        .register-container input[type="text"],
        .register-container input[type="email"],
        .register-container input[type="password"] {
            width: 100%;
            padding: 12px 20px;
            margin-bottom: 20px;
            border-radius: 8px;
            border: 1px solid #ddd;
            font-size: 16px;
            color: #333;
            background-color: #f9f9f9; /* Light background for better visibility */
            transition: all 0.3s ease;
        }

        .register-container input[type="text"]:focus,
        .register-container input[type="email"]:focus,
        .register-container input[type="password"]:focus {
            border-color: #3498db;
            background-color: #f0f8ff;
            outline: none;
        }

        /* Register Button */
        .register-container button {
            padding: 14px 28px;
            background-color: #3498db;
            color: #fff;
            border: none;
            border-radius: 50px;
            font-size: 16px;
            font-weight: bold;
            width: 100%;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .register-container button:hover {
            background-color: #2980b9;
            transform: translateY(-3px);
        }

        /* Footer note */
        .footer-note {
            margin-top: 20px;
            font-size: 14px;
            color: #888;
        }

        .footer-note a {
            color: #3498db;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .footer-note a:hover {
            color: #fff;
        }

        /* Animation for fading in */
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
            .register-container {
                padding: 30px 20px;
            }
        }
    </style>
</head>
<body>

<div class="register-container">
    <h2>Register</h2>
    <form method="post">
        <label for="username">Username</label>
        <input type="text" name="username" required><br>

        <label for="email">Email</label>
        <input type="email" name="email" required><br>

        <label for="password">Password</label>
        <input type="password" name="password" required><br>

        <button type="submit">Register</button>
    </form>

    <div class="footer-note">
        <p>Already have an account? <a href="login.php">Login here</a></p>
    </div>
</div>

</body>
</html>
