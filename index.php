<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
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
            background: url('https://www.echelonedge.com/wp-content/uploads/2023/05/Network-Inventory-Management.png') no-repeat center center fixed;
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
            background-color: rgba(0, 0, 0, 0.6);
            z-index: 0;
        }

        .welcome-container {
            position: relative;
            z-index: 1;
            text-align: center;
            background: rgba(255, 255, 255, 0.95);
            padding: 60px 40px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            width: 90%;
            max-width: 550px;
            animation: fadeIn 1.5s ease;
        }

        .welcome-container img.logo {
            width: 100px;
            border-radius: 10px;
            margin-bottom: 20px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .welcome-container h2 {
            color: #2c3e50;
            font-size: 32px;
            margin-bottom: 10px;
        }

        .welcome-container p {
            font-size: 17px;
            color: #555;
            margin-bottom: 30px;
        }

        .btn-group {
            margin-top: 20px;
        }

        .btn-group a {
            display: inline-block;
            margin: 10px;
            padding: 14px 28px;
            text-decoration: none;
            color: #fff;
            background: linear-gradient(to right, #3498db, #6dd5fa);
            border-radius: 50px;
            font-size: 16px;
            font-weight: bold;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            box-shadow: 0 4px 15px rgba(52, 152, 219, 0.4);
        }

        .btn-group a:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(52, 152, 219, 0.6);
        }

        .footer-note {
            margin-top: 30px;
            font-size: 14px;
            color: #888;
        }

        @media (max-width: 500px) {
            .welcome-container {
                padding: 30px 20px;
            }

            .btn-group a {
                display: block;
                width: 100%;
                margin: 10px 0;
            }
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
    </style>
</head>
<body>

<div class="welcome-container">
    <!-- 🔥 Your image added here -->
    <img class="logo" src="https://img.freepik.com/premium-photo/automated-inventory-management-system-wallpaper_987764-40035.jpg" alt="Inventory Banner">

    <h2>Welcome to Inventory Management System</h2>
    <p>Your smart assistant for tracking, organizing, and optimizing stock 📦</p>

    <div class="btn-group">
        <a href="login.php">🔐 Login</a>
        <a href="register.php">📝 Register</a>
    </div>

    <div class="footer-note">
        © 2025 IMS • Made with ❤️ for smart businesses
    </div>
</div>

</body>
</html>
