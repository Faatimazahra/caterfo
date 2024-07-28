<?php require_once __DIR__.'./incloud/header.php';?>

<!-- Menu Start -->
<div class="container-fluid menu py-6">
    <div class="container">
        <div class="text-center wow bounceInUp" data-wow-delay="0.1s">
            <small class="d-inline-block fw-bold text-dark text-uppercase bg-light border border-primary rounded-pill px-4 py-1 mb-3">Our Menu</small>
            <h1 class="display-5 mb-5">Most Popular Food in the World</h1>
        </div>
        <div class="tab-class text-center">
            <div class="tab-content">
                <div id="tab-6" class="tab-pane fade show p-0 active">
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

                            // Fetch menu items data
                            $sql = "SELECT name, image FROM menu";
                            $stmt = $pdo->query($sql);

                            // Display menu items
                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                echo '<div class="col-lg-6 wow bounceInUp" data-wow-delay="0.1s">';
                                echo '<div class="menu-item d-flex align-items-center">';
                                echo '<img class="flex-shrink-0 img-fluid rounded-circle" src="img/' . htmlspecialchars($row['image']) . '" alt="" style="width: 150px; height: 150px;">';
                                echo '<div class="w-100 d-flex flex-column text-start ps-4">';
                                echo '<div class="d-flex justify-content-between border-bottom border-primary pb-2 mb-2">';
                                echo '<h4>' . htmlspecialchars($row['name']) . '</h4>';
                                echo '</div>';
                                // Add description or other details here if needed
                                echo '</div></div></div>';
                            }
                        } catch(PDOException $e) {
                            echo 'Connection failed: ' . $e->getMessage();
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Menu End -->

<?php require_once __DIR__ .'./incloud/footer.php';?>
