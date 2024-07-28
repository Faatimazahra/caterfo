<?php
    require_once __DIR__."./index.html";

require_once __DIR__."./cnx.php";

// Function to delete a menu item by ID
function deleteMenuItem($pdo, $itemId) {
    $sql = "DELETE FROM menu WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $itemId, PDO::PARAM_INT);
    return $stmt->execute();
}

try {
    // Create a PDO instance
    $pdo = new PDO($dsn, DB_USER, DB_PASSWORD);
    // Set PDO to throw exceptions on error
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Check if menu item ID is provided in the URL
    if (isset($_GET['id'])) {
        $itemId = $_GET['id'];

        // Delete the menu item from the database
        if (deleteMenuItem($pdo, $itemId)) {
            // Respond with a success message
            echo "Menu item deleted successfully";
        } else {
            // Respond with an error message
            echo "Error deleting menu item";
        }
    } else {
        echo "Invalid menu item ID";
    }
} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}

// Close the PDO connection
$pdo = null;
?>
