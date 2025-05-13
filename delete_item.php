<?php
include("includes/db_connect.php");
$id = $_GET['id'];
$conn->query("DELETE FROM items WHERE id = $id");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Item Deleted</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', sans-serif;
            background: url('https://i.pinimg.com/736x/9b/32/9b/9b329b135daef267ce959b299b6cdc0c.jpg') no-repeat center center fixed;
            background-size: cover;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }

        .message-box {
            background: rgba(255, 255, 255, 0.85);
            padding: 40px;
            border-radius: 16px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
            text-align: center;
            animation: fadeIn 0.6s ease;
        }

        .message-box h2 {
            color: #c0392b;
            font-size: 24px;
            margin-bottom: 15px;
        }

        .message-box p {
            font-size: 18px;
            color: #2c3e50;
        }

        .back-link {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 25px;
            background-color: #e74c3c;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            transition: background 0.3s ease;
            font-weight: bold;
        }

        .back-link:hover {
            background-color: #c0392b;
        }

        @keyframes fadeIn {
            from {
                transform: translateY(20px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }
    </style>
</head>
<body>

    <div class="message-box">
        <h2>🗑️ Item Deleted</h2>
        <p>The item has been removed from your inventory.</p>
        <a href='view_items.php' class="back-link">← Back to Inventory</a>
    </div>

</body>
</html>
