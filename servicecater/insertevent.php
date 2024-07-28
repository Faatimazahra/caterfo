<?php
    require_once __DIR__."./index.html";

// Database connection parameters
$host = 'localhost'; // Change this to your database host
$dbname = 'caterserv'; // Change this to your database name
$username = 'root'; // Change this to your database username
$password = ''; // Change this to your database password

// Attempt to connect to the database
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Set PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
    die(); // Stop script execution if unable to connect to the database
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all form fields are filled
    if (!empty($_POST['name']) && !empty($_POST['description']) && !empty($_FILES['image'])) {
        // Get form data
        $name = $_POST['name'];
        $description = $_POST['description'];

        // Get the name of the uploaded file
        $filename = basename($_FILES['image']['name']);

        // Move the uploaded file to the appropriate directory
        if(move_uploaded_file($_FILES['image']['tmp_name'], "img/$filename")) {
            // Prepare SQL statement for inserting data into the events table
            $sql = "INSERT INTO events (name, description, image) VALUES (:name, :description, :image)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':image', $filename);

            // Execute the prepared statement
            if ($stmt->execute()) {
                echo '<div class="alert alert-success" role="alert">Event added successfully!</div>';
            } else {
                echo '<div class="alert alert-danger" role="alert">Failed to add event.</div>';
            }
        } else {
            echo '<div class="alert alert-danger" role="alert">Failed to upload image.</div>';
        }
    } else {
        echo '<div class="alert alert-danger" role="alert">All fields are required.</div>';
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Event Management</title>
    <style>
        /* Styles for the form container */
        .form-container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        /* Styles for form labels */
        .form-label {
            font-weight: bold;
        }

        /* Styles for form inputs */
        .form-control {
            width: 100%;
            padding: 8px;
            margin: 6px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        /* Styles for the submit button */
        .submit-button {
            background-color: #cfb874;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .submit-button:hover {
            background-color: #a78c4d;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <?php
        // Your PHP code for database connection and form submission goes here
        ?>

        <form method="POST" action="" enctype="multipart/form-data">
            <label class="form-label" for="name">Name</label>
            <input class="form-control" type="text" name="name" id="name" required>

            <label class="form-label" for="image">Image</label>
            <input class="form-control" type="file" name="image" id="image" required>

            <label class="form-label" for="description">Description</label>
            <input class="form-control" type="text" name="description" id="description" required>

            <button class="submit-button" type="submit">Submit</button>
        </form>
    </div> 
</body>
</html>
