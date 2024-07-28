<?php require_once __DIR__.'./incloud/header.php';?>
        <!-- Hero Start -->
        <div class="container-fluid bg-light py-6 my-6 mt-0">
            <div class="container">
                <div class="row g-5 align-items-center">
                    <div class="col-lg-7 col-md-12">
                        <small class="d-inline-block fw-bold text-dark text-uppercase bg-light border border-primary rounded-pill px-4 py-1 mb-4 animated bounceInDown">Welcome to CaterfO</small>
                        <h1 class="display-1 mb-4 animated bounceInDown">Book <span class="text-primary">Cater</span>fO For Your Dream Event</h1>
                        <a href="contact.php" class="btn btn-primary border-0 rounded-pill py-3 px-4 px-md-5 animated bounceInLeft">Know More</a>
                    </div>
                    <div class="col-lg-5 col-md-12">
                        <img src="img/hero.png" class="img-fluid rounded animated zoomIn" alt="">
                    </div>
                </div>
            </div>
        </div>
        <!-- Hero End -->


        <!-- About Satrt -->
        <div class="container-fluid py-6">
            <div class="container">
                <div class="row g-5 align-items-center">
                <div class="col-lg-5 wow bounceInUp" data-wow-delay="0.1s">
                        <div class="video">
                            <button type="button" class="btn btn-play" data-bs-toggle="modal" data-src="https://youtu.be/ji1zcXCTbJE?si=rgfxsTRr2Om3ZA98" data-bs-target="#videoModal">
                                <span></span>
                            </button>
                        </div>
                    </div>
                    <div class="col-lg-7 wow bounceInUp" data-wow-delay="0.3s">
                        <small class="d-inline-block fw-bold text-dark text-uppercase bg-light border border-primary rounded-pill px-4 py-1 mb-3">About Us</small>
                        <h1 class="display-5 mb-4">Trusted By 200 + satisfied clients</h1>
                        <p class="mb-4">Welcome to CaterFO We're a passionate team of food enthusiasts 
                            dedicated to making every event special. Since 2008,
                             we've been bringing people together through memorable culinary experiences.</p>
                        <div class="row g-4 text-dark mb-5">
                            <div class="col-sm-6">
                                <i class="fas fa-share text-primary me-2"></i>We insist on the best ingredients and top-notch presentation.
                            </div>
                            <div class="col-sm-6">
                                <i class="fas fa-share text-primary me-2"></i>24/7 Customer Support
                            </div>
                            <div class="col-sm-6">
                                <i class="fas fa-share text-primary me-2"></i>Easy Customization Options
                            </div>
                            <div class="col-sm-6">
                                <i class="fas fa-share text-primary me-2"></i>Delicious Deals for Delicious Meals
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- About End -->


        
        <!-- Modal Video -->
        <div class="modal fade" id="videoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content rounded-0">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Youtube Video</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- 16:9 aspect ratio -->
                        <div class="ratio ratio-16x9">
                            <iframe class="embed-responsive-item" src="" id="video" allowfullscreen allowscriptaccess="always"
                                allow="autoplay"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Fact End -->

        <?php require_once __DIR__ .'./incloud/footer.php';?>