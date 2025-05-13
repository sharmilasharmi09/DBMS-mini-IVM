<?php
include("includes/db_connect.php");

// Change threshold if needed
$query = "SELECT name, quantity FROM items WHERE quantity < 10";
$result = $conn->query($query);

$lowStockItems = [];

if ($result) {
    while ($row = $result->fetch_assoc()) {
        $lowStockItems[] = [
            "name" => $row["name"],
            "quantity" => $row["quantity"]
        ];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Low Stock Items</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: url('https://i.pinimg.com/originals/1e/39/f5/1e39f596b7f9d06809e5438a46d891ce.gif') no-repeat center center fixed;
            background-size: cover;
            margin: 0;
            padding: 40px 20px;
        }

        .container {
            max-width: 900px;
            margin: auto;
            background-color: rgba(255, 255, 255, 0.95);
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }

        h1 {
            text-align: center;
            color: #2c3e50;
            font-size: 32px;
            margin-bottom: 20px;
        }

        .dashboard-link {
            display: block;
            width: fit-content;
            margin: 0 auto 25px;
            background-color: #3498db;
            color: white;
            text-decoration: none;
            padding: 12px 24px;
            border-radius: 8px;
            font-weight: bold;
            transition: background-color 0.3s ease;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        .dashboard-link:hover {
            background-color: #2980b9;
        }

        .low-stock-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            background-color: white;
        }

        th, td {
            padding: 14px 18px;
            border-bottom: 1px solid #ddd;
            text-align: left;
            font-size: 16px;
        }

        th {
            background-color: #34495e;
            color: white;
        }

        td {
            color: #2c3e50;
        }

        .no-data {
            text-align: center;
            font-size: 18px;
            color: #e74c3c;
            padding: 20px 0;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>📉 Low Stock Items</h1>

    <!-- Go to Dashboard Button -->
    <a href="dashboard.php" class="dashboard-link">← Go to Dashboard</a>

    <table class="low-stock-table">
        <tr>
            <th>Item Name</th>
            <th>Quantity</th>
        </tr>
        <?php
        if (!empty($lowStockItems)) {
            foreach ($lowStockItems as $item) {
                echo "<tr>
                        <td>{$item['name']}</td>
                        <td>{$item['quantity']}</td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='2' class='no-data'>🎉 All items are well-stocked!</td></tr>";
        }
        ?>
    </table>
</div>

<script src="js/script.js"></script>
</body>
</html>
