<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>M.Pharm Course | Master of Pharmacy</title>

    <!-- Custom CSS -->
    <style>
        .hero-section {
            background: linear-gradient(rgba(230, 28, 28, 0.8), rgba(230, 28, 28, 0.8)), url('images/hero-bg-mpharm.jpg') no-repeat center center/cover;
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
        <h1>Welcome to the M.Pharm Program</h1>
        <p>Advance your career with the Master of Pharmacy program, where you'll gain deep expertise in pharmaceutical sciences, drug design, and more.</p>
        <a href="#about" class="btn btn-hero">Learn More</a>
    </section>

    <!-- Course Info Section -->
    <section id="about" class="container course-info">
        <h2>About the Program</h2>
        <p>The M.Pharm program is designed for students aiming to specialize in various aspects of pharmacy. It offers advanced studies in areas like pharmaceutical technology, pharmacology, and pharmaceutical chemistry.</p>
        <ul>
            <li>Duration: 2 Years</li>
            <li>Specializations available in Pharmaceutics, Pharmaceutical Analysis, Pharmacology, and more</li>
            <li>Advanced research-oriented curriculum with a focus on the latest trends in pharmaceutical sciences</li>
            <li>Hands-on experience through internships and research projects</li>
            <li>Industry connections and collaborations with pharmaceutical giants</li>
        </ul>
    </section>

    <!-- Program Highlights Section -->
    <section class="container program-highlights">
        <h2>Program Highlights</h2>
        <div class="row">
            <div class="col-md-6">
                <h5>Specializations</h5>
                <p>Students can choose from various specializations such as Pharmaceutical Technology, Pharmacology, Pharmaceutical Chemistry, and more to tailor their expertise in the field.</p>
            </div>
            <div class="col-md-6">
                <h5>Research Opportunities</h5>
                <p>The program offers ample research opportunities, allowing students to contribute to cutting-edge developments in drug discovery and pharmaceutical innovations.</p>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-6">
                <h5>Industry Exposure</h5>
                <p>Students gain real-world experience through internships at leading pharmaceutical companies, preparing them for careers in industry and academia.</p>
            </div>
            <div class="col-md-6">
                <h5>State-of-the-Art Facilities</h5>
                <p>The program is supported by state-of-the-art laboratories and facilities for practical learning, ensuring students are well-prepared for professional challenges.</p>
            </div>
        </div>
        <div class="text-center mt-4">
            <img src="images/mpharm-program-highlights.jpg" alt="M.Pharm Program Highlights" class="img-fluid rounded" style="max-width: 80%;">
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
                        <p class="card-text">Professor of Pharmaceutical Sciences, specializing in Drug Design and Development.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <img src="https://via.placeholder.com/150" class="card-img-top" alt="Faculty Image">
                    <div class="card-body">
                        <h5 class="card-title">Prof. Sanjay Kapoor</h5>
                        <p class="card-text">Associate Professor of Pharmacology, focusing on neuropharmacology and toxicology.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <img src="https://via.placeholder.com/150" class="card-img-top" alt="Faculty Image">
                    <div class="card-body">
                        <h5 class="card-title">Dr. Priya Agarwal</h5>
                        <p class="card-text">Associate Professor of Pharmaceutical Technology, specializing in drug delivery systems and formulation.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>


</body>

</html>