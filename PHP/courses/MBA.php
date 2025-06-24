<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MBA Course | Master of Business Administration</title>

    <!-- Custom CSS -->
    <style>
        .hero-section {
            background: linear-gradient(rgba(230, 28, 28, 0.8), rgba(230, 28, 28, 0.8)), url('images/hero-bg-mba.jpg') no-repeat center center/cover;
            color: white;
            padding: 100px 0;
            text-align: center;
            position: relative;
        }

        .hero-section h1 {
            font-size: 3rem;
            margin-bottom: 20px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }

        .hero-section p {
            font-size: 1.25rem;
            margin-bottom: 30px;
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.5);
        }

        .btn-hero {
            background-color: rgb(223, 24, 31);
            color: white;
            padding: 10px 20px;
            border-radius: 50px;
            transition: background-color 0.3s, transform 0.3s;
        }

        .btn-hero:hover {
            background-color: #ff4d4d;
            transform: scale(1.05);
        }

        .course-info,
        .program-highlights,
        .faculty-section,
        .contact-section {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }

        @media (max-width: 768px) {
            .hero-section h1 {
                font-size: 2.5rem;
            }

            .hero-section p {
                font-size: 1.2rem;
            }
        }
    </style>
</head>

<body>

    <!-- Hero Section -->
    <section class="hero-section">
        <h1>Welcome to the MBA Program</h1>
        <p>Elevate your career with the MBA program that nurtures leadership, strategic thinking, and business acumen.</p>
        <a href="#about" class="btn btn-hero">Learn More</a>
    </section>

    <!-- Course Info Section -->
    <section id="about" class="container course-info">
        <h2>About the Program</h2>
        <p>The MBA program is designed for aspiring leaders who wish to make an impact in the business world. Through advanced coursework and practical experience, students will gain in-depth knowledge of global business strategies, operations, and management principles.</p>
        <ul>
            <li>Duration: 2 Years</li>
            <li>Specializations: Marketing, Finance, Human Resource Management, Operations Management</li>
            <li>Industry-oriented training and internships</li>
            <li>Access to advanced management tools and technologies</li>
            <li>Networking with top industry professionals</li>
        </ul>
    </section>

    <!-- Program Highlights Section -->
    <section class="container program-highlights">
        <h2>Program Highlights</h2>
        <div class="row">
            <div class="col-md-6">
                <h5>Comprehensive Curriculum</h5>
                <p>The MBA program offers a well-rounded approach to business education, covering key areas like marketing, finance, leadership, and entrepreneurship.</p>
            </div>
            <div class="col-md-6">
                <h5>Global Exposure</h5>
                <p>Gain valuable insights into global business practices through case studies, international internships, and exposure to renowned industry leaders.</p>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-6">
                <h5>Leadership Development</h5>
                <p>Our program emphasizes the development of leadership and strategic decision-making skills, preparing students for high-level management roles.</p>
            </div>
            <div class="col-md-6">
                <h5>Networking Opportunities</h5>
                <p>Connect with influential business leaders, alumni, and fellow students, helping you build a strong network for career advancement.</p>
            </div>
        </div>
        <div class="text-center mt-4">
            <img src="images/mba-program-highlights.jpg" alt="MBA Program Highlights" class="img-fluid rounded" style="max-width: 80%;">
        </div>
    </section>

    <!-- Faculty Section -->
    <section id="faculty" class="container faculty-section">
        <h2>Our Faculty</h2>
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <img src="https://via.placeholder.com/150" class="card-img-top" alt="Faculty Image">
                    <div class="card-body">
                        <h5 class="card-title">Dr. Neha Kapoor</h5>
                        <p class="card-text">Professor of Business Administration, specializing in Strategic Management and Corporate Strategy.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <img src="https://via.placeholder.com/150" class="card-img-top" alt="Faculty Image">
                    <div class="card-body">
                        <h5 class="card-title">Prof. Ravi Jain</h5>
                        <p class="card-text">Associate Professor of Finance, focusing on Financial Markets, Risk Management, and Corporate Finance.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <img src="https://via.placeholder.com/150" class="card-img-top" alt="Faculty Image">
                    <div class="card-body">
                        <h5 class="card-title">Prof. Priya Sharma</h5>
                        <p class="card-text">Associate Professor of Marketing, specializing in Digital Marketing, Consumer Behavior, and Brand Management.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>


</body>

</html>