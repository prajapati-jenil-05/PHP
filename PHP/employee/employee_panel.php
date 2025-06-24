<?php
session_start();
include_once("../config.php");
if (!isset($_SESSION["user_id"])) {
    header("Location: ../login.php");
    exit();
}

// Database connection
$host = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "my_database";

// Create connection
$conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get logged-in user's email
$empmail = $_SESSION['email'] ?? '';

if (empty($empmail)) {
    die("No user is logged in.");
}

// Fetch employee data from the database
$sql = "SELECT * FROM employee WHERE email = ?";
$stmt = $conn->prepare($sql);

if ($stmt) {
    $stmt->bind_param("s", $empmail);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $employee = $result->fetch_assoc();
    } else {
        die("No employee found with the provided email.");
    }

    $stmt->close();
} else {
    die("Failed to prepare the SQL statement.");
}
$email = $_SESSION['email'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sidebar With Bootstrap</title>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap');

        ::after,
        ::before {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        a {
            text-decoration: none;
        }

        li {
            list-style: none;
        }

        h1 {
            margin-left: 10px;
            font-weight: 600;
            font-size: 1.5rem;
        }

        body {
            font-family: 'Poppins', sans-serif;
        }

        .wrapper {
            display: flex;
        }

        .main {
            min-height: 100vh;
            width: 100%;
            overflow: hidden;
            transition: all 0.35s ease-in-out;
            background-color: whitesmoke;
            padding: 0px;
        }

        #sidebar {
            width: 70px;
            min-width: 70px;
            z-index: 1000;
            transition: all .25s ease-in-out;
            background-color: rgb(255, 255, 255);
            display: flex;
            flex-direction: column;
        }

        #sidebar.expand {
            width: 300px;
            min-width: 300px;
        }

        .toggle-btn {
            background-color: transparent;
            cursor: pointer;
            border: 0;
            padding: 1rem 1.5rem;
        }

        .toggle-btn i {
            font-size: 1.5rem;
            color: red;
        }

        .sidebar-logo {
            margin: auto 0;
            color: red;
        }

        .sidebar-logo a {
            color: red;
            font-size: 1.15rem;
            font-weight: 600;
        }

        #sidebar:not(.expand) .sidebar-logo,
        #sidebar:not(.expand) a.sidebar-link span {
            display: none;
            color: red;
        }

        .sidebar-nav {
            padding: 0 0 0;
            flex: 1 1 auto;
        }

        a.sidebar-link {
            padding: .625rem 1.625rem;
            color: red;
            display: block;
            font-size: 0.9rem;
            white-space: nowrap;
            border-left: 3px solid transparent;
        }

        .sidebar-link i {
            font-size: 1.1rem;
            margin-right: .75rem;
        }

        a.sidebar-link:hover {
            background-color: rgba(255, 255, 255, .075);
            border-left: 3px solid #3b7ddd;
        }

        .sidebar-item {
            position: relative;
        }

        #sidebar:not(.expand) .sidebar-item .sidebar-dropdown {
            position: absolute;
            top: 0;
            left: 70px;
            background-color: rgb(255, 255, 255);
            padding: 0;
            min-width: 15rem;
            display: none;
        }

        #sidebar:not(.expand) .sidebar-item:hover .has-dropdown+.sidebar-dropdown {
            display: block;
            max-height: 15em;
            width: 100%;
            opacity: 1;
        }

        #sidebar.expand .sidebar-link[data-bs-toggle="collapse"]::after {
            border: solid;
            border-width: 0 .075rem .075rem 0;
            content: "";
            display: inline-block;
            padding: 2px;
            position: absolute;
            right: 1.5rem;
            top: 1.4rem;
            transform: rotate(-135deg);
            transition: all .2s ease-out;
        }

        #sidebar.expand .sidebar-link[data-bs-toggle="collapse"].collapsed::after {
            transform: rotate(45deg);
            transition: all .2s ease-out;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <aside id="sidebar">
            <div class="row">
                <button class="toggle-btn col-2" type="button" style="margin-left: 10px;">
                    <i class="fa-solid fa-bars" style="color: #ca2125;"></i>
                </button>
                <div class="col-3 sidebar-logo">
                    <a href="#" onclick="$('#content').load('employee_profile.php')"><?php echo $employee['firstname'] . " " . $employee['lastname']; ?></a>
                </div>
            </div>
            <ul class="sidebar-nav">
                <li class="sidebar-item">
                    <img src="profile_pictures/<?php echo $employee['photo']; ?>" style="width: 100%;" alt="image not loaded" class="rounded-circle shadow-sm">
                </li>
                <li class="sidebar-item">
                    <a href="#" onclick="$('#content').load('employee_dashboard.php')" class="sidebar-link">
                        <i class="fa-solid fa-chart-line" style="color: #ca2125;"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="#" onclick="$('#content').load('employee_profile.php')" class="sidebar-link">
                        <i class="fa-solid fa-id-card" style="color: #ca2125;"></i>
                        <span>Profile</span>
                    </a>
                </li>
                <!-- <li class="sidebar-item">
                    <a href="#" onclick="$('#content').load('employee_tasks.php')" class="sidebar-link">
                        <i class="fa fa-tasks" style="color: #ca2125;"></i> -->
                <!-- <i class="fa fa-tasks" aria-hidden="true"></i> -->
                <!-- <span>Tasks</span>
                    </a>
                </li> -->
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                        data-bs-target="#lreq" aria-expanded="false" aria-controls="lreq">
                        <i class="fa-solid fa-paperclip" style="color: #ca2125;"></i>
                        <span>Leave Requests</span>
                    </a>
                    <ul id="lreq" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                        <li class="sidebar-item">
                            <a href="#" onclick="$('#content').load('employee_new_leave_req.php');" class="sidebar-link">New Leave Requests</a>
                        </li>
                        <li class="sidebar-item">
                            <a href="#" onclick="$('#content').load('employee_all_leave_req.php');" class="sidebar-link">All Leave Requests</a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                        data-bs-target="#report" aria-expanded="false" aria-controls="report">
                        <i class="fa-solid fa-magnifying-glass" style="color: #ca2125;"></i>
                        <span>Reports</span>
                    </a>
                    <ul id="report" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                        <li class="sidebar-item">
                            <a href="#" onclick="$('#content').load('employee_leave_report.php')" class="sidebar-link">Leave Report</a>
                        </li>
                        <!-- <li class="sidebar-item">
                            <a href="#" onclick="$('#content').load('employee_task_report.php')" class="sidebar-link">Task Report</a>
                        </li> -->
                    </ul>
                </li>
            </ul>
            <div class="sidebar-footer">
                <a href="../logout.php" class="sidebar-link">
                    <i class="fa-solid fa-arrow-right-from-bracket" style="color: #ca2125;"></i>
                    <span><?php echo "$email"; ?></span>
                </a>
            </div>
        </aside>
        <div class="main">
            <header style="color:white; height: auto; min-height: 50px; background-color: rgba(212, 0, 0, 0.66); display: grid; grid-template-columns: auto 1fr auto; align-items: center; padding: 0 20px;" class=" container-fluid">
                <div>
                    <h1 style="margin: 0;"><a href="#" onclick="location.reload();" style="color: white;">EMPLOYEE MS</a></h1>
                </div>
                <div class="welcome-message" style="text-align: right; padding-right: 20px;">
                    Welcome Back: <?php echo "$email"; ?>
                </div>
                <div class="dropdown">
                    <img id="profileDropdown" class="dropdown-toggle profile-img rounded-circle shadow-sm" data-bs-toggle="dropdown" src="profile_pictures/<?php echo $employee['photo']; ?>" alt="dropdown-icon" style="width: 40px;">
                    <ul class="dropdown-menu" style="background-color: whitesmoke;">
                        <li><a class="dropdown-item" href="#" onclick="$('#content').load('employee_profile.php')">Profile</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="#" onclick="$('#content').load('employee_change_password.php')">Change Password</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="../logout.php">Log Out</a></li>
                    </ul>
                </div>
            </header>
            <div id="content">
                <?php include_once('employee_dashboard.php'); ?>
            </div>



        </div>
    </div>
    <style>
        @media screen and (max-width: 650px) {

            .welcome-message,
            .profile-img {
                display: none;
            }

            #sidebar {
                width: 50px;
                min-width: 50px;
            }

            a.sidebar-link {
                padding: .625rem 0.825rem;
            }

            .toggle-btn {
                padding: 1rem 1rem;
            }

            #sidebar:not(.expand) .sidebar-item .sidebar-dropdown {
                left: 50px;
            }
        }
    </style>
    <script>
        const hamBurger = document.querySelector(".toggle-btn");

        hamBurger.addEventListener("click", function() {
            document.querySelector("#sidebar").classList.toggle("expand");

        });
    </script>
    <script>
        $(document).ready(function() {
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.get('load') === 'newLeave') {
                $('#content').load('employee_new_leave_req.php');
            }
            // if (urlParams.get('load') === 'tasks') {
            //     $('#content').load('employee_tasks.php');
            // }
        });
    </script>
</body>

</html>