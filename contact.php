<?php require_once __DIR__.'./incloud/header.php'; ?>

<!-- Contact Start -->
<div class="container-fluid contact py-6 wow bounceInUp" data-wow-delay="0.1s">
    <div class="container">
        <div class="p-5 bg-light rounded contact-form">
            <div class="row g-4">
                <div class="col-12">
                    <small class="d-inline-block fw-bold text-dark text-uppercase bg-light border border-primary rounded-pill px-4 py-1 mb-3">Get in touch</small>
                    <h1 class="display-5 mb-0">Contact Us For Any Queries!</h1>
                </div>
                <div class="col-md-6 col-lg-7">
                    <form action="https://formsubmit.co/your@email.com" method="post">
                        <input type="text" name="name" class="w-100 form-control p-3 mb-4 border-primary bg-light" placeholder="Your Name" required>
                        <input type="email" name="email" class="w-100 form-control p-3 mb-4 border-primary bg-light" placeholder="Enter Your Email" required>
                        <textarea name="message" class="w-100 form-control mb-4 p-3 border-primary bg-light" rows="4" placeholder="Your Message" required></textarea>
                        <button type="submit" class="w-100 btn btn-primary form-control p-3 border-primary bg-primary rounded-pill">Submit Now</button>
                    </form>
                </div>
                <div class="col-md-6 col-lg-5">
                    <div>
                        <div class="d-inline-flex w-100 border border-primary p-4 rounded mb-4">
                            <i class="fas fa-map-marker-alt fa-2x text-primary me-4"></i>
                            <div class="">
                                <h4>Address</h4>
                                <p>1000 Street, Rabat, Morocco</p>
                            </div>
                        </div>
                        <div class="d-inline-flex w-100 border border-primary p-4 rounded mb-4">
                            <i class="fas fa-envelope fa-2x text-primary me-4"></i>
                            <div class="">
                                <h4>Mail Us</h4>
                                <p class="mb-2">caterfo@gmail.com</p>
                                <p class="mb-0">support@gmail.com</p>
                            </div>
                        </div>
                        <div class="d-inline-flex w-100 border border-primary p-4 rounded">
                            <i class="fa fa-phone-alt fa-2x text-primary me-4"></i>
                            <div class="">
                                <h4>Telephone</h4>
                                <p class="mb-2">(+212)06 00 00 00 00</p>
                                <p class="mb-0">(+212)05 00 00 00 00</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Contact End -->

<?php require_once __DIR__ .'./incloud/footer.php'; ?>
