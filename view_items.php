<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include("includes/db_connect.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Inventory</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            background: url('https://i.pinimg.com/originals/cd/f4/95/cdf4951a69fe542e2b7d6a07aa234a1b.gif') no-repeat center center fixed;
            background-size: cover;
            color: #333;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #fff;
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.4);
        }

        .back-btn {
            text-align: center;
            margin-bottom: 30px;
        }

        .back-btn a {
            display: inline-block;
            padding: 10px 20px;
            background-color: #2ecc71;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-weight: bold;
            box-shadow: 0 4px 10px rgba(0,0,0,0.2);
            transition: background-color 0.3s ease;
        }

        .back-btn a:hover {
            background-color: #27ae60;
        }

        .inventory-container {
            max-width: 800px;
            margin: 0 auto;
        }

        .item {
            background-color: rgba(255, 255, 255, 0.9);
            border: 1px solid #ccc;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 15px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .item:hover {
            background-color: rgba(255, 255, 255, 0.95);
            transform: scale(1.02);
        }

        .item-info {
            font-size: 18px;
            font-weight: bold;
        }

        .item-meta {
            font-size: 14px;
            color: #555;
            margin-top: 5px;
        }

        .item-actions a {
            margin-left: 15px;
            text-decoration: none;
            font-weight: bold;
            color: #2980b9;
        }

        .item-actions a:hover {
            text-decoration: underline;
            color: #1c5980;
        }

        .no-items {
            text-align: center;
            font-style: italic;
            color: #fff;
            text-shadow: 1px 1px 4px rgba(0, 0, 0, 0.5);
        }

        .message {
            background-color: #3498db;
            color: white;
            padding: 15px;
            font-size: 16px;
            font-weight: bold;
            text-align: center;
            border-radius: 8px;
            margin-bottom: 20px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            width: 100%;
            transform: translateY(-20px);
            animation: slideIn 0.5s ease-out forwards;
        }

        @keyframes slideIn {
            from {
                transform: translateY(-20px);
            }
            to {
                transform: translateY(0);
            }
        }

        .message.error {
            background-color: #e74c3c;
        }
    </style>
</head>
<body>

<h1>Inventory List</h1>

<div class="back-btn">
    <a href="dashboard.php">← Back to Dashboard</a>
</div>

<?php
if (isset($_GET['status'])) {
    $status = $_GET['status'];
    if ($status == 'edited') {
        echo "<div class='message'>Item edited successfully!</div>";
    } elseif ($status == 'deleted') {
        echo "<div class='message'>Item deleted successfully!</div>";
    }
}
?>

<div class="inventory-container">
    <?php
    $result = $conn->query("SELECT * FROM items");

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $expiry_date = isset($row['expiry_date']) ? date('d M Y', strtotime($row['expiry_date'])) : 'N/A';
            
            echo "<div class='item'>
                    <div>
                        <div class='item-info'>{$row['name']} - {$row['quantity']} units</div>
                        <div class='item-meta'>Category: {$row['category']}</div>
                        <div class='item-meta'>Expiry Date: {$expiry_date}</div>
                    </div>
                    <div class='item-actions'>
                        <a href='update_item.php?id={$row['id']}'>Edit</a>
                        <a href='delete_item.php?id={$row['id']}' onclick='return confirmDelete()'>Delete</a>
                    </div>
                  </div>";
        }
    } else {
        echo "<p class='no-items'>No items found in the inventory.</p>";
    }
    ?>
</div>

<script>
    function confirmDelete() {
        return confirm('Are you sure you want to delete this item?');
    }
</script>

<script src="js/script.js"></script>

</body>
</html>
