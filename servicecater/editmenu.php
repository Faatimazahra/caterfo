<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Menu Item</title>
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
    <?php
    require_once __DIR__."./index.html";

    require_once __DIR__."./cnx.php";

    // Function to update a menu item by ID
    function updateMenuItem($pdo, $itemId, $name, $image) {
        $sql = "UPDATE menu SET name = :name, image = :image WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':image', $image);
        $stmt->bindParam(':id', $itemId, PDO::PARAM_INT);
        return $stmt->execute();
    }

    try {
        // Create PDO instance
        $pdo = new PDO($dsn, DB_USER, DB_PASSWORD);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Check if menu item ID is provided in the URL
        if (isset($_GET['id'])) {
            $itemId = $_GET['id'];

            // Fetch menu item details from the database
            $sql = "SELECT * FROM menu WHERE id = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id', $itemId, PDO::PARAM_INT);
            $stmt->execute();
            $menuItem = $stmt->fetch(PDO::FETCH_ASSOC);

            // If the menu item exists, display the edit form
            if ($menuItem) {
    ?>
                <div class="container">
                    <div class="form-container">
                        <h2>Edit Menu Item</h2>
                        <form method="post" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<?php echo $menuItem['id']; ?>">
                            <label for="name">Name:</label><br>
                            <input type="text" id="name" name="name" value="<?php echo $menuItem['name']; ?>" class="form-control"><br>
                            <label for="image">Image:</label><br>
                            <img src="img/<?php echo $menuItem['image']; ?>" alt="<?php echo $menuItem['name']; ?>" style="max-width: 100px; max-height: 100px;"><br>
                            <input type="file" id="image" name="image" class="form-control"><br>
                            <input type="submit" name="submit" value="Update" class="btn-primary">
                        </form>
                    </div>
                </div>
    <?php
            } else {
                echo "Menu item not found.";
            }
        } else {
            echo "Invalid menu item ID.";
        }
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }

    // Process the form submission for updating the menu item
    if (isset($_POST['submit'])) {
        $itemId = $_POST['id'];
        $name = $_POST['name'];

        // Check if a new image is uploaded
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $filename = basename($_FILES['image']['name']);
            if (move_uploaded_file($_FILES['image']['tmp_name'], "img/$filename")) {
                // Update the menu item with the new image
                if (updateMenuItem($pdo, $itemId, $name, $filename)) {
                    echo "Menu item updated successfully.";
                } else {
                    echo "Error updating menu item.";
                }
            } else {
                echo "Failed to upload image.";
            }
        } else {
            // Update the menu item without changing the image
            if (updateMenuItem($pdo, $itemId, $name, $menuItem['image'])) {
                echo "Menu item updated successfully.";
            } else {
                echo "Error updating menu item.";
            }
        }
    }

    // Close the PDO connection
    $pdo = null;
    ?>
</body>
</html>
