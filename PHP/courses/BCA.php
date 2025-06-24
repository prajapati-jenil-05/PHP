<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BCA Course | Bachelor of Computer Applications</title>

    <!-- Custom CSS -->
    <style>
        .hero-section {
            background: linear-gradient(rgba(230, 28, 28, 0.8), rgba(230, 28, 28, 0.8)), url('images/hero-bg-bca.jpg') no-repeat center center/cover;
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
        <h1>Welcome to the BCA Program</h1>
        <p>Shape your future with the Bachelor of Computer Applications program, designed to equip you with the skills needed for the ever-evolving tech industry.</p>
        <a href="#about" class="btn btn-hero">Learn More</a>
    </section>

    <!-- Course Info Section -->
    <section id="about" class="container course-info">
        <h2>About the Program</h2>
        <p>The BCA program provides students with a solid foundation in computer science, programming, and software development. With industry-oriented courses, students will be equipped to build their careers in the IT industry.</p>
        <ul>
            <li>Duration: 3 Years</li>
            <li>Core subjects include programming languages, database management systems, web technologies, software engineering, and more</li>
            <li>Hands-on training through practical sessions, industry projects, and internships</li>
            <li>Access to cutting-edge software tools and technologies</li>
            <li>Strong foundation for further studies in the field of computer science</li>
        </ul>
    </section>

    <!-- Program Highlights Section -->
    <section class="container program-highlights">
        <h2>Program Highlights</h2>
        <div class="row">
            <div class="col-md-6">
                <h5>Hands-on Learning</h5>
                <p>Emphasis on practical learning through coding projects, internships, and software development tasks, enabling students to build real-world solutions.</p>
            </div>
            <div class="col-md-6">
                <h5>Industry-Relevant Curriculum</h5>
                <p>The curriculum is regularly updated to reflect the latest trends and technologies in the tech industry, preparing students for the job market.</p>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-6">
                <h5>Internships and Projects</h5>
                <p>Students gain practical exposure by working on projects with industry professionals, ensuring they are ready for real-world challenges upon graduation.</p>
            </div>
            <div class="col-md-6">
                <h5>Placement Support</h5>
                <p>With the backing of the university's placement cell, BCA students have access to job opportunities with leading IT companies.</p>
            </div>
        </div>
        <div class="text-center mt-4">
            <img src="images/bca-program-highlights.jpg" alt="BCA Program Highlights" class="img-fluid rounded" style="max-width: 80%;">
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
                        <h5 class="card-title">Dr. Amit Kumar</h5>
                        <p class="card-text">Professor of Computer Science, specializing in Artificial Intelligence and Data Science.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <img src="https://via.placeholder.com/150" class="card-img-top" alt="Faculty Image">
                    <div class="card-body">
                        <h5 class="card-title">Prof. Radhika Sharma</h5>
                        <p class="card-text">Associate Professor, focusing on Web Development and Software Engineering.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <img src="https://via.placeholder.com/150" class="card-img-top" alt="Faculty Image">
                    <div class="card-body">
                        <h5 class="card-title">Dr. Vishal Soni</h5>
                        <p class="card-text">Associate Professor, specializing in Computer Networks and Information Security.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
        
</body>

</html>