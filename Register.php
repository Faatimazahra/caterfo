<?php require_once __DIR__.'./incloud/header.php';?>

<!-- Book Us Start -->
<div class="container-fluid contact py-6 wow bounceInUp" data-wow-delay="0.1s">
    <div class="container">
        <div class="row g-0">
            <div class="col-1">
                <img src="img/background-site.jpg" class="img-fluid h-100 w-100 rounded-start" style="object-fit: cover; opacity: 0.7;" alt="">
            </div>
            <div class="col-10">
                <div class="border-bottom border-top border-primary bg-light py-5 px-4">
                    <div class="text-center">
                        <small class="d-inline-block fw-bold text-dark text-uppercase bg-light border border-primary rounded-pill px-4 py-1 mb-3">Book Us</small>
                        <h1 class="display-5 mb-5">Where you want Our Services</h1>
                    </div>
                    <div class="row g-4 form">
                        <div class="col-12">
                            <form method="post" action="your_action_page.php">
                                <div class="mb-3">
                                    <input type="text" class="form-control border-primary p-2" name="name" placeholder="Enter Your Name">
                                </div>
                                <div class="mb-3">
                                    <input type="email" class="form-control border-primary p-2" name="email" placeholder="Enter Your Email">
                                </div>
                                <div class="mb-3">
                                    <input type="password" class="form-control border-primary p-2" name="password" placeholder="Enter Your Password">
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary px-5 py-3 rounded-pill">Register</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-1">
                <img src="img/background-site.jpg" class="img-fluid h-100 w-100 rounded-end" style="object-fit: cover; opacity: 0.7;" alt="">
            </div>
        </div>
    </div>
</div>

<!-- Book Us End -->


<?php require_once __DIR__ .'./incloud/footer.php';?>