<?php
// Include database connection file
require_once 'db_connection.php';

// Fetch data from the service table
$sql = "SELECT * FROM service";
$result = mysqli_query($conn, $sql);

// Display data in a table
if (mysqli_num_rows($result) > 0) {
    echo '<table class="table">';
    echo '<thead><tr><th>ID</th><th>Name</th><th>Description</th></tr></thead>';
    echo '<tbody>';
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<tr>';
        echo '<td>' . $row['id'] . '</td>';
        echo '<td>' . $row['name'] . '</td>';
        echo '<td>' . $row['description'] . '</td>';
        echo '</tr>';
    }
    echo '</tbody>';
    echo '</table>';
} else {
    echo 'No data found.';
}

// Close database connection
mysqli_close($conn);
?>
