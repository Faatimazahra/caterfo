<?php
require_once __DIR__."./index.html";
require_once __DIR__."./cnx.php";

// Function to update a flower by ID
function updateFlower($pdo, $flowerId, $name, $description) {
    $sql = "UPDATE services SET name = :name, description = :description WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':id', $flowerId, PDO::PARAM_INT);
    return $stmt->execute();
}

try {
    // Create PDO instance
    $pdo = new PDO($dsn, DB_USER, DB_PASSWORD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Check if flower ID is provided in the URL
    if (isset($_GET['id'])) {
        $flowerId = $_GET['id'];

        // Fetch flower details from the database
        $sql = "SELECT * FROM services WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $flowerId, PDO::PARAM_INT);
        $stmt->execute();
        $flower = $stmt->fetch(PDO::FETCH_ASSOC);

        // If the flower exists, display the edit form
        if ($flower) {
?>
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
                <link rel="stylesheet" href="styles.css">
                <title>Edit services</title>
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
                        <h2>Edit services</h2>
                        <form method="post">
                            <input type="hidden" name="id" value="<?php echo $flower['id']; ?>">
                            <label for="name">Name:</label><br>
                            <input type="text" id="name" name="name" value="<?php echo $flower['name']; ?>" class="form-control"><br>
                            <label for="description">Description:</label><br>
                            <textarea id="description" name="description" class="form-control"><?php echo $flower['description']; ?></textarea><br>
                            <input type="submit" name="submit" value="Update" class="btn btn-primary">
                        </form>
                    </div>
                </div>
            </body>
            </html>
<?php
        } else {
            echo "services not found.";
        }
    } else {
        echo "Invalid flower ID.";
    }
} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}

// Process the form submission for updating the flower
if (isset($_POST['submit'])) {
    $flowerId = $_POST['id'];
    $name = $_POST['name'];
    $description = $_POST['description'];

    if (updateFlower($pdo, $flowerId, $name, $description)) {
        echo "services updated successfully.";
    } else {
        echo "Error updating services.";
    }
}

// Close the PDO connection
$pdo = null;
?>
