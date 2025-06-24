<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>B.Pharm Course | Bachelor of Pharmacy</title>

    <!-- Custom CSS -->
    <style>
        .hero-section {
            background: linear-gradient(rgba(230, 28, 28, 0.8), rgba(230, 28, 28, 0.8)), url('images/hero-bg-bpharm.jpg') no-repeat center center/cover;
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
        <h1>Welcome to the B.Pharm Program</h1>
        <p>Embark on a rewarding journey with the Bachelor of Pharmacy program, where you’ll gain a comprehensive understanding of pharmaceutical sciences and industry practices.</p>
        <a href="#about" class="btn btn-hero">Learn More</a>
    </section>

    <!-- Course Info Section -->
    <section id="about" class="container course-info">
        <h2>About the Program</h2>
        <p>The B.Pharm program equips students with the knowledge and skills needed to excel in the pharmaceutical industry. It covers a range of topics including drug discovery, drug manufacturing, pharmaceutical biotechnology, and patient care.</p>
        <ul>
            <li>Duration: 4 Years</li>
            <li>Curriculum includes practical exposure to pharmaceutical formulations and drug development</li>
            <li>Specializations available in Pharmacology, Pharmaceutical Chemistry, and Pharmaceutical Biotechnology</li>
            <li>Industry-integrated training and internships</li>
            <li>Collaboration with top pharmaceutical companies</li>
        </ul>
    </section>

    <!-- Program Highlights Section -->
    <section class="container program-highlights">
        <h2>Program Highlights</h2>
        <div class="row">
            <div class="col-md-6">
                <h5>Comprehensive Curriculum</h5>
                <p>The program covers a wide array of pharmaceutical subjects, from drug chemistry to pharmacy practice, ensuring students gain a complete understanding of the field.</p>
            </div>
            <div class="col-md-6">
                <h5>Hands-On Training</h5>
                <p>Practical training in state-of-the-art laboratories and internships with leading pharmaceutical companies prepare students for real-world challenges.</p>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-6">
                <h5>Industry-Ready Graduates</h5>
                <p>The program prepares students for careers in research, development, regulatory affairs, quality control, and clinical research in the pharmaceutical sector.</p>
            </div>
            <div class="col-md-6">
                <h5>Research and Innovation</h5>
                <p>Students are encouraged to engage in pharmaceutical research, contributing to the development of new and improved drugs and therapies.</p>
            </div>
        </div>
        <div class="text-center mt-4">
            <img src="images/bpharm-program-highlights.jpg" alt="B.Pharm Program Highlights" class="img-fluid rounded" style="max-width: 80%;">
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
                        <h5 class="card-title">Dr. Anjali Mehta</h5>
                        <p class="card-text">Professor of Pharmaceutical Sciences, specializing in Medicinal Chemistry and Drug Design.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <img src="https://via.placeholder.com/150" class="card-img-top" alt="Faculty Image">
                    <div class="card-body">
                        <h5 class="card-title">Prof. Sanjay Kapoor</h5>
                        <p class="card-text">Associate Professor of Pharmacology, focusing on drug mechanisms, safety, and pharmacokinetics.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <img src="https://via.placeholder.com/150" class="card-img-top" alt="Faculty Image">
                    <div class="card-body">
                        <h5 class="card-title">Dr. Priya Agarwal</h5>
                        <p class="card-text">Associate Professor of Pharmaceutical Technology, specializing in drug formulation and biotechnology.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

</body>

</html>