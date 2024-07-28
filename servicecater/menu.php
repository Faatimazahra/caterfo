<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Service Management</title>
    <style>
        /* Styles for the table */
table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
}

table th, table td {
    padding: 8px;
    border: 1px solid #ddd;
    text-align: left;
}

table th {
    background-color: #cfb874;
}

/* Styles for the button */
a button {
    display: inline-block;
    padding: 10px 20px;
    background-color: #cfb874;
    color: #fff;
    text-decoration: none;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

a button:hover {
    background-color: #cfb874;
}
table a {
    display: inline-block;
    padding: 6px 10px;
    background-color: #cfb874;
    color: #fff;
    text-decoration: none;
    border-radius: 4px;
}

table a:hover {
    background-color: #cfb874;
}
    </style>
    
</head>
<body>
<a href="insertmenu.php"><button>Add New Menu Item</button></a>

<?php
require_once __DIR__."./cnx.php";

try {
    // Create a PDO instance
    $pdo = new PDO($dsn, DB_USER, DB_PASSWORD);
    // Set PDO to throw exceptions on error
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Fetch and display menu data
    $sql = "SELECT * FROM menu";
    $result = $pdo->query($sql);

    if ($result->rowCount() > 0) {
        echo "<table border='1'><tr><th>ID</th><th>Name</th><th>Image</th><th>Actions</th></tr>";
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr><td>" . $row["id"] . "</td><td>" . $row["name"] . "</td>";
            // Display the image
            echo "<td><img src='img/" . $row["image"] . "' alt='" . $row["name"] . "' style='max-width: 100px; max-height: 100px;'></td>";
            // Provide links for edit and delete actions
            echo "<td><a href='editmenu.php?id=" . $row["id"] . "'>Edit</a> | <a href='deletemenu.php?id=" . $row["id"] . "'>Delete</a></td></tr>";
        }
        echo "</table>";
    } else {
        echo "No menu items found";
    }
} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}
?>
