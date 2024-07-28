<?php require_once __DIR__.'./incloud/header.php'; ?>

<!-- Events Start -->
<div class="container-fluid event py-6">
    <div class="container">
        <div class="text-center wow bounceInUp" data-wow-delay="0.1s">
            <small class="d-inline-block fw-bold text-dark text-uppercase bg-light border border-primary rounded-pill px-4 py-1 mb-3">Latest Events</small>
            <h1 class="display-5 mb-5">Our Social & Professional Events Gallery</h1>
        </div>
        <div class="tab-class text-center">
            <ul class="nav nav-pills d-inline-flex justify-content-center mb-5 wow bounceInUp" data-wow-delay="0.1s">
                <!-- Your tabs code -->
            </ul>
            <div class="tab-content">
                <div id="tab-1" class="tab-pane fade show p-0 active">
                    <div class="row g-4">
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

                            // Fetch events data
                            $sql = "SELECT id, name, image FROM events";
                            $stmt = $pdo->query($sql);

                            // Display events
                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                echo '<div class="col-md-6 col-lg-3 wow bounceInUp" data-wow-delay="0.1s">';
                                echo '<div class="event-img position-relative">';
                                echo '<a href="singleevent.php?event_id=' . $row['id'] . '">';
                                echo '<img class="img-fluid rounded w-100" src="img/' . htmlspecialchars($row['image']) . '" alt="">';
                                echo '<div class="event-overlay d-flex flex-column p-4">';
                                echo '<h4 class="text-white fs-5">' . htmlspecialchars($row['name']) . '</h4>'; // Increase font size here
                                // You can adjust the padding and text alignment as needed
                                echo '</div></a></div></div>';
                            }
                        } catch(PDOException $e) {
                            echo 'Connection failed: ' . $e->getMessage();
                        }
                        ?>
                    </div>
                </div>
                <!-- Other tabs content -->
            </div>
        </div>
    </div>
</div>
<!-- Events End -->

<?php require_once __DIR__ .'./incloud/footer.php'; ?>
