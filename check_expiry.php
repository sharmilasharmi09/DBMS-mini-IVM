<?php 
include("includes/db_connect.php");

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Fetch items with expiry_date
$query = "SELECT name, quantity, expiry_date FROM items WHERE expiry_date IS NOT NULL";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Check Item Expiry</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: url('https://i.pinimg.com/originals/58/37/40/583740c1268e7f2fff0209c16c462b33.gif') no-repeat center center fixed;
            background-size: cover;
            margin: 0;
            padding: 40px 20px;
            color: #333;
        }

        .container {
            max-width: 1000px;
            margin: auto;
            background-color: rgba(255, 255, 255, 0.95);
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.25);
        }

        h1 {
            text-align: center;
            color: #2c3e50;
            font-size: 32px;
        }

        .dashboard-link {
            display: block;
            text-align: center;
            margin: 20px auto;
            width: fit-content;
            background-color: #3498db;
            color: white;
            padding: 12px 24px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: bold;
            box-shadow: 0 5px 10px rgba(0,0,0,0.1);
            transition: background-color 0.3s ease;
        }

        .dashboard-link:hover {
            background-color: #2980b9;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 30px;
        }

        th, td {
            padding: 14px 18px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #34495e;
            color: white;
        }

        .expired {
            background-color: #f8d7da;
            color: #a94442;
        }

        .expiring-soon {
            background-color: #fff3cd;
            color: #856404;
        }

        .valid {
            background-color: #d4edda;
            color: #155724;
        }

        .no-data {
            text-align: center;
            font-size: 18px;
            color: #c0392b;
            margin-top: 30px;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>📦 Check Item Expiry Status</h1>

    <!-- Go to Dashboard Link -->
    <a href="dashboard.php" class="dashboard-link">← Go to Dashboard</a>

    <?php
    if ($result && $result->num_rows > 0) {
        echo "<table>
                <tr>
                    <th>Item Name</th>
                    <th>Quantity</th>
                    <th>Expiry Date</th>
                    <th>Status</th>
                </tr>";

        $today = new DateTime();

        while ($row = $result->fetch_assoc()) {
            $expiry = new DateTime($row['expiry_date']);
            $interval = $today->diff($expiry)->days;
            $isExpired = $expiry < $today;

            if ($isExpired) {
                $status = 'expired';
                $message = '❌ Expired';
            } elseif ($interval <= 7) {
                $status = 'expiring-soon';
                $message = '⚠️ Expiring Soon';
            } else {
                $status = 'valid';
                $message = '✅ Valid';
            }

            echo "<tr class='{$status}'>
                    <td>{$row['name']}</td>
                    <td>{$row['quantity']}</td>
                    <td>" . $expiry->format('d M Y') . "</td>
                    <td>{$message}</td>
                  </tr>";
        }

        echo "</table>";
    } else {
        echo "<p class='no-data'>No items with expiry dates found.</p>";
    }
    ?>
</div>

<script src="js/script.js"></script>
</body>
</html>

