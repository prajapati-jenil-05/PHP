<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Courses - RK University</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .course-card {
            transition: transform 0.3s ease-in-out;
        }

        .course-card:hover {
            transform: scale(1.05);
        }

        .course-img {
            height: 200px;
            object-fit: cover;
        }
    </style>
</head>

<body>
    <center style="padding-top: 30px;">
        <h1>Courses</h1>
    </center>
    <hr>
    <!-- Courses List -->
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card course-card shadow">
                    <a href="#" onclick="$('#contents').load('courses/CS.php');">
                        <img src="images/btechcs.jpg" class="card-img-top course-img" alt="B.Tech Computer Science">
                    </a>
                    <div class="card-body">
                        <h5 class="card-title">B.Tech Computer Science</h5>
                        <p class="text-muted">Category: Engineering</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card course-card shadow">
                    <a href="#" onclick="$('#contents').load('courses/ME.php');">
                        <img src="images/me.jpg" class="card-img-top course-img" alt="B.Tech Mechanical Engineering">
                    </a>
                    <div class="card-body">
                        <h5 class="card-title">B.Tech Mechanical Engineering</h5>
                        <p class="text-muted">Category: Engineering</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card course-card shadow">
                    <a href="#" onclick="$('#contents').load('courses/BBA.php');">
                        <img src="images/bba.webp" class="card-img-top course-img" alt="BBA (Bachelor of Business Administration)">
                    </a>
                    <div class="card-body">
                        <h5 class="card-title">BBA (Bachelor of Business Administration)</h5>
                        <p class="text-muted">Category: Management</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card course-card shadow">
                    <a href="#" onclick="$('#contents').load('courses/MBA.php');">
                        <img src="images/mba.jpg" class="card-img-top course-img" alt="MBA (Master of Business Administration)">
                    </a>
                    <div class="card-body">
                        <h5 class="card-title">MBA (Master of Business Administration)</h5>
                        <p class="text-muted">Category: Management</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card course-card shadow">
                    <a href="#" onclick="$('#contents').load('courses/BPHAR.php');">
                        <img src="images/bpharma.jpg" class="card-img-top course-img" alt="B.Pharm (Bachelor of Pharmacy)"></a>
                    <div class="card-body">
                        <h5 class="card-title">B.Pharm (Bachelor of Pharmacy)</h5>
                        <p class="text-muted">Category: Pharmacy</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card course-card shadow"><a href="#" onclick="$('#contents').load('courses/M_PHAR.php');">
                        <img src="images/mpharm.jpg" class="card-img-top course-img" alt="M.Pharm (Master of Pharmacy)"></a>
                    <div class="card-body">
                        <h5 class="card-title">M.Pharm (Master of Pharmacy)</h5>
                        <p class="text-muted">Category: Pharmacy</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card course-card shadow"><a href="#" onclick="$('#contents').load('courses/BCA.php');">
                        <img src="images/bca.jpg" class="card-img-top course-img" alt="BCA (Bachelor of Computer Applications)"></a>
                    <div class="card-body">
                        <h5 class="card-title">BCA (Bachelor of Computer Applications)</h5>
                        <p class="text-muted">Category: Computer Science</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card course-card shadow"><a href="#" onclick="$('#contents').load('courses/MCA.php');">
                        <img src="images/mca.jpg" class="card-img-top course-img" alt="MCA (Master of Computer Applications)"></a>
                    <div class="card-body">
                        <h5 class="card-title">MCA (Master of Computer Applications)</h5>
                        <p class="text-muted">Category: Computer Science</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>

</html>