<?php
session_start();
include_once("../config.php");
if (!isset($_SESSION["user_id"])) {
    header("Location: ../login.php");
    exit();
}

$email = $_SESSION["email"];
include_once("../connect.php");
$q = "SELECT * FROM employee where email = '$email'";
$row = $con->query($q)->fetch_assoc();
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
            background-color: rgba(0, 0, 0, 0.2);
            padding: 0px;
        }

        #sidebar {
            width: 70px;
            min-width: 70px;
            z-index: 1000;
            transition: all .25s ease-in-out;
            background-color: white;
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
            color: #ca2125;
        }

        .sidebar-logo {
            margin: auto 0;
        }

        .sidebar-logo a {
            color: #ca2125;
            font-size: 1.15rem;
            font-weight: 600;
        }

        #sidebar:not(.expand) .sidebar-logo,
        #sidebar:not(.expand) a.sidebar-link span {
            display: none;
        }

        .sidebar-nav {
            padding: 0 0 0;
            flex: 1 1 auto;
        }

        a.sidebar-link {
            padding: .625rem 1.625rem;
            color: #ca2125;
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
            background-color: white;
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
                    <a href="#" onclick="$('#content').load('admin_profile.php')"><?php echo "$email"; ?></a>
                </div>
            </div>
            <ul class="sidebar-nav">
                <li class="sidebar-item" style="padding: 7px;">
                    <img src="profile_pictures/<?php echo $row['photo']; ?>" alt="image not loaded" class="img-fluid rounded-circle shadow-lg">
                </li>
                <li class="sidebar-item">
                    <a href="#" onclick="$('#content').load('admin_dashboard.php')" class="sidebar-link">
                        <i class="fa-solid fa-chart-line" style="color: #ca2125;"></i> <span>Dashboard</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="#" onclick="$('#content').load('admin_profile.php')" class="sidebar-link">
                        <i class="fa-solid fa-id-card" style="color: #ca2125;"></i> <span>Profile</span>
                    </a>
                </li>
                <!-- <li class="sidebar-item">
                    <a href="#" class="sidebar-link">
                        <i class="lni lni-agenda"></i>
                        <span>Task</span>
                    </a>
                </li> -->
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                        data-bs-target="#dept" aria-expanded="false" aria-controls="dept">
                        <i class="fa-regular fa-building" style="color: #ca2125; padding-left: 3px;"></i>
                        <span>Department</span>
                    </a>
                    <ul id="dept" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                        <li class="sidebar-item">
                            <a href="#" onclick="$('#content').load('admin_add_dep.php');" class="sidebar-link">Add Department</a>
                        </li>
                        <li class="sidebar-item">
                            <a href="#" onclick="$('#content').load('admin_manage_dep.php')" class="sidebar-link">Manage Department</a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                        data-bs-target="#leave" aria-expanded="false" aria-controls="leave">
                        <i class="fa-solid fa-laptop" style="color: #ca2125;"></i>
                        <span>Leave Type</span>
                    </a>
                    <ul id="leave" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                        <li class="sidebar-item">
                            <a href="#" onclick="$('#content').load('admin_add_leave.php')" class="sidebar-link">Add Leave Type</a>
                        </li>
                        <li class="sidebar-item">
                            <a href="#" onclick="$('#content').load('admin_manage_leave.php')" class="sidebar-link">Manage Leave Type</a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                        data-bs-target="#emp" aria-expanded="false" aria-controls="emp">
                        <i class="fa-solid fa-users" style="color: #ca2125;"></i> <span>Employee</span>
                    </a>
                    <ul id="emp" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                        <li class="sidebar-item">
                            <a href="#" onclick="$('#content').load('admin_add_employee.php');" class="sidebar-link">Add Employee</a>
                        </li>
                        <li class="sidebar-item">
                            <a href="#" onclick="$('#content').load('admin_manage_employee.php');" class="sidebar-link">Manage Employee</a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item">
                    <a href="#" onclick="$('#content').load('admin_manage_salary.php')" class="sidebar-link">
                        <i class="fa-solid fa-sack-dollar" style="color: #ca2125;"></i> <span>Manage Salary</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                        data-bs-target="#lreq" aria-expanded="false" aria-controls="lreq">
                        <i class="fa-solid fa-paperclip" style="color: #ca2125;"></i> <span>Leave Requests</span>
                    </a>
                    <ul id="lreq" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                        <li class="sidebar-item">
                            <a href="#" onclick="$('#content').load('admin_new_req.php');" class="sidebar-link">New Leave Requests</a>
                        </li>
                        <li class="sidebar-item">
                            <a href="#" onclick="$('#content').load('admin_approved_req.php');" class="sidebar-link">Approved Leave Requests</a>
                        </li>
                        <li class="sidebar-item">
                            <a href="#" onclick="$('#content').load('admin_rejected_req.php');" class="sidebar-link">Rejected Leave Requests</a>
                        </li>
                        <li class="sidebar-item">
                            <a href="#" onclick="$('#content').load('admin_all_req.php');" class="sidebar-link">All Leave Requests</a>
                        </li>
                    </ul>
                </li>
                <!-- <li class="sidebar-item">
                    <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                        data-bs-target="#task" aria-expanded="false" aria-controls="task">
                        <i class="fa-brands fa-stack-overflow" style="color: #ca2125;"></i> <span>Tasks</span>
                    </a>
                    <ul id="task" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                        <li class="sidebar-item">
                            <a href="#" onclick="$('#content').load('admin_task_req.php')" class="sidebar-link">Task Completion Requests</a>
                        </li>
                        <li class="sidebar-item">
                            <a href="#" onclick="$('#content').load('admin_add_tasks.php')" class="sidebar-link">Assign Task</a>
                        </li>
                        <li class="sidebar-item">
                            <a href="#" onclick="$('#content').load('admin_manage_tasks.php')" class="sidebar-link">Manage Tasks</a>
                        </li>
                    </ul>
                </li> -->
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                        data-bs-target="#report" aria-expanded="false" aria-controls="report">
                        <i class="fa-solid fa-magnifying-glass" style="color: #ca2125;"></i> <span>Reports</span>
                    </a>
                    <ul id="report" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                        <li class="sidebar-item">
                            <a href="#" onclick="$('#content').load('admin_leave_report.php')" class="sidebar-link">Leave Report</a>
                        </li>
                        <!-- <li class="sidebar-item">
                            <a href="#" onclick="$('#content').load('admin_task_report.php')" class="sidebar-link">Task Report</a>
                        </li> -->
                    </ul>
                </li>
                <li class="sidebar-item">
                    <a href="#" onclick="$('#content').load('admin_contact.php')" class="sidebar-link">
                        <i class="fa-solid fa-address-book" style="color: #ca2125;"></i><span>Contact Request</span>
                    </a>
                </li>
            </ul>
            <div class="sidebar-footer">
                <a href="../logout.php" class="sidebar-link">
                    <i class="fa-solid fa-arrow-right-from-bracket" style="color: #ca2125;"></i> <span><?php echo "$email"; ?></span>
                </a>
            </div>
        </aside>
        <div class="main">
            <header style="color:white; height: auto; min-height: 50px; display: grid; grid-template-columns: auto 1fr auto; align-items: center; padding: 0 20px; background-color: rgba(212, 0, 0, 0.66);" class="container-fluid">
                <div>
                    <h1 style="margin: 0;"><a href="admin_panel.php" style="color: white;">EMPLOYEE MS</a></h1>
                </div>
                <div class="welcome-message" style="text-align: right; padding-right: 20px;">
                    Welcome Back: <?php echo "$email"; ?>
                </div>
                <div class="dropdown">
                    <img id="profileDropdown" class="dropdown-toggle profile-img rounded-circle" data-bs-toggle="dropdown" src="profile_pictures/<?php echo $row['photo']; ?>" alt="dropdown-icon" style="width: 40px;">
                    <ul class="dropdown-menu" style="background-color: white;">
                        <li><a class="dropdown-item" href="#" onclick="$('#content').load('admin_profile.php')">Profile</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="#" onclick="$('#content').load('admin_change_password.php');">Change Password</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="../logout.php">Log Out</a></li>
                    </ul>
                </div>
            </header>
            <div id="content">
                <?php include_once('admin_dashboard.php'); ?>
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
        $(document).ready(function() {
            // Check if 'load=employee' is in the URL
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.get('load') === 'employee') {
                $('#content').load('admin_add_employee.php');
            }
            if (urlParams.get('load') === 'manEmployee') {
                $('#content').load('admin_manage_employee.php');
            }
            if (urlParams.get('load') === 'department') {
                $('#content').load('admin_add_dep.php');
            }
            if (urlParams.get('load') === 'manDepartment') {
                $('#content').load('admin_manage_dep.php');
            }
            if (urlParams.get('load') === 'manLeave') {
                $('#content').load('admin_manage_leave.php');
            }
            if (urlParams.get('load') === 'leaveReq') {
                $('#content').load('admin_all_req.php');
            }
            if (urlParams.get('load') === 'newLeaveReq') {
                $('#content').load('admin_new_req.php');
            }
            // if (urlParams.get('load') === 'task') {
            //     $('#content').load('admin_add_tasks.php');
            // }
            if (urlParams.get('load') === 'manTasks') {
                $('#content').load('admin_manage_tasks.php');
            }
        });
    </script>
    <script>
        const hamBurger = document.querySelector(".toggle-btn");

        hamBurger.addEventListener("click", function() {
            document.querySelector("#sidebar").classList.toggle("expand");

        });
    </script>
</body>

</html>