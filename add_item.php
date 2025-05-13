<?php
include("includes/db_connect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $item_name = $_POST["item_name"];
    $quantity = $_POST["quantity"];
    $category = $_POST["category"];
    $perishable = $_POST["perishable"];
    $expiry_date = ($perishable === "Perishable") ? $_POST["expiry_date"] : NULL;

    $stmt = $conn->prepare("INSERT INTO items (name, quantity, category, expiry_date) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("siss", $item_name, $quantity, $category, $expiry_date);
    $stmt->execute();
    $success_message = "Item added successfully!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Item - Inventory System</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', sans-serif;
            background: url('https://i.pinimg.com/originals/8f/31/bf/8f31bfefab54b77a1a58d146412ab953.gif') no-repeat center center fixed;
            background-size: cover;
        }

        h1 {
            text-align: center;
            color: rgb(145, 173, 201);
            font-size: 36px;
            margin: 30px 0 10px;
            text-shadow: 1px 1px 4px rgba(255,255,255,0.6);
        }

        form {
            background-color: rgba(255, 255, 255, 0.9);
            padding: 30px;
            border-radius: 10px;
            max-width: 420px;
            margin: 20px auto;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        input[type="text"],
        input[type="number"],
        input[type="date"],
        select,
        button {
            padding: 10px;
            margin: 10px 0;
            font-size: 16px;
            border-radius: 4px;
            border: 1px solid #ccc;
            width: 100%;
        }

        button {
            background-color: #e91e63;
            color: #fff;
            border: none;
            cursor: pointer;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #c2185b;
        }

        .success-message {
            position: fixed;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            background-color: #28a745;
            color: white;
            padding: 15px 30px;
            border-radius: 25px;
            font-size: 18px;
            font-weight: bold;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
            opacity: 0;
            animation: slideIn 3s forwards;
        }

        @keyframes slideIn {
            0% {
                opacity: 0;
                top: -100px;
            }
            100% {
                opacity: 1;
                top: 20px;
            }
        }

        .shortcut-link {
            display: block;
            margin: 0 auto 20px;
            text-align: center;
            font-size: 18px;
            color: #e91e63;
            text-decoration: none;
            background-color: #fff0f5;
            padding: 10px 20px;
            border-radius: 5px;
            border: 1px solid #e91e63;
            width: fit-content;
            transition: background-color 0.3s ease;
        }

        .shortcut-link:hover {
            background-color: #e91e63;
            color: white;
        }
    </style>
</head>
<body>

<h1>Inventory Management System</h1>

<a href="dashboard.php" class="shortcut-link">🏠 Go to Dashboard</a>

<form method="post">
    Item Name:
    <input type="text" name="item_name" required><br>

    Quantity:
    <input type="number" name="quantity" required><br>

    Category:
    <input type="text" name="category"><br>

    Is the item perishable?
    <select name="perishable" id="perishable" required onchange="toggleExpiry()">
        <option value="">Select</option>
        <option value="Perishable">Perishable</option>
        <option value="Non-Perishable">Non-Perishable</option>
    </select><br>

    <div id="expiryField" style="display: none;">
        Expiry Date:
        <input type="date" name="expiry_date"><br>
    </div>

    <button type="submit">➕ Add Item</button>
</form>

<?php
if (isset($success_message)) {
    echo "<div class='success-message'>{$success_message}</div>";
}
?>

<script>
function toggleExpiry() {
    const perishableSelect = document.getElementById("perishable");
    const expiryField = document.getElementById("expiryField");
    
    if (perishableSelect.value === "Perishable") {
        expiryField.style.display = "block";
    } else {
        expiryField.style.display = "none";
    }
}
</script>

</body>
</html>
