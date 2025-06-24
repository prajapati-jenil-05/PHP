<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MCA Course | Master of Computer Applications</title>

    <!-- Custom CSS -->
    <style>
        .hero-section {
            background: linear-gradient(rgba(230, 28, 28, 0.8), rgba(230, 28, 28, 0.8)), url('images/hero-bg-mca.jpg') no-repeat center center/cover;
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
        <h1>Welcome to the MCA Program</h1>
        <p>The Master of Computer Applications program is designed to advance your knowledge in computer science and equip you with the skills to excel in the tech industry.</p>
        <a href="#about" class="btn btn-hero">Learn More</a>
    </section>

    <!-- Course Info Section -->
    <section id="about" class="container course-info">
        <h2>About the Program</h2>
        <p>The MCA program aims to provide students with a deep understanding of computer science, programming, and technology management. It offers advanced courses and research-based projects to prepare students for leadership roles in the IT industry.</p>
        <ul>
            <li>Duration: 2 Years</li>
            <li>Core subjects include advanced programming, cloud computing, machine learning, and data structures</li>
            <li>Research projects to foster innovation and problem-solving skills</li>
            <li>Industry-specific electives to specialize in areas like data analytics, AI, and software development</li>
            <li>Internships and workshops for hands-on experience and exposure to the industry</li>
        </ul>
    </section>

    <!-- Program Highlights Section -->
    <section class="container program-highlights">
        <h2>Program Highlights</h2>
        <div class="row">
            <div class="col-md-6">
                <h5>Advanced Curriculum</h5>
                <p>The curriculum is designed to provide in-depth knowledge in key areas like AI, cloud computing, and data analytics, ensuring students are prepared for a successful career in technology.</p>
            </div>
            <div class="col-md-6">
                <h5>Hands-on Learning</h5>
                <p>Students will engage in real-world projects, research, and internships to develop practical skills in software development, data analysis, and more.</p>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-6">
                <h5>Industry Collaboration</h5>
                <p>Collaborations with top tech companies provide students with the opportunity to work on industry projects, ensuring they are job-ready upon graduation.</p>
            </div>
            <div class="col-md-6">
                <h5>Placement Assistance</h5>
                <p>Our dedicated placement cell offers training, job fairs, and guidance to help MCA students secure positions at leading IT companies.</p>
            </div>
        </div>
        <div class="text-center mt-4">
            <img src="images/mca-program-highlights.jpg" alt="MCA Program Highlights" class="img-fluid rounded" style="max-width: 80%;">
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
                        <h5 class="card-title">Dr. Priya Mehta</h5>
                        <p class="card-text">Professor of Computer Science, specializing in Machine Learning and Artificial Intelligence.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <img src="https://via.placeholder.com/150" class="card-img-top" alt="Faculty Image">
                    <div class="card-body">
                        <h5 class="card-title">Prof. Rajesh Kumar</h5>
                        <p class="card-text">Associate Professor, focusing on Cloud Computing and Big Data Technologies.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <img src="https://via.placeholder.com/150" class="card-img-top" alt="Faculty Image">
                    <div class="card-body">
                        <h5 class="card-title">Dr. Sanjay Verma</h5>
                        <p class="card-text">Associate Professor, specializing in Data Analytics and Information Security.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>


</body>

</html>