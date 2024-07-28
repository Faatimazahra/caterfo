<?php
    require_once __DIR__."./index.html";

require_once __DIR__."./cnx.php";

// Initialize variables for form input and errors
$name = $description = '';
$name_err = $description_err = '';
$success_message = '';

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate name
    if (empty(trim($_POST["name"]))) {
        $name_err = "Please enter the service name.";
    } else {
        $name = trim($_POST["name"]);
    }

    // Validate description
    if (empty(trim($_POST["description"]))) {
        $description_err = "Please enter the description.";
    } else {
        $description = trim($_POST["description"]);
    }

    // Check input errors before inserting into database
    if (empty($name_err) && empty($description_err)) {
        try {
            // Create a PDO instance
            $pdo = new PDO($dsn, DB_USER, DB_PASSWORD);
            // Set PDO to throw exceptions on error
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Prepare an SQL statement to insert a new service
            $sql = "INSERT INTO services (name, description) VALUES (:name, :description)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':description', $description);

            // Execute the prepared statement
            if ($stmt->execute()) {
                // Provide feedback for successful addition
                $success_message = "Service added successfully.";
                // Clear form inputs after successful addition
                $name = $description = '';
            } else {
                echo "Something went wrong. Please try again later.";
            }
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }

        // Close the PDO connection
        unset($pdo);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add New Service</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
        }
        .wrapper {
            width: 50%;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            display: block;
            font-weight: bold;
        }
        input[type="text"],
        textarea {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        .help-block {
            color: red;
        }
        .success-message {
            color: green;
            text-align: center;
            margin-top: 10px;
        }
        input[type="submit"] {
            background-color: #cfb874;
            color: #fff;
            border: none;
            border-radius: 4px;
            padding: 10px 20px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        input[type="submit"]:hover {
            background-color: #a8926a;
        }
        a {
            text-decoration: none;
            color: #333;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Add New Service</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
                <label>Service Name</label>
                <input type="text" name="name" value="<?php echo htmlspecialchars($name); ?>">
                <span class="help-block"><?php echo $name_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($description_err)) ? 'has-error' : ''; ?>">
                <label>Description</label>
                <textarea name="description"><?php echo htmlspecialchars($description); ?></textarea>
                <span class="help-block"><?php echo $description_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" name="submit" value="Submit">
                <a href="/servicecater">Cancel</a>
            </div>
        </form>
        <div class="success-message"><?php echo $success_message; ?></div>
    </div>
</body>
</html>
