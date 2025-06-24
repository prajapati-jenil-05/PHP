<?php
// Database credentials
$servername = "localhost";
$username = "root";
$password = "";
$database = "my_database";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die(json_encode(["error" => "Connection failed: " . $conn->connect_error]));
}

// SQL query to count employees
$sqlEmployee = "SELECT COUNT(id) AS employee_count FROM employee";

// Execute query
$result = $conn->query($sqlEmployee);

// Check if query execution was successful
if ($result === false) {
    die(json_encode(["error" => "Query failed: " . $conn->error]));
}

// Fetch the result
$row = $result->fetch_assoc();

// Store the employee count in a variable
$employeeCount = $row['employee_count'];

$sqlDepartment = "SELECT COUNT(dep_id) AS department_count FROM department";

// Execute query
$result = $conn->query($sqlDepartment);

// Check if query execution was successful
if ($result === false) {
    die(json_encode(["error" => "Query failed: " . $conn->error]));
}

// Fetch the result
$row = $result->fetch_assoc();

// Store the employee count in a variable
$departmentCount = $row['department_count'];

// $sqlTask = "SELECT COUNT(TaskID) AS task_count FROM tasks where Status = 'Not Started' OR Status = 'In Progress'";

// // Execute query
// $result = $conn->query($sqlTask);

// // Check if query execution was successful
// if ($result === false) {
//     die(json_encode(["error" => "Query failed: " . $conn->error]));
// }

// // Fetch the result
// $row = $result->fetch_assoc();

// // Store the employee count in a variable
// $taskCount = $row['task_count'];

$sqlLeaves = "SELECT COUNT(leave_Id) AS leave_count FROM leave_requests WHERE STATUS = 'New';";

// Execute query
$result = $conn->query($sqlLeaves);

// Check if query execution was successful
if ($result === false) {
    die(json_encode(["error" => "Query failed: " . $conn->error]));
}

// Fetch the result
$row = $result->fetch_assoc();

// Store the employee count in a variable
$leaveCount = $row['leave_count'];

// Close connection
$conn->close();
?>
<style>
    .border-left-primary {
        border-left: .25rem solid #4e73df !important;
    }

    .border-bottom-primary {
        border-bottom: .25rem solid #4e73df !important
    }

    .border-left-secondary {
        border-left: .25rem solid #858796 !important
    }

    .border-bottom-secondary {
        border-bottom: .25rem solid #858796 !important
    }

    .border-left-success {
        border-left: .25rem solid #1cc88a !important
    }

    .border-bottom-success {
        border-bottom: .25rem solid #1cc88a !important
    }

    .border-left-info {
        border-left: .25rem solid #36b9cc !important
    }

    .border-bottom-info {
        border-bottom: .25rem solid #36b9cc !important
    }

    .border-left-warning {
        border-left: .25rem solid #f6c23e !important
    }

    .border-bottom-warning {
        border-bottom: .25rem solid #f6c23e !important
    }

    .border-left-danger {
        border-left: .25rem solid #e74a3b !important
    }

    .border-bottom-danger {
        border-bottom: .25rem solid #e74a3b !important
    }

    .border-left-light {
        border-left: .25rem solid #f8f9fc !important
    }

    .border-bottom-light {
        border-bottom: .25rem solid #f8f9fc !important
    }

    .border-left-dark {
        border-left: .25rem solid #5a5c69 !important
    }

    .border-bottom-dark {
        border-bottom: .25rem solid #5a5c69 !important
    }
</style>
<br>
<h1 style="padding: 0 20px 0 20px;">Dashboard</h1>
<div class="row" style="padding: 5px 20px 0 20px;">
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            <a href="admin_panel.php?load=manEmployee" style="text-decoration: none;">Registered Employees</a>
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $employeeCount; ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Annual) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1">
                            <a href="admin_panel.php?load=manDepartment" class="text-success" style="text-decoration: none;">listed departments</a>
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $departmentCount; ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-regular fa-building fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-danger shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1">
                            <a href="admin_panel.php?load=manTasks" class="text-danger" style="text-decoration: none;">Task Pending</a>
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $taskCount; ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-brands fa-stack-overflow fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div> -->


    <!-- Pending Requests Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-uppercase mb-1">
                            <a href="admin_panel.php?load=newLeaveReq" class="text-warning" style="text-decoration: none;">Pending New Leave Requests</a>
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $leaveCount; ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-comments fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>