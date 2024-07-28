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
    if (!empty($_POST['name']) && !empty($_FILES['image'])) {
        // Get form data
        $name = $_POST['name'];

        // Get the name of the uploaded file
        $filename = basename($_FILES['image']['name']);

        // Move the uploaded file to the appropriate directory
        if(move_uploaded_file($_FILES['image']['tmp_name'], "img/$filename")) {
            // Prepare SQL statement for inserting data into the menu table
            $sql = "INSERT INTO menu (name, image) VALUES (:name, :image)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':image', $filename);

            // Execute the prepared statement
            if ($stmt->execute()) {
                echo '<div class="alert alert-success" role="alert">Menu item added successfully!</div>';
            } else {
                echo '<div class="alert alert-danger" role="alert">Failed to add menu item.</div>';
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
    <title>Form</title>
    <style>
        body {
            background-color: #f0f0f0; /* Set a background color */
        }
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 70vh; /* Make the container take up the full height of the viewport */
        }
        .form-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Add a shadow effect */
            width: 900px;
        }
        .form-label {
            margin-bottom: 5px;
        }
        .form-control {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        .btn-primary {
            background-color: #cfb874;
            color: #fff;
            border: none;
            border-radius: 4px;
            padding: 10px 20px;
            cursor: pointer;
        }
        .btn-primary:hover {
            background-color: #a8926a;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-container">
            <form method="POST" action="" enctype="multipart/form-data">
                <div class="form-group">
                    <label class="form-label" for="name">Name</label>
                    <input class="form-control" type="text" name="name" id="name" required>
                </div>

                <div class="form-group">
                    <label class="form-label" for="image">Image</label>
                    <input class="form-control" type="file" name="image" id="image" required>
                </div>

                <button class="btn btn-primary" type="submit">Submit</button>
            </form>
        </div>
    </div>
</body>
</html>
