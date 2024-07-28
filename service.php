<?php require_once __DIR__.'./incloud/header.php';?>

<!-- Service Start -->
<div class="container-fluid service py-6">
    <div class="container">
        <div class="text-center wow bounceInUp" data-wow-delay="0.1s">
            <small class="d-inline-block fw-bold text-dark text-uppercase bg-light border border-primary rounded-pill px-4 py-1 mb-3">Our Services</small>
            <h1 class="display-5 mb-5">What We Offer</h1>
        </div>

        <div class="row g-4">
            <?php
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

                // Fetch services data
                $sql = "SELECT name, description FROM services";
                $stmt = $pdo->query($sql);

                // Display services
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo '<div class="col-lg-3 col-md-6 col-sm-12 wow bounceInUp" data-wow-delay="0.1s">';
                    echo '<div class="bg-light rounded service-item">';
                    echo '<div class="service-content d-flex align-items-center justify-content-center p-4">';
                    echo '<div class="service-content-icon text-center">';
                    echo '<h4 class="mb-3">' . htmlspecialchars($row['name']) . '</h4>';
                    echo '<p class="mb-4">' . htmlspecialchars($row['description']) . '</p>';
                    echo '</div></div></div></div>';
                }
            } catch(PDOException $e) {
                echo 'Connection failed: ' . $e->getMessage();
            }
            ?>
        </div>
    </div>
</div>
<!-- Service End -->

<?php require_once __DIR__ .'./incloud/footer.php';?>
