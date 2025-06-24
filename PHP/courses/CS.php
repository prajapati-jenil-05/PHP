<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Computer Science B.Tech Course</title>

    <!-- Custom CSS -->
    <style>
        .hero-section {
            background: linear-gradient(rgba(230, 28, 28, 0.8), rgba(230, 28, 28, 0.8)), url('images/hero-bg.jpg') no-repeat center center/cover;
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

        .course-info {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }

        .program-highlights {
            background-color: #f9f9f9;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }

        .faculty-section {
            background-color: #f1f1f1;
            padding: 30px;
        }

        .faculty-section .card {
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .faculty-section .card:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .contact-section {
            background-color: #343a40;
            color: white;
            padding: 40px;
        }

        .contact-section h2 {
            margin-bottom: 20px;
        }

        footer {
            background-color: #007bff;
            color: white;
            text-align: center;
            padding: 20px;
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
        <h1>Welcome to the Computer Science B.Tech Program</h1>
        <p>Develop the skills needed for a successful career in technology and innovation.</p>
        <a href="#about" class="btn btn-hero">Learn More</a>
    </section>

    <!-- Course Info Section -->
    <section id="about" class="container course-info">
        <h2>About the Program</h2>
        <p>The B.Tech in Computer Science is designed to give students a solid foundation in the principles of computing, programming, data structures, algorithms, software engineering, and more. Our program is aimed at creating professionals capable of solving real-world challenges through innovation in technology.</p>
        <ul>
            <li>Duration: 4 Years</li>
            <li>Specializations: Data Science, AI, Software Engineering</li>
            <li>Hands-on experience with real-world projects</li>
            <li>Internship opportunities with leading tech companies</li>
            <li>Access to state-of-the-art labs and resources</li>
        </ul>
    </section>

    <!-- Program Highlights Section -->
    <section class="container program-highlights">
        <h2>Program Highlights</h2>
        <div class="row">
            <div class="col-md-6">
                <h5>Cutting-Edge Curriculum</h5>
                <p>Our curriculum is continuously updated to keep pace with the latest technological advancements, ensuring that students are well-prepared for the job market.</p>
            </div>
            <div class="col-md-6">
                <h5>Industry Collaboration</h5>
                <p>We collaborate with industry leaders to provide students with insights into real-world applications and trends in technology.</p>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-6">
                <h5>Research Opportunities</h5>
                <p>Students have the chance to participate in cutting-edge research projects, contributing to advancements in various fields of computer science.</p>
            </div>
            <div class="col-md-6">
                <h5>Student Clubs and Activities</h5>
                <p>Join various clubs and activities that promote learning, networking, and skill development outside the classroom.</p>
            </div>
        </div>
        <div class="text-center mt-4">
            <img src="images/RK2.jpg" alt="Program Highlights" class="img-fluid rounded" style="max-width: 80%;">
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
                        <h5 class="card-title">Dr. Chetan Singadiya</h5>
                        <p class="card-text">Professor of Computer Science, specializing in Artificial Intelligence and Machine Learning.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <img src="https://via.placeholder.com/150" class="card-img-top" alt="Faculty Image">
                    <div class="card-body">
                        <h5 class="card-title">Prof. Snehal Sathwara</h5>
                        <p class="card-text">Associate Professor of Software Engineering and Cybersecurity.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <img src="https://via.placeholder.com/150" class="card-img-top" alt="Faculty Image">
                    <div class="card-body">
                        <h5 class="card-title">Prof. Chhaya Patel</h5>
                        <p class="card-text">Associate Professor of Website Design and Development.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

</body>

</html>