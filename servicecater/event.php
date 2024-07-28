<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Event Management</title>
    <style>
        /* Styles for the table and buttons */
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

        a.button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #cfb874;
            color: #fff;
            text-decoration: none;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        a.button:hover {
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

        /* Style for images */
        .event-image {
            max-width: 100px;
            max-height: 100px;
        }
    </style>
</head>
<body>
    <a href="insertevent.php" class="button">Add New Event</a>

    <?php
  require_once __DIR__."./cnx.php";

    try {
        // Create a PDO instance
        $pdo = new PDO($dsn, DB_USER, DB_PASSWORD);
        // Set PDO to throw exceptions on error
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Fetch and display event data
        $sql = "SELECT id, name, image,description FROM events";
        $result = $pdo->query($sql);

        if ($result->rowCount() > 0) {
            echo "<table border='1'><tr><th>ID</th><th>Name</th><th>Image</th><th>description</th><th>Actions</th></tr>";
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr><td>" . htmlspecialchars($row["id"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["name"]) . "</td>";
                echo "<td><img src='img/" . htmlspecialchars($row["image"]) . "' class='event-image' alt='Event Image'></td>";
                echo "<td>" . htmlspecialchars($row["description"]) . "</td>";
                // If you have a date field, display it here
                echo "<td><a href='editevent.php?id=" . $row["id"] . "'>Edit</a> | <a href='deleteevent.php?id=" . $row["id"] . "'>Delete</a></td></tr>";
            }
            echo "</table>";
        } else {
            echo "No events found";
        }
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
    ?>
</body>
</html>
