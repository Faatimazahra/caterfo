<?php require_once __DIR__."./index.html";?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Event</title>
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
            padding: 40px;
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
            <?php
                

                require_once __DIR__."./cnx.php";

                // Function to update an event by ID
                function updateEvent($pdo, $eventId, $name, $description, $image) {
                    $sql = "UPDATE events SET name = :name, description = :description, image = :image WHERE id = :id";
                    $stmt = $pdo->prepare($sql);
                    $stmt->bindParam(':name', $name);
                    $stmt->bindParam(':description', $description);
                    $stmt->bindParam(':image', $image);
                    $stmt->bindParam(':id', $eventId, PDO::PARAM_INT);
                    return $stmt->execute();
                }

                try {
                    // Create PDO instance
                    $pdo = new PDO($dsn, DB_USER, DB_PASSWORD);
                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    // Check if event ID is provided in the URL
                    if (isset($_GET['id'])) {
                        $eventId = $_GET['id'];

                        // Fetch event details from the database
                        $sql = "SELECT * FROM events WHERE id = :id";
                        $stmt = $pdo->prepare($sql);
                        $stmt->bindParam(':id', $eventId, PDO::PARAM_INT);
                        $stmt->execute();
                        $event = $stmt->fetch(PDO::FETCH_ASSOC);

                        // If the event exists, display the edit form
                        if ($event) {
            ?>
                            <h2>Edit Event</h2>
                            <form method="post" enctype="multipart/form-data">
                                <input type="hidden" name="id" value="<?php echo $event['id']; ?>">
                                <label for="name">Name:</label><br>
                                <input type="text" id="name" name="name" value="<?php echo $event['name']; ?>" class="form-control"><br>
                                <label for="description">Description:</label><br>
                                <textarea id="description" name="description" class="form-control"><?php echo $event['description']; ?></textarea><br>
                                <label for="image">Image:</label><br>
                                <img src="img/<?php echo $event['image']; ?>" alt="<?php echo $event['name']; ?>" style="max-width: 100px; max-height: 100px;"><br>
                                <input type="file" id="image" name="image" class="form-control"><br>
                                <input type="submit" name="submit" value="Update" class="btn-primary">
                            </form>
            <?php
                        } else {
                            echo "Event not found.";
                        }
                    } else {
                        echo "Invalid event ID.";
                    }
                } catch (PDOException $e) {
                    echo 'Error: ' . $e->getMessage();
                }

                // Process the form submission for updating the event
                if (isset($_POST['submit'])) {
                    $eventId = $_POST['id'];
                    $name = $_POST['name'];
                    $description = $_POST['description'];

                    // Check if a new image is uploaded
                    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                        $filename = basename($_FILES['image']['name']);
                        if (move_uploaded_file($_FILES['image']['tmp_name'], "img/$filename")) {
                            // Update the event with the new image
                            if (updateEvent($pdo, $eventId, $name, $description, $filename)) {
                                echo "Event updated successfully.";
                            } else {
                                echo "Error updating event.";
                            }
                        } else {
                            echo "Failed to upload image.";
                        }
                    } else {
                        // Update the event without changing the image
                        if (updateEvent($pdo, $eventId, $name, $description, $event['image'])) {
                            echo "Event updated successfully.";
                        } else {
                            echo "Error updating event.";
                        }
                    }
                }

                // Close the PDO connection
                $pdo = null;
            ?>
        </div>
    </div>
</body>
</html>
