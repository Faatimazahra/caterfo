<?php
    require_once __DIR__."./index.html";

require_once __DIR__."./cnx.php";

// Function to delete an event by ID
function deleteEvent($pdo, $eventId) {
    $sql = "DELETE FROM events WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $eventId, PDO::PARAM_INT);
    return $stmt->execute();
}

try {
    // Create a PDO instance
    $pdo = new PDO($dsn, DB_USER, DB_PASSWORD);
    // Set PDO to throw exceptions on error
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Check if event ID is provided in the URL
    if (isset($_GET['id'])) {
        $eventId = $_GET['id'];

        // Delete the event from the database
        if (deleteEvent($pdo, $eventId)) {
            // Respond with a success message
            echo "Event deleted successfully";
        } else {
            // Respond with an error message
            echo "Error deleting event";
        }
    } else {
        echo "Invalid event ID";
    }
} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}

// Close the PDO connection
$pdo = null;
?>
