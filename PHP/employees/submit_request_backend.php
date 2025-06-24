<?php
session_start();
// Include the database connection file
include '../connect.php';

// Get task ID from query parameter
$taskId = $_POST['task_id'];
$sqltasks = "SELECT * FROM task_completion_requests WHERE TaskID = '$taskId'";
$result = $con->query($sqltasks)->fetch_assoc();
if ($result) {
    $_SESSION['submission_message'] = '<div class="alert alert-danger">Request already exists.</div>';
    header("Location: employee_panel.php?load=tasks");
    exit();
} else {
    $empmail = $_SESSION['email'];
    $q = "SELECT * FROM employee WHERE email = '$empmail'";
    $row = $con->query($q)->fetch_assoc();
    $employeeId = $row['id'];
    print_r($row);
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $requestDescription = $_POST['request_description'];
        print_r($_POST);
        error_log("Request Description: " . $requestDescription);

        $sql = "INSERT INTO task_completion_requests (TaskID, EmployeeID, RequestDescription) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($con, $sql);
        mysqli_stmt_bind_param($stmt, "iis", $taskId, $employeeId, $requestDescription);

        if (mysqli_stmt_execute($stmt)) {
            $_SESSION['submission_message'] = '<div class="alert alert-success">Request submitted successfully!</div>';
            echo "success";
            header("Location: employee_panel.php?load=tasks");
        } else {
            error_log("MySQL Error: " . mysqli_error($con) . ". Query: " . $sql);
            $_SESSION['submission_message'] = '<div class="alert alert-danger">Error submitting request.</div>';
            echo "error";
            header("Location: employee_panel.php?load=tasks");
        }

        mysqli_stmt_close($stmt);
        mysqli_close($con);
        exit;
    }
}
