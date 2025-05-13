<?php
session_start(); 
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Management System - Dashboard</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        /* Background Image and Body Styling */
        body {
            margin: 0;
            padding: 0;
            font-family: 'Nunito', sans-serif;
            background: url('https://i.pinimg.com/originals/dc/a6/61/dca661166c7c412bae6b42e8d54e7a1b.gif') no-repeat center center fixed;
            background-size: cover;
        }

        h1 {
            text-align: center;
            color: #ffffff;
            font-size: 36px;
            margin-top: 30px;
            text-shadow: 2px 2px 5px rgba(0,0,0,0.6);
        }

        .nav-links {
            text-align: center;
            margin: 20px 0;
        }

        .nav-links a {
            text-decoration: none;
            color: #ffffff;
            margin: 0 12px;
            font-size: 18px;
            font-weight: bold;
            text-shadow: 1px 1px 3px rgba(0,0,0,0.6);
        }

        .nav-links a:hover {
            color: #ffdd57;
        }

        .container {
            width: 80%;
            margin: 20px auto;
            text-align: center;
            background-color: rgba(255, 255, 255, 0.85);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .container p {
            font-size: 18px;
            color: #2c3e50;
        }

        .feature-highlight {
            background-color: #f0f9ff;
            border-left: 5px solid #3498db;
            padding: 15px;
            margin: 30px auto;
            font-size: 17px;
            width: 80%;
            border-radius: 6px;
            color: #2c3e50;
        }

        .shortcut-links {
            margin-top: 30px;
            text-align: center;
        }

        .shortcut-links a {
            display: inline-block;
            margin: 10px;
            padding: 12px 20px;
            background-color: #3498db;
            color: #fff;
            border-radius: 5px;
            text-decoration: none;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        .shortcut-links a:hover {
            background-color: #2980b9;
        }

        /* About Section Styles */
        .about-section {
            width: 80%;
            margin: 40px auto;
            padding: 30px;
            background-color: rgba(0, 0, 0, 0.8);
            border-left: 6px solid #3498db;
            border-radius: 8px;
            color: #f1f1f1;
            font-size: 17px;
            text-align: left;
            line-height: 1.6;
        }

        .about-section h2,
        .about-section h3 {
            color: #ffffff;
        }

        .about-section ul {
            padding-left: 20px;
        }

        .about-section ul li {
            margin: 8px 0;
        }
    </style>
</head>
<body>

    <h1>Welcome to the Inventory Management System</h1>

    <div class="nav-links">
        <a href="add_item.php">Add Items</a> |
        <a href="view_items.php">View Inventory</a> | 
        <a href="search_item.php">Search Items</a> | 
        <a href="logout.php">Logout</a>
    </div>

    <div class="container">
        <p>Welcome back! You can manage your inventory here.</p>
        <p>Select an action from the menu above to get started.</p>

        <div class="feature-highlight">
            ✅ <strong>New Feature:</strong> Expiry Date Tracking is now live! <br>
            Track and manage perishable goods easily.
        </div>

        <div class="shortcut-links">
            <a href="check_expiry.php">📅 Check Expiry Dates</a>
            <a href="get_low_stock.php">📉 Low Stock Report</a>
            <a href="get_expiry_data.php">📊 Expiry Data Report</a>
            <a href="analytics_dashboard.php">📈 Smart Analytics Dashboard</a>
        </div>
    </div>

    <div class="about-section">
        <h2>📦 About the Inventory Management System</h2>
        <p>
            The Inventory Management System is a smart, user-friendly web application designed to streamline the process of tracking and managing stock for businesses of all sizes. Whether you're handling groceries, electronics, or any type of product-based inventory, this system helps you stay organized, reduce waste, and make informed decisions.
        </p>
        <h3>🛠️ Core Features</h3>
        <ul>
            <li>🔐 <strong>User Authentication</strong> – Secure login system to protect data access.</li>
            <li>📦 <strong>Item Management</strong> – Add, update, view, and delete inventory items with ease.</li>
            <li>🔎 <strong>Smart Search</strong> – Instantly search and filter items by name or category.</li>
            <li>📉 <strong>Low Stock Alerts</strong> – Get reports on products that need restocking.</li>
            <li>📅 <strong>Expiry Tracking</strong> – Monitor perishable items and view their expiry status in red/yellow/green indicators.</li>
            <li>📈 <strong>Analytics Dashboard</strong> – Visual charts (Bar & Pie) showing stock levels and category-wise distribution using Chart.js.</li>
            <li>📊 <strong>Expiry Reports</strong> – Generate data-driven expiry and wastage analysis.</li>
        </ul>
    </div>

</body>
</html>
