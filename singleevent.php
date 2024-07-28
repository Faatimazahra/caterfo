<?php require_once __DIR__.'./incloud/header.php'; ?>

<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2"> <!-- Adjusted column width -->
            <?php
            // Database connection parameters
            $host = 'localhost'; // Change this to your database host
            $dbname = 'caterserv'; // Change this to your database name
            $username = 'root'; // Change this to your database username
            $password = ''; // Change this to your database password

            try {
                // Attempt to connect to the database
                $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
                // Set PDO error mode to exception
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                // Check if event_id is set
                if(isset($_GET['event_id'])) {
                    $event_id = $_GET['event_id'];
                    // Fetch event details
                    $stmt = $pdo->prepare("SELECT name, description, image FROM events WHERE id = ?");
                    $stmt->execute([$event_id]);
                    $event = $stmt->fetch(PDO::FETCH_ASSOC);
                    
                    // Display event details with Bootstrap styling
                    echo '<h2 class="display-2">' . htmlspecialchars($event['name']) . '</h2>';
                    echo '<div class="text-center"><img src="img/' . htmlspecialchars($event['image']) . '" alt="Event Image" class="img-fluid" style="max-width: 70%; height: auto;"></div>'; // Adjusted styling for medium size
                    echo '<p class="display-7">' . htmlspecialchars($event['description']) . '</p>'; // Justify text
                } else {
                    echo "Event ID not specified.";
                }
            } catch(PDOException $e) {
                echo 'Connection failed: ' . $e->getMessage();
            }
            ?>
        </div>
    </div>
</div>

<?php require_once __DIR__.'./incloud/footer.php'; ?>
