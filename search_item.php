<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include("includes/db_connect.php");

$search = "";
$searchResults = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $search = $_POST["search"];
    $result = $conn->query("SELECT * FROM items WHERE name LIKE '%$search%'");

    if ($result->num_rows > 0) {
        $searchResults .= "<div class='results'>";
        while ($row = $result->fetch_assoc()) {
            $searchResults .= "
                <div class='card'>
                    <h2>{$row['name']}</h2>
                    <p>Quantity: <strong>{$row['quantity']}</strong></p>
                    <p>Category: {$row['category']}</p>
                </div>";
        }
        $searchResults .= "</div>";
    } else {
        $searchResults = "<p class='no-match'>No matching items found.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Search Inventory</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding: 40px 20px;
            background: url('https://i.pinimg.com/originals/e4/2b/8b/e42b8ba79cd4cfa1849ca187c5f84acb.gif') no-repeat center center fixed;
            background-size: cover;
            color: #2c3e50;
        }

        .overlay {
            background-color: rgba(255, 255, 255, 0.9);
            padding: 30px;
            border-radius: 12px;
            max-width: 700px;
            margin: auto;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        }

        h1 {
            text-align: center;
            margin-bottom: 25px;
            font-size: 32px;
            color: #34495e;
        }

        form {
            text-align: center;
            margin-bottom: 20px;
        }

        input[type="text"] {
            padding: 12px;
            font-size: 16px;
            width: 280px;
            border-radius: 8px;
            border: 1px solid #ccc;
            box-shadow: inset 0 1px 2px rgba(0,0,0,0.1);
        }

        button {
            padding: 12px 18px;
            font-size: 16px;
            background-color: #3498db;
            color: white;
            border: none;
            border-radius: 8px;
            margin-left: 10px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #2980b9;
        }

        .shortcut-link {
            display: block;
            margin: 10px auto 30px;
            text-align: center;
            font-size: 18px;
            color: #3498db;
            text-decoration: none;
            background-color: #ecf0f1;
            padding: 10px 20px;
            border-radius: 6px;
            border: 1px solid #3498db;
            transition: all 0.3s ease;
            width: fit-content;
        }

        .shortcut-link:hover {
            background-color: #3498db;
            color: white;
        }

        .results {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            justify-content: center;
            margin-top: 20px;
        }

        .card {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            width: 260px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            transition: transform 0.2s ease;
        }

        .card:hover {
            transform: scale(1.03);
        }

        .card h2 {
            margin-top: 0;
            color: #2c3e50;
            font-size: 20px;
        }

        .card p {
            margin: 5px 0;
            font-size: 16px;
        }

        .no-match {
            text-align: center;
            font-style: italic;
            color: #c0392b;
            font-size: 18px;
            margin-top: 20px;
        }
    </style>
</head>
<body>

<div class="overlay">
    <h1>Search Inventory</h1>

    <a href="dashboard.php" class="shortcut-link">← Back to Dashboard</a>

    <form method="post">
        <input type="text" name="search" placeholder="Search item name..." required>
        <button type="submit">Find</button>
    </form>

    <?php echo $searchResults; ?>
</div>

<script src="js/script.js"></script>
</body>
</html>

