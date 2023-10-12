<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>G Mobility</title>
    <style>
        @font-face {
            font-family: 'Digital-7';
            src: url('fonts/digital-7 (mono italic).ttf') format('truetype');
        }
        @font-face {
            font-family: 'wlm';
            src: url('fonts/wlm_1f_block_sans.ttf') format('truetype');
        }
    </style>
    

    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

 
    <link href="img/favicon.ico" rel="icon">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/animate/animate.min.css" rel="stylesheet">


    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
<?php
// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if a marker exists in the session or a cookie to prevent resubmission
    if (!isset($_SESSION['form_submitted'])) {
        // Database connection details for inserting data
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "gmdb";

        // Create a connection for inserting data
        $conn = new mysqli($servername, $username, $password, $database);

        // Check connection for inserting data
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Check if the form fields are set before extracting data
        if (isset($_POST['clientName'], $_POST['clientEmail'], $_POST['clientMessage'])) {
            // Extract data from the form
            $clientName = $_POST['clientName'];
            $clientEmail = $_POST['clientEmail'];
            $clientMessage = $_POST['clientMessage'];

            // Insert data into the products table
            $sql = "INSERT INTO contacts (clientName, email, clientMessage) VALUES ('$clientName', '$clientEmail', '$clientMessage')";

            if ($conn->query($sql) === TRUE) {
                // Insertion successful, set the marker
                $_SESSION['form_submitted'] = true;
                // Redirect to the same page using GET to avoid resubmission
                header("Location: " . $_SERVER['PHP_SELF']);
                exit(); // Terminate the script after the redirect
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }

        // Close the database connection for inserting data
        $conn->close();
    }
}
?>

    <!-- Navbar  -->
    <div class="container-fluid position-relative p-0">   
        <nav class="navbar navbar-expand-lg navbar-dark px-5 py-3 py-lg-0">
            <a href="index.html" class="navbar-brand p-0">
                <h1 class="m-0"><img class="w-100" src="img/logo.png" alt="logo" style="max-width: 60px"></i>GMIT</h1>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="fa fa-bars"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto py-0">
                    <a href="index.html" class="nav-item nav-link active">Home</a>
                    <a href="software.html" class="nav-item nav-link" >Software Dev</a>
                    <a href="technical.html" class="nav-item nav-link" >Technical</a>
                    <a href="sales.html" class="nav-item nav-link">Sales</a>
                    <a href="printing.html" class="nav-item nav-link">Printing</a>
                </div>
                <butaton type="button" class="btn text-primary ms-3" data-bs-toggle="modal" data-bs-target="#searchModal"><i class="fa fa-search"></i></butaton>
            </div>
        </nav>

        <div id="header-carousel" class="carousel slide carousel-fade" data-bs-ride="carousel" style="background-color: white;">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <!-- particles.js container -->
                     <div id="particles-js"></div>
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3" style="max-width: 900px;">
                            <h5 class="text-white text-uppercase mb-3 animated slideInDown" style="font-family: 'Digital-7', sans-serif;">We are here, the rest is still to come</h5>
                            <h1 class="display-2 text-white mb-md-4 animated zoomIn" style="font-family: 'Digital-7', sans-serif;">G Mobility Invest Tech CC</h1>
                            <a href="quote.html" class="btn btn-primary py-md-3 px-md-5 me-3 animated slideInLeft" style="font-family: 'Digital-7', sans-serif;">Free Quote</a>
                            <a href="" class="btn btn-outline-light py-md-3 px-md-5 animated slideInRight" style="font-family: 'Digital-7', sans-serif;">Contact Us</a>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="w-100" src="img/carousel-2.jpg" alt="Image">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3" style="max-width: 900px;">
                            <h5 class="text-white text-uppercase mb-3 animated slideInDown" style="font-family: 'Digital-7', sans-serif;">We are here, the rest is still to come</h5>
                            <h1 class="display-2 text-white mb-md-4 animated zoomIn" style="font-family: 'Digital-7', sans-serif;">G Mobility Invest Tech CC</h1>
                            <a href="quote.html" class="btn btn-primary py-md-3 px-md-5 me-3 animated slideInLeft">Free Quote</a>
                            <a href="" class="btn btn-outline-light py-md-3 px-md-5 animated slideInRight">Contact Us</a>
                        </div>
                    </div>
                </div>
            </div>
            
            <button class="carousel-control-prev" type="button" data-bs-target="#header-carousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#header-carousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    <!-- Navbar End -->

    <!-- Full Screen Search Start -->
    <div class="modal fade" id="searchModal" tabindex="-1">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content" style="background: rgba(9, 30, 62, .7);">
                <div class="modal-header border-0">
                    <button type="button" class="btn bg-white btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body d-flex align-items-center justify-content-center">
                    <div class="input-group" style="max-width: 600px;">
                        <input type="text" class="form-control bg-transparent border-primary p-3" placeholder="Type search keyword">
                        <button class="btn btn-primary px-4"><i class="bi bi-search"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- particles.js container -->
<div id="particles-js"></div>

<!-- scripts -->
<script src="js/particles.js"></script>
<script src="js/app.js"></script>
<script src="js/lib/stats.js"></script>
<script>
  var count_particles, stats, update;
  stats = new Stats;
  stats.setMode(0);
  stats.domElement.style.position = 'absolute';
  stats.domElement.style.left = '0px';
  stats.domElement.style.top = '0px';
  document.body.appendChild(stats.domElement);
  count_particles = document.querySelector('.js-count-particles');
  update = function() {
    stats.begin();
    stats.end();
    if (window.pJSDom[0].pJS.particles && window.pJSDom[0].pJS.particles.array) {
      count_particles.innerText = window.pJSDom[0].pJS.particles.array.length;
    }
    requestAnimationFrame(update);
  };
  requestAnimationFrame(update);
</script>
<!-- Full Screen Search End -->


    <!-- Features Start -->
    <section class="features">
        <div class="container py-5">
            <div class="section-title text-center pb-3 mb-5">
                <h1 class="fw-bold text-uppercase" style="font-family: 'Digital-7', sans-serif;">About Us</h1>
            </div>
            <div class="row g-5">
                <div class="col-lg-4">
                    <div class="feature wow zoomIn" data-wow-delay="0.2s">
                        <div class="feature-icon bg-primary rounded-circle d-flex align-items-center justify-content-center">
                            <i class="fa fa-cubes text-white"></i>
                        </div>
                        <h4>Our Expertise</h4>
                        <p class="mb-0">At G-Mobility Investment Technology cc, we have a wealth of expertise and experience in the IT and mobile infrastructure industry. Our team of dedicated professionals is well-versed in the latest technologies and trends, allowing us to provide innovative solutions tailored to your needs.</p>
                    </div>
                </div>
                <div class="col-lg-4 wow zoomIn" data-wow-delay="0.6s">
                    <div class="feature">
                        <div class="feature-icon bg-primary rounded-circle d-flex align-items-center justify-content-center">
                            <i class="fa fa-award text-white"></i>
                        </div>
                        <h4>Our values</h4>
                        <ul>
                            <li>Innovation</li>
                            <li>Good Governance</li>
                            <li>Team Work</li>
                            <li>Creativity</li>
                            <li>Best Corporate Citizenship</li>

                        </ul>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="feature wow zoomIn" data-wow-delay="0.4s">
                        <div class="feature-icon bg-primary rounded-circle d-flex align-items-center justify-content-center">
                            <i class="fa fa-users-cog text-white"></i>
                        </div>
                        <h4>OUR AIM</h4>
                        G-Mobility Investments Technology CC’s aim is to cover the whole of namibia
                        with specialized and integrated it services and products, with g-mobility
                        investments technology cc mobile platform, information communication
                        and commercials services, g-mobility is in a position to provide services
                        across namibia.
                    </div>
                </div>
                <div class="col-lg-4 wow zoomIn" data-wow-delay="0.5s">
                    <div class="feature">
                        <div class="feature-icon bg-primary rounded-circle d-flex align-items-center justify-content-center">
                            <i class="fa fa-phone-alt text-white"></i>
                        </div>
                        <h4>Our Mission</h4>
                        <p class="mb-0">G-Mobility Investments Technology
                            cc’s Mission is to mentor and assist
                            the clients for day to day IT solutions
                            and services. The pricing of these IT
                            solutions and services are therefore
                            mutually beneficial to the clients and
                            G-Mobility Investment Technology cc</p>
                    </div>
                </div>
                <div class="col-lg-4 wow zoomIn" data-wow-delay="0.5s">
                    <div class="feature">
                        <div class="feature-icon bg-primary rounded-circle d-flex align-items-center justify-content-center">
                            <i class="fa fa-phone-alt text-white"></i>
                        </div>
                        <h4>Our Vision</h4>
                        <p class="mb-0">G-Mobility Investment Technology cc’s
                            vision is to take Namibian private
                            businesses clients and public
                            institutions from the current level to
                            the next high level in tandem with the
                            best IT solutions and practices. Once
                            this acceptable level is reached, it is GMobility Investments Technology cc’s
                            Vision to ensure that the standards do
                            not decline. In doing so, the platform
                            will be a cost-effective IT solutions and
                            MOBILE Services platform, which quite
                            easily support Vision 2030</p>
                    </div>
                </div>
                <div class="col-lg-4 wow zoomIn" data-wow-delay="0.5s">
                    <div class="feature">
                        <div class="feature-icon bg-primary rounded-circle d-flex align-items-center justify-content-center">
                            <i class="fa fa-phone-alt text-white"></i>
                        </div>
                        <h4>Company Overview</h4>
                        <p class="mb-0">G-Mobility Investment Technology cc 
                            is an IT solution and mobile infrastructure company based in Namibia, 
                            with its Headquarters in Windhoek, Namibia. 
                            G-Mobility Investment Technology cc delivers 
                            high-quality IT products and services to its clients.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Features Start -->


    <!-- Quote Start -->
    <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-7">
                    <div class="section-title position-relative pb-3 mb-5">
                        <h5 class="fw-bold text-primary text-uppercase">Contact Us</h5>
                        <h1 class="mb-0">Get in Touch with G-Mobility Investment Technology cc</h1>
                    </div>
                    <p class="mb-4">If you have any questions or need assistance, please feel free to contact us. We are here to help.</p>
                    <div class="d-flex align-items-center mt-2 wow zoomIn" data-wow-delay="0.6s">
                        <div class="bg-primary d-flex align-items-center justify-content-center rounded" style="width: 60px; height: 60px;">
                            <i class="fa fa-phone-alt text-white"></i>
                        </div>
                        <div class="ps-4">
                            <h5 class="mb-2">Call us</h5>
                            <h4 class="text-primary mb-0">+264 85 663 1980</h4>
                        </div>
                    </div>
                </div>
                <!--email form-->
                <div class="col-lg-5">
                    <div class="bg-primary rounded h-100 d-flex align-items-center p-5 wow zoomIn" data-wow-delay="0.9s">
                        <form action="index.php" method="POST">
                            <div class="row g-3">
                                <div class="col-12">
                                    <input type="text" name="clientName" class="form-control bg-light border-0" placeholder="Your Name" style="height: 55px;">
                                </div>
                                <div class="col-12">
                                    <input type="email" name="clientEmail" class="form-control bg-light border-0" placeholder="Your Email" style="height: 55px;">
                                </div>
                                <div class="col-12">
                                    <textarea class="form-control bg-light border-0" name="clientMessage" rows="3" placeholder="Message"></textarea>
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-dark w-100 py-3" type="submit">Send Message</button>
                                </div>
                            </div>
                            
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Quote End -->


    <!-- Testimonial Start -->
    <div class="container-fluid py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="section-title text-center position-relative pb-3 mb-4 mx-auto" style="max-width: 600px;">
                <h5 class="fw-bold text-primary text-uppercase">Testimonial</h5>
                <h1 class="mb-0">What Our Clients Say About Our Digital Services</h1>
            </div>
            <div class="owl-carousel testimonial-carousel wow fadeInUp" data-wow-delay="0.6s">
                <div class="testimonial-item bg-light my-4">
                    <div class="d-flex align-items-center border-bottom pt-5 pb-4 px-5">
                        <img class="img-fluid rounded" src="img/testimonial-1.jpg" style="width: 60px; height: 60px;" >
                        <div class="ps-4">
                            <h4 class="text-primary mb-1">Client Name</h4>
                            <small class="text-uppercase">Profession</small>
                        </div>
                    </div>
                    <div class="pt-4 pb-5 px-5">
                        Dolor et eos labore, stet justo sed est sed. Diam sed sed dolor stet amet eirmod eos labore diam
                    </div>
                </div>
                <div class="testimonial-item bg-light my-4">
                    <div class="d-flex align-items-center border-bottom pt-5 pb-4 px-5">
                        <img class="img-fluid rounded" src="img/testimonial-2.jpg" style="width: 60px; height: 60px;" >
                        <div class="ps-4">
                            <h4 class="text-primary mb-1">Client Name</h4>
                            <small class="text-uppercase">Profession</small>
                        </div>
                    </div>
                    <div class="pt-4 pb-5 px-5">
                        Dolor et eos labore, stet justo sed est sed. Diam sed sed dolor stet amet eirmod eos labore diam
                    </div>
                </div>
                <div class="testimonial-item bg-light my-4">
                    <div class="d-flex align-items-center border-bottom pt-5 pb-4 px-5">
                        <img class="img-fluid rounded" src="img/testimonial-3.jpg" style="width: 60px; height: 60px;" >
                        <div class="ps-4">
                            <h4 class="text-primary mb-1">Client Name</h4>
                            <small class="text-uppercase">Profession</small>
                        </div>
                    </div>
                    <div class="pt-4 pb-5 px-5">
                        Dolor et eos labore, stet justo sed est sed. Diam sed sed dolor stet amet eirmod eos labore diam
                    </div>
                </div>
                <div class="testimonial-item bg-light my-4">
                    <div class="d-flex align-items-center border-bottom pt-5 pb-4 px-5">
                        <img class="img-fluid rounded" src="img/testimonial-4.jpg" style="width: 60px; height: 60px;" >
                        <div class="ps-4">
                            <h4 class="text-primary mb-1">Client Name</h4>
                            <small class="text-uppercase">Profession</small>
                        </div>
                    </div>
                    <div class="pt-4 pb-5 px-5">
                        Dolor et eos labore, stet justo sed est sed. Diam sed sed dolor stet amet eirmod eos labore diam
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Testimonial End -->
    

    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-light mt-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container">
            <div class="row gx-5">
                <div class="col-lg-8 col-md-6">
                    <div class="row gx-5">
                        <div class="col-lg-4 col-md-12 pt-5 mb-5">
                            <div class="section-title section-title-sm position-relative pb-3 mb-4">
                                <h3 class="text-light mb-0">Get In Touch</h3>
                            </div>
                            <div class="d-flex mb-2">
                                <i class="bi bi-geo-alt text-primary me-2"></i>
                                <p class="mb-0"> Fab House, Unit 10, 414 Independence Ave, Windhoek, Khomas Region, Namibia</p>
                            </div>
                            <div class="d-flex mb-2">
                                <i class="bi bi-envelope-open text-primary me-2"></i>
                                <p class="mb-0">info@gmobility.com.na</p>
                            </div>
                            <div class="d-flex mb-2">
                                <i class="bi bi-telephone text-primary me-2"></i>
                                <p class="mb-0">+264 85 663 1980</p>
                            </div>
                            <div class="d-flex mt-4">
                                <a class="btn btn-primary btn-square me-2" href="#"><i class="fab fa-twitter fw-normal"></i></a>
                                <a class="btn btn-primary btn-square me-2" href="#"><i class="fab fa-facebook-f fw-normal"></i></a>
                                <a class="btn btn-primary btn-square me-2" href="#"><i class="fab fa-linkedin-in fw-normal"></i></a>
                                <a class="btn btn-primary btn-square" href=""><i class="fab fa-instagram fw-normal"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-12 pt-0 pt-lg-5 mb-5">
                            <div class="section-title section-title-sm position-relative pb-3 mb-4">
                                <h3 class="text-light mb-0">Quick Links</h3>
                            </div>
                            <div class="link-animated d-flex flex-column justify-content-start">
                                <a class="text-light mb-2" href="index.html"><i class="bi bi-arrow-right text-primary me-2"></i>Home</a>
                                <a class="text-light mb-2" href="software.html"><i class="bi bi-arrow-right text-primary me-2"></i>Software Dev</a>
                                <a class="text-light mb-2" href="technical.html"><i class="bi bi-arrow-right text-primary me-2"></i>Technical</a>
                                <a class="text-light mb-2" href="sales.html"><i class="bi bi-arrow-right text-primary me-2"></i>Sales</a>
                                <a class="text-light mb-2" href="printing.html"><i class="bi bi-arrow-right text-primary me-2"></i>Printing</a>
                                <a class="text-light" href="#"><i class="bi bi-arrow-right text-primary me-2"></i>Contact Us</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid text-white" style="background: #061429;">
        <div class="container text-center">
            <div class="row justify-content-end">
                <div class="col-lg-8 col-md-6">
                    <div class="d-flex align-items-center justify-content-center" style="height: 75px;">
						Powered by <a class="text-white border-bottom" >  GMobility</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded back-to-top"><i class="bi bi-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <script src="js/main.js"></script>
</body>

</html>