<?php
session_start();

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "my_database";

// Create a database connection (Procedural style)
$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

// Check for connection errors (Procedural style)
if (mysqli_connect_errno()) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    print_r($_POST);
    $employee_id = isset($_POST['employee_id']) ? trim($_POST['employee_id']) : null;
    $leave_type = isset($_POST['leave_type']) ? trim($_POST['leave_type']) : null;
    $from_date = isset($_POST['from_date']) ? trim($_POST['from_date']) : null;
    $to_date = isset($_POST['to_date']) ? trim($_POST['to_date']) : null;

    $errors = [];

    if (empty($employee_id)) {
        $errors[] = "Employee ID is missing.";
    }
    if (empty($leave_type)) {
        $errors[] = "Please select a leave type.";
    }
    if (empty($from_date)) {
        $errors[] = "Please select the 'From Date'.";
    }
    if (empty($to_date)) {
        $errors[] = "Please select the 'To Date'.";
    }
    if (!empty($from_date) && !empty($to_date) && strtotime($to_date) < strtotime($from_date)) {
        $errors[] = "'To Date' cannot be before 'From Date'.";
    }

    if (empty($errors)) {
        // Prepare the INSERT query (Procedural style)
        $q = "SELECT * FROM leaves WHERE leave_id = $leave_type";
        $row = $conn->query($q)->fetch_assoc();
        $stmt = mysqli_prepare($conn, "INSERT INTO `leave_requests`(`employee_id`, `leave_id`, `leave_type`, `from_date`, `to_date`, `posting_date`, `status`) VALUES (?, ?, ?, ?, ?, NOW(), 'New')");

        if ($stmt) {
            // Bind parameters (Procedural style)
            mysqli_stmt_bind_param($stmt, "sisss", $employee_id, $leave_type, $row['leave_name'], $from_date, $to_date);

            // Execute the query (Procedural style)
            if (mysqli_stmt_execute($stmt)) {
                $_SESSION['message'] = "Leave request submitted successfully!";
                $_SESSION['message_type'] = "success";
                header("Location: employee_panel.php?load=newLeave");
                exit();
            } else {
                $_SESSION['message'] = "Error submitting leave request: " . mysqli_stmt_error($stmt);
                $_SESSION['message_type'] = "danger";
                header("Location: employee_panel.php?load=newLeave");
                exit();
            }

            // Close the statement (Procedural style)
            mysqli_stmt_close($stmt);
        } else {
            $_SESSION['message'] = "Error preparing statement: " . mysqli_error($conn);
            $_SESSION['message_type'] = "danger";
            header("Location: employee_panel.php?load=newLeave");
            exit();
        }
    } else {
        $_SESSION['errors'] = $errors;
        header("Location: employee_panel.php?load=newLeave");
        exit();
    }
} else {
    header("Location: employee_panel.php?load=newLeave");
    exit();
}

// Close the database connection (Procedural style)
mysqli_close($conn);
