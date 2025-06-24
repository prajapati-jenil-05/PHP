<?php
session_start();

// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "my_database";

// Create connection using mysqli_connect
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get employee ID (you'll need to get this from session or login)
$empemail = $_SESSION['email'];

// Corrected query using prepared statement.
$sql_employee = "SELECT id, firstname FROM employee WHERE email = ?";
$stmt_employee = mysqli_prepare($conn, $sql_employee);
mysqli_stmt_bind_param($stmt_employee, "s", $empemail); // "s" indicates string
mysqli_stmt_execute($stmt_employee);
$result_employee = mysqli_stmt_get_result($stmt_employee);
$employee = mysqli_fetch_assoc($result_employee);
mysqli_stmt_close($stmt_employee);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Tasks - Employee Portal</title>
    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            margin-top: 30px;
        }

        .task-card {
            border: 1px solid #ced4da;
            border-radius: 8px;
            margin-bottom: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }

        .task-card-header {
            background-color: #007bff;
            color: white;
            padding: 15px;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
        }

        .task-card-body {
            padding: 15px;
        }

        .task-details p {
            margin-bottom: 8px;
        }

        .task-actions a {
            margin-right: 10px;
        }

        #resultMessage {
            margin-bottom: 20px;
            /* padding: 15px; */
            /* border-radius: 8px; */
        }

        .alert-success {
            background-color: #d4edda;
            border-color: #c3e6cb;
            color: #155724;
        }

        .alert-danger {
            background-color: #f8d7da;
            border-color: #f5c6cb;
            color: #721c24;
        }
    </style>
</head>

<body>
    <div class="container">
        <div id="resultMessage">
            <?php
            if (isset($_SESSION['submission_message'])) {
                echo '<div class="alert" role="alert">' . $_SESSION['submission_message'] . '</div>';
                unset($_SESSION['submission_message']); // Clear the session message
            }
            ?>
        </div>

        <?php if ($employee): ?>
            <h2 class="mb-4">Welcome, <?php echo htmlspecialchars($employee['firstname']); ?>!</h2>
            <h3>Your Assigned Tasks</h3>

            <?php
            // Query tasks for the employee
            $sql_tasks = "SELECT * FROM tasks WHERE employee_id = ?";
            $stmt_tasks = mysqli_prepare($conn, $sql_tasks);
            mysqli_stmt_bind_param($stmt_tasks, "i", $employee['id']); // "i" indicates integer
            mysqli_stmt_execute($stmt_tasks);
            $result_tasks = mysqli_stmt_get_result($stmt_tasks);

            if (mysqli_num_rows($result_tasks) > 0):
                while ($row_tasks = mysqli_fetch_assoc($result_tasks)):
            ?>
                    <div class="task-card">
                        <div class="task-card-header">
                            Task ID: <?php echo htmlspecialchars($row_tasks["TaskID"]); ?>
                        </div>
                        <div class="task-card-body">
                            <div class="task-details">
                                <h4><?php echo htmlspecialchars($row_tasks["Title"]); ?></h4>
                                <p><strong>Description:</strong> <?php echo htmlspecialchars($row_tasks["TaskDescription"]); ?></p>
                                <p><strong>Start Time:</strong> <?php echo htmlspecialchars($row_tasks["StartTime"]); ?></p>
                                <p><strong>End Time:</strong> <?php echo htmlspecialchars($row_tasks["EndTime"]); ?></p>
                                <p><strong>Status:</strong> <?php echo htmlspecialchars($row_tasks["Status"]); ?></p>
                            </div>
                            <div class="task-actions">
                                <button class="btn btn-primary btn-sm" onclick="$('#content').load('submit_request.php?task_id=<?php echo htmlspecialchars($row_tasks["TaskID"]); ?>');">
                                    <i class="fas fa-check-circle me-1"></i> Submit Completion
                                </button>
                            </div>
                        </div>
                    </div>
                <?php
                endwhile;
            else:
                ?>
                <div class="alert alert-info" role="alert">
                    You have no tasks assigned at the moment.
                </div>
            <?php endif; ?>
            <?php mysqli_stmt_close($stmt_tasks); ?>

        <?php else: ?>
            <div class="alert alert-danger" role="alert">
                Employee not found.
            </div>
        <?php endif; ?>

        <div id="content">
        </div>
    </div>

    <?php mysqli_close($conn); ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>