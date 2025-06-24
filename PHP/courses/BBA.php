<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BBA Course | Bachelor of Business Administration</title>

    <!-- Custom CSS -->
    <style>
        .hero-section {
            background: linear-gradient(rgba(230, 28, 28, 0.8), rgba(230, 28, 28, 0.8)), url('images/hero-bg-bba.jpg') no-repeat center center/cover;
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
        <h1>Welcome to the BBA Program</h1>
        <p>Build a strong foundation in business with a degree that opens doors to leadership and managerial roles.</p>
        <a href="#about" class="btn btn-hero">Learn More</a>
    </section>

    <!-- Course Info Section -->
    <section id="about" class="container course-info">
        <h2>About the Program</h2>
        <p>The BBA program is designed to prepare students for leadership roles in the business world. The curriculum focuses on core business principles such as marketing, finance, human resources, and entrepreneurship.</p>
        <ul>
            <li>Duration: 3 Years</li>
            <li>Specializations: Marketing, Finance, Human Resource Management</li>
            <li>Industry-oriented training and internships</li>
            <li>Access to advanced business management tools and technologies</li>
            <li>Opportunities for hands-on learning through projects and workshops</li>
        </ul>
    </section>

    <!-- Program Highlights Section -->
    <section class="container program-highlights">
        <h2>Program Highlights</h2>
        <div class="row">
            <div class="col-md-6">
                <h5>Comprehensive Curriculum</h5>
                <p>The BBA program offers a well-rounded approach to business education, covering a variety of disciplines such as management, economics, marketing, and accounting.</p>
            </div>
            <div class="col-md-6">
                <h5>Global Exposure</h5>
                <p>Students will gain insights into global business practices through case studies, guest lectures from industry leaders, and international business trips.</p>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-6">
                <h5>Networking Opportunities</h5>
                <p>Students will have access to a strong network of alumni, industry professionals, and academic experts who will help guide their careers.</p>
            </div>
            <div class="col-md-6">
                <h5>Leadership Development</h5>
                <p>The BBA program emphasizes the development of leadership and entrepreneurial skills through student clubs, events, and hands-on experiences.</p>
            </div>
        </div>
        <div class="text-center mt-4">
            <img src="images/bba-program-highlights.jpg" alt="BBA Program Highlights" class="img-fluid rounded" style="max-width: 80%;">
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
                        <h5 class="card-title">Dr. Anjali Sharma</h5>
                        <p class="card-text">Professor of Business Administration, specializing in Organizational Behavior and Leadership.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <img src="https://via.placeholder.com/150" class="card-img-top" alt="Faculty Image">
                    <div class="card-body">
                        <h5 class="card-title">Prof. Amit Mehra</h5>
                        <p class="card-text">Associate Professor of Marketing, focusing on Digital Marketing and Consumer Behavior.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <img src="https://via.placeholder.com/150" class="card-img-top" alt="Faculty Image">
                    <div class="card-body">
                        <h5 class="card-title">Prof. Rajeev Gupta</h5>
                        <p class="card-text">Associate Professor of Finance, specializing in Corporate Finance and Investment Management.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>


</body>

</html>