<?php
include("includes/db_connect.php");

// 1. Stock Levels (items table)
$stockQuery = "SELECT name, quantity FROM items";
$stockResult = $conn->query($stockQuery);
$stockLabels = $stockData = [];
while ($row = $stockResult->fetch_assoc()) {
    $stockLabels[] = $row['name'];
    $stockData[] = $row['quantity'];
}

// 4. Category-wise Distribution
$categoryQuery = "SELECT category, SUM(quantity) as total FROM items GROUP BY category";
$catLabels = $catData = [];
$catResult = $conn->query($categoryQuery);
while ($row = $catResult->fetch_assoc()) {
    $catLabels[] = $row['category'] ?? "Uncategorized";
    $catData[] = $row['total'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Inventory Analytics Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <!-- External CSS link -->
    <link rel="stylesheet" href="css/style.css">

    <!-- External JavaScript link -->
    <script src="js/script.js"></script>
    
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: url('https://i.pinimg.com/originals/f1/59/53/f15953b0becec1c09a006cd38a50bc98.gif') no-repeat center center fixed;
            background-size: cover;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            margin-bottom: 40px;
            color:rgb(114, 190, 252);
        }

        .chart-container {
            width: 80%;
            margin: 40px auto;
            background: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        }

        canvas {
            margin-top: 20px;
        }

        /* Centered Back to Dashboard Button */
        .back-btn-container {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }

        .back-btn {
            background-color: #3498db;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            font-size: 18px;
            text-align: center;
            transition: background-color 0.3s ease;
        }

        .back-btn:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>

<div class="overlay">
    <!-- Back to Dashboard Button with Center Alignment -->
    <div class="back-btn-container">
        <a href="dashboard.php" class="back-btn">Back to Dashboard</a>
    </div>

    <h1>📊 Inventory Analytics Dashboard</h1>

    <div class="chart-container">
        <h3>📦 Stock Levels</h3>
        <canvas id="stockChart"></canvas>
    </div>

    <div class="chart-container">
        <h3>📊 Category-wise Stock Distribution</h3>
        <canvas id="categoryChart"></canvas>
    </div>
</div>

<script>
    // Chart 1: Stock Levels
    new Chart(document.getElementById('stockChart'), {
        type: 'bar',
        data: {
            labels: <?= json_encode($stockLabels); ?>,
            datasets: [{
                label: 'Quantity',
                data: <?= json_encode($stockData); ?>,
                backgroundColor: 'rgba(52, 152, 219, 0.7)',
                borderColor: 'rgba(41, 128, 185, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false } },
            scales: { y: { beginAtZero: true } }
        }
    });

    // Chart 2: Category Distribution
    new Chart(document.getElementById('categoryChart'), {
        type: 'pie',
        data: {
            labels: <?= json_encode($catLabels); ?>,
            datasets: [{
                data: <?= json_encode($catData); ?>,
                backgroundColor: [
                    '#9b59b6', '#3498db', '#2ecc71', '#f1c40f', '#e67e22', '#e74c3c'
                ]
            }]
        },
        options: {
            responsive: true
        }
    });
</script>

</body>
</html>
