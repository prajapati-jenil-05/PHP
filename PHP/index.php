<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RKU College Navbar with Carousel</title>
    <!-- Add Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Navbar link hover effect */
        .navbar-nav .nav-link:hover {
            background-color: rgb(223, 24, 31);
            border-radius: 4px;
        }

        /* Navbar brand (logo) styling */
        .navbar-brand img {
            height: 60px;
            border-radius: 5px;
            padding: 5px;
            background-color: rgba(255, 255, 255, 0.77);
        }

        .navbar-brand img:hover {
            background-color: whitesmoke;
            box-shadow: 0 0 8px rgb(223, 24, 31);
        }

        /* Section text and images styling */
        #about-text p {
            font-size: 1rem;
            line-height: 1.6;
            color: #333;
        }

        #about-text img {
            max-width: 100%;
            height: auto;
            display: block;
            margin: 0 auto;
        }

        /* Image for smaller devices */
        .carousel-item img {
            width: 100%;
            height: auto;
        }

        /* For larger screens */
        @media (min-width: 768px) {
            .carousel-inner img {
                height: 600px;
                object-fit: cover;
            }

            #about-text p {
                font-size: 1.2rem;
            }
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .navbar-brand img {
                height: 50px;
            }

            .navbar-nav .nav-link {
                padding: 0.5rem 1rem;
            }

            .carousel-inner img {
                height: 300px;
            }

            .container-fluid.bg-white {
                padding: 20px !important;
            }

            .row {
                padding-inline: 1px !important;
            }

            .col-md-4,
            .col-md-8 {
                padding: 10px !important;
            }

            .col-md-4.bg-light {
                margin-bottom: 20px;
            }
        }

        @media (max-width: 576px) {
            .navbar-brand img {
                height: 40px;
            }

            .carousel-inner img {
                height: 200px;
            }

            .container-fluid.bg-white {
                padding: 10px !important;
            }

            .row {
                padding-inline: 10px !important;
            }

            .col-md-4,
            .col-md-8 {
                padding: 5px !important;
            }

            .col-md-4.bg-light {
                margin-bottom: 15px;
            }
        }
    </style>
</head>
<?php
if (isset($_COOKIE['success'])) { ?>
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        <strong>Success!</strong> <?php echo $_COOKIE['success']; ?>
    </div>
<?php
}
if (isset($_COOKIE['error'])) {
?>
    <div class="alert alert-danger alert-dismissible">
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        <strong>Error!</strong> <?php echo $_COOKIE['error']; ?>
    </div>
<?php
}
?>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <!-- Logo -->
            <a class="navbar-brand" href="index.php">
                <img src="images/logo.png" alt="RKU Logo" class="d-inline-block align-text-top">
            </a>
            <!-- Toggle button for mobile view -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Navbar Links -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item mx-2">
                        <a class="nav-link active" href="#" onclick="window.location.reload();">Home</a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link" href="#" onclick="$('#contents').load('courses.php');">Courses</a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link" href="#contact">Contact us</a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link" href="login.php">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div id="contents">
        <!-- Carousel Section -->
        <div id="carouselExampleAutoplay" class="carousel slide" data-bs-ride="carousel">
            <!-- Indicators -->
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleAutoplay" data-bs-slide-to="0" class="active"
                    aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleAutoplay" data-bs-slide-to="1"
                    aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleAutoplay" data-bs-slide-to="2"
                    aria-label="Slide 3"></button>
            </div>

            <!-- Carousel Items -->
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="images/RK2.jpg" class="d-block w-100" alt="First slide">
                </div>
                <div class="carousel-item">
                    <img src="images/RK3.jpg" class="d-block w-100" alt="Second slide">
                </div>
                <div class="carousel-item">
                    <img src="images/RK4.jpg" class="d-block w-100" alt="Third slide">
                </div>
            </div>

            <!-- Carousel Controls (Optional) -->
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplay" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplay" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

        <!-- About RKU Section -->
        <section id="about" class="mt-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <div class="text-center">
                            <img src="images/RK5.png" class="img-fluid mb-3">
                        </div>
                        <p class="text-center">
                            RKU is the only University in Saurashtra region to be in the Top 200 Universities in India for two consecutive years as per NIRF Ranking (2021 &amp; 2022) by Ministry of Education, Government of India.
                        </p>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="text-center">
                            <img src="images/RK6.png" class="img-fluid mb-3">
                        </div>
                        <p class="text-center">
                            RKU secured a position in Top Private Universities in India to get Excellent Band category in Atal Ranking of Institutions on Innovation Achievements published by Ministry of Education, Government of India.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- About RK University Section -->
        <div class="container py-5">
            <div class="row">
                <div class="col-lg-8 mx-auto text-center">
                    <h2 class="fw-bold">About RK University</h2>
                    <p class="lead text-muted">Empowering students through education, research, and innovation.</p>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-md-6 mb-4">
                    <img src="images/RK7.jpg" alt="RK University Campus" class="img-fluid rounded shadow">
                </div>
                <div class="col-md-6">
                    <p>RK University (RKU), located in Tramba, Rajkot, is a leading educational institution in Gujarat, India. It offers a range of undergraduate, postgraduate, and doctoral programs in various fields such as Engineering, Management, Pharmacy, Science, and Computer Applications.</p>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><strong>🔹 Established:</strong> 2009</li>
                        <li class="list-group-item"><strong>🔹 Location:</strong> Tramba, Rajkot, Gujarat, India</li>
                        <li class="list-group-item"><strong>🔹 Recognized by:</strong> UGC, AICTE, PCI</li>
                        <li class="list-group-item"><strong>🔹 Website:</strong> <a href="https://www.rku.ac.in" target="_blank">www.rku.ac.in</a></li>
                    </ul>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-lg-12">
                    <h3 class="fw-bold">Why Choose RK University?</h3>
                    <ul class="list-unstyled">
                        <li>✅ State-of-the-art infrastructure with modern labs and research centers.</li>
                        <li>✅ Highly qualified faculty and industry experts.</li>
                        <li>✅ Entrepreneurial & startup support through incubation programs.</li>
                        <li>✅ International collaborations and student exchange programs.</li>
                        <li>✅ A vibrant campus life with cultural events and leadership programs.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Contact Section -->
    <section id="contact">
        <div class="container-fluid bg-white p-5 shadow rounded">
            <div class="row" style="padding-inline: 100px;">
                <!-- Contact Info -->
                <div class="col-lg-4 bg-light p-4 rounded">
                    <h2 class="h5 fw-bold mb-3">Main Campus</h2>
                    <p class="small text-muted">RK University, Bhavnagar Highway,<br>Kasturbadham, Rajkot, Gujarat, India 360020</p>
                    <h2 class="h5 fw-bold mt-3">City Campus</h2>
                    <p class="small text-muted">New 150ft Ring Road, Mota Mawa, Kalawad Road, Rajkot, Gujarat, India 360004</p>
                    <h2 class="h5 fw-bold mt-3">Contact Number</h2>
                    <p class="small text-muted">+91-9712489122<br>+91-9925714450</p>
                </div>
                <!-- Contact Form -->
                <div class="col-lg-8">
                    <h2 class="h4 fw-bold mb-3">Contact Us</h2>
                    <form id="contactForm" method="post" action="contact.php">
                        <div class="mb-3">
                            <input type="text" class="form-control" id="fullName" placeholder="Full Name" name="fullname">
                            <span class="error text-danger small" id="fullNameError"></span>
                        </div>
                        <div class="mb-3">
                            <input type="email" class="form-control" id="email" placeholder="Email" name="email">
                            <span class="error text-danger small" id="emailError"></span>
                        </div>
                        <div class="row g-3 mb-3">
                            <div class="col">
                                <input type="text" class="form-control" id="subject" placeholder="Subject" name="subject">
                                <span class="error text-danger small" id="subjectError"></span>
                            </div>
                            <div class="col">
                                <input type="tel" class="form-control" id="phone" placeholder="Phone" name="mobile">
                                <span class="error text-danger small" id="phoneError"></span>
                            </div>
                        </div>
                        <div class="mb-3">
                            <textarea class="form-control" rows="4" id="message" placeholder="Message" name="message"></textarea>
                            <span class="error text-danger small" id="messageError"></span>
                        </div>
                        <div class="d-flex gap-3">
                            <button type="submit" class="btn btn-primary">Send Your Message</button>
                            <button type="reset" class="btn btn-secondary">Reset</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer Section -->
    <footer class="bg-dark text-light pt-5 pb-4">
        <div class="container text-center text-md-start">
            <div class="row">
                <!-- About Section -->
                <div class="col-md-4">
                    <h5 class="fw-bold">About RK University</h5>
                    <p class="small">RK University (RKU) is a leading educational institution in Rajkot, Gujarat, India, offering quality education in engineering, management, pharmacy, and more.</p>
                </div>

                <!-- Quick Links -->
                <div class="col-md-2">
                    <h5 class="fw-bold">Quick Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="index.php" class="text-light text-decoration-none">Home</a></li>
                        <li><a href="index.php?#about" class="text-light text-decoration-none">About</a></li>
                        <li><a href="#" onclick="$('#contents').load('courses.php');" class="text-light text-decoration-none">Courses</a></li>
                        <li><a href="#contact" class="text-light text-decoration-none">Contact</a></li>
                    </ul>
                </div>

                <!-- Contact Info -->
                <div class="col-md-3">
                    <h5 class="fw-bold">Contact Us</h5>
                    <p class="small">
                        📍 RK University, Bhavnagar Highway, Kasturbadham, Tramba, Rajkot, Gujarat, India – 360020
                    </p>
                    <p class="small">📞 +91-9712489122, +91-9925714450</p>
                    <p class="small">📧 info@rku.ac.in</p>
                </div>

                <!-- Social Media -->
                <div class="col-md-3">
                    <h5 class="fw-bold">Follow Us</h5>
                    <div class="d-flex">
                        <a href="https://www.facebook.com/rkuindia/" class="text-light me-3"><img src="https://cdn-icons-png.flaticon.com/512/733/733547.png" width="24"></a>
                        <a href="https://www.instagram.com/rkuniversity/" class="text-light me-3"><img src="https://cdn-icons-png.flaticon.com/512/733/733558.png" width="24"></a>
                        <a href="https://x.com/RKUniversity?ref_src=twsrc%5Egoogle%7Ctwcamp%5Eserp%7Ctwgr%5Eauthor" class="text-light me-3"><img src="https://cdn-icons-png.flaticon.com/512/733/733579.png" width="24"></a>
                        <a href="https://www.youtube.com/@RKUniversityIndia" class="text-light"><img src="https://cdn-icons-png.flaticon.com/512/1384/1384060.png" width="24"></a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Copyright Section -->
        <div class="bg-secondary text-center py-3 mt-4">
            <p class="mb-0 small">&copy; 2025 RK University. All Rights Reserved.</p>
        </div>
    </footer>

    <!-- Bootstrap JS and Popper -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            $("#contactForm").submit(function(e) {
                e.preventDefault(); // Prevent form submission

                let isValid = true;

                // Get form values
                let fullName = $("#fullName").val().trim();
                let email = $("#email").val().trim();
                let subject = $("#subject").val().trim();
                let phone = $("#phone").val().trim();
                let message = $("#message").val().trim();

                // Email regex
                let emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
                // Phone number regex (only digits, 10 length)
                let phonePattern = /^[0-9]{10}$/;

                // Reset previous errors
                $(".error").text("");

                // Validation Checks
                if (fullName === "") {
                    $("#fullNameError").text("Full Name is required.");
                    isValid = false;
                }

                if (email === "" || !emailPattern.test(email)) {
                    $("#emailError").text("Enter a valid email.");
                    isValid = false;
                }

                if (subject === "") {
                    $("#subjectError").text("Subject is required.");
                    isValid = false;
                }

                if (phone === "" || !phonePattern.test(phone)) {
                    $("#phoneError").text("Enter a valid phone number (10 digits).");
                    isValid = false;
                }

                if (message === "") {
                    $("#messageError").text("Message cannot be empty.");
                    isValid = false;
                }

                // If valid, submit the form
                if (isValid) {
                    this.submit();
                }
            });
        });
    </script>
</body>

</html>