<?php
    require_once __DIR__."./index.html";

require_once __DIR__."./cnx.php";

// Function to delete a flower by ID
function deleteFlower($pdo, $flowerId) {
    $sql = "DELETE FROM services WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $flowerId, PDO::PARAM_INT);
    return $stmt->execute();
}

try {
    $pdo = new PDO($dsn, DB_USER, DB_PASSWORD);

    // Check if flower ID is provided in the URL
    if (isset($_GET['id'])) {
        $flowerId = $_GET['id'];

        // Delete the flower from the database
        if (deleteFlower($pdo, $flowerId)) {
            // Respond with a success message
            echo "Row deleted successfully";
        } else {
            // Respond with an error message
            echo "Error deleting ";
        }
    } else {
        echo "Invalid  ID";
    }
} catch (PDOException $e) {
    echo 'erreur' /* .$e->getMessage() */;
}


// Process the form submission for deleting rows
if (isset($_POST['delete'])) {
    $deleteId = $_POST['delete_id'];
    if (deleteFlower($pdo, $deleteId)) {
        echo "Row deleted successfully";
       
    } else {
        echo "Error deleting flower";
    }
}

// Close the PDO connection
$pdo = null;
?>
