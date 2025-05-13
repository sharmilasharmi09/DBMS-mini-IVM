<?php
include("includes/db_connect.php");
error_reporting(E_ALL);
ini_set('display_errors', 1);

$today = date('Y-m-d');
$query = "SELECT name, expiry_date FROM items WHERE expiry_date IS NOT NULL";
$result = $conn->query($query);

$items = [];

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $expiry = new DateTime($row['expiry_date']);
        $todayDate = new DateTime();
        $interval = $todayDate->diff($expiry)->days;
        $status = "";

        if ($expiry < $todayDate) {
            $status = "Expired";
        } elseif ($interval <= 7) {
            $status = "Expiring Soon";
        } else {
            $status = "Valid";
        }

        $items[] = [
            "name" => $row["name"],
            "expiry_date" => $expiry->format('d M Y'),
            "status" => $status
        ];
    }
} else {
    echo "No items found or query failed.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Expiry Report</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: url('https://i.pinimg.com/originals/75/ca/dc/75cadc0f6c22661cd913204fe1d1c205.gif') no-repeat center center fixed;
            background-size: cover;
            margin: 0;
            padding: 50px 20px;
        }

        .container {
            max-width: 950px;
            margin: auto;
            background-color: rgba(255, 255, 255, 0.96);
            padding: 35px;
            border-radius: 14px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
        }

        h1 {
            text-align: center;
            color: #2c3e50;
            font-size: 32px;
        }

        .dashboard-link {
            display: inline-block;
            margin: 20px auto;
            background-color: #2980b9;
            color: #fff;
            padding: 12px 24px;
            text-decoration: none;
            border-radius: 8px;
            font-weight: bold;
            transition: 0.3s ease;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        .dashboard-link:hover {
            background-color: #1f6391;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
            background-color: white;
        }

        th, td {
            padding: 14px 16px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #34495e;
            color: white;
        }

        td {
            color: #2c3e50;
            font-weight: 500;
        }

        .Expired {
            background-color: #f8d7da;
            color: #a94442;
        }

        .Expiring\ Soon {
            background-color: #fff3cd;
            color: #856404;
        }

        .Valid {
            background-color: #d4edda;
            color: #155724;
        }

        .no-data {
            text-align: center;
            padding: 20px 0;
            font-size: 18px;
            color: #e74c3c;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>📦 Items Expiry Report</h1>

    <div style="text-align: center;">
        <a href="dashboard.php" class="dashboard-link">← Go to Dashboard</a>
    </div>

    <table>
        <tr>
            <th>Item Name</th>
            <th>Expiry Date</th>
            <th>Status</th>
        </tr>
        <?php
        if (!empty($items)) {
            foreach ($items as $item) {
                $statusClass = str_replace(' ', '-', $item['status']);
                echo "<tr class='{$item['status']}'>
                        <td>{$item['name']}</td>
                        <td>{$item['expiry_date']}</td>
                        <td>{$item['status']}</td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='3' class='no-data'>No items to display.</td></tr>";
        }
        ?>
    </table>
</div>

<script src="js/script.js"></script>
</body>
</html>
