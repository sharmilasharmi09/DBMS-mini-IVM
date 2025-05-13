<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include("includes/db_connect.php");

$id = $_GET['id'] ?? null;
$success_message = '';

if (!$id) {
    echo "Invalid item ID.";
    exit;
}

$result = $conn->query("SELECT * FROM items WHERE id = $id");
$row = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $item_name = $_POST["item_name"];
    $quantity = $_POST["quantity"];
    $category = $_POST["category"];

    // Handle expiry date conditionally
    if (!empty($row["expiry_date"])) {
        $expiry_date = $_POST["expiry_date"];
    } else {
        $expiry_date = NULL;
    }

    $stmt = $conn->prepare("UPDATE items SET name = ?, quantity = ?, category = ?, expiry_date = ? WHERE id = ?");
    $stmt->bind_param("sissi", $item_name, $quantity, $category, $expiry_date, $id);
    $stmt->execute();

    $success_message = "✅ Item updated successfully!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Item</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', sans-serif;
            background: url('https://i.pinimg.com/736x/34/75/1b/34751bfa17d02eb85b2250445f8a131b.jpg') no-repeat center center fixed;
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .container {
            position: relative;
            background: rgba(255, 255, 255, 0.9);
            padding: 40px;
            border-radius: 16px;
            box-shadow: 0 8px 30px rgba(0,0,0,0.1);
            width: 400px;
            animation: fadeIn 0.8s ease;
        }

        h2 {
            text-align: center;
            color: #2c3e50;
            margin-bottom: 20px;
        }

        form input[type="text"],
        form input[type="number"],
        form input[type="date"],
        form button {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border-radius: 8px;
            border: 1px solid #ccc;
            box-sizing: border-box;
            font-size: 16px;
        }

        form button {
            background-color: #3498db;
            color: white;
            border: none;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        form button:hover {
            background-color: #2980b9;
        }

        .shortcut-link {
            display: block;
            text-align: center;
            font-size: 16px;
            margin-bottom: 20px;
            color: #3498db;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .shortcut-link:hover {
            color: #2c3e50;
        }

        .message {
            position: absolute;
            top: -20px;
            left: 50%;
            transform: translateX(-50%);
            background-color: #FFDDC1;
            color: black;
            padding: 15px 25px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            font-weight: bold;
            animation: slideIn 0.5s ease-out forwards;
        }

        @keyframes slideIn {
            from { transform: translate(-50%, -30px); opacity: 0; }
            to { transform: translate(-50%, 0); opacity: 1; }
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>

<div class="container">
    <?php if ($success_message): ?>
        <div class="message"><?= $success_message ?></div>
    <?php endif; ?>

    <h2>Edit Item</h2>
    <a href="dashboard.php" class="shortcut-link">← Back to Dashboard</a>

    <form method="post">
        Item Name: <input type="text" name="item_name" value="<?= htmlspecialchars($row['name']) ?>" required>
        Quantity: <input type="number" name="quantity" value="<?= htmlspecialchars($row['quantity']) ?>" required>
        Category: <input type="text" name="category" value="<?= htmlspecialchars($row['category']) ?>">
        
        <?php if (!empty($row['expiry_date'])): ?>
            Expiry Date: <input type="date" name="expiry_date" value="<?= htmlspecialchars($row['expiry_date']) ?>">
        <?php else: ?>
            <input type="hidden" name="expiry_date" value="">
        <?php endif; ?>

        <button type="submit">Update Item</button>
    </form>
</div>

<script src="js/script.js"></script>
</body>
</html>
