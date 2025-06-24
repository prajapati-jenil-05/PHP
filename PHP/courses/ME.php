<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mechanical Engineering B.Tech Course</title>

    <!-- Custom CSS -->
    <style>
        .hero-section {
            background: linear-gradient(rgba(230, 28, 28, 0.8), rgba(230, 28, 28, 0.8)), url('images/hero-bg-mechanical.jpg') no-repeat center center/cover;
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
        <h1>Welcome to the Mechanical Engineering B.Tech Program</h1>
        <p>Prepare for a career in designing, analyzing, and manufacturing mechanical systems.</p>
        <a href="#about" class="btn btn-hero">Learn More</a>
    </section>

    <!-- Course Info Section -->
    <section id="about" class="container course-info">
        <h2>About the Program</h2>
        <p>The B.Tech in Mechanical Engineering program provides a broad understanding of the principles of mechanics, thermodynamics, fluid dynamics, and material science, preparing students to design and develop machines and systems.</p>
        <ul>
            <li>Duration: 4 Years</li>
            <li>Specializations: Thermal Engineering, Design Engineering, Robotics</li>
            <li>Hands-on experience with real-world projects</li>
            <li>Internship opportunities with leading mechanical engineering firms</li>
            <li>Access to state-of-the-art labs and resources</li>
        </ul>
    </section>

    <!-- Program Highlights Section -->
    <section class="container program-highlights">
        <h2>Program Highlights</h2>
        <div class="row">
            <div class="col-md-6">
                <h5>Advanced Curriculum</h5>
                <p>The mechanical engineering curriculum incorporates the latest advancements in technology and research, equipping students with the necessary skills for the future of engineering.</p>
            </div>
            <div class="col-md-6">
                <h5>Industry Collaboration</h5>
                <p>Our collaboration with industry leaders ensures that students are exposed to real-world challenges and technological innovations.</p>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-6">
                <h5>Cutting-Edge Research</h5>
                <p>Students can participate in research projects and gain valuable experience in fields such as renewable energy, robotics, and more.</p>
            </div>
            <div class="col-md-6">
                <h5>Student Clubs and Activities</h5>
                <p>Mechanical engineering students actively engage in clubs and activities that promote skill development, teamwork, and innovation.</p>
            </div>
        </div>
        <div class="text-center mt-4">
            <img src="images/mechanical-program-highlights.jpg" alt="Mechanical Program Highlights" class="img-fluid rounded" style="max-width: 80%;">
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
                        <h5 class="card-title">Dr. Rajesh Patel</h5>
                        <p class="card-text">Professor of Mechanical Engineering, specializing in Thermal Engineering and Fluid Dynamics.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <img src="https://via.placeholder.com/150" class="card-img-top" alt="Faculty Image">
                    <div class="card-body">
                        <h5 class="card-title">Prof. Praveen Kumar</h5>
                        <p class="card-text">Associate Professor of Machine Design and Manufacturing Processes.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <img src="https://via.placeholder.com/150" class="card-img-top" alt="Faculty Image">
                    <div class="card-body">
                        <h5 class="card-title">Prof. Neelam Verma</h5>
                        <p class="card-text">Associate Professor specializing in Robotics and Automation Engineering.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>


</body>

</html>